<?php
defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class SiMPeL extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'html', 'form'));
		$this->load->library('session');
		$this->load->model(array("Mdl_home", "Mdl_fungsi", 'M_simpel'));
	}

    function getData($idPeraturan=null) {

        if ($idPeraturan == null) {
            echo 'Invalid Parameter .!';
            return;
        }   

        $jns_peraturan = '';

        if ($idPeraturan == 1) {
            $jns_peraturan = 'Prolegnas RUU Prioritas Tahunan';
        }

        if ($idPeraturan == 2) {
            $jns_peraturan = 'Progsun PP/PERPRES';
        }

        if ($idPeraturan == 3) {
            $jns_peraturan = 'PROLEG PUPR';
        }

        if ($idPeraturan == 4) {
            $jns_peraturan = 'IP RPP/RPERPRES';
        }

        if ($idPeraturan == 5) {
            $jns_peraturan = 'IP RPERMEN';
        }


        $data['tcari'] = "";
        $data['tipe_dokumen'] = "4";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
        $data['judul'] = "";
        $data['tag_id'] = "";
        $data['dataaktif'] = "SiMPeL";
        $data['status'] = "";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
        $data['kd_jns_peraturan'] = $idPeraturan;
        $data['jns_peraturan'] = $jns_peraturan;
        $data ['idPeraturan'] = $idPeraturan;
        $this->load->view("simpel_home", $data);
    }

    public function getDataDukung()
    {
        $idPeraturan = $this->input->post('idPeraturan');
        $kd_jns_peraturan = $this->input->post('kd_jns_peraturan');
        
        $data1 = '';
        $data2 = '';
        $data3 = '';
        $data4 = '';
        $data5 = '';

        if ($kd_jns_peraturan == 1 OR $kd_jns_peraturan == 2 OR $kd_jns_peraturan == 5) {
            $data1 = $this->M_simpel->getDataCapaian($idPeraturan,1);
            $data2 = $this->M_simpel->getDataCapaian($idPeraturan,2);
            $data3 = $this->M_simpel->getDataCapaian($idPeraturan,3);
            $data4 = $this->M_simpel->getDataCapaian($idPeraturan,4);
        }

        if ($kd_jns_peraturan == 3) {
            $data1 = $this->M_simpel->getDataCapaian($idPeraturan,5);
            $data2 = $this->M_simpel->getDataCapaian($idPeraturan,6);
            $data3 = $this->M_simpel->getDataCapaian($idPeraturan,7);
            $data4 = $this->M_simpel->getDataCapaian($idPeraturan,8);
        }


        if ($kd_jns_peraturan == 4) {
            $data1 = $this->M_simpel->getDataCapaian($idPeraturan,9);
            $data2 = $this->M_simpel->getDataCapaian($idPeraturan,10);
            $data3 = $this->M_simpel->getDataCapaian($idPeraturan,11);
            $data4 = $this->M_simpel->getDataCapaian($idPeraturan,12);
        }

        echo json_encode(['b03' => $data1, 'b06' => $data2, 'b09' => $data3, 'b12' => $data4]);

    }


}