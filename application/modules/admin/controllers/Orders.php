<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		verify_session('admin');

		$this->load->library('form_validation');
		$this->load->library('pdfgenerator');
		$this->load->model(array(
			'order_model' => 'order',
			'supplier_model' => 'supplier'
		));
	}

	public function index()
	{
		$params['title'] = 'Kelola Purchase Order';
		$params['active_page'] = 'po';

		// $config['base_url'] = site_url('admin/orders/index');
		// $config['total_rows'] = $this->order->count_all_orders();
		// $config['per_page'] = 10;
		// $config['uri_segment'] = 4;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = floor($choice);

		// $config['first_link']       = '«';
		// $config['last_link']        = '»';
		// $config['next_link']        = '›';
		// $config['prev_link']        = '‹';
		// $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		// $config['full_tag_close']   = '</ul></nav></div>';
		// $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		// $config['num_tag_close']    = '</span></li>';
		// $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		// $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		// $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		// $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		// $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		// $config['prev_tagl_close']  = '</span>Next</li>';
		// $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		// $config['first_tagl_close'] = '</span></li>';
		// $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		// $config['last_tagl_close']  = '</span></li>';

		// $this->load->library('pagination', $config);
		// $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$orders['po'] = $this->order->get_all_orders();
		// $orders['pagination'] = $this->pagination->create_links();

		$this->load->view('header', $params);
		$this->load->view('orders/orders', $orders);
		$this->load->view('footer');
	}

	public function add_new_po()
	{
		$params['title'] = 'Tambah Purchase Order Baru';
		$params['active_page'] = 'po';

		$po['flash'] = $this->session->flashdata('add_new_po_flash');
		$po['suppliers'] = $this->supplier->get_all_suppliers();
		$po['last_id'] = $this->order->get_last_po_id();


		if (!$po['last_id']) {
			$po['last_id'] = new \stdClass();
			$po['last_id']->po_id = date('Ym') . '0000';
		}

		$this->load->view('header', $params);
		$this->load->view('orders/add_new_po', $po);
		$this->load->view('footer');
	}

	public function edit_po($id_po = '')
	{
		if ($this->order->is_po_exist($id_po)) {
			$params['title'] = 'Edit Purchase Order';
			$params['active_page'] = 'po';

			$po['flash'] = $this->session->flashdata('edit_po_flash');
			$po['suppliers'] = $this->supplier->get_all_suppliers();
			$po['po_id'] = $id_po;
			$po['total_po'] = $this->order->get_total_sum_poed_products($id_po);

			$this->load->view('header', $params);
			$this->load->view('orders/edit_po', $po);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	public function retur_po($id_po = '')
	{
		if ($this->order->is_po_exist($id_po)) {
			$params['title'] = 'Edit Purchase Order';
			$params['active_page'] = 'po';

			$po['suppliers'] = $this->supplier->get_all_suppliers();
			$po['po_id'] = $id_po;
			$po['total_po'] = $this->order->get_total_sum_poed_products($id_po);

			$this->load->view('header', $params);
			$this->load->view('orders/retur_po', $po);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	public function api()
	{
		//JANGAN LUPA DEKLARASIKAN ACTION DISINI
		$action = $this->input->get('action');
		switch ($action) {
			case 'orders':
				$orders['data'] = $this->order->get_all_orders_for_api();

				$response = $orders;
				break;
			case 'list_po_products':
				$nomor_po = $this->input->get('nomor_po');

				$orders['data'] = $this->order->get_all_poed_products($nomor_po);

				$response = $orders;
				break;
			case 'add_po':
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

				$this->form_validation->set_rules('nomor_po', 'Nomor PO', 'required|is_unique[tb_po.po_id]');

				if ($this->form_validation->run() === FALSE) {
					$this->index();
					$response = array('code' => 409);

					if (form_error('id')) {
						$response['id_error'] = form_error('id');
					}
				} else {
					$id_po = $this->input->post('nomor_po');
					$tgl_po = $this->input->post('tanggal_po');
					$id_supplier = $this->input->post('supplier');
					$no_faktur = $this->input->post('nomor_faktur');
					$tgl_faktur = $this->input->post('tanggal_faktur');
					$jatuh_tempo = $this->input->post('jatuh_tempo');
					$status = 'belum_selesai';

					$data = array(
						'po_id' => $id_po,
						'po_tgl' => $tgl_po,
						'po_nofak' => $no_faktur,
						'po_tglfak' => $tgl_faktur,
						'po_tgljatuhtempo' => $jatuh_tempo,
						'po_idsup' => $id_supplier,
						'po_idadm' => get_current_user_id(),
						'po_status' => $status,
					);

					$this->order->add_new_po_doc($data);
					$orders['code'] = 201;
					$response = $orders;
				}
				break;
			case 'delete_po':
				$id_po = $this->input->post('id_po');

				$this->order->delete_po($id_po);

				$response = array('code' => 204);
				break;
			case 'save_po':
				$id_po = $this->input->post('id_po');

				$no_fak = $this->input->post('no_fak');
				$tgl_fak = $this->input->post('tgl_fak');
				$jatuh_tempo = $this->input->post('jatuh_tempo');

				$data = array(
					'po_nofak' => $no_fak,
					'po_tglfak' => $tgl_fak,
					'po_tgljatuhtempo' => $jatuh_tempo,
					'po_status' => 'temporer',
				);

				$this->order->save_po($id_po, $data);
				$response = array('code' => 201, 'message' => 'Data PO berhasil disimpan sementara');
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
			case 'add_product':
				$beli_idpo = $this->input->post('idpo_pesanan');
				$beli_idbrg = $this->input->post('idbrg_pesanan');
				$beli_jumlahbrg = $this->input->post('jumlah_pesanan');

				$is_unique = $this->order->is_po_brg_unique($beli_idpo, $beli_idbrg);

				if ($is_unique) {
					$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
					$this->form_validation->set_rules('idpo_pesanan', 'Id PO', 'required');
					$this->form_validation->set_rules('idbrg_pesanan', 'Id Barang', 'required');

					if ($this->form_validation->run() === FALSE) {
						$this->index();
						$response = array('code' => 409);
					} else {

						$data = array(
							'beli_idpo' => $beli_idpo,
							'beli_jumlahbrg' => $beli_jumlahbrg,
							'beli_idbrg' => $beli_idbrg,
						);

						$this->order->add_new_po_product($data);
						$orders['data'] = $this->order->get_all_poed_products($beli_idpo);
						$orders['total_po'] = $this->order->get_total_sum_poed_products($beli_idpo);
						$response = $orders;
					}
				} else if ($beli_idbrg == null) {
					$response = array('code' => 409);
				} else {
					$old_data = array(
						'beli_idpo' => $beli_idpo,
						'beli_jumlahbrg' => $beli_jumlahbrg,
						'beli_idbrg' => $beli_idbrg,
					);
					$response = array('code' => 500, 'old_data' => $old_data);
				}

				break;
				case 'add_product_retur':
					$beli_idpo = $this->input->post('idpo_pesanan');
					$beli_idbrg = $this->input->post('idbrg_pesanan');
					$beli_jumlahbrg = $this->input->post('jumlah_pesanan');
	
					$is_unique = $this->order->is_po_brg_unique($beli_idpo, $beli_idbrg);
	
					if ($is_unique) {
						$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
						$this->form_validation->set_rules('idpo_pesanan', 'Id PO', 'required');
						$this->form_validation->set_rules('idbrg_pesanan', 'Id Barang', 'required');
	
						if ($this->form_validation->run() === FALSE) {
							$this->index();
							$response = array('code' => 409);
						} else {
	
							$data = array(
								'beli_idpo' => $beli_idpo,
								'beli_jumlahbrg' => $beli_jumlahbrg,
								'beli_idbrg' => $beli_idbrg,
							);
	
							$this->order->add_new_po_product_retur($data);
							$orders['data'] = $this->order->get_all_poed_products($beli_idpo);
							$orders['total_po'] = $this->order->get_total_sum_poed_products($beli_idpo);
							$response = $orders;
						}
					} else if ($beli_idbrg == null) {
						$response = array('code' => 409);
					} else {
						$old_data = array(
							'beli_idpo' => $beli_idpo,
							'beli_jumlahbrg' => $beli_jumlahbrg,
							'beli_idbrg' => $beli_idbrg,
						);
						$response = array('code' => 500, 'old_data' => $old_data);
					}
	
					break;
			case 'delete_product':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idpo_pesanan = $this->input->post('idpo_pesanan');

				$this->order->delete_product($idpo_pesanan, $idbrg_pesanan);

				$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
				$response = array('code' => 204, 'total_po' => $total_po);
				break;
			case 'delete_product_retur':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idpo_pesanan = $this->input->post('idpo_pesanan');

				$can_delete = $this->order->delete_product_retur($idpo_pesanan, $idbrg_pesanan);

				if($can_delete){
					$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
					$response = array('code' => 204, 'total_po' => $total_po);
				}else{
					$response = array('code' => 500);
				}
				break;
			case 'edit_product':
				$idbrg_pesanan = $this->input->post('edit_idbrg_pesanan');
				$idpo_pesanan = $this->input->post('edit_idpo_pesanan');
				$jumlah_pesanan = $this->input->post('edit_jumlah_pesanan');

				$this->order->edit_product_qty($idpo_pesanan, $idbrg_pesanan, $jumlah_pesanan);

				$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
				$response = array('code' => 201, 'total_po' => $total_po, 'message' => 'Barang berhasil diperbarui');
				break;
			case 'edit_product_retur':
				$idbrg_pesanan = $this->input->post('edit_idbrg_pesanan');
				$idpo_pesanan = $this->input->post('edit_idpo_pesanan');
				$jumlah_pesanan = $this->input->post('edit_jumlah_pesanan');
				$jumlah_pesanan_lama = $this->input->post('edit_jumlah_pesanan_lama');
				$penambahan = $jumlah_pesanan - $jumlah_pesanan_lama;

				// if($penambahan>0){
					$this->order->edit_product_qty_retur($idpo_pesanan, $idbrg_pesanan, $jumlah_pesanan, $penambahan);
	
					$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
					$response = array('code' => 201, 'total_po' => $total_po, 'message' => 'Barang berhasil diperbarui');
				// }
				// else{
				// 	$is_pengurangan_lebih_dari_stok= true;

				// 	if($is_pengurangan_lebih_dari_stok){
				// 		$response = array('code' => 409, 'message' => 'Jumlah barang yang diretur melebihi stok yang tersedia');
				// 	}else{
				// 		$this->order->edit_product_qty_retur($idpo_pesanan, $idbrg_pesanan, $jumlah_pesanan, $penambahan);
	
				// 		$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
				// 		$response = array('code' => 201, 'total_po' => $total_po, 'message' => 'Barang berhasil diperbarui');
				// 	}
				// }
				break;
			case 'edit_product_quantity':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idpo_pesanan = $this->input->post('idpo_pesanan');
				$jumlah_pesanan = $this->input->post('jumlah_pesanan');

				$this->order->update_product_qty($idpo_pesanan, $idbrg_pesanan, $jumlah_pesanan);


				$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
				$response = array('code' => 201, 'total_po' => $total_po, 'message' => 'Barang berhasil diperbarui');
				break;
			case 'edit_product_quantity_retur':
				$idbrg_pesanan = $this->input->post('idbrg_pesanan');
				$idpo_pesanan = $this->input->post('idpo_pesanan');
				$jumlah_pesanan = $this->input->post('jumlah_pesanan');

				$this->order->update_product_qty_retur($idpo_pesanan, $idbrg_pesanan, $jumlah_pesanan);

				$total_po = $this->order->get_total_sum_poed_products($idpo_pesanan);
				$response = array('code' => 201, 'total_po' => $total_po, 'message' => 'Barang berhasil diperbarui');
				break;
			case 'view_product':
				$idbrg = $this->input->get('idbrg');
				$idpo = $this->input->get('idpo');

				$data['data'] = $this->order->product_data($idpo, $idbrg);
				$response = $data;
				break;
			case 'check_unique':
				$beli_idpo = $this->input->post('idpo_pesanan');
				$beli_idbrg = $this->input->post('idbrg_pesanan');

				$is_unique = $this->order->is_po_brg_unique($beli_idpo, $beli_idbrg);

				$response = array('code' => 201, 'is_unique' => $is_unique);
				break;
			case 'view_data_po':
				$id_po = $this->input->get('id_po');

				$data['data'] = $this->order->po_data($id_po);
				$response = $data;
				break;
			case 'search':
				$term = $this->input->post('term');
				// $products['data'] = $this->transaction->get_all_products();
				$products['data'] = $this->order->search_all_avail_products($term);
				$response = $products;
				break;
			case 'get_product':
				$idbrg = $this->input->get('id_barang');

				$data['data'] = $this->order->get_single_product_data($idbrg);
				$response = $data;
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}

	public function cetak_po($id_po=''){
    
		// $is_exist_and_match=$this->order->is_po_exist_and_admin_match($id_po);
		$is_exist=$this->order->is_po_exist($id_po);
		if($is_exist){
			
			// title dari pdf
			$data['title_pdf'] = 'Dokumen Purchase Order (PO)';
			// filename dari pdf ketika didownload
			$filename = 'PO '.$id_po;
			// setting paper
			$paper = 'A4';
			// $paper = array(0, 0, 226.77, 326.19);

			//orientasi paper potrait / landscape
			$orientation = "portrait";
	
			$data['po'] = $this->order->po_data_for_report($id_po);
			$data['barang_po'] = $this->order->get_all_po_products_for_report($id_po);
			$data['total_biaya_po'] = $this->order->get_total_sum_po_products_for_report($id_po);
			
			$html = $this->load->view('orders/po_pdf', $data, true);	    
			
			// run dompdf
			$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
		}else{
			show_404();
		}
	}


	// 
	// 
	// 
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
			$order['order_flash'] = $this->session->flashdata('order_flash');
			$order['payment_flash'] = $this->session->flashdata('payment_flash');

			$this->load->view('header', $params);
			$this->load->view('orders/view', $order);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	public function status()
	{
		$status = $this->input->post('status');
		$order = $this->input->post('order');

		$this->order->set_status($status, $order);
		$this->session->set_flashdata('order_flash', 'Status berhasil diperbarui');

		redirect('admin/orders/view/' . $order);
	}
}
