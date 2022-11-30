<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Passwords extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		verify_session('admin');

		$this->load->model(array(
			'password_model' => 'password',
			// 'order_model' => 'order',
			// 'payment_model' => 'payment'
		));
		$this->load->library('form_validation');
	}

	public function index()
	{
		$params['title'] = 'Kelola Password';
		$params['active_page'] = "password";

		$this->load->view('header', $params);
		$this->load->view('passwords/passwords');
		$this->load->view('footer');
	}

	public function view($id = 0)
	{
		if ($this->customer->is_kasir_exist($id)) {
			$data = $this->customer->customer_data($id);

			$params['title'] = $data->name;

			$customer['customer'] = $data;
			$customer['flash'] = $this->session->flashdata('customer_flash');
			$customer['orders'] = $this->order->order_by($id);
			$customer['payments'] = $this->payment->payment_by($id);

			$this->load->view('header', $params);
			$this->load->view('customers/view', $customer);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	public function edit($action = '')
	{
		switch ($action) {
			// case 'admin_password':
			// 	$id = $this->input->post('id');
			// 	$password = $this->input->post('password');
			// 	$password = password_hash($password, PASSWORD_BCRYPT);

			// 	$this->password->edit_admin_password($id, $password);
			// 	$response = array('code' => 201);
			// 	break;
			case 'kasir_password':
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
				$this->form_validation->set_message('required', '%s dibutuhkan.');
				$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
				
				if ($this->form_validation->run() === FALSE) {
					$this->index();
					$response = array('code' => 409);

					if (form_error('password')) {
						$response['password_error'] = form_error('password');
					}
				} else {
					$id = $this->input->post('id');
					$password = $this->input->post('password');
					$password = password_hash($password, PASSWORD_BCRYPT);

					$this->password->edit_kasir_password($id, $password);
					$response = array('code' => 201);
				}
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}

	public function api($action = '')
	{
		switch ($action) {
			case 'admin_passwords':
				$id = get_current_user_id();
				$passwords = $this->password->get_all_admin_passwords($id);

				// $n = 0;
				// foreach ($passwords as $password)
				// {
				//     $passwords[$n]->profile_picture = base_url('assets/uploads/users/'. $password->profile_picture);

				//     $n++;
				// }

				$passwords['data'] = $passwords;

				$response = $passwords;
				break;
			case 'kasir_passwords':
				$passwords = $this->password->get_all_kasir_passwords();

				$passwords['data'] = $passwords;

				$response = $passwords;
				break;
			case 'add_kasir':
				//HARUS ADA FORM VALIDATION DI SINI
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

				//UNTUK UNIQUE BEBERAPA TABEL: $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_admin.admin_id <> '. $this->session->userdata('admin_id').' and email=]');
				// $this->form_validation->set_rules('nohp', 'No. HP', 'required|is_unique[tb_kasir.ksr_nohp]|is_unique[tb_admin.adm_nohp]',array('is_unique' => 'The %s is already taken'));
				
				
				// "add_user_rule"   => [
				// 	[
				// 		"field" => "username",
				// 		"label" => "Username",
				// 		"rules" => "required|trim|is_unique[users.username]",
				// 		"errors" => [
				// 			'is_unique' => 'The %s is already taken.',
				// 		],
				// 	],
				// ],

				$this->form_validation->set_rules('id', 'Id Kasir', 'required|is_unique[tb_kasir.ksr_id]|is_unique[tb_admin.adm_id]|min_length[6]');
				$this->form_validation->set_rules('nohp', 'No. HP', 'required|is_unique[tb_kasir.ksr_nohp]|is_unique[tb_admin.adm_nohp]|min_length[10]');
				$this->form_validation->set_rules('nama', 'Nama', 'required|min_length[1]');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
				
				// atur pesan yang akan ditampilkan jika terjadi error
				
				$this->form_validation->set_message('required', '%s dibutuhkan.');
				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
				$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');

				if ($this->form_validation->run() === FALSE) {
					$this->index();
					$response = array('code' => 409);

					if (form_error('id')) {
						
						$response['id_error'] = form_error('id');
					}
					if (form_error('nohp')) {
						$response['nohp_error'] = form_error('nohp');
					}
					if (form_error('nama')) {
						
						$response['nama_error'] = form_error('nama');
					}
					if (form_error('password')) {
						$response['password_error'] = form_error('password');
					}
				} else {
					$id = $this->input->post('id');
					$nama = $this->input->post('nama');
					$nohp = $this->input->post('nohp');
					$password = $this->input->post('password');
					$password = password_hash($password, PASSWORD_BCRYPT);

					$data = array(
						'ksr_id' => $id,
						'ksr_nama' => $nama,
						'ksr_nohp' => $nohp,
						'ksr_password' => $password,
					);

					$this->password->add_kasir($data);
					$response = array('code' => 204);
				}
				break;
			case 'delete_admin':
				$id = $this->input->post('id');

				$this->password->delete_admin($id);

				$response = array('code' => 204);
				break;
			case 'delete_kasir':
				$id = $this->input->post('id');

				$this->password->delete_kasir($id);

				$response = array('code' => 204);
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}
}
