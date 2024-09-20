<?php

defined('BASEPATH') OR Exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("auth");
        $this->load->model("Mdl_session");
        $this->load->model("mdl_log");
		$this->load->model("mdl_fungsi");
        $this->load->model("Mdl_pengguna");
		$this->load->helper('url');
        $this->load->library('session');
    }
	function getdb(){
		//echo $this->db->database;
		//echo $this->mdl_fungsi->get_last_id("ppj_tags");
	}
    function index() {
        $data['nr'] = "";$data['respon']='';
        $this->load->view("login_form", $data);
    }
	
	function noresult() {
        $data['nr'] = "p3";$data['respon']='';
        $this->load->view("login_form", $data);
    }
	function gtsj(){
		echo phpinfo();
	}
    function auth() {
		/*$secret_key = "6LcVtvwUAAAAABrlX3C4l3VtcFnkH2AMFyXlXs0J";
		$res=$this->input->post('g-recaptcha-response');
		$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$res);
		$response = json_decode($verify);
		
		if($response->success){
		*/		$user_id = $this->input->post("email");
				$password = $this->input->post("password");
				$tipe = $this->input->post('tipe');
				
				$where = array(
					'username' => $user_id,
					'password' => md5($password)
				);
				$session_id=session_id();
				$waktu=date("YmdHi");
				if($tipe==1){
					$json['respon']="nodata";
				}elseif($tipe==2){
					$jsondata = file_get_contents("https://ehrm.pu.go.id/pupr/api/api_birohukum2.php?username=$user_id&kata_sandi=$password");
					$json = json_decode($jsondata,true);
				}
				
				
				if($json['respon']=="nodata"){
					$array = $this->auth->cek_data($where, 'ppj_users');
					$p = (object) $array;
					$nm = $p->nama;
					$res = $p->respon;
					if ($res == "OK") {
						//session_destroy();
						//session_start();
						$new_session = array(
							'sess_id' => $user_id,
							'sess_nama' => $nm
						);
						$this->session->set_userdata($new_session);
						$data['sess_id'] = $this->session->userdata('sess_id');
						$data['sess_nama'] = $this->session->userdata('sess_nama');

						//$this->load->view("home_form",$data);
						$ip = $this->Mdl_session->getUserIpAddr();
						$tgl_login = date("YmdHis");

						$this->db->where("ip", $ip);
						$this->db->delete("tb_session");
						$data = array("ip" => $ip,
							"tgl_login" => $tgl_login,
							"sess_id" => $user_id,
							"sess_nama" => $nm,
							"session"=>$session_id,
							"waktu"=>$tgl_login);

						$this->db->insert("tb_session", $data);

						$tgl = date("YmdHis");

						$data = array("ip" => $ip,
							"user_id" => $user_id,
							"tgl" => $tgl);

						$this->mdl_log->simpan("Login", "login", $user_id, '');
						
						redirect("home");
						//$this->load->view("home_form",$data);
						//echo "ok";
					} else {
						
						redirect("login/noresult");
					}
				}elseif($json['respon']=="sukses"){
					//echo $json[0]['id_pegawai'];
					//echo $json[0]['nm_lengkap'];
					
						//session_destroy();
						//session_start();
					$get_last_id= $this->mdl_fungsi->get_last_id("ppj_users");
					$username = $json['data'][0]['kdpengguna']."_".$json['data'][0]['id_pegawai'];
					$nmlengkap = $json['data'][0]['nm_lengkap'];
					$sandi = $json['data'][0]['password'];
					$surat = $json['data'][0]['email'];
					$grup ="5";
					$unor ="";
					$unker = "";
					$user_id="admin";
					$user_name="admin";
					$tgl=date("YmdHis");
					$token=date("YmdHis").$user_name.$nmlengkap.$username;
					$remember_token=base64_encode($sandi);
					$token_aktivasi=md5($token);
					$aktivasi_status='Y';
					$token_create=date("YmdHis");
					$link= base_url()."Aktivasi?token=".$token_aktivasi;
					
					$ck=$this->db->query("select * from ppj_users where username='".$username."'");
					if($ck->num_rows() > 0){
						foreach($ck->result_array() as $hkueri){
							$get_last_id=$hkueri['user_id'];
						}
						$data = array(
							'email' => $surat,
							'fullname' => $nmlengkap,
							'pengubah' => $user_id,
							'jenis'=>'ehrm',
							'tgl_modifikasi' => date('YmdHis')
						);
						$where=array("username"=>$username,"user_id"=>$get_last_id);
						$this->Mdl_pengguna->ubah('ppj_users', $data,$where);
						
					}else{
						  $data = array(
								'group_id' => $grup,
								'unor'=>$unor,
								'dept_id' => $unker,
								'username' => $username,
								'password' => md5($sandi),
								'status' => '0',
								'email' => $surat,
								'fullname' => $nmlengkap,
								'created_by' => '',
								'tgl_buat' => date('YmdHis'),
								'pembuat'=>$user_id,
								'tgl_modifikasi'=>$tgl,
								'pengubah'=>$user_id,
								'token_aktivasi'=>$token_aktivasi,
								'aktivasi_status'=>$aktivasi_status,
								'remember_token'=>$remember_token,
								'token_create'=>$token_create,
								'jenis'=>'ehrm'
								
							);
							
							$this->Mdl_pengguna->tambah('ppj_users', $data);
					
					}
					
					
				  
						
						$new_session = array(
							'sess_id' => $username,
							'sess_nama' =>  $nmlengkap
						);
						$this->session->set_userdata($new_session);
						$data['sess_id'] = $this->session->userdata('sess_id');
						$data['sess_nama'] = $this->session->userdata('sess_nama');

						//$this->load->view("home_form",$data);
						$ip = $this->Mdl_session->getUserIpAddr();
						$tgl_login = date("YmdHis");

						$this->db->where("ip", $ip);
						$this->db->delete("tb_session");
						
						$data = array("ip" => $ip,
							"tgl_login" => $tgl_login,
							"sess_id" => $username,
							"sess_nama" => $nmlengkap,
							"session"=>$session_id,
							"waktu"=>$tgl_login);
						
						
						
						$this->db->insert("tb_session", $data);

						$tgl = date("YmdHis");

						$data = array("ip" => $ip,
							"user_id" => $username,
							"tgl" => $tgl);

						$this->mdl_log->simpan("Login", "login", $username, '');

						redirect("home");
				}else{
					//redirect("login/noresult");
					$array = $this->auth->cek_data($where, 'ppj_users');
					$p = (object) $array;
					$nm = $p->nama;
					$res = $p->respon;
					if ($res == "OK") {
						//session_destroy();
						//session_start();
						$new_session = array(
							'sess_id' => $user_id,
							'sess_nama' => $nm
						);
						$this->session->set_userdata($new_session);
						$data['sess_id'] = $this->session->userdata('sess_id');
						$data['sess_nama'] = $this->session->userdata('sess_nama');

						//$this->load->view("home_form",$data);
						$ip = $this->Mdl_session->getUserIpAddr();
						$tgl_login = date("YmdHis");

						$this->db->where("ip", $ip);
						$this->db->delete("tb_session");
						$data = array("ip" => $ip,
							"tgl_login" => $tgl_login,
							"sess_id" => $user_id,
							"sess_nama" => $nm,
							"session"=>$session_id,
							"waktu"=>$tgl_login);

						$this->db->insert("tb_session", $data);

						$tgl = date("YmdHis");

						$data = array("ip" => $ip,
							"user_id" => $user_id,
							"tgl" => $tgl);

						$this->mdl_log->simpan("Login", "login", $user_id, '');

						redirect("home");
						
						//$this->load->view("home_form",$data);
						//echo "ok";
					} else {
						
						redirect("login/noresult");
					}
				}
		/*}else{ 
				//echo $res;
			//	echo $secret_key;
				$this->session->set_flashdata('respon','recaptcha'); 
				redirect("Login/gagal","refresh");
				
		}*/
        
    }
	
	function gagal(){
		$data['respon']='recaptcha';$data['nr']='';
		$this->load->view("login_form",$data);
		
	}
	
    public function logout($user_id) {
        $ip = $this->Mdl_session->getUserIpAddr();
        $this->db->where("ip", $ip);
        $this->db->delete("tb_session");

        $this->session->unset_userdata('sess_mlk_nama');
        $this->session->unset_userdata('sess_mlk_id');
        $this->mdl_log->simpan("Login", "logout", $user_id, '');
        session_destroy();
        redirect('login');
    }

}

?>