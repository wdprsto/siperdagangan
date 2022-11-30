<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->user_id = get_current_user_id();
	}

	public function count_all_orders()
	{
		return $this->db->get('tb_pembelian')->num_rows();
	}

	public function get_all_orders()
	{
		$orders = $this->db->query("
            SELECT *
            FROM tb_po
            LEFT JOIN tb_supplier
                ON po_idsup = sup_id
            LEFT JOIN tb_admin
                ON po_idadm = adm_id
        ");

		return $orders->result();
	}

	public function get_all_orders_for_api()
	{

		$orders = $this->db->query("
            SELECT tb_po.*, tb_supplier.*, tb_admin.*, group_concat(beli_idbrg) as beli_idbrg, group_concat(brg_nama) as brg_nama, group_concat(brg_hargadasar) as brg_hargadasar, group_concat(beli_jumlahbrg) as beli_jumlahbrg, group_concat(brg_hargadasar*beli_jumlahbrg) as beli_hargadasar, sum(brg_hargadasar*beli_jumlahbrg) as beli_totalhargadasar, group_concat(brg_satuan) as brg_satuan
            FROM tb_po
            LEFT JOIN tb_supplier
                ON po_idsup = sup_id
            LEFT JOIN tb_admin
                ON po_idadm = adm_id
			LEFT JOIN tb_pembelian
				ON beli_idpo = po_id
			LEFT JOIN tb_barang
				ON beli_idbrg = brg_id
			GROUP BY po_id
        ");

		return $orders->result();
	}

	public function get_last_po_id()
	{
		$tanggal = date("Ym");

		$last_id = $this->db->query("
			SELECT po_id
			FROM tb_po
			WHERE po_id LIKE '$tanggal%'
			ORDER BY po_id DESC
			LIMIT 1
		");

		return $last_id->row();
	}

	public function add_new_po_doc(array $po)
	{
		$this->db->insert('tb_po', $po);
	}

	public function po_data($id_po)
	{
		return $this->db->where('po_id', $id_po)->get('tb_po')->row();
	}

	public function get_all_poed_products($nomor_po)
	{

		$orders = $this->db->query("
            SELECT * FROM tb_pembelian
            LEFT JOIN tb_barang
                ON beli_idbrg = brg_id
			LEFT JOIN tb_kategori
				ON brg_idkat = kat_id
			WHERE beli_idpo = '$nomor_po'
        ");

		return $orders->result();
	}

	public function get_total_sum_poed_products($nomor_po)
	{
		$orders = $this->db->query("
            SELECT sum(beli_jumlahbrg*brg_hargadasar) as total_harga, count(*) as total_barang FROM tb_pembelian
            LEFT JOIN tb_barang
                ON beli_idbrg = brg_id
			WHERE beli_idpo = '$nomor_po'
        ");

		return $orders->row();
	}

	public function add_new_po_product(array $data)
	{
		$this->db->insert('tb_pembelian', $data);
	}

	public function add_new_po_product_retur(array $data)
	{
		$this->db->insert('tb_pembelian', $data);

		$jumlah_brg = $data['beli_jumlahbrg'];
		$idbrg = $data['beli_idbrg'];
		$this->db->query("
			UPDATE tb_barang
			SET brg_stok = brg_stok + '$jumlah_brg'
			WHERE brg_id = '$idbrg'
		");

	}


	public function delete_product($idpo_pesanan, $idbrg_pesanan)
	{
		return $this->db->where('beli_idpo', $idpo_pesanan)->where('beli_idbrg', $idbrg_pesanan)->delete('tb_pembelian');
	}

	public function delete_product_retur($idpo_pesanan, $idbrg_pesanan)
	{
		$this->db->query("
			UPDATE tb_barang LEFT JOIN tb_pembelian ON brg_id = beli_idbrg
			SET brg_stok = brg_stok - beli_jumlahbrg
			WHERE beli_idbrg = '$idbrg_pesanan' AND beli_idpo = '$idpo_pesanan'
		");
		$this->db->where('beli_idpo', $idpo_pesanan)->where('beli_idbrg', $idbrg_pesanan)->delete('tb_pembelian');
		return true;
	}

	public function is_po_brg_unique($idpo_pesanan, $idbrg_pesanan)
	{
		return ($this->db->where('beli_idpo', $idpo_pesanan)->where('beli_idbrg', $idbrg_pesanan)->get('tb_pembelian')->num_rows() > 0) ? FALSE : TRUE;
	}

	public function is_po_exist($idpo)
	{
		return ($this->db->where('po_id', $idpo)->get('tb_po')->num_rows() > 0) ? TRUE : FALSE;
	}

	//update sesuai masukan
	public function edit_product_qty($idpo, $idbarang, $newqty)
	{
		return $this->db->query("
			UPDATE tb_pembelian
			SET beli_jumlahbrg = '$newqty'
			WHERE beli_idbrg = '$idbarang' AND beli_idpo = '$idpo'
		");
	}

	//update sesuai masukan
	public function edit_product_qty_retur($idpo, $idbarang, $newqty, $penambahan)
	{
		$this->db->query("
			UPDATE tb_pembelian
			SET beli_jumlahbrg = '$newqty'
			WHERE beli_idbrg = '$idbarang' AND beli_idpo = '$idpo'
			");
		$this->db->query("
			UPDATE tb_barang 
			SET brg_stok = brg_stok + $penambahan
			WHERE brg_id = '$idbarang' 
		");
		return true;
	}

	//inkremental
	public function update_product_qty($idpo, $idbarang, $newqty)
	{
		return $this->db->query("
			UPDATE tb_pembelian
			SET beli_jumlahbrg = beli_jumlahbrg + '$newqty'
			WHERE beli_idbrg = '$idbarang' AND beli_idpo = '$idpo'
		");
	}

	public function update_product_qty_retur($idpo, $idbarang, $newqty)
	{
		 $this->db->query("
			UPDATE tb_pembelian
			SET beli_jumlahbrg = beli_jumlahbrg + '$newqty'
			WHERE beli_idbrg = '$idbarang' AND beli_idpo = '$idpo'
		");
		$this->db->query("
			UPDATE tb_barang 
			SET brg_stok = brg_stok + $newqty
			WHERE brg_id = '$idbarang' 
			");
		return true;
	}

	public function delete_po($id_po)
	{
		$this->db->where('beli_idpo', $id_po)->delete('tb_pembelian');
		$this->db->where('po_id', $id_po)->delete('tb_po');
		return true;
	}

	public function save_po($idpo, $data)
	{
		return $this->db->where('po_id', $idpo)->update('tb_po', $data);
	}

	public function permanent_save_po($idpo, $data)
	{
		$this->db->where('po_id', $idpo)->update('tb_po', $data);
		$this->db->query("
			UPDATE tb_barang tbb
			INNER JOIN tb_pembelian tbp 
			ON tbb.brg_id = tbp.beli_idbrg
			SET tbb.brg_stok = tbb.brg_stok + tbp.beli_jumlahbrg
			WHERE tbp.beli_idpo = '$idpo'
		");
		return true;
	}

	public function product_data($idpo, $idbrg)
	{
		$this->db->select('*');
		$this->db->from('tb_pembelian');
		$this->db->join('tb_barang', 'beli_idbrg = brg_id', 'left');
		$this->db->where('beli_idpo', $idpo);
		$this->db->where('beli_idbrg', $idbrg);
		$data = $this->db->get()->row();

		//$this->db->where('brg_id', $id)->get('tb_barang')->row();
		return $data;
	}

	public function count_finished_transaction()
	{
		return $this->db->where('nota_status', 'selesai')->get('tb_nota')->num_rows();
	}

	public function sum_finished_transactions()
	{
		$orders = $this->db->query("
			SELECT SUM(brg_hargajual*jual_jumlahbrg-jual_diskon) AS total_penjualanselesai
			FROM tb_nota
			LEFT JOIN tb_penjualan
				ON jual_idnota = nota_id
			LEFT JOIN tb_barang
				ON jual_idbrg = brg_id
			WHERE nota_status = 'selesai'
        ");

		return $orders->row()->total_penjualanselesai;
	}


	public function get_total_sum_po_products_for_report($nomor_po)
	{

		$orders = $this->db->query("
			SELECT SUM(brg_hargadasar*beli_jumlahbrg) AS total_harga, count(*) as total_barang FROM tb_pembelian
			LEFT JOIN tb_barang
					ON beli_idbrg = brg_id
			WHERE beli_idpo = '$nomor_po'
        ");

		return $orders->row();
	}

	public function get_all_po_products_for_report($nomor_po)
	{
		$orders = $this->db->query("
			SELECT tb_pembelian.*, tb_barang.*, tb_kategori.*,
			(brg_hargadasar*beli_jumlahbrg) AS beli_hargadasar
			FROM tb_pembelian
			LEFT JOIN tb_barang
				ON beli_idbrg = brg_id
			LEFT JOIN tb_kategori
				ON brg_idkat = kat_id
			WHERE beli_idpo = '$nomor_po'
        ");

		return $orders->result();
	}

	public function po_data_for_report($id_po)
	{
		$this->db->select('*');
		$this->db->from('tb_po');
		$this->db->join('tb_admin', 'po_idadm = adm_id', 'left');
		$this->db->join('tb_supplier', 'po_idsup = sup_id', 'left');
		$this->db->where('po_id', $id_po);
		$data = $this->db->get()->row();

		return $data;
	}


	public function is_po_exist_and_admin_match($idpo)
	{
		return ($this->db->where('po_id', $idpo)->where('po_idadm', $this->user_id)->get('tb_po')->num_rows() > 0) ? TRUE : FALSE;
	}
	
	public function transaction_overview()
	{
		$data = $this->db->query("
			SELECT  MONTH(nota_tgl) AS month, SUM(jual_jumlahbrg*brg_hargajual-jual_diskon) AS income
			FROM tb_nota
			LEFT JOIN tb_penjualan 
				ON jual_idnota = nota_id
			LEFT JOIN tb_barang
				ON jual_idbrg = brg_id
				WHERE nota_status = 'selesai'
			GROUP BY MONTH(nota_tgl)
		");

		return $data->result();
	}

	public function transaction_count()
	{
		$data = $this->db->query("
			SELECT  MONTH(nota_tgl) AS month, COUNT(*) AS sale
			FROM tb_nota
			WHERE nota_status = 'selesai'
			GROUP BY MONTH(nota_tgl)
		");

		return $data->result();
	}

	public function search_all_avail_products($term)
	{
		$data = $this->db->query("
			SELECT brg_id, brg_nama, brg_stok, brg_satuan
			FROM tb_barang
			LEFT JOIN tb_kategori
				ON kat_id = brg_idkat
			WHERE brg_stok >0 AND
			(brg_nama LIKE '%$term%' OR brg_id LIKE '%$term%')
		")->result();

		return $data;
	}

	public function get_single_product_data($idbrg)
	{
		$this->db->select('*');
		$this->db->from('tb_barang');
		$this->db->where('brg_id', $idbrg);
		$data = $this->db->get()->row();

		//$this->db->where('brg_id', $id)->get('tb_barang')->row();
		return $data;
	}
	// 
	// BATAS SINI
	// 

	public function latest_orders()
	{
		$orders = $this->db->query("
            SELECT o.id, o.order_number, o.order_date, o.order_status, o.payment_method, o.total_price, o.total_items, c.name AS coupon, cu.name AS customer
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            JOIN customers cu
                ON cu.user_id = o.user_id
            ORDER BY o.order_date DESC
            LIMIT 5
        ");

		return $orders->result();
	}

	public function is_order_exist($id)
	{
		return ($this->db->where('id', $id)->get('orders')->num_rows() > 0) ? TRUE : FALSE;
	}

	public function order_data($id)
	{
		$data = $this->db->query("
            SELECT o.*, c.name, c.code, p.id as payment_id, p.payment_price, p.payment_date, p.picture_name, p.payment_status, p.confirmed_date, p.payment_data
            FROM orders o
            LEFT JOIN coupons c
                ON c.id = o.coupon_id
            LEFT JOIN payments p
                ON p.order_id = o.id
            WHERE o.id = '$id'
        ");

		return $data->row();
	}

	public function order_items($id)
	{
		$items = $this->db->query("
            SELECT oi.product_id, oi.order_qty, oi.order_price, p.name, p.picture_name
            FROM order_item oi
            JOIN products p
	            ON p.id = oi.product_id
            WHERE order_id = '$id'");

		return $items->result();
	}

	public function set_status($status, $order)
	{
		return $this->db->where('id', $order)->update('orders', array('order_status' => $status));
	}

	public function product_ordered($id)
	{
		$orders = $this->db->query("
            SELECT oi.*, o.id as order_id, o.order_number, o.order_date, c.name, p.product_unit AS unit
            FROM order_item oi
            JOIN orders o
	            ON o.id = oi.order_id
            JOIN customers c
                ON c.user_id = o.user_id
            JOIN products p
	            ON p.id = oi.product_id
            WHERE oi.product_id = '$id'");

		return $orders->result();
	}

	public function order_by($id)
	{
		return $this->db->where('user_id', $id)->order_by('order_date', 'DESC')->get('orders')->result();
	}

	public function order_overview()
	{
		$overview = $this->db->query("
            SELECT MONTH(order_date) month, COUNT(order_date) sale 
            FROM orders
            WHERE order_date >= NOW() - INTERVAL 1 YEAR
            GROUP BY MONTH(order_date)");

		return $overview->result();
	}

}
