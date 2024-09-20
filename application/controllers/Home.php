<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'html', 'form'));
        $this->load->library('session');
        $this->load->model('Mdl_fungsi');
        $this->load->model('Mdl_home');
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
        $data['status'] = "";
        $data['dataaktif'] = "home";
        $data['dept_id'] = 'kosong_field';
        $data['tipe_cari'] = 'cepat';
        $data['user_online'] = $this->Mdl_fungsi->simpan_session('1');
        $this->load->view("home_form", $data);
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
    function test_enk()
    {
        echo $var = $this->Mdl_fungsi->encrypt_data('2731');
        echo "-" . $this->Mdl_fungsi->decrypt_data($var);
    }


    function create_json_all()
    {
        header("Access-Control-Allow-Origin: *");
        $per_id = '';
        $tp_dok = '';
        $limit = 10;
        $start = 0;


        $start = intval(htmlspecialchars($this->input->post('start')));
        $limit = intval(htmlspecialchars($this->input->post('length')));
        if ($limit == "") {
            $start = 0;
            $limit = 10;
        }

        $totalData = $this->Mdl_fungsi->produk_count_result();
        $totalFiltered = $this->Mdl_fungsi->produk_count_result();
        $posts = $this->Mdl_fungsi->produk_limit($limit, $start);

        $data = array();
        if (!empty($posts)) {
            $i = 0;
            foreach ($posts->result_array() as $post) {
                $nama_peraturan = $this->Mdl_home->cari_peraturan_id_2($post['peraturan_category_id']);
                $peraturan_id = $post['peraturan_id'];
                $judul3 = str_ireplace("<p>", "", $post['judul']);
                $judul4 = str_ireplace("</p>", "", $judul3);
                $judul2 = str_ireplace("\r", "", $judul4);
                $judul = str_ireplace("\n", "", $judul2);
                $bln = substr($post['tanggal'], 4, 2);
                $tahun = substr($post['tanggal'], 0, 4);
                $bln2 = $this->Mdl_home->cari_bulan($bln);
                $tgl_asli = substr($post['tanggal'], 6, 2) . " <span class='translatable'>$bln2</span> " . substr($post['tanggal'], 0, 4);
                $dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
                foreach ($dtktg as $dkt) {
                    $kdkt = $dkt['percategorycode'];
                }
                if ($post['tipe_dokumen'] == "1") {
                    if ($post['file_abstrak'] != "") {
                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                    } else {
                        $path_abstrak = "tidak ada";
                    }

                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                } else if ($post['tipe_dokumen'] == "2") {
                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                } else if ($post['tipe_dokumen'] == "3") {
                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                } else if ($post['tipe_dokumen'] == "4") {
                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                }


                $stat = $post['status'];
                $tambahan = '';
                if ($stat == '1') {
                    $tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon2.png" style="width:20px;height:20px">';
                } elseif ($stat == '0' or $stat == '') {
                    $tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon1.png" style="width:20px;height:20px">';
                }
                $pwds = md5($post['peraturan_id'] . date("YmYmmY"));
                $path_abs = base64_encode($post['peraturan_id']) . "^" . $pwds;
                $tp_dok = $post['tipe_dokumen'];
                $per_id = $post['peraturan_id'];
                $data_produk = '';
                $data_produk .= '<div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px"><a href="' . base_url() . 'detail-dokumen/' . $per_id . '/' . $tp_dok . '" class="headline"><label style="font-size:16px;font-weight:bold;color:#6d6e70;text-align:left;float:left">' . $judul . '<label></a></div>';
                $data_produk .= '<br><div class="post-meta" style="margin-left:10px;"><p><i class="fa fa-clock-o"></i> ' . $tgl_asli . '&nbsp;&nbsp;<i class="fa fa-download"> ' . $post['download_count'] . ' <span class="translatable">kali</span></i>&nbsp;' . $tambahan . '</p></div>';
                $data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="#abstrak_' . $i . '" class="btn btn-primary btn-sm" onclick=panggil_abstrak("' . $path_abs . '") style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Abstrak</span></a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . $path_upload . '" class="btn btn-primary btn-sm" download style="color:#fff" onclick=klikunduh(' . $peraturan_id . ')><i class="fa fa-download"></i> <span class="translatable">Unduh</span></a> </div>';
                $nestedData['data_produk'] = $data_produk;
                $data[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "draw" => intval(htmlspecialchars($this->input->post('draw'))),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
    }

    function update_judul()
    {
        $data_peraturan = $this->Mdl_home->ambil_peraturan();
        foreach ($data_peraturan as $dp) {
            $data_nama_peraturan = $this->Mdl_home->ambil_nama_peraturan($dp['peraturan_category_id']);
            foreach ($data_nama_peraturan as $dnp) {
                $nama_peraturan = $dnp['percategoryname'];
            }
            $tahun = substr($dp['tanggal'], 0, 4);
            $id_peraturan = $dp['peraturan_id'];
            $data = array('judul' => $nama_peraturan . " Kementerian Pekerjaan Umum dan Perumahan Rakyat Nomor " . $dp['noperaturan'] . " Tahun " . $tahun . " tentang " . $dp['tentang']);
            $this->Mdl_home->update_judul($id_peraturan, $data);
        }
    }

    function tambah_unduh()
    {
        $peraturan_id = '';
        if (!empty($_REQUEST['peraturan_id'])) {
            $peraturan_id = htmlspecialchars($_REQUEST['peraturan_id']);
        }


        $data_unduh = $this->Mdl_home->ambil_unduh($peraturan_id);
        $data_unduh_baru = $data_unduh + 1;
        $data = array(
            "download_count" => $data_unduh_baru
        );
        $this->Mdl_home->update_unduh($peraturan_id, $data);
        $json_data = array(
            "peraturan_id" => $peraturan_id,
            "jumlah" => $data_unduh,
            "jumlah_baru" => $data_unduh_baru
        );
        echo json_encode($json_data);
    }

    function get_path_abstrak()
    {
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json");

        $str = $_REQUEST['peraturan_id'];
        $kode = explode("^", $_REQUEST['peraturan_id']);
        $peraturan_id = base64_decode($kode[0]);
        $posts = array();
        $pwds = md5($peraturan_id . date("YmYmmY"));
        $path_abs = base64_encode($peraturan_id) . "^" . $pwds;
        if ($str == $path_abs) {
            $kueri = $this->db->query("select peraturan_category_id,tanggal,file_abstrak,tipe_dokumen from ppj_peraturan where peraturan_id='" . $peraturan_id . "'");
            foreach ($kueri->result_array() as $post) {
                $bln = substr($post['tanggal'], 4, 2);
                $tahun = substr($post['tanggal'], 0, 4);
                $dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
                foreach ($dtktg as $dkt) {
                    $kdkt = $dkt['percategorycode'];
                }
                if ($post['tipe_dokumen'] == "1") {
                    if ($post['file_abstrak'] != "") {
                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                    } else {
                        $path_abstrak = "tidak ada";
                    }
                } else if ($post['tipe_dokumen'] == "2") {
                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                } else if ($post['tipe_dokumen'] == "3") {
                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                } else if ($post['tipe_dokumen'] == "4") {
                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
                }
                $posts = array("respon" => "ok", "path" => $path_abstrak);
            }
        } else {
            $posts = array("respon" => "nok");
        }
        echo json_encode($posts);
    }

    public function post_subs()
    {
     
        $token= $this->input->post('email_1');
        
        $res= $this->Mdl_fungsi->sendEmail($this->input->post('email_1'),$this->input->post('nama'),'subscribe','');
        if($res=="ok"){
            $data = array(
                'email' => $this->input->post('email_1'),
                'nama' => $this->input->post('nama'),
                'status' => '0',
                'tgl_buat' => date('d/m/Y')
            );

            $this->db->insert('tb_subscribe ', $data);
        }
        $posts = array('respon' => $res);
        
        echo json_encode($posts);
    }

    function post_rating()
    {
        header("Access-Control-Allow-Origin: *");
        
        if (isset($_REQUEST['rating_data'])) {
            $data = array(
                'nama'          =>    $this->input->post('user_name'),
                'email'         =>    $this->input->post('email'),
                'deskripsi'     =>    $this->input->post('user_review'),
                'rating'        =>    $this->input->post('rating_data'),
                'tanggal'       =>     $this->input->post('tanggal')
            );

            $query = $this->db->insert('tb_rating', $data);
        }
        
        if (isset($_REQUEST["action"])) {
            
            $average_rating = 0;
            $total_review = 0;
            $five_star_review = 0;
            $four_star_review = 0;
            $three_star_review = 0;
            $two_star_review = 0;
            $one_star_review = 0;
            $total_user_rating = 0;
            $query = $this->db->order_by('id', 'desc')->get('tb_rating')->result_array();
            foreach ($query as $row) {
                $review_content[] = array(
                    'user_name'       =>    $row["nama"],
                    'email'           =>    $row["email"],
                    'user_review'     =>    $row["deskripsi"],
                    'rating'       =>    $row["rating"]
                );

                if ($row["rating"] == '5') {
                    $five_star_review++;
                }

                if ($row["rating"] == '4') {
                    $four_star_review++;
                }

                if ($row["rating"] == '3') {
                    $three_star_review++;
                }

                if ($row["rating"] == '2') {
                    $two_star_review++;
                }

                if ($row["rating"] == '1') {
                    $one_star_review++;
                }

                $total_review++;

                $total_user_rating = $total_user_rating + $row["rating"];
            }
            if($total_user_rating > 0 && $total_review > 0){
                $average_rating = $total_user_rating / $total_review;
            }else{
                $average_rating=0;
            }
            

            $output = array(
                'average_rating'    =>    number_format($average_rating, 1),
                'total_review'        =>    $total_review,
                'five_star_review'    =>    $five_star_review,
                'four_star_review'    =>    $four_star_review,
                'three_star_review'    =>    $three_star_review,
                'two_star_review'    =>    $two_star_review,
                'one_star_review'    =>    $one_star_review
            );
            echo json_encode($output);
            
        }
        
    }

    function get_path_produk()
    {
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json");

        $str = $_REQUEST['peraturan_id'];
        $kode = explode("^", $_REQUEST['peraturan_id']);
        $peraturan_id = base64_decode($kode[0]);
        $posts = array();
        $pwds = md5($peraturan_id . date("YmYmmY"));
        $path_abs = base64_encode($peraturan_id) . "^" . $pwds;

        if ($str == $path_abs) {
            $kueri = $this->db->query("select peraturan_category_id,tanggal,file_upload,tipe_dokumen from ppj_peraturan where peraturan_id='" . $peraturan_id . "'");
            foreach ($kueri->result_array() as $post) {
                $bln = substr($post['tanggal'], 4, 2);
                $tahun = substr($post['tanggal'], 0, 4);
                $dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
                foreach ($dtktg as $dkt) {
                    $kdkt = $dkt['percategorycode'];
                }

                $tipe_file_upload = substr($post['file_upload'], -3);


                if ($post['tipe_dokumen'] == "1") {
                    if ($post['file_upload'] != "") {
                        if ($tipe_file_upload == 'pdf') {
                            $path_peraturan = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                        } else {
                            $path_peraturan = "tidak ada";
                        }
                    } else {
                        $path_peraturan = "tidak ada";
                    }
                } else if ($post['tipe_dokumen'] == "2") {
                    $path_peraturan = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                } else if ($post['tipe_dokumen'] == "3") {
                    $path_peraturan = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                } else if ($post['tipe_dokumen'] == "4") {
                    $path_peraturan = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
                }
                $posts = array("respon" => "ok", "path" => $path_peraturan);
            }
        } else {
            $posts = array("respon" => "nok");
        }
        echo json_encode($posts);
    }

    function get_path_parsial()
    {
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json");

        $str = $_REQUEST['id'];
        $kdkt = $_REQUEST['kdkt'];
        $tahun = $_REQUEST['tahun'];
        $bulan = $_REQUEST['bulan'];
        $tipe = $_REQUEST['tipe'];

        $kode = explode("^", $_REQUEST['id']);
        $peraturan_id = base64_decode($kode[0]);
        $posts = array();
        $pwds = md5($peraturan_id . date("YmYmmY"));
        $path_abs = base64_encode($peraturan_id) . "^" . $pwds;

        if ($str == $path_abs) {
            $kueri = $this->db->query("select file from ppj_peraturan_file where id='" . $peraturan_id . "'");
            foreach ($kueri->result_array() as $post) {

                $tipe_file_upload = substr($post['file'], -3);


                if ($tipe == "1") {
                    if ($post['file'] != "") {
                        if ($tipe_file_upload == 'pdf') {
                            $path_peraturan = base_url('internal/assets/assets/produk_parsial/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $post['file']);
                        } else {
                            $path_peraturan = "tidak ada";
                        }
                    } else {
                        $path_peraturan = "tidak ada";
                    }
                } else if ($tipe == "2") {
                    $path_peraturan = base_url('internal/assets/assets/produk_parsial/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $post['file']);
                } else if ($tipe == "3") {
                    $path_peraturan = base_url('internal/assets/assets/produk_parsial/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $post['file']);
                } else if ($tipe == "4") {
                    $path_peraturan = base_url('internal/assets/assets/produk_parsial/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $post['file']);
                }
                $posts = array("respon" => "ok", "path" => $path_peraturan);
            }
        } else {
            $posts = array("respon" => "nok");
        }
        echo json_encode($posts);
    }
}
