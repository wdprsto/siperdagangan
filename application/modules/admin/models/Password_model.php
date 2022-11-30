<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

		public function get_all_kasir()
		{
			return $this->db->get('tb_kasir')->result();
		}

    public function count_all_admin_password()
    {
        return $this->db->get('tb_admin')->num_rows();
    }

	public function count_all_kasir_password()
    {
        return $this->db->get('tb_kasir')->num_rows();
    }
	
	public function get_all_admin_passwords($id)
	{
		$admin_passwords = $this->db->query("
			SELECT *
			FROM tb_admin
			WHERE adm_id <> '$id'
		");
				
		return $admin_passwords->result();
	}

	public function get_all_kasir_passwords()
	{
		$admin_passwords = $this->db->query("
			SELECT *
			FROM tb_kasir
		");
				
		return $admin_passwords->result();
	}
	
	public function delete_admin($id)
	{
		// $this->db->query("SET FOREIGN_KEY_CHECKS=0;");
		$this->db->where('adm_id', $id)->delete('tb_admin');
		// $this->db->where('id', $id)->delete('users');
		// $this->db->where('user_id', $id)->delete('orders');
		// $this->db->query("
		// 	DELETE order_item
		// 	FROM order_item
		// 	JOIN orders
		// 		ON orders.id = order_item.order_id
		// 	WHERE orders.user_id = '$id'");
		// $this->db->query("
		// 	DELETE payments
		// 	FROM payments
		// 	INNER JOIN orders ON orders.id = payments.order_id
		// 	WHERE orders.user_id = '$id'");
		// $this->db->query("DELETE orders FROM orders WHERE user_id = '$id'");
	}

	public function edit_admin_password($id, $password)
	{
		$this->db->query("
            UPDATE tb_admin
						SET adm_password = '$password'
            WHERE adm_id = '$id'
        ");
	}

	public function edit_kasir_password($id, $password)
	{
		$this->db->query("
            UPDATE tb_kasir
						SET ksr_password = '$password'
            WHERE ksr_id = '$id'
        ");
	}

	public function delete_kasir($id)
	{
		$this->db->query("SET FOREIGN_KEY_CHECKS=0;");
		$this->db->where('ksr_id', $id)->delete('tb_kasir');
		$this->db->query("SET FOREIGN_KEY_CHECKS=1;");
	}

    public function latest_customers()
    {   
        $sql="select * from customers order by id DESC limit 0,5";
        //return $this->db->order_by('id', 'DESC')->get('customers')->limit("5")->result();
        return $this->db->query($sql)->result();
    }


    public function is_kasir_exist($id)
    {
        return ($this->db->where('user_id', $id)->get('customers')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function customer_data($id)
    {
        $customer = $this->db->query("
            SELECT c.user_id as id, c.profile_picture, c.name, u.email, c.phone_number, c.address, u.register_date
            FROM customers c
            JOIN users u
                ON u.id = c.user_id
            WHERE c.user_id = '$id'
        ");
                
        return $customer->row();
    }

		
    public function add_kasir($data)
    {
        $this->db->insert('tb_kasir', $data);

        return true;
    }
}
