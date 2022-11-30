<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//CATEGORY MODEL
	public function get_all_categories()
	{
		return $this->db->order_by('kat_nama', 'ASC')->get('tb_kategori')->result();
	}

	public function add_category($id, $name)
	{
		$this->db->insert('tb_kategori', array('kat_id' => $id, 'kat_nama' => $name));

		return $this->db->insert_id();
	}

	public function delete_category($id)
	{
		$this->db->query("SET FOREIGN_KEY_CHECKS=0;");
		$this->db->where('kat_id', $id)->delete('tb_kategori');
		$this->db->query("SET FOREIGN_KEY_CHECKS=1;");

		return true;
	}

	public function category_data($id)
	{
		return $this->db->where('kat_id', $id)->get('tb_kategori')->row();
	}

	public function edit_category($id, $name)
	{
		return $this->db->where('kat_id', $id)->update('tb_kategori', array('kat_nama' => $name));
	}

	public function last_category_id()
	{
		return $this->db->order_by('kat_id', 'DESC')->limit(1)->get('tb_kategori')->row();
	}

	public function latest_categories()
	{
		return $this->db->order_by('kat_id', 'DESC')->limit(5)->get('tb_kategori')->result();
	}


	//PRODUCT MODEL
	public function get_all_products()
	{
		$data = $this->db->query("
			SELECT *
			FROM tb_barang
			LEFT JOIN tb_kategori
				ON kat_id = brg_idkat
		")->result();

		return $data;
	}

	public function get_products_by_cat($kat_id)
	{
		$data = $this->db->query("
			SELECT *
			FROM tb_barang
			LEFT JOIN tb_kategori
				ON kat_id = brg_idkat
			WHERE brg_idkat = '$kat_id';
		")->result();

		return $data;
	}

	public function count_all_products()
	{
		return $this->db->get('tb_barang')->num_rows();
	}

	public function delete_product($id)
	{
		$this->db->query("SET FOREIGN_KEY_CHECKS=0;");
		$this->db->where('brg_id', $id)->delete('tb_barang');
		$this->db->query("SET FOREIGN_KEY_CHECKS=1;");
		return true;
	}

	public function edit_product($id, $product)
	{
		return $this->db->where('brg_id', $id)->update('tb_barang', $product);
	}

	public function product_data($id)
	{
		// $data = $this->db->query("
		// 	SELECT *
		// 	FROM tb_barang
		// 	LEFT JOIN tb_supplier
		// 		ON brg_idsup = sup_id
		// 	LEFT JOIN tb_kategori
		// 		ON brg_idkat = kat_id  
		// 	WHERE brg_id = '$id'
		// ")->result();

		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->join('tb_kategori', 'brg_idkat = kat_id', 'left');
		$this->db->where('brg_id', $id);
		$data = $this->db->get()->row();

		//$this->db->where('brg_id', $id)->get('tb_barang')->row();
		return $data;
	}


	public function add_new_product(array $products)
	{
		$this->db->insert('tb_barang', $products);
	}

	public function last_category_product_id($kat_id)
	{
		return $this->db->where('brg_idkat', $kat_id)->order_by('brg_id', 'DESC')->limit(1)->get('tb_barang')->row();
	}

	public function count_all_categories()
	{
		return $this->db->get('tb_kategori')->num_rows();
	}

	public function daftar_semua_barang()
	{
	 // MENGATASI FOREIGN KEY CHECK = 0, UNTUK KATEGORI TERHAPUS KITA GUNAKAN COALESCE. UNTUK MENAMPILKAN BARANG PADA KATEGORI TERHAPUS, UBAH INNER JOIN JADI LEFT JOIN
		$products = $this->db->query("
			SELECT brg_id, brg_nama, brg_stok, brg_satuan, brg_hargadasar, brg_hargajual, brg_idkat as kat_id, COALESCE(kat_nama ,'Terhapus') as kat_nama
			FROM tb_barang
			INNER JOIN tb_kategori 
				ON kat_id = brg_idkat
			ORDER BY 1
		");

		return $products->result();
	}

	
	public function daftar_barang_menurut_kategori($kat_id)
	{
		$products = $this->db->query("
			SELECT brg_id, brg_nama, brg_stok, brg_satuan, brg_hargadasar, brg_hargajual, kat_id, kat_nama 
			FROM tb_barang
			LEFT JOIN tb_kategori 
				ON kat_id = brg_idkat
			WHERE kat_id = '$kat_id'
		");

		return $products->result();
	}
		
	public function get_nama_kategori($id_kat)
	{
		return $this->db->where('kat_id', $id_kat)->get('tb_kategori')->row();
	}

	
	public function daftar_barang_terlaris($bulan, $tahun)
	{
		$products = $this->db->query("
			WITH tb_penjualan_nota AS (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON jual_idnota = nota_id WHERE nota_status = 'selesai' AND nota_tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH))
			SELECT brg_id, brg_nama, brg_stok, brg_satuan, brg_hargadasar, brg_hargajual, brg_idkat, COALESCE(SUM(jual_jumlahbrg),0) AS jumlah_terjual FROM tb_barang 
			LEFT JOIN tb_penjualan_nota ON brg_id = jual_idbrg 
			GROUP BY brg_id
			HAVING jumlah_terjual > 0
			ORDER BY jumlah_terjual DESC
			LIMIT 10
		");

		return $products->result();
	}

	public function daftar_barang_kurang_laris($bulan, $tahun)
	{
		$products = $this->db->query("
			WITH tb_penjualan_nota AS (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON jual_idnota = nota_id WHERE nota_status = 'selesai' AND nota_tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH))
			SELECT brg_id, brg_nama, brg_stok, brg_satuan, brg_hargadasar, brg_hargajual, brg_idkat, COALESCE(SUM(jual_jumlahbrg),0) AS jumlah_terjual FROM tb_barang 
			LEFT JOIN tb_penjualan_nota ON brg_id = jual_idbrg 
			GROUP BY brg_id
			ORDER BY jumlah_terjual ASC
			LIMIT 10
		");

		return $products->result();
	}

	
	public function daftar_barang_semua($bulan, $tahun)
	{
		$products = $this->db->query("
			WITH tb_penjualan_nota AS (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON jual_idnota = nota_id WHERE nota_status = 'selesai' AND nota_tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH))
			SELECT brg_id, brg_nama, brg_stok, brg_satuan, brg_hargadasar, brg_hargajual, brg_idkat, COALESCE(SUM(jual_jumlahbrg),0) AS jumlah_terjual FROM tb_barang 
			LEFT JOIN tb_penjualan_nota ON brg_id = jual_idbrg 
			GROUP BY brg_id
			ORDER BY jumlah_terjual DESC
		");

		return $products->result();
	}

	
	// public function daftar_barang_laporan_bulanan($bulan, $tahun)
	// {
	// 	$products = $this->db->query("
	// 		SELECT  brg_id, brg_nama, kat_id, kat_nama, brg_satuan, COALESCE(SUM(brg_hargadasar * beli_jumlahbrg),0) AS jumlah_pembelian, 
	// 			COALESCE(SUM(brg_hargajual * jual_jumlahbrg - jual_diskon),0) AS jumlah_penjualan
	// 		FROM tb_barang
	// 		LEFT JOIN tb_kategori 
	// 			ON kat_id = brg_idkat
	// 		LEFT JOIN (SELECT * FROM tb_pembelian LEFT JOIN tb_po ON po_id = beli_idpo WHERE po_tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH) AND po_status='permanen') AS tb_beli
	// 			ON brg_id = beli_idbrg
	// 		LEFT JOIN (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON nota_id = jual_idnota WHERE nota_tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH) AND nota_status='selesai') AS tb_jual
	// 			ON brg_id = jual_idbrg
	// 		GROUP BY brg_id
	// 		ORDER BY brg_idkat, brg_id
	// 	");

	// 	return $products->result();
	// }

	public function daftar_barang_laporan_bulanan($bulan, $tahun)
	{
		$products = $this->db->query("
			SELECT  brg_id, brg_nama, kat_id, kat_nama, brg_satuan, COALESCE(SUM(brg_hargadasar * jual_jumlahbrg),0) AS jumlah_pembelian, 
				COALESCE(SUM(brg_hargajual * jual_jumlahbrg - jual_diskon),0) AS jumlah_penjualan
			FROM tb_barang
			INNER JOIN tb_kategori 
				ON kat_id = brg_idkat
			INNER JOIN (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON nota_id = jual_idnota WHERE nota_tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH) AND nota_status='selesai') AS tb_jual
				ON brg_id = jual_idbrg
			GROUP BY brg_id
			ORDER BY brg_idkat, brg_id
		");

		return $products->result();
	}

	
	public function daftar_barang_laporan_tahunan( $tahun)
	{
		$products = $this->db->query("
			SELECT  brg_id, brg_nama, kat_id, kat_nama, brg_satuan, COALESCE(SUM(brg_hargadasar * jual_jumlahbrg),0) AS jumlah_pembelian, 
				COALESCE(SUM(brg_hargajual * jual_jumlahbrg - jual_diskon),0) AS jumlah_penjualan
			FROM tb_barang
			INNER JOIN tb_kategori 
				ON kat_id = brg_idkat
			INNER JOIN (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON nota_id = jual_idnota WHERE nota_tgl BETWEEN '$tahun-01-01' AND DATE_ADD('$tahun-01-01',INTERVAL 1 YEAR) AND nota_status='selesai') AS tb_jual
				ON brg_id = jual_idbrg
			GROUP BY brg_id
			ORDER BY brg_idkat, brg_id
		");

		return $products->result();
	}

	public function daftar_barang_laporan_harian($tanggal)
	{
		$products = $this->db->query("
			SELECT  brg_id, brg_nama, kat_id, kat_nama, brg_satuan, COALESCE(SUM(brg_hargadasar * jual_jumlahbrg),0) AS jumlah_pembelian, 
				COALESCE(SUM(brg_hargajual * jual_jumlahbrg - jual_diskon),0) AS jumlah_penjualan
			FROM tb_barang
			INNER JOIN tb_kategori 
				ON kat_id = brg_idkat
			INNER JOIN (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON nota_id = jual_idnota WHERE DATE(nota_tgl) = '$tanggal' AND nota_status='selesai') AS tb_jual
				ON brg_id = jual_idbrg
			GROUP BY brg_id
			ORDER BY brg_idkat, brg_id
		");

		//KASUS MAU NETAPI FOREIGN KEY CHECK = 0BIAR MASIH BISA LIAT DATA WALAU DIAPUS
		// $products = $this->db->query("
		// SELECT  brg_id, brg_nama, brg_idkat AS kat_id, 
		// COALESCE(kat_nama, 'Terhapus') as kat_nama, brg_satuan, COALESCE(SUM(brg_hargadasar * jual_jumlahbrg),0) AS jumlah_pembelian, 
		// 	COALESCE(SUM(brg_hargajual * jual_jumlahbrg - jual_diskon),0) AS jumlah_penjualan
		// FROM tb_barang
		// LEFT JOIN tb_kategori 
		// 	ON kat_id = brg_idkat
		// INNER JOIN (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON nota_id = jual_idnota WHERE DATE(nota_tgl) = '$tanggal' AND nota_status='selesai') AS tb_jual
		// 	ON brg_id = jual_idbrg
		// GROUP BY brg_id
		// ORDER BY brg_idkat, brg_id

	// ");

		return $products->result();
	}

	public function daftar_barang_laporan_harian_kasir($tanggal,$kasir)
	{
		$products = $this->db->query("
			SELECT  brg_id, brg_nama, kat_id, kat_nama, brg_satuan, COALESCE(SUM(brg_hargadasar * jual_jumlahbrg),0) AS jumlah_pembelian, 
				COALESCE(SUM(brg_hargajual * jual_jumlahbrg - jual_diskon),0) AS jumlah_penjualan
			FROM tb_barang
			INNER JOIN tb_kategori 
				ON kat_id = brg_idkat
			INNER JOIN (SELECT * FROM tb_penjualan LEFT JOIN tb_nota ON nota_id = jual_idnota WHERE DATE(nota_tgl) = '$tanggal' AND nota_status='selesai' AND nota_idksr = '$kasir') AS tb_jual
				ON brg_id = jual_idbrg
			GROUP BY brg_id
			ORDER BY brg_idkat, brg_id
		");

		return $products->result();
	}
	


	// public function daftar_rekapitulasi_per_tanggal($bulan, $tahun)
	// {
	// 	$products = $this->db->query("
	// 		WITH tb_data AS(SELECT CONCAT('N',nota_id) AS kode, DATE_FORMAT(nota_tgl, '%Y-%m-%d') AS tgl, nota_status AS STATUS 
	// 			,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah
	// 			FROM tb_nota
	// 			LEFT JOIN tb_penjualan ON nota_id = jual_idnota
	// 			LEFT JOIN tb_barang ON jual_idbrg = brg_id
	// 			GROUP BY nota_id
	// 			HAVING nota_status = 'selesai'
	// 			UNION 
	// 			SELECT CONCAT('P',po_id) AS kode, DATE_FORMAT(po_tgl, '%Y-%m-%d') AS tgl, po_status AS STATUS
	// 				,SUM(brg_hargadasar * beli_jumlahbrg ) AS jumlah
	// 			FROM tb_po
	// 			LEFT JOIN tb_pembelian ON po_id = beli_idpo
	// 			LEFT JOIN tb_barang ON beli_idbrg = brg_id
	// 			GROUP BY po_id
	// 			HAVING po_status = 'permanen'
	// 			ORDER BY tgl)
	// 		SELECT tgl, COALESCE(SUM(CASE WHEN LEFT(kode,1)='P' THEN jumlah END),0) AS jumlah_pembelian, COALESCE(SUM(CASE WHEN LEFT(kode,1)='N' THEN jumlah END),0) AS jumlah_penjualan FROM tb_data 
	// 		WHERE tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH)
	// 		GROUP BY tgl
	// 	");

	// 	return $products->result();
	// }
	public function daftar_rekapitulasi_per_tanggal($bulan, $tahun)
	{
		$products = $this->db->query("
			WITH tb_data AS(SELECT nota_id as kode, DATE_FORMAT(nota_tgl, '%Y-%m-%d') AS tgl, nota_status AS STATUS 
				,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah_jual
				,SUM(brg_hargadasar * jual_jumlahbrg) AS jumlah_beli
				FROM tb_nota
				LEFT JOIN tb_penjualan ON nota_id = jual_idnota
				LEFT JOIN tb_barang ON jual_idbrg = brg_id
				GROUP BY nota_id
				HAVING nota_status = 'selesai'
			)
			SELECT tgl, COALESCE(SUM(jumlah_beli),0) AS jumlah_pembelian, COALESCE(SUM(jumlah_jual),0) AS jumlah_penjualan FROM tb_data 
			WHERE tgl BETWEEN '$tahun-$bulan-01' AND DATE_ADD('$tahun-$bulan-01',INTERVAL 1 MONTH)
			GROUP BY tgl
		");

		return $products->result();
	}

	public function daftar_rekapitulasi_per_bulan($tahun)
	{
		$products = $this->db->query("
			WITH tb_data AS(SELECT nota_id as kode, DATE_FORMAT(nota_tgl, '%Y-%m-%d') AS tgl, nota_status AS STATUS 
				,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah_jual
				,SUM(brg_hargadasar * jual_jumlahbrg) AS jumlah_beli
				FROM tb_nota
				LEFT JOIN tb_penjualan ON nota_id = jual_idnota
				LEFT JOIN tb_barang ON jual_idbrg = brg_id
				GROUP BY nota_id
				HAVING nota_status = 'selesai'
			)
			SELECT MONTH(tgl) AS tgl, COALESCE(SUM(jumlah_beli),0) AS jumlah_pembelian, COALESCE(SUM(jumlah_jual),0) AS jumlah_penjualan FROM tb_data 
			WHERE tgl BETWEEN '$tahun-01-01' AND DATE_ADD('$tahun-01-01',INTERVAL 1 YEAR)
			GROUP BY 1
		");

		return $products->result();
	}

	public function daftar_rekapitulasi_per_nota($tanggal)
	{
		$products = $this->db->query("
			WITH tb_data AS(SELECT nota_id as kode, DATE_FORMAT(nota_tgl, '%Y-%m-%d') AS tgl, nota_status AS STATUS 
				,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah_jual
				,SUM(brg_hargadasar * jual_jumlahbrg) AS jumlah_beli
				FROM tb_nota
				LEFT JOIN tb_penjualan ON nota_id = jual_idnota
				LEFT JOIN tb_barang ON jual_idbrg = brg_id
				GROUP BY nota_id
				HAVING nota_status = 'selesai'
			)
			SELECT kode, COALESCE(SUM(jumlah_beli),0) AS jumlah_pembelian, COALESCE(SUM(jumlah_jual),0) AS jumlah_penjualan FROM tb_data 
			WHERE tgl = '$tanggal'
			GROUP BY kode
		");

		return $products->result();
	}

	public function daftar_rekapitulasi_per_nota_kasir($tanggal, $kasir)
	{
		$products = $this->db->query("
			WITH tb_data AS(SELECT nota_id as kode, DATE_FORMAT(nota_tgl, '%Y-%m-%d') AS tgl, nota_status AS STATUS
				,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah_jual
				,SUM(brg_hargadasar * jual_jumlahbrg) AS jumlah_beli
				FROM tb_nota
				LEFT JOIN tb_penjualan ON nota_id = jual_idnota
				LEFT JOIN tb_barang ON jual_idbrg = brg_id
				where nota_idksr = '$kasir'
				GROUP BY nota_id
				HAVING nota_status = 'selesai'
			)
			SELECT kode, COALESCE(SUM(jumlah_beli),0) AS jumlah_pembelian, COALESCE(SUM(jumlah_jual),0) AS jumlah_penjualan FROM tb_data 
			WHERE tgl = '$tanggal'
			GROUP BY kode
			#HAVING jumlah_pembelian > 0;
		");

		return $products->result();
	}

	public function daftar_rekapitulasi_per_kasir($tanggal)
	{
		$products = $this->db->query("
		WITH tb_data AS(SELECT nota_idksr, nota_tgl AS tgl, nota_status AS STATUS 
			,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah_jual
			,SUM(brg_hargadasar * jual_jumlahbrg) AS jumlah_beli
		FROM tb_nota
		LEFT JOIN tb_penjualan ON nota_id = jual_idnota
		LEFT JOIN tb_barang ON jual_idbrg = brg_id
		WHERE DATE(nota_tgl)='$tanggal' AND nota_status = 'selesai' 
		GROUP BY nota_idksr)
		SELECT ksr_id, ksr_nama, COALESCE(jumlah_jual,0) AS jumlah_penjualan, COALESCE(jumlah_beli,0) AS jumlah_pembelian FROM tb_kasir LEFT JOIN tb_data ON ksr_id = nota_idksr
		");

		return $products->result();
	}

	public function daftar_rekapitulasi_per_kategori($tanggal)
	{
		// MENGATASI FOREIGN KEY CHECK = 0, UNTUK KATEGORI TERHAPUS KITA GUNAKAN COALESCE
		$products = $this->db->query("
		SELECT brg_idkat, COALESCE(kat_nama, 'Terhapus') as kat_nama, nota_tgl AS tgl, nota_status AS STATUS 
			,SUM(brg_hargajual * jual_jumlahbrg - jual_diskon) AS jumlah_penjualan
			,SUM(brg_hargadasar * jual_jumlahbrg) AS jumlah_pembelian
		FROM tb_nota
		LEFT JOIN tb_penjualan ON nota_id = jual_idnota
		LEFT JOIN tb_barang ON jual_idbrg = brg_id
		LEFT JOIN tb_kategori ON brg_idkat = kat_id
		WHERE DATE(nota_tgl)='$tanggal' AND brg_idkat IS NOT NULL
		GROUP BY brg_idkat
		");

		return $products->result();
	}

	
	public function update_hargajual($id, $val)
	{	

		return $this->db->where('brg_id', $id)->update('tb_barang', array('brg_hargajual' => $val));
	}

	
	public function update_hargadasar($id, $val)
	{	

		return $this->db->where('brg_id', $id)->update('tb_barang', array('brg_hargadasar' => $val));
	}

	//
	//
	//
}
