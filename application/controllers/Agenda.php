<?php

defined("BASEPATH") OR EXIT("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_home');
		$this->load->model('Mdl_fungsi');
    }
	 function index() {
       
        //$item = $this->mdl_session->tampil("tb_session", $ip);
        //$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['tcari'] = "";
        $data['tipe_dokumen'] = "";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
        $data['judul'] = "";
		$data['tag_id'] = "";
        $data['status'] = "";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
		$data['dataaktif']="informasi_hukum";
        $this->load->view("agenda_home", $data);
    }
    function detail($id) {
        $ip = $this->input->ip_address();
        //$item = $this->mdl_session->tampil("tb_session", $ip);
		//$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
		 $data['tcari'] = "";
        $data['tipe_dokumen'] = "";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
        $data['judul'] = "";
		$data['tag_id'] = "";
        $data['status'] = "";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
		$data['dataaktif']="informasi_hukum";
		$data['get_data']=$this->Mdl_fungsi->get_detail_agenda($id);
		$this->load->view("agenda_detail", $data);
    }
     function create_json_all() {

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $totalData = $this->Mdl_fungsi->agenda_count_result();
        $totalFiltered = $this->Mdl_fungsi->agenda_count_result();
        $posts = $this->Mdl_fungsi->agenda_limit($limit, $start);

        $data = array();
        if (!empty($posts)) {
            $i = 0;
            foreach ($posts->result_array() as $post) {
                $data_produk='';
				$data_produk .='<div class="container"><a href="'.base_url().'agenda/detail/'.$post['id'].'" ><label style="font-size:18px"><strong>'.$post['judul'].'</strong></label><br><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;'.substr($post['tanggal'],6,2).'/'.substr($post['tanggal'],4,2).'/'.substr($post['tanggal'],0,4).' - '. $post['jam'].'</a><br><i class="fa fa-map"></i>&nbsp;&nbsp;'.$post['tempat'].'<br>'.$post['isi'].'<br><a href="'.base_url().'agenda/detail/'.$post['id'].'" class="btn btn-primary" style="color:#fff;margin-top:5px;">Selengkapnya</a></div><br>';
				$nestedData['data'] = $data_produk;
                $data[] = $nestedData;
				$i++;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
    }

}
