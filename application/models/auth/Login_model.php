<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    protected $username;
    protected $password;
	  protected $role;

    public function __construct()
    {
        parent::__construct();
    }

    public function login($username = '', $password = '')
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function is_user_exist()
    {
        $username = $this->username;

        $check_admin = $this->db
            ->where('adm_id', $username)
            ->get('tb_admin')
            ->num_rows();

				$check_kasir = $this->db
            ->where('ksr_id', $username)
            ->get('tb_kasir')
            ->num_rows();

				if($check_admin>0){
						$this->role = 'admin';
						return TRUE;
				}
				else if($check_kasir>0){
						$this->role = 'kasir';
						return TRUE;
				}

				return FALSE;
    }

    protected function _get($row = '')
    {
        $username = $this->username;
			
				switch($row): 
					case 'password': 
						if($this->role == 'admin'){
							$field = $this->db
							->select('adm_password')
							->where('adm_id', $username)
							->get('tb_admin')
							->row()
							->adm_password;
						}else if($this->role == 'kasir'){
							$field = $this->db
							->select('ksr_password')
							->where('ksr_id', $username)
							->get('tb_kasir')
							->row()
							->ksr_password;
						}
						return $field;
						break;
					case 'nama': 
						if($this->role == 'admin'){
							$field = $this->db
							->select('adm_nama')
							->where('adm_id', $username)
							->get('tb_admin')
							->row()
							->adm_password;
						}else if($this->role == 'kasir'){
							$field = $this->db
							->select('ksr_nama')
							->where('ksr_id', $username)
							->get('tb_kasir')
							->row()
							->ksr_password;
						}
						return $field;
						break;
				endswitch;
    }

    public function get_role()
    {
        return $this->role;
    }

    public function get_password()
    {
        return $this->_get('password');
    }

	public function get_name()
    {
        return $this->_get('nama');
    }

	public function logged_username()
    {
        return $this->username;
    }


    // public function logged_user_id()
    // {
    //     return $this->_get('id');
    // }
}
