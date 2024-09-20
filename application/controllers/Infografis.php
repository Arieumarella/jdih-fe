<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Infografis extends CI_Controller
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

        //$item = $this->mdl_session->tampil("tb_session", $ip);
        //$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['tcari'] = "";
        $data['tipe_dokumen'] = "";
        $data['peraturan_category_id'] = "";
        $data['noperaturan'] = "";
        $data['tahun'] = "";
        $data['judul'] = "";
        $data['tag_id'] = "";
        $data['dataaktif'] = "informasi_hukum";
        $data['status'] = "";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
        $this->load->view("infografis_home", $data);
    }
    function detail($id)
    {
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
        $data['dataaktif'] = "informasi_hukum";
        $ip = $this->input->ip_address();
        //$item = $this->mdl_session->tampil("tb_session", $ip);
        //$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['get_data'] = $this->Mdl_fungsi->get_detail_infografis($id)->result_array()[0] ?? [];
        // var_dump($data["get_data"]);die();
        $this->load->view("infografis_detail", $data);
    }

    function create_json_all()
    {

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $totalData = $this->Mdl_fungsi->infografis_count_result();
        $totalFiltered = $this->Mdl_fungsi->infografis_count_result();
        $posts = $this->Mdl_fungsi->infografis_limit($limit, $start);

        $data = array();
        if (!empty($posts)) {
            $i = 0;
            foreach ($posts->result_array() as $post) {
                $data_produk = '';
                $data_produk .= '<div class="row"><div class="col-4"><img src="' . base_url('internal/assets/assets/infografis') . '/' . $post['gambar_1'] . '"></div><div class="col-8"><a href="' . base_url() . 'infografis/detail/' . $post['id'] . '"><label style="font-size:18px"><strong>' . $post['judul'] . '</strong></label>' . substr($post['isi'], 0, 150) . '...</a><br><a href="' . base_url() . 'infografis/detail/' . $post['id'] . '" class="btn btn-primary" style="color:#fff;margin-top:5px;">Selengkapnya</a></div></div>';
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
