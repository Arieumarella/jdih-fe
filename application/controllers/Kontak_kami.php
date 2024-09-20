<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Kontak_kami extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_home');
        $this->load->model('Mdl_fungsi');
    }

    function index()
    {
        $data['tcari'] = "";
        $data['tipe_dokumen'] = "";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
        $data['tag_id'] = "";
        $data['judul'] = "";
        $data['status'] = "";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';

        $ip = $this->input->ip_address();
        $data['get_data'] = $this->Mdl_home->get_widget('3');
        // var_dump($data['get_data']);
        // die();
        $data['dataaktif'] = "tentang_jdih";
        $this->load->view("kontak_kami", $data);
    }

    function download($kodekat, $tahun, $bulan, $fileupload)
    {
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


    function update_kondisi()
    {
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

    function update_sifat()
    {
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
