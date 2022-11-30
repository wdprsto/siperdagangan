<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->library(['form_validation', 'encryption']);
        $this->load->model('auth/Register_model', 'register');
    }

    public function index()
    {
        $this->load->view('auth/register');
    }

    public function verify()
    {
        $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[16]|is_unique[tb_admin.adm_id]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('phone_number', 'No. HP', 'required|min_length[9]|max_length[16]|is_unique[tb_admin.adm_nohp]');
		$this->form_validation->set_rules('role', 'Role', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|min_length[10]');
        // $this->form_validation->set_rules('address', 'Alamat', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $name = $this->input->post('name');
            $phone_number = $this->input->post('phone_number');
			$role =  $this->input->post('role');
            // $email = $this->input->post('email');
            // $address = $this->input->post('address');

            $password = password_hash($password, PASSWORD_BCRYPT);
            
			if($role == 'admin'){
				$admin_data = array(
					// 'email' => $email,
					'adm_id' => $username,
					'adm_password' => $password,
					'adm_nama' => $name,
					'adm_nohp' => $phone_number
					// 'role_id' => 2,
					// 'register_date' => date('Y-m-d H:i:s'),
					// 'profile_picture' => 'users.png'
				);

				// $user = $this->register->register_admin($admin_data);
				$this->register->register_admin($admin_data);
			}
			else if($role == 'kasir'){
				$kasir_data = array(
					// 'email' => $email,
					'ksr_id' => $username,
					'ksr_password' => $password,
					'ksr_nama' => $name,
					'ksr_nohp' => $phone_number
					// 'role_id' => 2,
					// 'register_date' => date('Y-m-d H:i:s'),
					// 'profile_picture' => 'users.png'
				);

				// $user = $this->register->register_kasir($kasir_data);
				$this->register->register_kasir($kasir_data);
			}
            

            // $customer_data = array(
            //     'user_id' => $user,
            //     'name' => $name,
            //     'phone_number' => $phone_number,
            //     // 'address' => $address,
            //     'profile_picture' => 'users.png'
            // );

            // $this->register->register_customer($customer_data);

            $login_data = [
                'is_login' => TRUE,
                // 'user_id' => $user,
				'user_id' => $username,
                'login_at' => time(),
                'remember_me' => FALSE,
				'user_role' => $role
            ];

            $login_data = json_encode($login_data);
            $login_session = $this->encryption->encrypt($login_data);
            $this->session->set_userdata('__ACTIVE_SESSION_DATA', $login_session);

            $this->session->set_flashdata('store_flash', 'Pendaftaran akun berhasil!');
           
			if($role === 'admin'){
				redirect('admin');
			}
			else if($role === 'kasir'){
				redirect('kasir');
			}
            
        }
    }
}


