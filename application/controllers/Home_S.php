<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Mdl_home');
		$this->load->model('Mdl_fungsi');
    }

    function index() {
        $ip = $this->input->ip_address();
        //$item = $this->mdl_session->tampil("tb_session", $ip);
        $data['get_banner'] = $this->Mdl_home->get_banner();
        $data['get_banner_news'] = $this->Mdl_home->get_banner_news();
        $data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['get_produk_populer'] = $this->Mdl_home->get_produk_populer();
		$data['get_link_utama'] = $this->Mdl_home->get_link_utama();
        $data['get_pp'] = $this->Mdl_home->get_pp();
        $data['get_unit'] = $this->Mdl_home->get_unit();
        $this->load->view("home_form", $data);
    }
    
    
    
    

}

?>