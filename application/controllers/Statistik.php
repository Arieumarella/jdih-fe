<?php

class Statistik extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
        $this->load->model('Mdl_fungsi');
        $this->load->model('Mdl_statistik');
        $this->load->model('Mdl_home');
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
        $data['dataaktif'] = "statistik";
        $this->load->view('statistik', $data);
    }

    function test()
    {
        $data = $this->Mdl_statistik->ambil_unduhan('1');
        foreach ($data as $dt) {
            echo $dt['download_count'] . '<br>';
        }
    }

    function kirim_value()
    {
        if (isset($_POST['value'])) {
            $value = $_POST['value'];
            $post = $this->Mdl_statistik->ambil_unor($value);
            echo json_encode($post);
        }
    }

    function jumlah_peraturan()
    {
        if (isset($_POST['data'])) {$data = $_POST['data'];}else{$data='';}
        
        $post = $this->Mdl_statistik->jumlah_peraturan_unor($data);
        echo json_encode($post);
    }

    function get_peraturan()
    {
        header('Access-Control-Allow-Origin: *');

        $result = array();
        $opsi = $this->security->xss_clean(htmlspecialchars($this->input->post('opsi',true)));
        $tahun = $this->security->xss_clean(htmlspecialchars($this->input->post('tahun',true)));
        $tahun_old = $this->security->xss_clean(htmlspecialchars($this->input->post('tahun_old',true)));
        $category = $this->Mdl_statistik->ambil_peraturan_kategori($opsi);
        foreach ($category as $row) {
            if($opsi == 1){
                $aturan = $this->Mdl_statistik->ambil_peraturan_per_kategori($row['peraturan_category_id'], $tahun_old, $tahun, $opsi);
            } 
            else {
                $aturan = $this->Mdl_statistik->ambil_peraturan_per_kategori($row['peraturan_category_id'], $tahun_old, $tahun, $opsi);
            }
            $merge = array_merge(array('kategori' => $row['percategorycode']), array('peraturan' => $aturan));
            array_push($result, (object)$merge);
        }
        echo json_encode($result);
    }
    function get_peraturan_by_status()
    {
        header('Access-Control-Allow-Origin: *');

        $result = array();  
        $opsi = $this->security->xss_clean(htmlspecialchars($this->input->post('opsi',true)));
        $tahun = $this->security->xss_clean(htmlspecialchars($this->input->post('tahun',true)));
        $tahun_old = $this->security->xss_clean(htmlspecialchars($this->input->post('tahun_old',true)));
        $category = $this->Mdl_statistik->ambil_peraturan_kategori($opsi);
        foreach ($category as $row) {
            $berlaku = $this->Mdl_statistik->ambil_peraturan_by_status($row['peraturan_category_id'], $tahun_old, $tahun, $opsi, '0');
            $tidak_berlaku = $this->Mdl_statistik->ambil_peraturan_by_status($row['peraturan_category_id'], $tahun_old, $tahun, $opsi, '1');
            $merge = array_merge(array('kategori' => $row['percategorycode']), array('peraturan_berlaku' => $berlaku), array('peraturan_tidak_berlaku' => $tidak_berlaku));
            array_push($result, (object)$merge);
        }
        echo json_encode($result);
    }
}
