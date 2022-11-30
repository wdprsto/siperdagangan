<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('kasir');

        $this->load->model(array(
            // 'payment_model' => 'payment',
            'transaction_model' => 'transaction',
            // 'review_model' => 'review'
        ));
    }

    public function index()
    {
        $params['title'] = get_settings('store_tagline');
		$params['active_page'] = "dashboard";
		
        $home['total_transaction'] = $this->transaction->count_all_transactions();
		$home['pending_transaction'] = $this->transaction->count_pending_transactions();
        $home['total_payment'] = $this->transaction->sum_finished_transactions();
        // $home['total_process_order'] = $this->transaction->count_process_order();
        // $home['total_review'] = $this->review->count_all_reviews();

        $home['flash'] = $this->session->flashdata('store_flash');

        $this->load->view('header', $params);
        $this->load->view('home', $home);
        $this->load->view('footer');
    }
}
