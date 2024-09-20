<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Struktur_organisasi extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_home');
	$this->load->model('Mdl_fungsi');
    }

    function index() {
       
	$data['tcari'] = "";
        $data['tipe_dokumen'] = "";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
	$data['tag_id'] = "";
        $data['judul'] = "";
        $data['status'] = "";
	$data['dataaktif']="struktur_organisasi";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
        $this->load->view("struktur_organisasi", $data);
    }
    
   

}

?>