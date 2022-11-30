<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

		$this->load->library('form_validation');
        $this->load->model(array(
            'supplier_model' => 'supplier',
        ));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $params['title'] = 'Kelola Data Supplier';
				$params['active_page'] = "supplier";

		$suppliers['flash'] = $this->session->flashdata('suppliers_flash');

        $this->load->view('header', $params);
        $this->load->view('products/supplier', $suppliers);
        $this->load->view('footer');
    }

	#KATEGORI BARANG
    public function supplier_api()
    {
        $action = $this->input->get('action');

        switch ($action) {
            case 'list' :
                $suppliers['data'] = $this->supplier->get_all_suppliers();
                $response = $suppliers;
            break;
            case 'view_data' :
                $id = $this->input->get('id');

                $data['data'] = $this->supplier->supplier_data($id);
                $response = $data;
            break;
            case 'add_supplier' :
							//HARUS ADA FORM VALIDATION DI SINI
							$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

							//UNTUK UNIQUE BEBERAPA TABEL: $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_admin.admin_id <> '. $this->session->userdata('admin_id').' and email=]');
							$this->form_validation->set_rules('id', 'Username', 'required|is_unique[tb_supplier.sup_id]');
							$this->form_validation->set_rules('nohp', 'No. HP', 'required|is_unique[tb_supplier.sup_nohp]');
							$this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required|min_length[2]');
							$this->form_validation->set_rules('inisial', 'Inisial', 'is_unique[tb_supplier.sup_inisial]');
							$this->form_validation->set_rules('norek', 'No. Rekening', 'is_unique[tb_supplier.sup_norek]');

							
							$this->form_validation->set_message('required', '%s dibutuhkan.');
							$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
							$this->form_validation->set_message('is_unique', '%s sudah terdapat pada data supplier lainnya, silahkan coba lagi.');
				
							if ($this->form_validation->run() === FALSE)
							{
								$this->index();
								$response = array('code' => 409);

								if(form_error('id')){
									$response['id_error'] = form_error('id');
								} 
								if(form_error('norek')){
									$response['norek_error'] = form_error('norek');
								} 
								if(form_error('nohp')){
									$response['nohp_error'] = form_error('nohp');
								} 
								if(form_error('inisial')){
									$response['inisial_error'] = form_error('inisial');
								} 
								if(form_error('perusahaan')){
									$response['perusahaan_error'] = form_error('perusahaan');
								} 
							}
							else
							{
								$id = $this->input->post('id');
								$perusahaan = $this->input->post('perusahaan');
								$alamat = $this->input->post('alamat');
								$norek = $this->input->post('norek');
								$bank = $this->input->post('bank');
								$personal = $this->input->post('personal');
								$nohp = $this->input->post('nohp');
								$inisial = $this->input->post('inisial');
								
								$data = array(
									'sup_id' => $id,
									'sup_perusahaan' => $perusahaan,
									'sup_alamat' => $alamat,
									'sup_norek' => $norek,
									'sup_bank' => $bank,
									'sup_personal' => $personal,
									'sup_nohp' => $nohp,
									'sup_inisial' => $inisial,
								);
				
								$this->supplier->add_supplier($data);
								$categories['data'] = $this->supplier->get_all_suppliers();
								$response = $categories;
								
							}
            break;
            case 'delete_supplier' :
                $id = $this->input->post('id');

                $this->supplier->delete_supplier($id);
                $response = array('code' => 204, 'message' => 'Supplier berhasil dihapus!');
            break;
            case 'edit_supplier' :

								$id = $this->input->post('id');
								//HARUS ADA FORM VALIDATION DI SINI
								$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

								//UNTUK UNIQUE BEBERAPA TABEL: $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_admin.admin_id <> '. $this->session->userdata('admin_id').' and email=]');
								$this->form_validation->set_rules('norek', 'No. Rekening', 'is_unique[tb_supplier.sup_id <> '.$id.' and sup_norek=]');
								$this->form_validation->set_rules('nohp', 'No. HP', 'required|is_unique[tb_supplier.sup_id <> '.$id.' and sup_nohp=]');
								$this->form_validation->set_rules('inisial', 'Inisial', 'is_unique[tb_supplier.sup_id <> '.$id.' and sup_inisial=]');
								$this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required|min_length[2]');
								$this->form_validation->set_message('is_unique', '%s sudah terdapat pada data supplier lainnya, silahkan coba lagi.');
								$this->form_validation->set_message('required', '%s dibutuhkan.');
								$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
					
								if ($this->form_validation->run() === FALSE)
								{
									$this->index();
									$response = array('code' => 409);

									if(form_error('norek')){
										$response['norek_error'] = form_error('norek');
									} 
									if(form_error('nohp')){
										$response['nohp_error'] = form_error('nohp');
									} 
									if(form_error('inisial')){
										$response['inisial_error'] = form_error('inisial');
									} 
									if(form_error('perusahaan')){
										$response['perusahaan_error'] = form_error('perusahaan');
									} 
								}
								else
								{
									//BAGIAN INI NANTI DIMULAI DENGAN FORM VALIDATION DULU
									$perusahaan = $this->input->post('perusahaan');
									$alamat = $this->input->post('alamat');
									$norek = $this->input->post('norek');
									$bank = $this->input->post('bank');
									$personal = $this->input->post('personal');
									$nohp = $this->input->post('nohp');
									$inisial = $this->input->post('inisial');

									$data = array(
										'sup_perusahaan' => $perusahaan,
										'sup_alamat' => $alamat,
										'sup_norek' => $norek,
										'sup_bank' => $bank,
										'sup_personal' => $personal,
										'sup_nohp' => $nohp,
										'sup_inisial' => $inisial,
									);

									$this->supplier->edit_supplier($id, $data);
									$response = array('code' => 201, 'message' => 'Supplier berhasil diperbarui');
								}
            break;
						case 'last_id':
							$data['data'] = $this->supplier->last_supplier_id();
							$response = $data;
						break;
        }

        $response = json_encode($response);
        $this->output->set_content_type('application/json')
            ->set_output($response);
    }
	#END OF KATEGORI BARANG
}
