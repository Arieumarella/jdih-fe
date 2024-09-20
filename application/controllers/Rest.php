<?php
defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');
class Rest extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();



        $this->load->helper(array('url', 'html'));

        $this->load->library('session');
        $this->load->library('Kirim_email_baru');
        $this->load->model(array('Mdl_home', 'Mdl_fungsi', 'Mdl_Rest'));

    }



    function getProduk()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];
        $akhir = $_REQUEST['akhir'];
        //$mulai=$this->input->get('mulai');
        //$akhir=$this->input->get('akhir');
        $kueri = $this->Mdl_Rest->getProduk($mulai, $akhir);



        echo json_encode($kueri);

    }

    function getProdukInternal()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $kueri = $this->Mdl_Rest->getProdukInternal($mulai, $akhir);



        echo json_encode($kueri);

    }

    function getCariCepat()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $tcari = $_REQUEST['tcari'];

        $akhir = $_REQUEST['akhir'];

        $kueri = $this->Mdl_Rest->getCariCepat($mulai, $akhir, $tcari);



        echo json_encode($kueri);

    }

    function getCariDetail()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $category = $_REQUEST['category'];

        $substansi = $_REQUEST['substansi'];

        $status = $_REQUEST['status'];

        $nomor = $_REQUEST['nomor'];

        $tahun = $_REQUEST['tahun'];

        $judul = $_REQUEST['judul'];



        $kueri = $this->Mdl_Rest->getCariDetail($mulai, $akhir, $category, $substansi, $status, $nomor, $tahun, $judul);



        echo json_encode($kueri);

    }

    function getSubstansiLimit()

    {

        //echo $tthi('mulai');

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $tcari = $_REQUEST['tcari'];

        $tipe = $_REQUEST['tipe'];

        $kueri = $this->Mdl_Rest->getSubstansiLimit($mulai, $akhir, $tipe, $tcari);



        echo json_encode($kueri);

    }



    function getDetail()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $id = $_REQUEST['id'];

        $kueri = $this->Mdl_Rest->getDetail($id);

        echo json_encode($kueri);

    }



    function getFavorit()

    {

        //echo $tthi('mulai');

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $tcari = $_REQUEST['tcari'];

        $tipe = $_REQUEST['tipe'];

        $string = $_REQUEST['peraturan_id'];

        $array = array_map('intval', explode(',', $string));

        $peraturan_id = implode("','", $array);

        $kueri = $this->Mdl_Rest->getFavorit($mulai, $akhir, $tipe, $tcari, $peraturan_id);



        echo json_encode($kueri);

    }



    function getDataComboPencarian()
    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $kueri = $this->Mdl_Rest->getDataComboPencarian();

        echo json_encode($kueri);

    }



    function getProleg()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $kueri = $this->Mdl_Rest->getProleg($mulai, $akhir);



        echo json_encode($kueri);

    }



    function getIzinPemrakarsa()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');

        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $kueri = $this->Mdl_Rest->getIzinPemrakarsa($mulai, $akhir);



        echo json_encode($kueri);

    }



    function getProlegDetail()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $id = $_REQUEST['id'];

        $kueri = $this->Mdl_Rest->getProlegDetail($id);



        echo json_encode($kueri);

    }



    function getIzinPrakarsaDetail()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $id = $_REQUEST['id'];

        $kueri = $this->Mdl_Rest->getIzinPrakarsaDetail($id);



        echo json_encode($kueri);

    }



    function getProdukSubstansi()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $mulai = $_REQUEST['mulai'];

        $akhir = $_REQUEST['akhir'];

        $substansi = $_REQUEST['substansi'];



        $kueri = $this->Mdl_Rest->getProdukSubstansi($mulai, $akhir, $substansi);



        echo json_encode($kueri);

    }



    function getLinkTerkait()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kueri = $this->Mdl_Rest->getLinkTerkait();



        echo json_encode($kueri);

    }



    function getBantuan()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kueri = $this->Mdl_Rest->getBantuan();



        echo json_encode($kueri);

    }


    function Ttime(){
        $tgl_buat=date("YmdHis");
        $st=substr($tgl_buat,0,4)."-".substr($tgl_buat,4,2)."-".substr($tgl_buat,6,2)." ".substr($tgl_buat,8,2).":".substr($tgl_buat,10,2).":".substr($tgl_buat,12,2);
        //$st=date("Y-m-d H:i");
        $timestamp = strtotime($st) + 60*60*4;

        $time = date('YmdHis', $timestamp);

        echo $time;//11:09
    }
    function LoginAuth()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $kueri = $this->Mdl_Rest->getLoginAuth($username, $password);
        echo json_encode($kueri);

    }

    function LoginOTP()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');
        $username = $_REQUEST['username'];
        $kodeOtp = $_REQUEST['kodeOtp'];
        $kueri = $this->Mdl_Rest->getLoginOTP($username, $kodeOtp);
        echo json_encode($kueri);

    }

    function getSliderPeraturan()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kueri = $this->Mdl_Rest->getSliderPeraturan();



        echo json_encode($kueri);

    }



    function getCountStatus()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kode = $_REQUEST['kode'];



        $kueri = $this->Mdl_Rest->getCountStatus($kode);



        echo json_encode($kueri);

    }



    function getCountPeraturan()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kueri = $this->Mdl_Rest->getCountPeraturan();



        echo json_encode($kueri);

    }



    function getCountViewPeraturan()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kueri = $this->Mdl_Rest->getCountViewPeraturan();



        echo json_encode($kueri);

    }



    function getCountDownloadPeraturan()

    {

        date_default_timezone_set('Asia/Jakarta');

        header('Access-Control-Allow-Origin: *');



        $kueri = $this->Mdl_Rest->getCountDownloadPeraturan();



        echo json_encode($kueri);

    }

    function changeNameFIle(){
        $this->db->select('a.peraturan_id,a.tanggal,a.file_upload,a.noperaturan,a.file_abstrak,a.peraturan_category_id,b.percategorycode,b.singkatan_file');
        $this->db->from('ppj_peraturan as a');
        $this->db->where('substring(a.tanggal,1,4) >= "2019" AND substring(a.tanggal,1,4) <= "2022" ');
        //$this->db->where('a.peraturan_category_id = 8');
        $this->db->where('a.peraturan_id','2935');
        $this->db->join('ppj_peraturan_category as b','a.peraturan_category_id=b.peraturan_category_id');
        $this->db->order_by('a.peraturan_id','asc');
        $kueri=$this->db->get()->result_array();
        foreach($kueri as $rw){
            $nomorperaturan=str_ireplace(" ","",$rw['noperaturan']);
            $fileupload=$rw['file_upload'];
            $file_abstrak=$rw['file_abstrak'];
            $bulan=substr($rw['tanggal'],4,2);
            $tahun=substr($rw['tanggal'],0,4);
            
            $dtktg = $this->Mdl_Rest->get_kategori($rw['peraturan_category_id']);
            foreach ($dtktg as $dkt) {
                $kodekat = $dkt['percategorycode'];
                $namakode = $dkt['singkatan_file'];
            }
            $nop=explode("/",$nomorperaturan);
            foreach($nop as $i =>$key) {}
            if($i <=0){
                $namafileupload=$tahun.$namakode.$nomorperaturan;
            }else{
                $namafileupload=$tahun.$namakode.$nop[0];
            }

            //$filepart = './internal/assets/assets/produk_zip/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $fileupload;
            $pathab='./internal/assets/assets/produk_abstrak/' . $kodekat . '/' . $tahun . '/' . $bulan . '/';
            $path='./internal/assets/assets/produk/' . $kodekat . '/' . $tahun . '/' . $bulan . '/';

            $fileab =  $pathab. $file_abstrak;
            $file =  $path . $fileupload;
            $adafile=$adaab='';
            if($file_abstrak !=''){
                if (file_exists($fileab)){
                    $nop1=explode(".",$rw['file_abstrak']);
                    $exab='';
                    foreach($nop1 as $i =>$key) {$exab=$key;}
                    $adaab ="File exist.";
                    if(rename($fileab, $pathab.'ab'.$namafileupload.'.'.$exab)){
                        $data=array('file_abstrak' => 'ab'.$namafileupload.'.'.$exab);
                        $this->db->where('peraturan_id', $rw['peraturan_id']);
                        $this->db->update('ppj_peraturan', $data);
    
                    }
                }else{
                    $adaab= "File does not exist.";
                }
            }
            if($fileupload!=''){
                if (file_exists($file)){
                    $nop2=explode(".",$rw['file_upload']);
                    $exfile='';
                    foreach($nop2 as $i =>$key) {$exfile=$key;}
                    $adaab ="File exist.";
                    if(rename($file, $path.$namafileupload.'.'.$exfile)){
                        $data=array('file_upload' => $namafileupload.'.'.$exfile,
                                    'file_zip' => $namafileupload.'.'.$exfile);
                        $this->db->where('peraturan_id', $rw['peraturan_id']);
                        $this->db->update('ppj_peraturan', $data);
    
                    }
                }else{
                    $adafile= "File does not exist.";
                }
            }
            
            echo 'nomor :'.$rw['peraturan_id'].'-'.$rw['noperaturan'].'-'.$rw['percategorycode'].'<br>file abstrak '.$rw['file_abstrak'].': '.$adaab.
            '<br>file utama '.$rw['file_upload'].': ' .$adafile.'<br><br>';
        }
    }

    
    function cekFavorit()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $peraturan_id=$this->input->get('peraturan_id');
        $kueri = $this->Mdl_Rest->cekFavorit($sessid,$peraturan_id);
        echo json_encode($kueri);

    }
    function simpanFavorit()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $peraturan_id=$this->input->get('peraturan_id');
        $tipe=$this->input->get('tipe');
        $kueri = $this->Mdl_Rest->simpanFavorit($sessid,$peraturan_id,$tipe);
        echo json_encode($kueri);

    }

    function get_favorit()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $kueri = $this->Mdl_Rest->get_favorit($sessid);
        echo json_encode($kueri);

    }
    function simpanDataLogin()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $username=$this->input->get('username');
        $fullname=$this->input->get('fullname');
        $email=$this->input->get('email');
        $grup=$this->input->get('grup');
        $unor=$this->input->get('unor');
        
        $data=array('sessid'=>$sessid,
                'username'=>$username,
                'fullname'=>$fullname,
                'email'=>$email,
                'grup'=>$grup,
                'unor'=>$unor    
        );
        $this->db->where('sessid',$sessid);
        $this->db->delete('tb_data_login');
        $this->db->insert('tb_data_login',$data);
        $kueri=array('respon'=>'ok');
        echo json_encode($kueri);

    }
    function cekDataLogin()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $kueri = $this->Mdl_Rest->cekDataLogin($sessid);
        echo json_encode($kueri);

    }
    function getProfile()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $kueri = $this->Mdl_Rest->getProfile($sessid);
        echo json_encode($kueri);

    }
    function getOutLogin()

    {

        date_default_timezone_set('Asia/Jakarta');
        header('Access-Control-Allow-Origin: *');
        $sessid=$this->input->get('sessid');
        $kueri = $this->Mdl_Rest->getOutLogin($sessid);
        echo json_encode($kueri);

    }

    function updatePass(){
        $kata="PuPRjd1h1922!";
        $kueri=$this->db->get('ppj_users');
        foreach($kueri->result_array() as $rw){
            $password= md5($rw['username'].''.$kata);
            $this->db->where('user_id', $rw['user_id']);
            $this->db->update('ppj_users', array('password'=>$password));
        }
    }
}

