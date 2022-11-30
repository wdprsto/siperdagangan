<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		
        verify_session('admin');
		
        $this->load->model(array(
            'product_model' => 'product',
            'order_model' => 'order',
            // 'payment_model' => 'payment'
        ));
    }

    public function index()
    {
        $params['title'] = 'Admin '. get_store_name();
		$params['active_page'] = "dashboard";

        $overview['total_products'] = $this->product->count_all_products();
        $overview['total_category'] = $this->product->count_all_categories();
        $overview['total_finished_transaction'] = $this->order->count_finished_transaction();
        $overview['sum_finished_transaction'] = $this->order->sum_finished_transactions();

        // $overview['products'] = $this->product->latest();
        // $overview['categories'] = $this->product->latest_categories();
        // $overview['payments'] = $this->payment->payment_overview();
        // $overview['orders'] = $this->order->latest_orders();
        // $overview['customers'] = $this->customer->latest_customers();

        // $overview['order_overviews'] = $this->order->order_overview();
        // $overview['income_overviews'] = $this->order->income_overview();

	
		$overview['flash'] = $this->session->flashdata('store_flash');
 
        $this->load->view('header', $params);
        $this->load->view('overview', $overview);
        $this->load->view('footer');
    }
}
