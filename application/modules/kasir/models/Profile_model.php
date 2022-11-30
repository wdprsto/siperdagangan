<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

    public function get_profile()
    {
        $id = $this->user_id;

        $data = $this->db->query("
            SELECT *
            FROM tb_kasir
            WHERE ksr_id = '$id'
        ");

        return $data->row();
    }

    public function update($data)
    {
        $this->db->where('ksr_id', $this->user_id)->update('tb_kasir', $data);
        // $this->db->where('ksr_id', $this->user_id)->update('tb_kasir', array('profile_picture'=>$data->profile_picture)); 
        return true;
    }

    public function update_account($data)
    {
		$this->db->query("SET FOREIGN_KEY_CHECKS=0;");
		$this->db->where('nota_idksr', $this->user_id)->update('tb_nota', array('nota_idksr' => $data->ksr_id));
        $this->db->where('ksr_id', $this->user_id)->update('tb_kasir', $data);
		$this->db->query("SET FOREIGN_KEY_CHECKS=1;");
        return true;
    }
}
