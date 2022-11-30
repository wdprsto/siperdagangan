<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		verify_session('admin');

		$this->load->model(array(
			'product_model' => 'product',
			'order_model' => 'order'
		));
		$this->load->library('form_validation');
	}

	public function index()
	{
		$params['title'] = 'Kelola Barang ' . get_store_name();
		$params['active_page'] = "product";

		$products['categories'] = $this->product->get_all_categories();
		// $products['products'] = $this->product->get_all_products();

		$this->load->view('header', $params);
		$this->load->view('products/products', $products);
		$this->load->view('footer');
	}


	#KELOLA BARANG
	public function product_api()
	{
		$action = $this->input->get('action');

		switch ($action) {
			case 'list':
				$products['data'] = $this->product->get_all_products();
				$response = $products;
				break;
			case 'list_by_cat':
				$kat_id = $this->input->get('kat_id');
				$products['data'] = $this->product->get_products_by_cat($kat_id);
				$response = $products;
				break;
			case 'view_data':
				$id = $this->input->get('id');

				$data['data'] = $this->product->product_data($id);
				$response = $data;
				break;
			case 'delete_product':
				$id = $this->input->post('id');

				$this->product->delete_product($id);

				$response = array('code' => 204);
				break;
			case 'edit_product':
				$id = $this->input->post('id');
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
				
				$this->form_validation->set_rules('nama', 'Nama Barang', 'required|is_unique[tb_barang.brg_id <> '.$id.' and brg_nama=]|min_length[1]');
				$this->form_validation->set_rules('satuan', 'Satuan Barang', 'required|min_length[1]');
				$this->form_validation->set_rules('idkat', 'Kategori Barang', 'required');

				$this->form_validation->set_message('required', '%s dibutuhkan.');
				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
				$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
				
				if ($this->form_validation->run() === FALSE) {
					$this->index();
					$response = array('code' => 409);

					if (form_error('nama')) {
						$response['nama_error'] = form_error('nama');
					}
					if (form_error('satuan')) {
						$response['satuan_error'] = form_error('satuan');
					}
					if (form_error('idkat')) {
						$response['idkat_error'] = form_error('idkat');
					}
				} else {

					$nama = $this->input->post('nama');
					$stok = $this->input->post('stok');
					$satuan = $this->input->post('satuan');
					$hargadasar = $this->input->post('hargadasar');
					$hargajual = $this->input->post('hargajual');
					$idkat = $this->input->post('idkat');

					$data = array(
						'brg_nama' => $nama,
						'brg_stok' => $stok,
						'brg_satuan' => $satuan,
						'brg_hargadasar' => $hargadasar,
						'brg_hargajual' => $hargajual,
						'brg_idkat' => $idkat,
					);

					$this->product->edit_product($id, $data);
					$response = array('code' => 201, 'message' => 'Barang berhasil diperbarui');
				}
				break;
			case 'add_product':
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

				$this->form_validation->set_rules('id', 'Id Barang', 'required|is_unique[tb_barang.brg_id]');
				$this->form_validation->set_rules('nama', 'Nama Barang', 'required|is_unique[tb_barang.brg_nama]|min_length[1]');
				$this->form_validation->set_rules('satuan', 'Satuan Barang', 'required|min_length[1]');
				$this->form_validation->set_rules('idkat', 'Kategori Barang', 'required');
				
				$this->form_validation->set_message('required', '%s dibutuhkan.');
				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
				$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
				if ($this->form_validation->run() === FALSE) {
					$this->index();
					$response = array('code' => 409);

					if (form_error('id')) {
						$response['id_error'] = form_error('id');
					}
					if (form_error('nama')) {
						$response['nama_error'] = form_error('nama');
					}
					if (form_error('satuan')) {
						$response['satuan_error'] = form_error('satuan');
					}
					if (form_error('idkat')) {
						$response['idkat_error'] = form_error('idkat');
					}
				} else {
					$id = $this->input->post('id');

					$nama = $this->input->post('nama');
					//hapus koma dari nama barang
					$nama = str_replace(',', ' ', $nama);
					$stok = $this->input->post('stok');
					$satuan = $this->input->post('satuan');
					$hargadasar = $this->input->post('hargadasar');
					$hargajual = $this->input->post('hargajual');
					$idkat = $this->input->post('idkat');

					$data = array(
						'brg_id' => $id,
						'brg_nama' => $nama,
						'brg_stok' => $stok,
						'brg_satuan' => $satuan,
						'brg_hargadasar' => $hargadasar,
						'brg_hargajual' => $hargajual,
						'brg_idkat' => $idkat,
					);

					$this->product->add_new_product($data);
					$products['data'] = $this->product->get_all_products();
					$response = $products;
				}
				break;
			case 'last_product_id':
				$kat_id = $this->input->get('kat_id');

				$products['data'] = $this->product->last_category_product_id($kat_id);
				$response = $products;
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}

	// ubah harga barang

	public function edit_product_price()
	{
		$params['title'] = 'Ubah Harga Barang ' . get_store_name();
		$params['active_page'] = "edit_product_price";

		$products['categories'] = $this->product->get_all_categories();
		// $products['products'] = $this->product->get_all_products();

		$this->load->view('header', $params);
		$this->load->view('products/edit_product_price', $products);
		$this->load->view('footer');
	}

	public function api_ubah_harga()
	{

		$id_brg = $this->input->post('id');
		$jenis_harga = $this->input->post('name');
		$val = $this->input->post('val');

		if ($jenis_harga == 'harga_dasar') {
			$this->product->update_hargadasar($id_brg, $val);
			$response = array('code' => 201, 'message' => 'Barang berhasil diperbarui');
		} else if ($jenis_harga == 'harga_jual') {
			$this->product->update_hargajual($id_brg, $val);
			$response = array('code' => 201, 'message' => 'Barang berhasil diperbarui');
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}

	public function search()
	{
		$query = $this->input->get('search_query');
		$query = html_escape($query);

		$params['title'] = 'Cari "' . $query . '"';
		$params['query'] = $query;

		$config['base_url'] = site_url('admin/products/search');
		$config['total_rows'] = $this->product->count_all_products();
		$config['per_page'] = 16;
		$config['uri_segment'] = 4;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = floor($choice);

		$config['first_link']       = '«';
		$config['last_link']        = '»';
		$config['next_link']        = '›';
		$config['prev_link']        = '‹';
		$config['reuse_query_string'] = TRUE;
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->load->library('pagination', $config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$products['products'] = $this->product->search_products($query, $config['per_page'], $page);
		$products['pagination'] = $this->pagination->create_links();
		$products['count'] = $this->product->count_search($query);

		$this->load->view('header', $params);
		$this->load->view('products/search', $products);
		$this->load->view('footer');
	}

	// public function add_new_product()
	// {
	//     $params['title'] = 'Tambah Produk Baru';

	//     $product['flash'] = $this->session->flashdata('add_new_product_flash');
	//     $product['categories'] = $this->product->get_all_categories();

	//     $this->load->view('header', $params);
	//     $this->load->view('products/add_new_product', $product);
	//     $this->load->view('footer');
	// }

	// public function add_product()
	// {
	//     $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

	//     $this->form_validation->set_rules('name', 'Nama produk', 'trim|required|min_length[4]|max_length[255]');
	//     $this->form_validation->set_rules('price', 'Harga produk', 'trim|required');
	//     $this->form_validation->set_rules('stock', 'Stok barang', 'required|numeric');
	//     $this->form_validation->set_rules('unit', 'Satuan barang', 'required');
	//     $this->form_validation->set_rules('description', 'Deskripsi produk', 'max_length[512]');

	//     if ($this->form_validation->run() == FALSE)
	//     {
	//         $this->add_new_product();
	//     }
	//     else
	//     {
	//         $name = $this->input->post('name');
	//         $category_id = $this->input->post('category_id');
	//         $price = $this->input->post('price');
	//         $stock = $this->input->post('stock');
	//         $unit = $this->input->post('unit');
	//         $desc = $this->input->post('description');
	//         $date = date('Y-m-d H:i:s');

	//         $config['upload_path'] = './assets/uploads/products/';
	//         $config['allowed_types'] = 'jpg|png|jpeg';
	//         $config['max_size'] = 2048;

	//         $this->load->library('upload', $config);

	//         if ( isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0')
	//         {
	//             if ( ! $this->upload->do_upload('picture'))
	//             {
	//                 $error = array('error' => $this->upload->display_errors());

	//                 show_error($error);
	//             }
	//             else
	//             {
	//                 $upload_data = $this->upload->data();
	//                 $file_name = $upload_data['file_name'];
	//             }
	//         }

	//         $category_data = $this->product->category_data($category_id);
	//         $category_name = $category_data->name;

	//         $sku = create_product_sku($name, $category_name, $price, $stock);

	//         $product['category_id'] = $category_id;
	//         $product['sku'] = $sku;
	//         $product['name'] = $name;
	//         $product['description'] = $desc;
	//         $product['price'] = $price;
	//         $product['stock'] = $stock;
	//         $product['product_unit'] = $unit;
	//         $product['picture_name'] = $file_name;
	//         $product['add_date'] = $date;

	//         $this->product->add_new_product($product);
	//         $this->session->set_flashdata('add_new_product_flash', 'Produk baru berhasil ditambahkan!');

	//         redirect('admin/products/add_new_product');
	//     }
	// }

	// public function edit($id = 0)
	// {
	//     if ( $this->product->is_product_exist($id))
	//     {
	//         $data = $this->product->product_data($id);

	//         $params['title'] = 'Edit '. $data->name;

	//         $product['flash'] = $this->session->flashdata('edit_product_flash');
	//         $product['product'] = $data;
	//         $product['categories'] = $this->product->get_all_categories();

	//         $this->load->view('header', $params);
	//         $this->load->view('products/edit_product', $product);
	//         $this->load->view('footer');
	//     }
	//     else
	//     {
	//         show_404();
	//     }
	// }

	// public function edit_product()
	// {
	//     $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

	//     $this->form_validation->set_rules('name', 'Nama produk', 'trim|required|min_length[4]|max_length[255]');
	//     $this->form_validation->set_rules('price', 'Harga produk', 'trim|required');
	//     $this->form_validation->set_rules('stock', 'Stok barang', 'required|numeric');
	//     $this->form_validation->set_rules('unit', 'Satuan barang', 'required');
	//     $this->form_validation->set_rules('description', 'Deskripsi produk', 'max_length[512]');

	//     if ($this->form_validation->run() == FALSE)
	//     {
	//         $id = $this->input->post('id');
	//         $this->edit($id);
	//     }
	//     else
	//     {
	//         $id = $this->input->post('id');
	//         $data = $this->product->product_data($id);
	//         $current_picture = $data->picture_name;

	//         $name = $this->input->post('name');
	//         $category_id = $this->input->post('category_id');
	//         $price = $this->input->post('price');
	//         $discount = $this->input->post('price_discount');
	//         $stock = $this->input->post('stock');
	//         $unit = $this->input->post('unit');
	//         $desc = $this->input->post('description');
	//         $available = $this->input->post('is_available');
	//         $date = date('Y-m-d H:i:s');

	//         $config['upload_path'] = './assets/uploads/products/';
	//         $config['allowed_types'] = 'jpg|png|jpeg';
	//         $config['max_size'] = 2048;

	//         $this->load->library('upload', $config);

	//         if ( isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0')
	//         {
	//             if ( $this->upload->do_upload('picture'))
	//             {
	//                 $upload_data = $this->upload->data();
	//                 $new_file_name = $upload_data['file_name'];

	//                 if ( $this->product->is_product_have_image($id))
	//                 {
	//                     $file = './assets/uploads/products/'. $current_picture;

	//                     $file_name = $new_file_name;
	//                     unlink($file);
	//                 }
	//                 else
	//                 {
	//                     $file_name = $new_file_name;
	//                 }
	//             }
	//             else
	//             {
	//                 show_error($this->upload->display_errors());
	//             }
	//         }
	//         else
	//         {
	//             $file_name = ($this->product->is_product_have_image($id)) ? $current_picture : NULL;
	//         }

	//         $product['category_id'] = $category_id;
	//         $product['name'] = $name;
	//         $product['description'] = $desc;
	//         $product['price'] = $price;
	//         $product['current_discount'] = $discount;
	//         $product['stock'] = $stock;
	//         $product['product_unit'] = $unit;
	//         $product['picture_name'] = $file_name;
	//         $product['is_available'] = $available;

	//         $this->product->edit_product($id, $product);
	//         $this->session->set_flashdata('edit_product_flash', 'Produk berhasil diperbarui!');

	//         redirect('admin/products/view/'. $id);
	//     }
	// }

	public function view($id = 0)
	{
		if ($this->product->is_product_exist($id)) {
			$data = $this->product->product_data($id);

			$params['title'] = $data->name . ' | SKU ' . $data->sku;

			$product['product'] = $data;
			$product['flash'] = $this->session->flashdata('product_flash');
			$product['orders'] = $this->order->product_ordered($id);

			$this->load->view('header', $params);
			$this->load->view('products/view', $product);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}

	#KATEGORI BARANG
	public function category()
	{
		$params['title'] = 'Kelola Kategori Barang';
		$params['active_page'] = "category";


		$categories['categories'] = $this->product->get_all_categories();

		$this->load->view('header', $params);
		$this->load->view('products/category', $categories);
		$this->load->view('footer');
	}

	public function category_api()
	{
		$action = $this->input->get('action');

		switch ($action) {
			case 'list':
				$categories['data'] = $this->product->get_all_categories();
				$response = $categories;
				break;
			case 'view_data':
				$id = $this->input->get('id');

				$data['data'] = $this->product->category_data($id);
				$response = $data;
				break;
			case 'add_category':
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');

				$this->form_validation->set_rules('id', 'Id Kategori', 'required|is_unique[tb_kategori.kat_id]');
				$this->form_validation->set_rules('name', 'Nama Kategori', 'required|min_length[3]|is_unique[tb_kategori.kat_nama]');
				// $this->form_validation->set_rules('name', 'Nama Kategori', 'is_unique[tb_kategori.kat_nama]');

				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');

				$this->form_validation->set_message('required', '%s dibutuhkan.');
				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
				$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');
				
				if ($this->form_validation->run() == FALSE) {
					$this->category();
					$response = array('code' => 409);

					if (form_error('id')) {
						$response['id_error'] = form_error('id');
					}
					if (form_error('name')) {
						$response['name_error'] = form_error('name');
					}
					// if(form_error('name')){
					// 	$response['name_error'] = form_error('name');
					// }

				} else {
					$name = $this->input->post('name');
					$id = $this->input->post('id');

					$this->product->add_category($id, $name);
					$categories['data'] = $this->product->get_all_categories();
					$response = $categories;
				}
				break;
			case 'delete_category':
				$id = $this->input->post('id');

				$this->product->delete_category($id);
				$response = array('code' => 204, 'message' => 'Kategori berhasil dihapus!');
				break;
			case 'edit_category':
				$this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold"><small>', '</small></div>');
				
				$id = $this->input->post('id');
				$this->form_validation->set_rules('name', 'Nama Kategori', 'required|is_unique[tb_kategori.kat_id <> '.$id.' and kat_nama=]|min_length[3]');

				$this->form_validation->set_message('is_unique', '%s sudah pernah digunakan, silahkan coba lagi.');
				$this->form_validation->set_message('required', '%s dibutuhkan.');
				$this->form_validation->set_message('min_length', 'Panjang karakter minimal %s adalah %s karakter.');

				if ($this->form_validation->run() == FALSE) {
					$this->category();
					$response = array('code' => 409);

					if (form_error('name')) {
						$response['name_error'] = form_error('name');
					}

				} else {
					$name = $this->input->post('name');

					$this->product->edit_category($id, $name);
					$response = array('code' => 201, 'message' => 'Kategori berhasil diperbarui');
				}
				break;
			case 'last_id':
				$data['data'] = $this->product->last_category_id();
				$response = $data;
				break;
		}

		$response = json_encode($response);
		$this->output->set_content_type('application/json')
			->set_output($response);
	}
	#END OF KATEGORI BARANG


	// public function coupons()
	// {
	//     $params['title'] = 'Kelola Kupon Belanja';

	//     $this->load->view('header', $params);
	//     $this->load->view('products/coupons');
	//     $this->load->view('footer');
	// }

	// public function _get_coupon_list()
	// {
	//     $coupons = $this->product->get_all_coupons();
	//     $n = 0;

	//     foreach ($coupons as $coupon)
	//     {
	//         $coupons[$n]->credit = 'Rp '. format_rupiah($coupon->credit);
	//         $coupons[$n]->start_date = get_formatted_date($coupon->start_date);
	//         $coupons[$n]->is_active = ($coupon->is_active == 1) ? ((strtotime($coupon->expired_date) < time()) ? 'Sudah kadaluarsa' : 'Masih berlaku') : 'Tidak aktif';
	//         $coupons[$n]->expired_date = get_formatted_date($coupon->expired_date);

	//         $n++;
	//     }

	//     return $coupons;
	// }

	// public function coupon_api()
	// {
	//     $action = $this->input->get('action');

	//     switch ($action) {
	//         case 'coupon_list' :
	//             $coupons['data'] = $this->_get_coupon_list();

	//             $response = $coupons;
	//         break;
	//         case 'view_data' :
	//             $id = $this->input->get('id');

	//             $data['data'] = $this->product->coupon_data($id);
	//             $response = $data;
	//         break;
	//         case 'add_coupon' :
	//             $name = $this->input->post('name');
	//             $code = $this->input->post('code');
	//             $credit = $this->input->post('credit');
	//             $start = $this->input->post('start_date');
	//             $end = $this->input->post('expired_date');

	//             $coupon = array(
	//                 'name' => $name,
	//                 'code' => $code,
	//                 'credit' => $credit,
	//                 'start_date' => date('Y-m-d', strtotime($start)),
	//                 'expired_date' => date('Y-m-d', strtotime($end))
	//             );

	//             $this->product->add_coupon($coupon);
	//             $coupons['data'] = $this->_get_coupon_list();

	//             $response = $coupons;
	//         break;
	//         case 'delete_coupon' :
	//             $id = $this->input->post('id');

	//             $this->product->delete_coupon($id);
	//             $response = array('code' => 204, 'message' => 'Kupon berhasil dihapus!');
	//         break;
	//         case 'edit_coupon' :
	//             $id = $this->input->post('id');
	//             $name = $this->input->post('name');
	//             $code = $this->input->post('code');
	//             $credit = $this->input->post('credit');
	//             $start = $this->input->post('start_date');
	//             $end = $this->input->post('expired_date');
	//             $active = $this->input->post('is_active');

	//             $coupon = array(
	//                 'name' => $name,
	//                 'code' => $code,
	//                 'credit' => $credit,
	//                 'start_date' => date('Y-m-d', strtotime($start)),
	//                 'expired_date' => date('Y-m-d', strtotime($end)),
	//                 'is_active' => $active
	//             );

	//             $this->product->edit_coupon($id, $coupon);
	//             $response = array('code' => 201, 'message' => 'Kupon berhasil diperbarui');
	//         break;
	//     }

	//     $response = json_encode($response);
	//     $this->output->set_content_type('application/json')
	//         ->set_output($response);
	// }
}
