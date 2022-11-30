<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('kasir');
  
        $this->load->model(array(
            'profile_model' => 'profile'
        ));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = $this->profile->get_profile();

		$params['active_page'] = "dashboard";
        $params['title'] = $data->ksr_nama;
        $user['user'] = $data;
        $user['flash'] = $this->session->flashdata('profile');

        $this->load->view('header', $params);
        $this->load->view('profile', $user);
        $this->load->view('footer');
    }

    public function edit_name()
    {
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required|max_length[30]|min_length[1]');
        $this->form_validation->set_rules('phone_number', 'No. HP', 'required|is_unique[tb_admin.adm_nohp]|is_unique[tb_kasir.ksr_id <> "'.get_current_user_id().'" and ksr_nohp=]|min_length[10]');

		$this->form_validation->set_message('required', '%s dibutuhkan.');
        $this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
		$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
		$this->form_validation->set_message('max_length', 'Panjang karakter maksimal %s adalah %s karakter.');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $data = new stdClass();

            $data->ksr_nama = $this->input->post('name');
            $data->ksr_nohp = $this->input->post('phone_number');
            // $data->address = $this->input->post('address');


            $flash_message = ($this->profile->update($data)) ? 'Profil berhasil diperbarui!' : 'Terjadi kesalahan';

            $this->session->set_flashdata('profile', $flash_message);
            redirect('kasir/profile');
        }
    }

    public function edit_account()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|is_unique[tb_admin.adm_id]|is_unique[tb_kasir.ksr_id <> "'.get_current_user_id().'" and ksr_id=]');
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');

		$this->form_validation->set_message('required', '%s dibutuhkan.');
        $this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
		$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');

        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $data = new stdClass();
            $profile = $this->profile->get_profile();

            $get_password = $this->input->post('password');

            if (empty($get_password)) {
                $password = $profile->ksr_password;
            }
            else {
                $password = password_hash($get_password, PASSWORD_BCRYPT);
            }


            $data->ksr_id = $this->input->post('username');
            $data->ksr_password = $password;
			
            $flash_message = ($this->profile->update_account($data)) ? 'Akun berhasil diperbarui' : 'Terjadi kesalahan';
            
            $this->session->set_flashdata('profile', $flash_message);
            $this->session->set_flashdata('show_tab', 'akun');

			if(get_current_user_id()==$data->ksr_id){
				redirect('kasir/profile');
			}else{
				$this->session->set_flashdata('change_uname_notice', 'Silahkan login dengan username yang baru');
				redirect('auth/logout');
			}
	
        }
    }

}
