<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Konsultasipublik extends CI_Controller
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
        $this->load->view("konsultasi_publik_home", $data);
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
        $data['id'] = $id;
        //$item = $this->mdl_session->tampil("tb_session", $ip);
        //$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
        $data['get_data'] = $this->Mdl_fungsi->get_detail_konsultasi_publik($id);
        $data['get_komentar'] = $this->Mdl_fungsi->get_konsultasi_publik_komentar($id);
        $this->load->view("konsultasi_publik_detail", $data);
    }

    function create_json_all()
    {

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $totalData = $this->Mdl_fungsi->konsultasi_publik_count_result();
        $totalFiltered = $this->Mdl_fungsi->konsultasi_publik_count_result();
        $posts = $this->Mdl_fungsi->konsultasi_publik_limit($limit, $start);

        $data = array();
        if (!empty($posts)) {
            $i = 0;
            foreach ($posts->result_array() as $post) {
                $data_produk = '';
                $data_produk .= '<div class="row"><div class="col-12"></div><div class="col-12"><a style="" href="' . base_url() . 'konsultasipublik/detail/' . $post['id'] . '"><label style="font-size:18px"><strong>' . $post['judul'] . '</strong></label>' . substr($post['pokok_pikiran'], 0, 150) . '...</a><br><a href="' . base_url() . 'konsultasipublik/detail/' . $post['id'] . '" class="btn btn-sm" style="background-color: #45678d; color:#fff;margin-top:5px;">Selengkapnya</a></div></div>';
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

    public function kirim_komentar()
    {

      $nama = htmlspecialchars($_REQUEST['name_komentar']);
      $email = htmlspecialchars($_REQUEST['email_komentar']);
      $komentar = htmlspecialchars($_REQUEST['komentar']);
      $captcha_response = trim($this->input->post('g-recaptcha-response'));

      $peraturan_id = htmlspecialchars($_REQUEST['peraturan_id']);

      if ($captcha_response != '') {

        $queryh = $this->db->get("tb_recaptcha")->result_array();
        $keySecret = $queryh[0]['key_secret'];
        // $keySecret = '6LcLmPIcAAAAAEkUH32lz2P11C2odRC4syjAvB4O';

        $check = array(
          'secret'    =>  $keySecret,
          'response'    =>  $this->input->post('g-recaptcha-response')
      );

        $startProcess = curl_init();

        curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

        curl_setopt($startProcess, CURLOPT_POST, true);

        curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

        curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

        $receiveData = curl_exec($startProcess);

        $finalResponse = json_decode($receiveData, true);

        if ($finalResponse['success']) {
          if ($nama == null || $email == null) {
            $posts = array('respon' => 'nok', 'message' => 'Nama atau email masih belum terisi');
        } else {
            $data = [
              'nama' => $nama,
              'email' => $email,
              'komentar' => $komentar,
              'tgl_buat' => date("Y-m-d H:i:s"),
              'konsultasi_publik_id' => $peraturan_id,
              'status' => false
          ];

          if ($this->Mdl_fungsi->konsultasi_publik_insert_komentar($data) == true) {

            $posts = array('respon' => 'ok', 'message' => 'Komentar berhasil dikirim dan akan ditinjau lebih lanjut oleh admin');
                // $res = $this->Mdl_fungsi->sendEmail($email, $nama, 'sk', $data);

                // if ($res == "ok") {
                //     $posts = array('respon' => 'ok', 'message' => 'Email berhasil dikirim');
                // } else {
                //     $posts = array('respon' => 'ok', 'message' => 'Email gagal dikirim');
                // }
        } else {
          $posts = array('respon' => 'nok', 'message' => 'Maaf komentar anda gagal dikirim');
      }
  }
} else {
  $posts = array('respon' => 'nok2', 'message' => 'Email gagal dikirim');
}
} else {
    $posts = array('respon' => 'nok3', 'message' => 'Captcha belum dicentang');
}
$response['posts'] = $posts;

echo json_encode($posts);

}
}
