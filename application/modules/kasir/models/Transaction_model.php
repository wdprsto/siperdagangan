<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

	
    public function get_all_my_transactions()
    {
        $id = $this->user_id;

        $orders = $this->db->query("
			SELECT *
			FROM tb_nota
			LEFT JOIN tb_kasir
				ON nota_idksr = ksr_id
			WHERE nota_idksr = '$id'
        ");

        return $orders->result();
    }

    public function get_all_my_transactions_for_api()
    {
        $id = $this->user_id;

        $orders = $this->db->query("
			SELECT tb_nota.*, tb_kasir.*, GROUP_CONCAT(jual_idbrg) AS jual_idbrg, GROUP_CONCAT(brg_nama) AS brg_nama, GROUP_CONCAT(brg_hargajual) AS brg_hargajual, GROUP_CONCAT(jual_jumlahbrg) AS jual_jumlahbrg, GROUP_CONCAT(brg_hargajual*jual_jumlahbrg) AS jual_hargajual, SUM(brg_hargajual*jual_jumlahbrg) AS jual_totalhargajual, GROUP_CONCAT(brg_satuan) AS brg_satuan, GROUP_CONCAT(jual_diskon) AS jual_diskon,   SUM(jual_diskon) AS jual_totaldiskon, SUM(brg_hargajual*jual_jumlahbrg-jual_diskon) AS jual_totalbersih
			FROM tb_nota
			LEFT JOIN tb_kasir
				ON nota_idksr = ksr_id
			LEFT JOIN tb_penjualan
				ON jual_idnota = nota_id
			LEFT JOIN tb_barang
				ON jual_idbrg = brg_id
			GROUP BY nota_id
			HAVING nota_idksr='$id'
        ");

        return $orders->result();
    }

	public function delete_nota($id_nota)
    {
		$this->db->where('jual_idnota', $id_nota)->delete('tb_penjualan');
		$this->db->where('nota_id', $id_nota)->delete('tb_nota');
        return true;
    }

	
	public function get_last_nota_id(){
		$tanggal = date("Ymd");

		$last_id = $this->db->query("
			SELECT nota_id
			FROM tb_nota
			WHERE nota_id LIKE '$tanggal%'
			ORDER BY nota_id DESC
			LIMIT 1
		");

		return $last_id->row();
	}

	
    public function add_new_nota(Array $nota)
    {
        $this->db->insert('tb_nota', $nota);
		
    }

	
	public function get_all_notas()
    {
        
        $orders = $this->db->query("
            SELECT * FROM tb_penjualan
            LEFT JOIN tb_barang
                ON jual_idbrg = brg_id
			LEFT JOIN tb_kategori
				ON brg_idkat = kat_id
        ");

        return $orders->result();
    }
	
	public function get_all_nota_products($nomor_nota)
    {
        
        $orders = $this->db->query("
			SELECT * FROM tb_penjualan
			LEFT JOIN tb_barang
				ON jual_idbrg = brg_id
			LEFT JOIN tb_kategori
				ON brg_idkat = kat_id
			WHERE jual_idnota = '$nomor_nota'
        ");

        return $orders->result();
    }

	public function is_nota_brg_unique($idnota_pesanan, $idbrg_pesanan)
    {
        return ($this->db->where('jual_idnota', $idnota_pesanan)->where('jual_idbrg', $idbrg_pesanan)->get('tb_penjualan')->num_rows() > 0) ? FALSE : TRUE;
    }

	public function add_new_nota_product(Array $products)
    {
        $this->db->insert('tb_penjualan', $products);
		
    }

	public function add_new_nota_product_retur($products)
    {
		$this->db->insert('tb_penjualan', $products);

		$jumlah_brg = $products['jual_jumlahbrg'];
		$idbrg = $products['jual_idbrg'];
		$this->db->query("
			UPDATE tb_barang
			SET brg_stok = brg_stok - '$jumlah_brg'
			WHERE brg_id = '$idbrg'
		");
		
    }

	public function get_total_sum_nota_products($nomor_nota)
    {
        
        $orders = $this->db->query("
            SELECT sum(jual_jumlahbrg*brg_hargajual-jual_diskon) as total_harga, count(*) as total_barang FROM tb_penjualan
            LEFT JOIN tb_barang
                ON jual_idbrg = brg_id
			WHERE jual_idnota = '$nomor_nota'
        ");

        return $orders->row();
    }

	public function get_total_sum_nota_products_for_report($nomor_nota)
    {
        
        $orders = $this->db->query("
            SELECT SUM(brg_hargajual*jual_jumlahbrg) AS total_hargakotor, sum(jual_jumlahbrg*brg_hargajual-jual_diskon) as total_hargabersih, SUM(jual_diskon) AS total_diskon, count(*) as total_barang FROM tb_penjualan
            LEFT JOIN tb_barang
                ON jual_idbrg = brg_id
			WHERE jual_idnota = '$nomor_nota'
        ");

        return $orders->row();
    }

	public function get_all_nota_products_for_report($nomor_nota)
    {
        $orders = $this->db->query("
			SELECT tb_penjualan.*, tb_barang.*, tb_kategori.*,
			(brg_hargajual*jual_jumlahbrg) AS jual_hargajual,
			(brg_hargajual*jual_jumlahbrg-jual_diskon) AS jual_hargadiskon
			FROM tb_penjualan
			LEFT JOIN tb_barang
				ON jual_idbrg = brg_id
			LEFT JOIN tb_kategori
				ON brg_idkat = kat_id
			WHERE jual_idnota = '$nomor_nota'
        ");

        return $orders->result();
    }

	public function jumlah_barang_di_nota($nomor_nota)
	{
		$this->db->select('*');
		$this->db->from('tb_nota'); 
		$this->db->join('tb_penjualan', 'nota_id = jual_idnota', 'left');
		$this->db->where('nota_id',$nomor_nota);     
		$data = $this->db->get()->num_rows(); 

	return $data;

	}

	public function nota_data_for_report($id_nota)
    {
		$this->db->select('*');
		$this->db->from('tb_nota'); 
		$this->db->join('tb_kasir', 'nota_idksr = ksr_id', 'left');
		$this->db->where('nota_id',$id_nota);     
		$data = $this->db->get()->row(); 

		return $data;
    }

	//inkremental
	public function update_product_qty($idnota, $idbarang, $newqty, $newdiskon)
    {
		return $this->db->query("
			UPDATE tb_penjualan
			SET jual_jumlahbrg = jual_jumlahbrg + '$newqty',  jual_diskon = jual_diskon + '$newdiskon'
			WHERE jual_idbrg = '$idbarang' AND jual_idnota = '$idnota'
		");
    }

	public function update_product_qty_retur($idnota, $idbarang, $newqty, $newdiskon)
    {
		//newqty=stok tambahan yang akan ditambahkan
		$this->db->query("
			UPDATE tb_penjualan
			SET jual_jumlahbrg = jual_jumlahbrg + '$newqty',  jual_diskon = jual_diskon + '$newdiskon'
			WHERE jual_idbrg = '$idbarang' AND jual_idnota = '$idnota'
		");

		$this->db->query("
			UPDATE tb_barang
			SET brg_stok = brg_stok - '$newqty'
			WHERE brg_id = '$idbarang'
		");

		return true;
    }
	
	//update sesuai masukan
	public function edit_product_qty($idnota, $idbarang, $newqty, $newdiskon)
    {
		return $this->db->query("
			UPDATE tb_penjualan
			SET jual_jumlahbrg = '$newqty', jual_diskon = '$newdiskon'
			WHERE jual_idbrg = '$idbarang' AND jual_idnota = '$idnota'
		");
    }

	public function edit_product_qty_retur($idnota, $idbarang, $newqty, $newdiskon, $selisih)
    {
		$this->db->query("
			UPDATE tb_penjualan
			SET jual_jumlahbrg = '$newqty', jual_diskon = '$newdiskon'
			WHERE jual_idbrg = '$idbarang' AND jual_idnota = '$idnota'
		");

		$this->db->query("
			UPDATE tb_barang
			SET brg_stok = brg_stok - '$selisih'
			WHERE brg_id = '$idbarang'
		");

		return true;
    }

	public function delete_product($idnota, $idbrg)
    {
		$this->db->where('jual_idbrg', $idbrg)->where('jual_idnota', $idnota)->delete('tb_penjualan');
        return true;
    }

	public function delete_product_retur($idnota, $idbrg)
    {
		$this->db->query("
			UPDATE tb_barang LEFT JOIN tb_penjualan ON brg_id = jual_idbrg
			SET brg_stok = brg_stok + jual_jumlahbrg
			WHERE jual_idbrg = '$idbrg' AND jual_idnota = '$idnota'
		");
		$this->db->where('jual_idbrg', $idbrg)->where('jual_idnota', $idnota)->delete('tb_penjualan');
        return true;
    }
	
	public function product_data($idnota, $idbrg){
		$this->db->select('*');
		$this->db->from('tb_penjualan'); 
		$this->db->join('tb_barang', 'jual_idbrg = brg_id', 'left');
		$this->db->where('jual_idnota',$idnota);    
		$this->db->where('jual_idbrg',$idbrg);     
		$data = $this->db->get()->row(); 

		//$this->db->where('brg_id', $id)->get('tb_barang')->row();
		return $data;
	}

	public function save_nota($idnota, $data)
    {
	
		$this->db->where('nota_id', $idnota)->update('tb_nota', $data);
		$this->db->query("
			UPDATE tb_barang tbb
			INNER JOIN tb_penjualan tbp
			ON tbb.brg_id = tbp.jual_idbrg
			SET tbb.brg_stok = tbb.brg_stok - tbp.jual_jumlahbrg
			WHERE tbp.jual_idnota = '$idnota'
		");
		return true;
    }

	public function get_all_avail_products()
	{
		$data = $this->db->query("
			SELECT *
			FROM tb_barang
			LEFT JOIN tb_kategori
				ON kat_id = brg_idkat
			WHERE brg_stok >0
		")->result();

		return $data;
	}

	public function get_product_data($id)
	{
		$data = $this->db->query("
			SELECT *
			FROM tb_barang
			LEFT JOIN tb_kategori
				ON kat_id = brg_idkat
			WHERE brg_id = '$id'
		")->result();

		return $data;
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

	public function check_stock($idnota, $idbrg_pesanan, $pesanan_sekarang)
    {

		$this->db->select('*');
		$this->db->from('tb_barang'); 
		$this->db->join('tb_penjualan', 'jual_idbrg=brg_id', 'right'); 
		$this->db->where('jual_idbrg',$idbrg_pesanan);    
		$this->db->where('jual_idnota',$idnota);    
		$data = $this->db->get()->row(); 

		return ($data->brg_stok - ($pesanan_sekarang + $data->jual_jumlahbrg) >= 0) ? TRUE : FALSE;
    }

	public function check_stock_retur($idnota, $idbrg_pesanan, $pesanan_sekarang)
	{

	$this->db->select('*');
	$this->db->from('tb_barang'); 
	$this->db->join('tb_penjualan', 'jual_idbrg=brg_id', 'right'); 
	$this->db->where('jual_idbrg',$idbrg_pesanan);    
	$this->db->where('jual_idnota',$idnota);    
	$data = $this->db->get()->row(); 

	return (($data->brg_stok - $data->jual_jumlahbrg) >= 0) ? TRUE : FALSE;
	// return ($data->brg_stok - $data->jual_jumlahbrg);
	}

	public function is_nota_exist($idnota)
    {
        return ($this->db->where('nota_id', $idnota)->get('tb_nota')->num_rows() > 0) ? TRUE : FALSE;
    }
	
	
	public function is_nota_exist_and_kasir_match($idnota)
    {
        return ($this->db->where('nota_id', $idnota)->where('nota_idksr', $this->user_id)->get('tb_nota')->num_rows() > 0) ? TRUE : FALSE;
    }
	

    public function count_all_transactions()
    {
        $id_kasir = $this->user_id;

        return $this->db->where('nota_idksr', $id_kasir)->get('tb_nota')->num_rows();
    }

	public function count_pending_transactions()
    {
        $id_kasir = $this->user_id;

        return $this->db->where('nota_idksr', $id_kasir)->where('nota_status', 'belum_selesai')->get('tb_nota')->num_rows();
    }

	public function sum_finished_transactions()
    {
		$id_kasir = $this->user_id;

        $orders = $this->db->query("
			SELECT SUM(brg_hargajual*jual_jumlahbrg-jual_diskon) AS total_penjualanselesai
			FROM tb_nota
			LEFT JOIN tb_penjualan
				ON jual_idnota = nota_id
			LEFT JOIN tb_barang
				ON jual_idbrg = brg_id
			WHERE nota_status = 'selesai' AND
					nota_idksr = '$id_kasir'
        ");

        return $orders->row()->total_penjualanselesai;
    }

	// 
	// END
	// 

    public function count_process_order()
    {
        $id = $this->user_id;

        return $this->db->where(array('user_id' => $id, 'order_status' => 2))->get('orders')->num_rows();
    }

    public function order_with_bank_payments()
    {
        return $this->db->where(array('user_id' => $this->user_id, 'payment_method' => 1, 'order_status' => 1))->order_by('order_date', 'DESC')->get('orders')->result();
    }

    public function is_order_exist($id)
    {
        $user_id = $this->user_id;

        return ($this->db->where(array('id' => $id, 'user_id' => $user_id))->get('orders')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function order_data($id)
    {
        $data = $this->db->query("
            SELECT o.*, c.name, c.code, p.payment_price, p.payment_date, p.picture_name, p.payment_status, p.confirmed_date, p.payment_data
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

    public function cancel_order($id)
    {
        $data = $this->order_data($id);
        $payment_method = $data->payment_method;

        $status =  ($payment_method == 1) ? 5 : 4; 

        return $this->db->where('id', $id)->update('orders', array('order_status' => $status));
    }

    public function delete_order($id)
    {
        if ( ($this->db->where('order_id', $id)->get('order_item')->num_rows() > 0)){
            $this->db->where('order_id', $id)->delete('order_item');
        }
       
        if ( ($this->db->where('order_id', $id)->get('payments')->num_rows() > 0)){
            $this->db->where('order_id', $id)->delete('payments');
        }
        
        $this->db->where('id', $id)->delete('orders');
    }

    public function all_orders()
    {
        $id = $this->user_id;

        $orders = $this->db->query("           
            SELECT *, o.id AS id, o.order_number AS order_number 
            FROM orders AS o
            LEFT JOIN reviews AS r
            ON o.id = r.order_id
            WHERE o.user_id = '$id' AND r.id IS NULL
            ORDER BY order_date DESC;
        ");

        return $orders->result();
    }
	public function nota_data($id_nota)
    {
		return $this->db->where('nota_id', $id_nota)->get('tb_nota')->row();
    }

	//
	// MENGELOLA PRODUK
	//
	
	//CATEGORY MODEL
    public function get_all_categories()
    {
        return $this->db->order_by('kat_nama', 'ASC')->get('tb_kategori')->result();
    }
	
    public function add_category($id,$name)
    {
		$this->db->insert('tb_kategori', array('kat_id'=>$id,'kat_nama' => $name));

        return $this->db->insert_id();
    }

	public function delete_category($id)
    {
        return $this->db->where('kat_id', $id)->delete('tb_kategori');
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

	public function edit_product($id, $product)
    {
        return $this->db->where('brg_id', $id)->update('tb_barang', $product);
    }
	
    public function add_new_product(Array $products)
    {
        $this->db->insert('tb_barang', $products);
		
    }
	
	public function last_category_product_id($kat_id)
    {
		return $this->db->where('brg_idkat', $kat_id)->order_by('brg_id', 'DESC')->limit(1)->get('tb_barang')->row();
    }	

}
