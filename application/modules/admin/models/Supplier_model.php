<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

	
    public function get_all_suppliers()
    {
        return $this->db->get('tb_supplier')->result();
    }
	
    public function add_supplier($data)
    {
        $this->db->insert('tb_supplier', $data);

        return $this->db->insert_id();
    }

	public function delete_supplier($id)
    {
		$this->db->query("SET FOREIGN_KEY_CHECKS=0;"); 
		$this->db->where('sup_id', $id)->delete('tb_supplier');
		$this->db->query("SET FOREIGN_KEY_CHECKS=1;");
        return true;
    }

    public function supplier_data($id)
    {
        return $this->db->where('sup_id', $id)->get('tb_supplier')->row();
    }

    public function edit_supplier($id, $data)
    {
        return $this->db->where('sup_id', $id)->update('tb_supplier', $data);
    }
	
	public function latest_supplier()
    {
        return $this->db->order_by('sup_id', 'DESC')->limit(5)->get('tb_supplier')->result();
    }

	public function last_supplier_id()
	{
		return $this->db->order_by('sup_id', 'DESC')->limit(1)->get('tb_supplier')->row();
	}
}
