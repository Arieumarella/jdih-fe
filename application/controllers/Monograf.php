<?php
defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Monograf extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'html', 'form'));
		$this->load->library('session');
		$this->load->model(array("Mdl_home", "Mdl_fungsi"));
	}

    function index() {
		//$item = $this->mdl_session->tampil("tb_session", $ip);
        //$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['tcari'] = "";
        $data['tipe_dokumen'] = "2";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
        $data['judul'] = "";
        $data['tag_id'] = "";
        $data['dataaktif'] = "informasi_hukum";
        $data['status'] = "";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
		$this->load->view("monograf_home", $data);
    }
}