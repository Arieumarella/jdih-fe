<?php

defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Produk_hukum extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->helper(array('url', 'html', 'form'));
    $this->load->library('session');
    $this->load->model(array('Mdl_produk_hukum', 'Mdl_home', 'Mdl_Rest'));
    $this->load->model('Mdl_fungsi');
    $this->load->library('form_validation');
  }
  function tes()
  {
    $token = $_REQUEST['token'];
    echo $this->Mdl_fungsi->decript($token);
  }

  function kirim_email()
  {
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 400); //300 seconds = 5 minutes
    set_time_limit(400);

    $this->load->library("Kirim_email");
    $nama = htmlspecialchars($_REQUEST['nama']);
    $email = htmlspecialchars($_REQUEST['email']);
    $peraturan_id = htmlspecialchars($_REQUEST['peraturan_id']);

    //$mail = new PHPMailer();
    //echo $Username."\n".$Password;
    $kueri = $this->db->query("select file_upload,peraturan_id,judul from ppj_peraturan where peraturan_id='" . $this->db->escape_str($peraturan_id) . "'");
    if ($kueri->num_rows() > 0) {
      foreach ($kueri->result_array() as $hkueri) {
        $kueri = $this->db->get("tb_konfig_email")->result_array();
        foreach ($kueri as $rw) {
          $Host = $rw['nama_host'];
          $Username = $rw['host_user_name'];
          $Password = $rw['host_password'];
          $From = $rw['email_from'];
          $FromName = $rw['email_from_name'];
        }

        $judul = $hkueri['judul'];
        $cek_email = $this->db->query("select * from tb_email_template where usage_type='3'");

        foreach ($cek_email->result_array() as $etmp) {
          $Subject = $etmp['subject'];
          $body1 = str_ireplace("(nama)", $nama, $etmp['body_email']);
          $token = $this->Mdl_fungsi->encript($peraturan_id);

          if ($hkueri['file_upload'] != '') {
            $body2 = str_ireplace("(judul)", $judul, $body1);

            $url_link = "https://jdih.pu.go.id/download/peraturan.php?token=" . $token;
            $link = "Silahkan mengunduh lampiran, dengan klik berikut : <a href='$url_link'>Klik Disini</a>";
            $body3 = str_ireplace("(link)", $link, $body2);
          } else {
            $body2 = str_ireplace("(link)", "", $body1);
          }
          $body = $body3;
        }
        //echo $body;
        $To = $email;
        $ToName = $nama;

        //$this->db->where("tipe","Dropbox_Pengirim");
        //$body='test';
        //$Subject='testemail';		
        $mail = new PHPMailer();

        $mail->IsSMTP();                     // send via SMTP
        $mail->Host     = $Host;
        $mail->SMTPAuth = true;             // turn on SMTP authentication
        $mail->Username = $Username;
        $mail->Password = $Password;

        $mail->From     = $From;
        $mail->FromName = $FromName;

        $mail->AddAddress($To, $ToName);

        $mail->WordWrap = 50;                // set word wrap
        $mail->Priority = 2;
        $mail->IsHTML(true);
        $mail->Subject  =  $Subject;

        $mail->Body     = $body;
        $mail->port = 587;
        //$mail->SMTPDebug = 2;

        if (!$mail->Send()) {
          $mail_stat_ins = $mail->ErrorInfo;
          $posts[] = array('respon' => 'nok');
        } else {
          $simpan = $this->db->query("insert into tb_send_email 
						(date_time,recipient,cc,email_type,subject_mail,delivery_status)
						values
						('" . date("YmdHis") . "','" . $this->db->escape_str($email) . "','-','3','" . $this->db->escape_str($Subject) . "','sending')");

          $posts[] = array('respon' => 'ok');
        }
      }
    } else {
      $posts[] = array('respon' => 'nok');
    }

    $response['posts'] = $posts;
    echo json_encode($posts);
  }

  public function kirim_komentar()
  {

    $this->form_validation->set_rules('name_komentar', 'Name Komentar', 'required');
    $this->form_validation->set_rules('email_komentar', 'Email Komentar', 'required|valid_email');
    $this->form_validation->set_rules('komentar', 'Komentar', 'required');
    $this->form_validation->set_rules('tipe', 'Tipe', 'required');


    if ($this->form_validation->run() == FALSE) {
      // Validasi gagal, tampilkan pesan kesalahan
      $errors = $this->form_validation->error_array();

      // Kirim daftar error ke halaman formulir
      $data['errors'] = $errors;
      $posts = array('respon' => 'nok3', 'message' => $data);
    }

    $nama = htmlspecialchars($this->input->post('name_komentar'));
    $email = htmlspecialchars($this->input->post('email_komentar'));
    $komentar = htmlspecialchars($this->input->post('komentar'));
    $tipe = htmlspecialchars($this->input->post('tipe'));
    $captcha_response = trim($this->input->post('g-recaptcha-response'));
    $peraturan_id = $tipe != "2" ? htmlspecialchars($this->input->post('peraturan_id')) : "0";

    if ($captcha_response != '') {

      $finalResponse = verifyRecaptcha($captcha_response);

      if ($finalResponse) {

        $config['upload_path'] = "./internal/assets/berkas_komentar";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);

        if ($nama == null || $email == null) {
          $posts = array('respon' => 'nok', 'message' => 'Nama atau email masih belum terisi');
        } else {
          if ($this->upload->do_upload("berkas")) {
            $files = array('upload_data' => $this->upload->data());

            $file = $files['upload_data']['file_name'];
            $data = [
              'nama' => $nama,
              'email' => $email,
              'komentar' => $komentar,
              'tanggal' => date("Ymd"),
              'peraturan_id' => $peraturan_id,
              'tipe' => $tipe,
              'berkas' => $file
            ];
          } else {
            $data = [
              'nama' => $nama,
              'email' => $email,
              'komentar' => $komentar,
              'tanggal' => date("Ymd"),
              'peraturan_id' => $peraturan_id,
              'tipe' => $tipe,
            ];
          }

          $this->db->set($data);

          if ($this->db->insert('tb_sk') == true) {

            $res = $this->Mdl_fungsi->sendEmail($email, $nama, 'sk', $data);

            if ($res == "ok") {
              $posts = array('respon' => 'ok', 'message' => 'Email berhasil dikirim');
            } else {
              $posts = array('respon' => 'ok', 'message' => 'Email gagal dikirim');
            }
          } else {
            $posts = array('respon' => 'nok', 'message' => 'Email gagal dikirim');
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


  function index()
  {
    //$item = $this->mdl_session->tampil("tb_session", $ip);
    $data['get_banner'] = $this->Mdl_produk_hukum->get_banner();
    $data['get_banner_news'] = $this->Mdl_produk_hukum->get_banner_news();
    $data['get_awal_produk'] = $this->Mdl_produk_hukum->get_awal_produk();
    $data['get_produk_populer'] = $this->Mdl_home->get_produk_populer();
    //        $data['get_pp'] = $this->Mdl_home->get_pp();
    $data['get_unit'] = $this->Mdl_home->get_unit();
    $data['get_link_utama'] = $this->Mdl_home->get_link_utama();
    $data['get_link_terkait'] = $this->Mdl_home->get_link_terkait();
    $data['stat_today'] = $this->Mdl_home->get_stat_today();
    $data['stat_yesterday'] = $this->Mdl_home->get_stat_yesterday();
    $data['stat_total'] = 0;
    $this->load->view("produk_hukum_form", $data);
  }

  function detail($peraturan_id, $tipe_dokumen)
  {
    //$item = $this->mdl_session->tampil("tb_session", $ip);
    //$data['get_awal_produk'] = $this->Mdl_home->get_awal_produk();
    $data['tcari'] = "";
    $data['tipe_dokumen'] = $tipe_dokumen;
    $data['peraturan_category_id'] = "";
    $data['noperaturan'] = "";
    $data['tahun'] = "";
    $data['tag_id'] = "";
    $data['tipe_cari'] = "cepat";
    $data['judul'] = "";
    $data['dataaktif'] = "produk_hukum";
    $data['status'] = "";
    $data['dept_id'] = '';
    $data['peraturan_id'] = $peraturan_id;
    $data['data_detail'] = $this->Mdl_produk_hukum->get_detail($peraturan_id);
    $datadetaildua = $this->Mdl_produk_hukum->get_noperaturan($peraturan_id);
    $data['get_awal_produk'] = $this->Mdl_produk_hukum->get_awal_produk($peraturan_id);
    foreach ($datadetaildua->result_array() as $ddd) {
      $data['data_detail_dua'] = $this->Mdl_produk_hukum->get_detail_dua($ddd['noperaturan'], $peraturan_id);
    }
    $data['data_file'] = $this->Mdl_produk_hukum->get_peraturan_file($peraturan_id);
    $dataview = $this->Mdl_produk_hukum->get_view_count($peraturan_id);
    foreach ($dataview as $dv) {
      $view_count = $dv->view_count + 1;
    }
    $datatambah = array(
      'view_count' => $view_count
    );
    $this->Mdl_produk_hukum->add_view_count($peraturan_id, $datatambah);

    $data['tipe_cari'] = 'cepat';
    $data['user_online'] = $this->Mdl_fungsi->simpan_session('6');
    $data['data_per_terkait'] = $this->Mdl_produk_hukum->ambil_peraturan_terkait($peraturan_id);
    $this->load->view("produk_hukum_form", $data);
  }

  function view($peraturan_id)
  {


    $data['get_banner'] = $this->Mdl_produk_hukum->get_banner();
    $data['get_banner_news'] = $this->Mdl_produk_hukum->get_banner_news();
    $data['get_awal_produk'] = $this->Mdl_produk_hukum->get_awal_produk($peraturan_id);
    $data['get_produk_populer'] = $this->Mdl_home->get_produk_populer();
    //$data['get_pp'] = $this->Mdl_home->get_pp();
    $data['get_unit'] = $this->Mdl_home->get_unit();
    $data['data_detail'] = $this->Mdl_produk_hukum->get_detail($peraturan_id);
    $datadetaildua = $this->Mdl_produk_hukum->get_noperaturan($peraturan_id);
    $data['get_link_utama'] = $this->Mdl_home->get_link_utama();
    $data['get_link_terkait'] = $this->Mdl_home->get_link_terkait();
    $data['stat_today'] = $this->Mdl_home->get_stat_today();
    $data['stat_yesterday'] = $this->Mdl_home->get_stat_yesterday();
    $data['stat_total'] = 0;
    foreach ($datadetaildua->result_array() as $ddd) {
      $data['data_detail_dua'] = $this->Mdl_produk_hukum->get_detail_dua($ddd['noperaturan'], $peraturan_id);
    }
    $data['data_file'] = $this->Mdl_produk_hukum->get_peraturan_file($peraturan_id);
    $dataview = $this->Mdl_produk_hukum->get_view_count($peraturan_id);
    foreach ($dataview as $dv) {
      $view_count = $dv->view_count + 1;
    }
    $datatambah = array(
      'view_count' => $view_count
    );
    $this->Mdl_produk_hukum->add_view_count($peraturan_id, $datatambah);
    $this->load->view("produk_hukum_form", $data);
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

      $datacount = $this->Mdl_produk_hukum->get_download_count($fileupload);
      foreach ($datacount as $dc) {
        $downcount = $dc['download_count'] + 1;
        $peraturanid = $dc['peraturan_id'];
      }
      $data = array(
        'download_count' => $downcount
      );
      $this->Mdl_produk_hukum->add_download_count($peraturanid, $data);
      force_download($file, NULL);
    }
  }

  function download_parsial($kodekat, $tahun, $bulan, $file_parsial)
  {
    if (!empty($kodekat) && !empty($tahun) && !empty($bulan) && !empty($file_parsial)) {
      $this->load->helper('download');
      $file = './internal/assets/assets/produk_parsial/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $file_parsial;
      $datacount = $this->Mdl_produk_hukum->get_file_count($file_parsial);
      foreach ($datacount as $dc) {
        $filecount = $dc['download_count'] + 1;
        $peraturanid = $dc['peraturan_id'];
      }
      $data = array(
        'download_count' => $filecount
      );
      $this->Mdl_produk_hukum->add_file_count($peraturanid, $file_parsial, $data);
      force_download($file, NULL);
    }
  }

  function download_abstrak($kodekat, $tahun, $bulan, $file_abstrak)
  {
    if (!empty($kodekat) && !empty($tahun) && !empty($bulan) && !empty($file_abstrak)) {
      $this->load->helper('download');
      $file = './internal/assets/assets/produk_abstrak/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $file_abstrak;
      force_download($file, NULL);
    }
  }

  function sendmail()
  {

    // Konfigurasi email
    $config = [
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'protocol' => 'smtp',
      'smtp_host' => 'mail.pu.go.id',
      'smtp_user' => 'jdih@pu.go.id', // Email gmail
      'smtp_pass' => 'Birohk2017', // Password gmail
      'smtp_crypto' => 'ssl',
      'smtp_port' => 465,
      'crlf' => "\r\n",
      'newline' => "\r\n",
      'charset'   => 'iso-8859-1'
    ];

    // Load library email dan konfigurasinya
    $this->load->library('email', $config);

    // Email dan nama pengirim
    $this->email->from('jdih@pu.go.id', 'Admin JDIH');

    // Email penerima
    $this->email->to('muzaen@gmail.com'); // Ganti dengan email tujuan
    // Lampiran email, isi dengan url/path file
    $this->email->attach('http://jdih.pu.go.id/assets/img/core-img/logopupr2.png');

    // Subject email
    $this->email->subject('Kirim Produk Hukum dari Server');

    // Isi email
    $this->email->message("Coba Kirim Email");

    // Tampilkan pesan sukses atau error
    if ($this->email->send()) {
      echo 'Sukses! email berhasil dikirim.';
    } else {
      echo 'Error! email tidak dapat dikirim.';
    }
  }

  function tambah_unduh()
  {
    $peraturan_id = htmlspecialchars($this->input->post('peraturan_id'));
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

  function test_kirim_email()
  {
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 400); //300 seconds = 5 minutes
    set_time_limit(400);

    $this->load->library('Kirim_email_baru');
    $nama = 'sandy';
    $email = 'sandyvaldo90@gmail.com';
    $Subject = 'test';
    $konfig = $this->Mdl_Rest->getKonfigEmail();
    $Host = $konfig->nama_host;
    $Username = $konfig->host_user_name;  // SMTP password
    $Password = $konfig->host_password;            // SMTP username

    $From = $konfig->email_from;
    $FromName = $konfig->email_from_name;
    $Body = 'Dear ';
    $To = $email;
    $ToName = $nama;


    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $Host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $Username;
    $mail->Password = $Password;
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->From     = $From;
    $mail->FromName = $FromName;

    $mail->AddAddress($To, $ToName);
    $mail->WordWrap = 50;        // set word wrap
    $mail->Priority = 2;
    $mail->SMTPDebug = 2;
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject  =  $Subject;
    $mail->IsHTML(true);
    $mail->MsgHTML($Body);
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    if (!$mail->Send()) {
      $mail_stat_ins = $mail->ErrorInfo;
      echo $mail_stat_ins;
      echo "gagal";
    } else {
      echo "sukses";
    }
  }
}
