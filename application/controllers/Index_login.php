<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index_login extends CI_Controller {

	public function index()
	{
		$session_data = session_data();

		if($session_data->user_role == 'admin'){
			redirect('admin');
		}
		else if($session_data->user_role == 'kasir'){
			redirect('kasir');
		}else{
			redirect('auth/login');
		}
		
	}
}
