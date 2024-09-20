<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_Model
 *
 * @author user
 */
class Mdl_produk_hukum extends CI_Model {

    function get_banner() {
        return $this->db->query("select gambar from tb_banner_home where status='a'")->result_array();
    }

    function get_pp() {
        return $this->db->query("select peraturan_category_id,percategoryname from ppj_peraturan_category where percategorykondisi='1' order by ppj_peraturan_category.order ASC")->result_array();
    }
function get_link_utama() {
        return $this->db->query("select linkname,linkurl from ppj_link_utama")->result_array();
    }
    function get_unit() {
        return $this->db->query("select deptname from ppj_departemen where parent_id='0' order by ppj_departemen.order ASC")->result_array();
    }

    function get_banner_news() {
        return $this->db->query("select peraturan_id,tentang,noperaturan from ppj_peraturan where check_banner='y' order by tgl_modifikasi DESC")->result_array();
        //return $this->db->query("select tentang,noperaturan from ppj_peraturan where status='0' and kondisi='3' order by tgl_modifikasi DESC limit 0,6")->result_array();
    }

    function get_awal_produk($peraturan_id) {
        $tgl = date("Y") - 2;
        return $this->db->query("select * from ppj_peraturan where kondisi='3' and peraturan_id='" . $peraturan_id . "' order by tgl_modifikasi DESC ")->result_array();
    }

    function get_produk_populer() {
        $tgl = date("Y") - 2;
        return $this->db->query("select tentang,noperaturan,status,peraturan_category_id,tanggal,download_count from ppj_peraturan where kondisi='3' and substring(tanggal,1,4)>='" . $tgl . "' order by download_count DESC limit 0,5 ")->result_array();
    }

    function cari_peraturan_id($id) {
        $hasil = '';
        $kueri = $this->db->query("select percategoryname from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        foreach ($kueri as $hkueri) {
            $hasil = $hkueri['percategoryname'];
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

    function get_artikel_terkait($peraturan_id, $peraturan_category_id) {
        $kueri1 = $this->db->query("select * from ppj_peraturan where peraturan_category_id='" . $peraturan_category_id . "' and peraturan_id > '" . $peraturan_id . "' limit 0,5");
        if ($kueri1->num_rows() >= 5) {
            return $kueri1;
        } else {
            $kueri2 = $this->db->query("select * from ppj_peraturan where peraturan_category_id='" . $peraturan_category_id . "' and peraturan_id < '" . $peraturan_id . "' limit 0,5");
            return $kueri2;
        }
    }

}
