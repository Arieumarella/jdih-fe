<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_home extends CI_Model {

    function get_banner() {
        return $this->db->query("select gambar from tb_banner_home where status='a'")->result_array();
    }

    function get_pp($tipe) {
        return $this->db->query("select tipe,peraturan_category_id,percategoryname from ppj_peraturan_category where percategorykondisi='1'  and tipe='".$tipe."' order by ppj_peraturan_category.order ASC")->result_array();
    }

    function get_unit() {
        return $this->db->query("select deptname,dept_id from ppj_departemen where parent_id='0' order by ppj_departemen.order ASC")->result_array();
    }
	function get_berita() {
        return $this->db->query("select * from tb_berita order by tgl_modifikasi DESC")->result_array();
    }
	function get_berita_count() {
		$total=0;
        return $this->db->query("select * from tb_berita order by tgl_modifikasi DESC")->num_rows();
    }
	function get_agenda() {
		$tgl=date("Ymd");
        return $this->db->query("select * from tb_agenda where tanggal >= '".$tgl."' order by tgl_modifikasi ASC")->result_array();
    }
	function get_link_utama() {
        return $this->db->query("select linkname,linkurl from ppj_link_utama order by ppj_link_utama.order ASC")->result_array();
    }
	function get_link_terkait() {
        return $this->db->query("select linkname,linkurl from ppj_link_terkait order by ppj_link_terkait.order ASC")->result_array();
    }
    function get_banner_news() {
        return $this->db->query("select peraturan_id,tentang,noperaturan from ppj_peraturan where check_banner='y' order by tgl_modifikasi DESC")->result_array();
        //return $this->db->query("select tentang,noperaturan from ppj_peraturan where status='0' and kondisi='3' order by tgl_modifikasi DESC limit 0,6")->result_array();
    }

    function get_awal_produk() {
        $tgl = date("Y") - 2;
        return $this->db->query("select peraturan_id,tentang,katalog,abstrak,file_abstrak,noperaturan,
		status,peraturan_category_id,tanggal,download_count,file_zip from ppj_peraturan
		where kondisi='3' and approval_2='1' order by peraturan_id DESC ")->result_array();
    }
	
	 function get_data_awal($start,$limit) {
        $tgl = date("Y") - 2;
        return $this->db->query("select peraturan_id,tentang,katalog,abstrak,file_abstrak,noperaturan,
		status,peraturan_category_id,tanggal,download_count,file_zip from ppj_peraturan
		where kondisi='3' and approval_2='1' order by tgl_modifikasi DESC limit ".$limit.",".$start."")->result_array();
    }
	
	function get_jumlah_data(){
		$total=0;
		$kueri=$this->db->query("select count(*) as total from ppj_peraturan
		where kondisi='3' and approval_2='1' order by tgl_modifikasi DESC ")->result_array();
		foreach($kueri as $rw){$total=$rw['total'];}
		
		return $total;
	}
    function get_produk_populer() {
        $tgl = date("Y") - 2;
        return $this->db->query("select peraturan_id,tentang,noperaturan,status,peraturan_category_id,tanggal,
		download_count from ppj_peraturan where kondisi='3'  and approval_2='1' order by download_count DESC limit 0,5 ")->result_array();
    }

    function cari_peraturan_id($id) {
        $hasil = '';
        $kueri = $this->db->query("select percategoryname from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        foreach ($kueri as $hkueri) {
            $hasil = $hkueri['percategoryname'];
        }
        echo $hasil;
    }
	
	function cari_peraturan_code($id) {
        $hasil = '';
        $kueri = $this->db->query("select percategorycode from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        foreach ($kueri as $hkueri) {
            $hasil = $hkueri['percategorycode'];
        }
        echo $hasil;
    }
    function cari_bulan($kode) {
        switch ($kode) {
            case "01":
                $bulan = "Januari";
                break;
            case "02":
                $bulan = "Februari";
                break;
            case "03":
                $bulan = "Maret";
                break;
            case "04":
                $bulan = "April";
                break;
            case "05":
                $bulan = "Mei";
                break;
            case "06":
                $bulan = "Juni";
                break;
            case "07":
                $bulan = "Juli";
                break;
            case "08":
                $bulan = "Agustus";
                break;
            case "09":
                $bulan = "September";
                break;
            case "10":
                $bulan = "Oktober";
                break;
            case "11":
                $bulan = "November";
                break;
            case "12":
                $bulan = "Desember";
                break;
            default;
        }
        return $bulan;
    }

    function get_kategori($kategoriid) {
        $this->db->where('peraturan_category_id', $kategoriid);
        $query = $this->db->get('ppj_peraturan_category');
        return $query->result_array();
    }
    
    function get_download_count($namafile) {
        $this->db->select('peraturan_id, download_count');
        $this->db->where('file_zip', $namafile);
        $query = $this->db->get('ppj_peraturan');
        return $query->result_array();
    }

    function add_download_count($peraturanid, $data) {
        $this->db->where('peraturan_id', $peraturanid);
        $this->db->update('ppj_peraturan', $data);
    }
	
	function get_widget($id){
		$kueri=$this->db->query("select widgetname,widgetcontent,widgetmore from ppj_widget where widget_id='".$id."'")->result_array();
		return $kueri;
	}
	
	function get_stat_today(){
		$total=0;
		
		$tgl= date('Y-m-d');
		$kueri=$this->db->query("select count(*) as total from ppj_hit_counter where tanggal='".$tgl."'")->result_array();
		foreach($kueri as $rw){$total=$rw['total'];}
		return $total;
	}
	
	function get_stat_yesterday(){
		$total=0;
		$date = strtotime("-1 day");
		$tgl= date('Y-m-d', $date);
		$kueri=$this->db->query("select count(*) as total from ppj_hit_counter where tanggal='".$tgl."'")->result_array();
		foreach($kueri as $rw){$total=$rw['total'];}
		return $total;
	}
	
	function get_stat_total(){
		$total=0;
		$kueri=$this->db->query("select count(*) as total from ppj_hit_counter")->result_array();
		foreach($kueri as $rw){$total=$rw['total'];}
		return $total;
	}

}
