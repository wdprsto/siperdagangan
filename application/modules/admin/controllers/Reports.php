<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		verify_session('admin');

		$this->load->library('pdfgenerator');
		$this->load->model(array(
			'order_model' => 'order',
			'product_model' => 'product',
			'setting_model' => 'setting',
			'password_model' => 'password',
		));
	}

	public function index()
	{
		$params['title'] = 'Kelola Laporan';
		$params['active_page'] = "reports";
		$overview['transaction_overview'] = $this->order->transaction_overview();
		$overview['transaction_count'] = $this->order->transaction_count();
		$overview['data_kategori'] = $this->product->get_all_categories();
		$overview['data_kasir'] = $this->password->get_all_kasir();

		$this->load->view('header', $params);
		$this->load->view('reports/reports', $overview);
		$this->load->view('footer');
	}

	public function cetak_daftar_semua_barang()
	{
		// title dari pdf
		$data['title_pdf'] = 'Daftar Barang';
		// filename dari pdf ketika didownload
		$filename = 'Daftar Barang per ' . date('d-m-Y');
		// setting paper
		$paper = 'A4';

		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$data['barangs'] = $this->product->daftar_semua_barang();
		$data['admin'] = $this->setting->get_profile();

		$html = $this->load->view('reports/daftar_semua_barang_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_barang_menurut_kategori()
	{
		$id_kat = $this->input->post('kategori');

		// title dari pdf
		$data['title_pdf'] = 'Daftar Barang Per Kategori';
		// setting paper
		$paper = 'A4';

		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$data['nama_kategori'] = $this->product->get_nama_kategori($id_kat)->kat_nama;
		$data['barangs'] = $this->product->daftar_barang_menurut_kategori($id_kat);
		$data['admin'] = $this->setting->get_profile();

		// filename dari pdf ketika didownload
		$filename = 'Daftar Barang Kategori ' . $data["nama_kategori"] . ' per ' . date('d-m-Y');

		$html = $this->load->view('reports/daftar_barang_menurut_kategori_pdf', $data, true);
		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_barang_terlaris()
	{
		$tahun = $this->input->post('data-tahun-hidden');
		$bulan = $this->input->post('data-bulan-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Daftar Barang Terlaris';
		// filename dari pdf ketika didownload
		$filename = 'Daftar Barang Terlaris ' . $bulan . '-' . $tahun;
		// setting paper
		$paper = 'A4';

		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$data['barangs'] = $this->product->daftar_barang_terlaris($bulan, $tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['bulan'] = get_month($bulan);
		$data['tahun'] = $tahun;
		$html = $this->load->view('reports/daftar_barang_terlaris_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_barang_kurang_laris()
	{
		$tahun = $this->input->post('data-tahun-hidden');
		$bulan = $this->input->post('data-bulan-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Daftar Barang Kurang Laris';
		// filename dari pdf ketika didownload
		$filename = 'Daftar Barang Kurang Laris ' . $bulan . '-' . $tahun;
		// setting paper
		$paper = 'A4';

		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$data['barangs'] = $this->product->daftar_barang_kurang_laris($bulan, $tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['bulan'] = get_month($bulan);
		$data['tahun'] = $tahun;
		$html = $this->load->view('reports/daftar_barang_kurang_laris_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_tampilkan_semua()
	{
		$tahun = $this->input->post('data-tahun-hidden');
		$bulan = $this->input->post('data-bulan-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Daftar Jumlah Penjualan Barang';
		// filename dari pdf ketika didownload
		$filename = 'Daftar Jumlah Penjualan Barang ' . $bulan . '-' . $tahun;
		// setting paper
		$paper = 'A4';

		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$data['barangs'] = $this->product->daftar_barang_semua($bulan, $tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['bulan'] = get_month($bulan);
		$data['tahun'] = $tahun;
		$html = $this->load->view('reports/daftar_barang_semua_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_laporan_bulanan()
	{
		$tahun = $this->input->post('data-tahun-lapbul-hidden');
		$bulan = $this->input->post('data-bulan-lapbul-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Laporan Bulanan';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['barangs'] = $this->product->daftar_barang_laporan_bulanan($bulan, $tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['bulan'] = get_month($bulan);
		$data['tahun'] = $tahun;
		
		// filename dari pdf ketika didownload
		$filename = 'Laporan Bulan ' .$data['bulan'];

		$html = $this->load->view('reports/laporan_bulanan_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_laporan_tahunan()
	{
		$tahun = $this->input->post('data-tahun-laphun-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Laporan Tahunan';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['barangs'] = $this->product->daftar_barang_laporan_tahunan($tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['tahun'] = $tahun;
		
		// filename dari pdf ketika didownload
		$filename = 'Laporan Tahun ' .$data['tahun'];

		$html = $this->load->view('reports/laporan_tahunan_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_laporan_harian()
	{
		$tanggal = $this->input->post('data-tanggal-laphar-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Laporan Harian';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['barangs'] = $this->product->daftar_barang_laporan_harian($tanggal);
		$data['admin'] = $this->setting->get_profile();
		$data['tanggal'] = $tanggal;
		
		// filename dari pdf ketika didownload
		$filename = 'Laporan Harian ' .$data['tanggal'];

		$html = $this->load->view('reports/laporan_harian_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_hasil_penjualan_kasir_detail()
	{
		$tanggal = $this->input->post('data-tanggal-lapsir-hidden');
		$kasir = $this->input->post('data-kasir-lapsir-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Laporan Hasil Penjualan Detail';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['barangs'] = $this->product->daftar_barang_laporan_harian_kasir($tanggal, $kasir);
		$data['admin'] = $this->setting->get_profile();
		$data['kasir'] = $this->setting->get_kasir($kasir);
		$data['tanggal'] = $tanggal;
		
		// filename dari pdf ketika didownload
		$filename = 'Laporan Penjualan Kasir Detail ' .$data['tanggal'];

		$html = $this->load->view('reports/laporan_hasil_penjualan_detail_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_rekapitulasi_per_bulan()
	{
		$tahun = $this->input->post('data-tahun-laphun-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Rekapitulasi per Bulan';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['uangs'] = $this->product->daftar_rekapitulasi_per_bulan($tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['tahun'] = $tahun;
		
		// filename dari pdf ketika didownload
		$filename = 'Rekap per Bulan Tahun ' .$data['tahun'];

		$html = $this->load->view('reports/rekapitulasi_per_bulan_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_rekapitulasi_per_tanggal()
	{
		$tahun = $this->input->post('data-tahun-lapbul-hidden');
		$bulan = $this->input->post('data-bulan-lapbul-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Rekapitulasi per Tanggal';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['uangs'] = $this->product->daftar_rekapitulasi_per_tanggal($bulan, $tahun);
		$data['admin'] = $this->setting->get_profile();
		$data['bulan'] = get_month($bulan);
		$data['tahun'] = $tahun;
		
		// filename dari pdf ketika didownload
		$filename = 'Rekap per Tanggal Bulan ' .$data['bulan'];

		$html = $this->load->view('reports/rekapitulasi_per_tanggal_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_rekapitulasi_per_nota()
	{
		$tanggal = $this->input->post('data-tanggal-laphar-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Rekapitulasi per Nota';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['uangs'] = $this->product->daftar_rekapitulasi_per_nota($tanggal);
		$data['admin'] = $this->setting->get_profile();
		$data['tanggal'] = $tanggal;

		// filename dari pdf ketika didownload
		$filename = 'Rekap per Nota Tanggal ' .$data['tanggal'];

		$html = $this->load->view('reports/rekapitulasi_per_nota_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_rekapitulasi_per_nota_kasir()
	{
		$tanggal = $this->input->post('data-tanggal-lapsir-hidden');
		$kasir = $this->input->post('data-kasir-lapsir-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Rekapitulasi per Nota';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['uangs'] = $this->product->daftar_rekapitulasi_per_nota_kasir($tanggal, $kasir);
		$data['admin'] = $this->setting->get_profile();
		$data['kasir'] = $this->setting->get_kasir($kasir);
		$data['tanggal'] = $tanggal;

		// filename dari pdf ketika didownload
		$filename = 'Rekap per Nota Tanggal ' .$data['tanggal'].' Kasir '.$kasir;

		$html = $this->load->view('reports/rekapitulasi_per_nota_kasir_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}

	public function cetak_rekapitulasi_per_kasir()
	{
		$tanggal = $this->input->post('data-tanggal-lapsir-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Rekapitulasi per Kasir';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['uangs'] = $this->product->daftar_rekapitulasi_per_kasir($tanggal);
		$data['admin'] = $this->setting->get_profile();
		$data['tanggal'] = $tanggal;

		// filename dari pdf ketika didownload
		$filename = 'Rekap per Kasir Tanggal ' .$data['tanggal'];

		$html = $this->load->view('reports/rekapitulasi_per_kasir_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}


	public function cetak_rekapitulasi_per_kategori()
	{
		$tanggal = $this->input->post('data-tanggal-laphar-hidden');
		// title dari pdf
		$data['title_pdf'] = 'Rekapitulasi per Kategori';
		// setting paper
		$paper = 'A4';
		
		//orientasi paper potrait / landscape
		$orientation = "portrait";
		
		$data['uangs'] = $this->product->daftar_rekapitulasi_per_kategori($tanggal);
		$data['admin'] = $this->setting->get_profile();
		$data['tanggal'] = $tanggal;

		// filename dari pdf ketika didownload
		$filename = 'Rekap per Kategori Tanggal ' .$data['tanggal'];

		$html = $this->load->view('reports/rekapitulasi_per_kategori_pdf', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $filename, $paper, $orientation);
	}



	// 
// 
// 
	public function api($action = '')
	{
		switch ($action) {
			case 'admin_passwords':
				$id = get_current_user_id();
				$passwords = $this->password->get_all_admin_passwords($id);

				// $n = 0;
				// foreach ($passwords as $password)
				// {
				//     $passwords[$n]->profile_picture = base_url('assets/uploads/users/'. $password->profile_picture);

				//     $n++;
				// }

				$passwords['data'] = $passwords;

				$response = $passwords;
				break;
			case 'kasir_passwords':
				$passwords = $this->password->get_all_kasir_passwords();

				$passwords['data'] = $passwords;

				$response = $passwords;
				break;
			case 'delete_admin':
				$id = $this->input->post('id');

				$this->password->delete_admin($id);

				$response = array('code' => 204);
				break;
			case 'delete_kasir':
				$id = $this->input->post('id');

				$this->password->delete_kasir($id);

				$response = array('code' => 204);
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}
}
