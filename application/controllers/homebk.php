<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
		$this->load->model('Mdl_fungsi');
        $this->load->model('Mdl_home');
    }

    function index() {
        $ip = $this->input->ip_address();
        //$item = $this->mdl_session->tampil("tb_session", $ip);
		$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['get_banner'] = $this->Mdl_home->get_banner();
        $data['get_banner_news'] = $this->Mdl_home->get_banner_news();
        
        $data['get_produk_populer'] = $this->Mdl_home->get_produk_populer();
		$data['get_link_utama'] = $this->Mdl_home->get_link_utama();
		$data['get_link_terkait'] = $this->Mdl_home->get_link_terkait();
        $data['stat_today']=$this->Mdl_home->get_stat_today();
		$data['stat_yesterday']=$this->Mdl_home->get_stat_yesterday();
		
		$data['get_berita'] = $this->Mdl_home->get_berita();
		$data['get_agenda'] = $this->Mdl_home->get_agenda();
        $data['get_pp'] = $this->Mdl_home->get_pp();
        $data['get_unit'] = $this->Mdl_home->get_unit();
        
		//$data['stat_total']=$this->Mdl_home->get_stat_total();
		$data['stat_total']=0;

		$this->load->view("home_form", $data);
    }
    
    function download($kodekat, $tahun, $bulan, $fileupload) {
        if (!empty($kodekat) && !empty($tahun) && !empty($bulan) && !empty($fileupload)) {
            //load download helper
            $this->load->helper('download');

            //get file info from database
            //file path
            $file = './internal/assets/assets/produk_zip/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $fileupload;
            //download file from directory

            $datacount = $this->Mdl_home->get_download_count($fileupload);
            foreach ($datacount as $dc) {
                $downcount = $dc['download_count'] + 1;
                $peraturanid = $dc['peraturan_id'];
            }
            $data = array(
                'download_count' => $downcount
            );
            $this->Mdl_home->add_download_count($peraturanid, $data);
            force_download($file, NULL);
        }
    }

        
    function update_kondisi() {
        $data = $this->db->get('ppj_peraturan');
        foreach ($data->result_array() as $rw) {
            if ($rw['status'] === NULL) {
                $this->db->where('peraturan_id', $rw['peraturan_id']);
                $data = array(
                    'status' => '0'
                );
                $this->db->update('ppj_peraturan', $data);
            }
        }
    }

    function update_sifat() {
        $data = $this->db->get('ppj_peraturan');
        foreach ($data->result_array() as $rw) {
            if ($rw['sifat'] === NULL) {
                $this->db->where('peraturan_id', $rw['peraturan_id']);
                $data = array(
                    'sifat' => '1'
                );
                $this->db->update('ppj_peraturan', $data);
            }
        }
    }

}

?>