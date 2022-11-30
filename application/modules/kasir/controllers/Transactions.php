<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		verify_session('kasir');

		$this->load->library('form_validation');
		// panggil library yang kita buat sebelumnya yang bernama pdfgenerator
		$this->load->library('pdfgenerator');
		$this->load->model(array(
			'transaction_model' => 'transaction'
		));
	}

	public function index()
	{
		$params['title'] = 'Transaksi Saya';
		$params['active_page'] = 'transaksi';

		$transactions['nota'] = $this->transaction->get_all_my_transactions();

		$this->load->view('header', $params);
		$this->load->view('transactions/transactions', $transactions);
		$this->load->view('footer');
	}

	public function view($id = 0)
	{
		if ($this->order->is_order_exist($id)) {
			$data = $this->order->order_data($id);
			$items = $this->order->order_items($id);
			$banks = json_decode(get_settings('payment_banks'));
			$banks = (array) $banks;

			$params['title'] = 'Order #' . $data->order_number;

			$order['data'] = $data;
			$order['items'] = $items;
			$order['delivery_data'] = json_decode($data->delivery_data);
			$order['banks'] = $banks;

			$this->load->view('header', $params);
			$this->load->view('orders/view', $order);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	public function transaction_api()
	{
		$action = $this->input->get('action');
		switch ($action) {
			case 'my_nota':
				$transactions['data'] = $this->transaction->get_all_my_transactions();

				$response = $transactions;
				break;
			case 'my_nota_for_api':
				$transactions['data'] = $this->transaction->get_all_my_transactions_for_api();

				$response = $transactions;
				break;
			case 'delete_nota':
				$id_nota = $this->input->post('id_nota');

				$this->transaction->delete_nota($id_nota);

				$response = array('code' => 204);
				break;
			case 'cancel_order':
				$id = $this->input->post('id');
				$data = $this->order->order_data($id);

				if (($data->payment_method == 1 && $data->order_status == 1) || ($data->payment_method == 2 && $data->order_status == 1)) {
					$this->order->cancel_order($id);
					$response = array('code' => 200, 'success' => TRUE, 'message' => 'Order dibatalkan');
				} else {
					$response = array('code' => 200, 'error' => TRUE, 'message' => 'Order tidak dapat dibatalkan');
				}
				break;
			case 'orders':
				$reviews['data'] = $this->order->get_all_orders_for_api();

				$response = $reviews;
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}

	public function add_new_nota()
	{
		$params['title'] = 'Tambah Nota Baru';
		$params['active_page'] = 'transaksi';

		$nota['flash'] = $this->session->flashdata('add_new_nota_flash');
		$nota['last_id'] = $this->transaction->get_last_nota_id();

		if (!$nota['last_id']) {
			$nota['last_id'] = new \stdClass();
			$nota['last_id']->nota_id = date('Ymd') . '00';
		}

		$this->load->view('header', $params);
		$this->load->view('transactions/add_new_nota', $nota);
		$this->load->view('footer');
	}

	public function edit_nota($id_nota = '')
	{
		if ($this->transaction->is_nota_exist($id_nota)) {
			$params['title'] = 'Edit Nota';
			$params['active_page'] = 'transaksi';

			$nota['flash'] = $this->session->flashdata('edit_nota_flash');
			$nota['nota_id'] = $id_nota;
			$nota['total_nota'] = $this->transaction->get_total_sum_nota_products($id_nota);

			$this->load->view('header', $params);
			$this->load->view('transactions/edit_nota', $nota);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	public function retur_nota($id_nota = '')
	{
		if ($this->transaction->is_nota_exist($id_nota)) {
			$params['title'] = 'Retur Nota';
			$params['active_page'] = 'transaksi';

			$nota['flash'] = $this->session->flashdata('retur_nota_flash');
			$nota['nota_id'] = $id_nota;
			$nota['total_nota'] = $this->transaction->get_total_sum_nota_products($id_nota);

			$this->load->view('header', $params);
			$this->load->view('transactions/retur_nota', $nota);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	#KELOLA BARANG
	public function product_api()
	{
		$action = $this->input->get('action');

		switch ($action) {
			case 'list':
				// $products['data'] = $this->transaction->get_all_products();
				$products['data'] = $this->transaction->get_all_avail_products();
				$response = $products;
				break;
			case 'search':
				$term = $this->input->post('term');
				// $products['data'] = $this->transaction->get_all_products();
				$products['data'] = $this->transaction->search_all_avail_products($term);
				$response = $products;
				break;
			case 'get_data':
				$id = $this->input->get('id_barang');

				$data['data'] = $this->transaction->get_product_data($id);
				$response = $data;
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}

	public function cetak_nota($id_nota=''){
    
		$is_exist_and_match=$this->transaction->is_nota_exist_and_kasir_match($id_nota);

		if($is_exist_and_match){
			
			// title dari pdf
			$data['title_pdf'] = 'Nota Penjualan';
			// filename dari pdf ketika didownload
			$filename = 'Nota '.$id_nota;
			// setting paper
			$paper = 'A4';
			// $paper = array(0, 0, 226.77, 326.19);

			//orientasi paper potrait / landscape
			$orientation = "portrait";
	
			$data['nota'] = $this->transaction->nota_data_for_report($id_nota);
			$data['barang_nota'] = $this->transaction->get_all_nota_products_for_report($id_nota);
			$data['total_biaya_nota'] = $this->transaction->get_total_sum_nota_products_for_report($id_nota);
			
			$html = $this->load->view('transactions/nota_pdf', $data, true);	    
			
			// run dompdf
			$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
		}else{
			show_404();
		}
	}

	public function cetak_nota_80($id_nota=''){
    
		$is_exist_and_match=$this->transaction->is_nota_exist_and_kasir_match($id_nota);

		if($is_exist_and_match){
						
			$data['nota'] = $this->transaction->nota_data_for_report($id_nota);
			$data['barang_nota'] = $this->transaction->get_all_nota_products_for_report($id_nota);
			$data['total_biaya_nota'] = $this->transaction->get_total_sum_nota_products_for_report($id_nota);
			
			$jumlah_barang = $this->transaction->jumlah_barang_di_nota($id_nota);
			$jumlah_barang = $jumlah_barang > 1 ? $jumlah_barang : 0;

			// title dari pdf
			$data['title_pdf'] = 'Nota Penjualan';
			// filename dari pdf ketika didownload
			$filename = 'Nota '.$id_nota;
			// setting paper
			$paper = array( 0 , 0 , 226.77 , 410 + (25*$jumlah_barang)) ;
			// $paper = array(0, 0, 226.77, 326.19);

			//orientasi paper potrait / landscape
			$orientation = "portrait";
			$html = $this->load->view('transactions/nota80_pdf', $data, true);	    
			
			// run dompdf
			$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
		}else{
			show_404();
		}
	}
	// 
	// disini
	// 

	public function api($action = '')
	{
		$action = $this->input->get('action');
		switch ($action) {
			case 'list_nota_products':
				$nomor_nota = $this->input->get('nomor_nota');

				$orders['data'] = $this->transaction->get_all_nota_products($nomor_nota);

				$response = $orders;
				break;
			case 'add_nota':
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

				$this->form_validation->set_rules('nomor_nota', 'Nomor Nota', 'required|is_unique[tb_nota.nota_id]');
				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');


				if ($this->form_validation->run() === FALSE) {
					$this->index();
					$response = array('code' => 409);
					
					if (form_error('nomor_nota')) {
						$response['id_error'] = form_error('nomor_nota');
					}
				} else {
					$id_nota = $this->input->post('nomor_nota');
					$tgl_nota = $this->input->post('tanggal_nota');
					$nama_pembeli = $this->input->post('nama_pembeli');
					$no_plat = $this->input->post('no_plat');
					$status = 'belum_selesai';

					$data = array(
						'nota_id' => $id_nota,
						'nota_tgl' => $tgl_nota,
						'nota_pembeli' => $nama_pembeli,
						'nota_plat' => $no_plat,
						'nota_idksr' => get_current_user_id(),
						'nota_status' => $status,
					);

					$this->transaction->add_new_nota($data);
					$notas['code'] = 201; //nota berhasil disimpan
					$response = $notas;
				}
				break;
			case 'delete_nota':
				$id_nota = $this->input->post('id_nota');

				$this->transaction->delete_nota($id_nota);

				$response = array('code' => 204);
				break;
			case 'add_product':
				$jual_idnota = $this->input->post('idnota_pesanan');
				$jual_idbrg = $this->input->post('idbrg_pesanan');
				$jual_jumlahbrg = $this->input->post('jumlah_pesanan');
				$jual_diskon = $this->input->post('diskon_pesanan');

				$is_unique = $this->transaction->is_nota_brg_unique($jual_idnota, $jual_idbrg);

				if ($is_unique) {
					$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
					$this->form_validation->set_rules('idnota_pesanan', 'Id Nota', 'required');
					$this->form_validation->set_rules('idbrg_pesanan', 'Id Barang', 'required');

					if ($this->form_validation->run() === FALSE) {
						$this->index();
						$response = array('code' => 409);
					} else {

						$data = array(
							'jual_idnota' => $jual_idnota,
							'jual_jumlahbrg' => $jual_jumlahbrg,
							'jual_idbrg' => $jual_idbrg,
							'jual_diskon' => $jual_diskon,
						);

						$this->transaction->add_new_nota_product($data);
						$nota['code'] = 201; //berhasil ditambah
						$nota['total_nota'] = $this->transaction->get_total_sum_nota_products($jual_idnota);
						$response = $nota;
					}
				} else if ($jual_idbrg == null) {
					//kalau datanya kosong
					$response = array('code' => 409);
				} else {
					//kalau barnagnya double/sudah ada di list
					$response = array('code' => 500);
				}

				break;
				case 'add_product_retur':
					$jual_idnota = $this->input->post('idnota_pesanan');
					$jual_idbrg = $this->input->post('idbrg_pesanan');
					$jual_jumlahbrg = $this->input->post('jumlah_pesanan');
					$jual_diskon = $this->input->post('diskon_pesanan');
	
					$is_unique = $this->transaction->is_nota_brg_unique($jual_idnota, $jual_idbrg);
	
					if ($is_unique) {
						$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
						$this->form_validation->set_rules('idnota_pesanan', 'Id Nota', 'required');
						$this->form_validation->set_rules('idbrg_pesanan', 'Id Barang', 'required');
	
						if ($this->form_validation->run() === FALSE) {
							$this->index();
							$response = array('code' => 409);
						} else {
	
							$data = array(
								'jual_idnota' => $jual_idnota,
								'jual_jumlahbrg' => $jual_jumlahbrg,
								'jual_idbrg' => $jual_idbrg,
								'jual_diskon' => $jual_diskon,
							);
	
							$this->transaction->add_new_nota_product_retur($data);
							$nota['code'] = 201; //berhasil ditambah
							$nota['total_nota'] = $this->transaction->get_total_sum_nota_products($jual_idnota);
							$response = $nota;
						}
					} else if ($jual_idbrg == null) {
						//kalau datanya kosong
						$response = array('code' => 409);
					} else {
						//kalau barnagnya double/sudah ada di list
						$response = array('code' => 500);
					}
	
					break;
			case 'edit_product_quantity':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idnota_pesanan = $this->input->post('idnota_pesanan');
				$jumlah_pesanan = $this->input->post('jumlah_pesanan');
				$diskon_pesanan = $this->input->post('diskon_pesanan');

				$is_stock_enough = $this->transaction->check_stock($idnota_pesanan, $idbrg_pesanan, $jumlah_pesanan);

				if ($is_stock_enough) {
					$this->transaction->update_product_qty($idnota_pesanan, $idbrg_pesanan, $jumlah_pesanan, $diskon_pesanan);

					$total_nota = $this->transaction->get_total_sum_nota_products($idnota_pesanan);
					$response = array('code' => 201, 'total_nota' => $total_nota, 'message' => 'Barang berhasil diperbarui');
				} else {
					$response = array('code' => 409);
				}
				break;
				case 'edit_product_quantity_retur':
					$idbrg_pesanan = $this->input->post('idbrg_pesanan');
					$idnota_pesanan = $this->input->post('idnota_pesanan');
					$jumlah_pesanan = $this->input->post('jumlah_pesanan');
					$diskon_pesanan = $this->input->post('diskon_pesanan');
	
					//$is_stock_enough = $this->transaction->check_stock_retur($idnota_pesanan, $idbrg_pesanan, $jumlah_pesanan); //validasi stok diserahkan di depan dengan Javascript
	
					// if ($is_stock_enough) {
						$this->transaction->update_product_qty_retur($idnota_pesanan, $idbrg_pesanan, $jumlah_pesanan, $diskon_pesanan);
	
						$total_nota = $this->transaction->get_total_sum_nota_products($idnota_pesanan);
						$response = array('code' => 201, 'total_nota' => $total_nota, 'message' => 'Barang berhasil diperbarui');
					// } else {
					// 	$response = array('code' => 409);
					// }
					break;
			case 'delete_product':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idnota_pesanan = $this->input->post('idnota_pesanan');

				$this->transaction->delete_product($idnota_pesanan, $idbrg_pesanan);

				$total_nota = $this->transaction->get_total_sum_nota_products($idnota_pesanan);
				$response = array('code' => 204, 'total_nota' => $total_nota);
				break;
			case 'retur_delete_product':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idnota_pesanan = $this->input->post('idnota_pesanan');

				$this->transaction->delete_product_retur($idnota_pesanan, $idbrg_pesanan);

				$total_nota = $this->transaction->get_total_sum_nota_products($idnota_pesanan);
				$response = array('code' => 204, 'total_nota' => $total_nota);
				break;
			case 'view_product':
				$idbrg = $this->input->get('idbrg');
				$idnota = $this->input->get('idnota');

				$data['data'] = $this->transaction->product_data($idnota, $idbrg);
				$response = $data;
				break;
			case 'edit_product':
				$idbrg_pesanan = $this->input->post('edit_idbrg_pesanan');
				$idnota_pesanan = $this->input->post('edit_idnota_pesanan');
				$jumlah_pesanan = $this->input->post('edit_jumlah_pesanan');
				$diskon_pesanan = $this->input->post('edit_diskon_pesanan');

				$this->transaction->edit_product_qty($idnota_pesanan, $idbrg_pesanan, $jumlah_pesanan, $diskon_pesanan);

				$total_nota = $this->transaction->get_total_sum_nota_products($idnota_pesanan);
				$response = array('code' => 201, 'total_nota' => $total_nota, 'message' => 'Barang berhasil diperbarui');
				break;
				case 'edit_product_retur':
					$idbrg_pesanan = $this->input->post('edit_idbrg_pesanan');
					$idnota_pesanan = $this->input->post('edit_idnota_pesanan');
					$jumlah_pesanan = $this->input->post('edit_jumlah_pesanan');
					$jumlah_pesanan_lama = $this->input->post('edit_jumlah_pesanan_lama');
					$diskon_pesanan = $this->input->post('edit_diskon_pesanan');

					$selisih_pesanan = $jumlah_pesanan - $jumlah_pesanan_lama;
	
					$this->transaction->edit_product_qty_retur($idnota_pesanan, $idbrg_pesanan, $jumlah_pesanan, $diskon_pesanan, $selisih_pesanan);
	
					$total_nota = $this->transaction->get_total_sum_nota_products($idnota_pesanan);
					$response = array('code' => 201, 'total_nota' => $total_nota, 'message' => 'Barang berhasil diperbarui');
					break;
			case 'save_nota':
				$id_nota = $this->input->post('id_nota');
				$tgl_nota = $this->input->post('tgl_nota');
				$nama_pembeli = $this->input->post('nama_pembeli');
				$no_plat = $this->input->post('no_plat');

				$data = array(
					'nota_tgl' => $tgl_nota,
					'nota_pembeli' => $nama_pembeli,
					'nota_plat' => $no_plat,
					'nota_status' => 'selesai'
				);

				$this->transaction->save_nota($id_nota, $data);
				$response = array('code' => 201, 'message' => 'Data PO berhasil disimpan sementara');
				break;
			case 'view_data_nota':
				$id_nota = $this->input->get('id_nota');

				$data['data'] = $this->transaction->nota_data($id_nota);
				$response = $data;
				break;

			case 'permanent_save_po':
				$id_po = $this->input->post('id_po');

				$no_fak = $this->input->post('no_fak');
				$tgl_fak = $this->input->post('tgl_fak');
				$jatuh_tempo = $this->input->post('jatuh_tempo');

				$data = array(
					'po_nofak' => $no_fak,
					'po_tglfak' => $tgl_fak,
					'po_tgljatuhtempo' => $jatuh_tempo,
					'po_status' => 'permanen',
				);

				$this->order->permanent_save_po($id_po, $data);
				$response = array('code' => 201, 'message' => 'Data PO berhasil disimpan sementara');
				break;

			case 'check_unique':
				$beli_idpo = $this->input->post('idpo_pesanan');
				$beli_idbrg = $this->input->post('idbrg_pesanan');

				$is_unique = $this->order->is_po_brg_unique($beli_idpo, $beli_idbrg);

				$response = array('code' => 201, 'is_unique' => $is_unique);
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}
}
