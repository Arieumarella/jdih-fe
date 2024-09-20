<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Tentang_kami extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_home');
		$this->load->model('Mdl_fungsi');
    }

    function index() {
        $ip = $this->input->ip_address();
		 $data['tcari'] = "";
        $data['tipe_dokumen'] = "";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
		$data['tag_id'] = "";
        $data['judul'] = "";
        $data['status'] = "";
		$data['dataaktif']="tentang_jdih";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
        $data['get_data']=$this->Mdl_home->get_widget('1');
		$this->load->view("tentang_kami", $data);
    }
    
   

}

?>