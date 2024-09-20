<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Cari extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model(array('Mdl_home', 'Mdl_cari'));
		$this->load->model('Mdl_fungsi');
    }

    function index() {
        
        //$item = $this->mdl_session->tampil("tb_session", $ip);
        if (isset($_POST['caridetail'])) {
            $jenis = $this->input->post('jenis');
            $nomor = $this->input->post('nomor');
            $tahun = $this->input->post('tahun');
            $judul = $this->input->post('judul');
            $status = $this->input->post('status');

            echo $jenis . br() . $nomor . br() . $tahun . br() . $judul . br() . $status;
        }
        
         if (isset($_POST['caricepat'])) {
            $jenis = $this->input->post('jenis');
            $nomor = $this->input->post('nomor');
            $tahun = $this->input->post('tahun');
            $judul = $this->input->post('judul');
            $status = $this->input->post('status');

            echo $jenis . br() . $nomor . br() . $tahun . br() . $judul . br() . $status;
        }
        

        $data['get_banner'] = $this->Mdl_home->get_banner();
        $data['get_banner_news'] = $this->Mdl_home->get_banner_news();
        $data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['get_produk_populer'] = $this->Mdl_home->get_produk_populer();
        $data['get_pp'] = $this->Mdl_home->get_pp();
        $data['get_unit'] = $this->Mdl_home->get_unit();





        $this->load->view("home_form", $data);
    }

}

?>
