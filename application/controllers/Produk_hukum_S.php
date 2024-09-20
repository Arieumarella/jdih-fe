<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Produk_hukum extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Mdl_produk_hukum');
		$this->load->model('Mdl_fungsi');
    }

    function index() {

        $ip = $this->input->ip_address();
        //$item = $this->mdl_session->tampil("tb_session", $ip);
        $data['get_banner'] = $this->Mdl_produk_hukum->get_banner();
        $data['get_banner_news'] = $this->Mdl_produk_hukum->get_banner_news();
        $data['get_awal_produk'] = $this->Mdl_produk_hukum->get_awal_produk();
        $data['get_produk_populer'] = $this->Mdl_produk_hukum->get_produk_populer();
        $data['get_pp'] = $this->Mdl_produk_hukum->get_pp();
        $data['get_unit'] = $this->Mdl_produk_hukum->get_unit();
		$data['get_link_utama'] = $this->Mdl_produk_hukum->get_link_utama();
        $this->load->view("produk_hukum_form", $data);
    }

    function view($peraturan_id) {

        $ip = $this->input->ip_address();
        $data['get_banner'] = $this->Mdl_produk_hukum->get_banner();
        $data['get_banner_news'] = $this->Mdl_produk_hukum->get_banner_news();
        $data['get_awal_produk'] = $this->Mdl_produk_hukum->get_awal_produk($peraturan_id);
        $data['get_produk_populer'] = $this->Mdl_produk_hukum->get_produk_populer();
        $data['get_pp'] = $this->Mdl_produk_hukum->get_pp();
        $data['get_unit'] = $this->Mdl_produk_hukum->get_unit();
        $this->load->view("produk_hukum_form", $data);
    }

}
