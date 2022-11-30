<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->library('encryption');
        $this->load->helper('cookie');
    }

    public function index()
    {
        $check_session_in_cookie = $this->input->cookie('__ACTIVE_SESSION_DATA');
        $check_session_in_session = $this->session->userdata('__ACTIVE_SESSION_DATA');

		$change_uname_notice =  $this->session->flashdata('change_uname_notice');

        if ($check_session_in_cookie)
        {
            delete_cookie('__ACTIVE_SESSION_DATA');
			
            $this->session->set_flashdata('login_flash', 'Berhasil logout!');
			
			if($change_uname_notice){	
				$this->session->set_flashdata('change_uname_notice', $change_uname_notice);
			}
        }
        else if ($check_session_in_session)
        {
            $this->session->unset_userdata('__ACTIVE_SESSION_DATA');

            $this->session->set_flashdata('login_flash', 'Berhasil logout!');

			if($change_uname_notice){	
				$this->session->set_flashdata('change_uname_notice', $change_uname_notice);
			}
        }
        else
        {
            $this->session->set_flashdata('login_flash', 'Anda belum login!');
        }

        redirect('/auth/login');
    }
}
