<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
    public $user_id;

    public function __construct()
    {
        parent::__construct(); 

        $this->user_id = get_current_user_id();
    }

    public function get_profile()
    {
        $id = $this->user_id;
        $user = $this->db->where('adm_id', $id)->get('tb_admin');

        return $user->row();
    }

	public function get_kasir($id)
    {
        $user = $this->db->where('ksr_id', $id)->get('tb_kasir');

        return $user->row();
    }

    public function update_profile($data)
    {
        $id = $this->user_id;
		$this->db->query("SET FOREIGN_KEY_CHECKS=0;");
		$this->db->where('po_idadm', $id)->update('tb_po', array('po_idadm' => $data['adm_id']));
		$this->db->where('adm_id', $id)->update('tb_admin', $data);
		$this->db->query("SET FOREIGN_KEY_CHECKS=1;");
        return true;
    }
}
