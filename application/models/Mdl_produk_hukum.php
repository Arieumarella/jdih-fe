<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_produk_hukum extends CI_Model
{

    public function save($data, $table)
    {
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function get_banner()
    {
        return $this->db->query("select gambar from tb_banner_home where status='a'")->result_array();
    }

    function get_pp()
    {
        return $this->db->query("select peraturan_category_id,percategoryname from ppj_peraturan_category where percategorykondisi='1' order by ppj_peraturan_category.order ASC")->result_array();
    }

    function get_unit()
    {
        return $this->db->query("select deptname from ppj_departemen where parent_id='0' order by ppj_departemen.order ASC")->result_array();
    }

    function get_banner_news()
    {
        return $this->db->query("select peraturan_id,tentang,noperaturan from ppj_peraturan where check_banner='y' order by tgl_modifikasi DESC")->result_array();
        //return $this->db->query("select tentang,noperaturan from ppj_peraturan where status='0' and kondisi='3' order by tgl_modifikasi DESC limit 0,6")->result_array();
    }

    // function get_awal_produk($peraturan_id)
    // {
    //     $tgl = date("Y") - 2;
    //     return $this->db->query("select ppj_peraturan.*, tb_bidang_hukum.nama AS bidang_hukum from ppj_peraturan LEFT JOIN tb_bidang_hukum ON tb_bidang_hukum.id = ppj_peraturan.bidang_hukum where ppj_peraturan.kondisi='3' and ppj_peraturan.peraturan_id='" . $peraturan_id . "' order by ppj_peraturan.tgl_modifikasi DESC ")->result_array();
    // }

    function get_awal_produk($peraturan_id)
    {
        $tgl = date("Y") - 2;
        $this->db->select('ppj_peraturan.*');
        $this->db->from('ppj_peraturan');
        $this->db->join('tb_bidang_hukum', 'tb_bidang_hukum.id = ppj_peraturan.bidang_hukum', 'left');
        $this->db->where('ppj_peraturan.kondisi', '3');
        $this->db->where('ppj_peraturan.peraturan_id', $peraturan_id);
        $this->db->order_by('ppj_peraturan.tgl_modifikasi', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
    }


    function get_produk_populer()
    {
        $tgl = date("Y") - 2;
        return $this->db->query("select tentang,noperaturan,status,peraturan_category_id,tanggal,download_count from ppj_peraturan where kondisi='3' and substring(tanggal,1,4)>='" . $tgl . "' order by download_count DESC limit 0,5 ")->result_array();
    }

    function cari_peraturan_id($id)
    {
        $hasil = '';
        $kueri = $this->db->query("select percategoryname from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        foreach ($kueri as $hkueri) {
            $hasil = $hkueri['percategoryname'];
        }
        echo $hasil;
    }

    function cari_bulan($kode)
    {
        $bulan = '';
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

    function get_artikel_terkait($peraturan_id, $peraturan_category_id)
    {
        $kueri1 = $this->db->query("select * from ppj_peraturan where peraturan_category_id='" . $peraturan_category_id . "' and peraturan_id > '" . $peraturan_id . "' limit 0,5");
        if ($kueri1->num_rows() >= 5) {
            return $kueri1;
        } else {
            $kueri2 = $this->db->query("select * from ppj_peraturan where peraturan_category_id='" . $peraturan_category_id . "' and peraturan_id < '" . $peraturan_id . "' limit 0,5");
            return $kueri2;
        }
    }

    function get_view_count($peraturanid)
    {
        $this->db->select('view_count');
        $this->db->where('peraturan_id', $peraturanid);
        $query = $this->db->get('ppj_peraturan');
        return $query->result();
    }

    function add_view_count($peraturanid, $data)
    {
        $this->db->where('peraturan_id', $peraturanid);
        $this->db->update('ppj_peraturan', $data);
    }

    function get_detail($peraturan_id)
    {
        $this->db->where('peraturan_id', $peraturan_id);
        $query = $this->db->get('ppj_peraturan_detail');
        return $query;
    }

    function get_peraturanid($noperaturan)
    {
        $this->db->select('peraturan_id, tipe_dokumen');
        $this->db->where('noperaturan', $noperaturan);
        $query = $this->db->get('ppj_peraturan');
        return $query;
    }

    function get_peraturanid_byID($peraturan_id)
    {
        $this->db->select('peraturan_id, tipe_dokumen');
        $this->db->where('peraturan_id', $peraturan_id);
        $query = $this->db->get('ppj_peraturan');
        return $query;
    }

    function get_noperaturan($peraturanid)
    {
        $this->db->select('noperaturan');
        $this->db->where('peraturan_id', $peraturanid);
        $query = $this->db->get('ppj_peraturan');
        return $query;
    }

    // function get_detail_dua($noperaturan, $peraturanid)
    // {
    //     $this->db->where('noperaturan', $noperaturan);
    //     $this->db->where('peraturan_id', $peraturanid);
    //     $query = $this->db->get('ppj_peraturan_detail');
    //     return $query;
    // }

    function get_detail_dua($noperaturan, $peraturanid)
    {
        $this->db->select('*');
        $this->db->from('ppj_peraturan_detail');
        $this->db->where('noperaturan', $noperaturan);
        $this->db->where('peraturan_id', $peraturanid);

        $query = $this->db->get();
        return $query;
    }


    function get_tentang($peraturanid)
    {
        $this->db->select('tipe_dokumen,peraturan_id, noperaturan, tentang, tanggal_pengundangan');
        $this->db->where('peraturan_id', $peraturanid);
        $query = $this->db->get('ppj_peraturan');
        return $query;
    }

    function get_namakategori($id)
    {
        $this->db->select('percategoryname, percategorycode');
        $this->db->where('peraturan_category_id', $id);
        $query = $this->db->get('ppj_peraturan_category');
        return $query;
    }

    // function get_peraturan_file($peraturanid)
    // {
    //     $this->db->where('peraturan_id', $peraturanid);
    //     $query = $this->db->get('ppj_peraturan_file');
    //     return $query;
    // }

    function get_peraturan_file($peraturanid)
    {
        $this->db->where('peraturan_id', $peraturanid);
        $query = $this->db->get('ppj_peraturan_file');
        return $query;
    }


    function get_download_count($namafile)
    {
        $this->db->select('peraturan_id, download_count');
        $this->db->where('file_zip', $namafile);
        $query = $this->db->get('ppj_peraturan');
        return $query->result_array();
    }

    function add_download_count($peraturanid, $data)
    {
        $this->db->where('peraturan_id', $peraturanid);
        $this->db->update('ppj_peraturan', $data);
    }

    function get_file_count($namafile)
    {
        $this->db->select('peraturan_id, download_count');
        $this->db->where('file', $namafile);
        $query = $this->db->get('ppj_peraturan_file');
        return $query->result_array();
    }

    function add_file_count($peraturanid, $namafile, $data)
    {
        $this->db->where('peraturan_id', $peraturanid);
        $this->db->where('file', $namafile);
        $this->db->update('ppj_peraturan_file', $data);
    }

    function ambil_peraturan_terkait($idper)
    {
        $this->db->where('id_peraturan', $idper);
        $query = $this->db->get('tb_peraturan_terkait');
        return $query;
    }

    function ambil_detail_peraturan($idper)
    {
        $this->db->select('peraturan_id, tipe_dokumen, peraturan_category_id, noperaturan');
        $this->db->where('peraturan_id', $idper);
        $query = $this->db->get('ppj_peraturan');
        return $query->result_array();
    }
}
