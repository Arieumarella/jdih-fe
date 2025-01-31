<?php

date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') or exit('No direct script access allowed');

class Mdl_home extends CI_Model
{

    function get_banner()
    {
        return $this->db->query("select gambar from tb_banner_home where status='a'")->result_array();
    }

    function get_pp($tipe)
    {
        return $this->db->query("select tipe,peraturan_category_id,percategoryname from ppj_peraturan_category where percategorykondisi='1'  and tipe='" . $tipe . "' order by ppj_peraturan_category.order ASC")->result_array();
    }

    function get_unit()
    {
        return $this->db->query("select deptname,dept_id from ppj_departemen where parent_id='0' AND parent_id <> '10' AND dept_id <> '10' order by ppj_departemen.order ASC")->result_array();
    }

    function get_berita()
    {
        return $this->db->query("select * from tb_berita order by tgl_modifikasi DESC limit 0,3")->result_array();
    }

    function get_infografis()
    {
        return $this->db->query("select * from tb_infografis order by tgl_modifikasi DESC limit 0,3")->result_array();
    }

    function get_konsultasi_publik()
    {
        return $this->db->query("select * from tb_konsutasi_publik order by tgl_buat DESC limit 0,3")->result_array();
    }

    function get_berita_count()
    {
        $total = 0;
        return $this->db->query("select * from tb_berita order by tgl_modifikasi DESC limit 0,3")->num_rows();
    }

    function get_infografis_count()
    {
        return $this->db->query("select * from tb_infografis order by tgl_modifikasi DESC limit 0,3")->num_rows();
    }

    function get_konsultasi_publik_count()
    {
        return $this->db->query("select * from tb_konsultasi_publik order by tgl_buat DESC limit 0,3")->num_rows();
    }


    function get_agenda()
    {
        $tgl = date("Ymd");
        return $this->db->query("select * from tb_agenda where tanggal >= '" . $tgl . "' order by tgl_modifikasi ASC")->result_array();
    }

    function get_link_utama()
    {
        return $this->db->query("select linkname,linkurl from ppj_link_utama order by ppj_link_utama.order ASC")->result_array();
    }

    function get_link_terkait()
    {
        return $this->db->query("select linkname,linkurl from ppj_link_terkait order by ppj_link_terkait.order ASC")->result_array();
    }

    function get_tags()
    {
        $query = $this->db->query("select tag_id,tagname  from ppj_tags  order by tagname ASC");
        return $query->result_array();
    }
    function get_tags_fe()
    {
        $query = $this->db->query("select tag_id as id,tagname as name, icon from ppj_tags where status = 'y' order by tagname ASC");
        return $query->result_array();
    }

    function get_banner_news()
    {
        //return $this->db->query("select tipe_dokumen, peraturan_id,tentang,noperaturan from ppj_peraturan where check_banner='y' order by tgl_modifikasi DESC")->result_array();
        //4 Feb 2020
        return $this->db->query("select tipe_dokumen, tentang, tanggal,peraturan_id,judul,noperaturan from ppj_peraturan where check_banner='y' order by tgl_modifikasi DESC")->result_array();
        //return $this->db->query("select tentang,noperaturan from ppj_peraturan where status='0' and kondisi='3' order by tgl_modifikasi DESC limit 0,6")->result_array();
    }

    function get_awal_produk()
    {
        $tgl = date("Y") - 2;
        return $this->db->query("select peraturan_id,tentang,katalog,abstrak,file_abstrak,noperaturan,
           status,peraturan_category_id,tanggal,download_count,file_zip from ppj_peraturan
           where kondisi='3' and approval_2='1' order by peraturan_id DESC ")->result_array();
    }

    function get_data_awal($start, $limit)
    {
        $tgl = date("Y") - 2;
        return $this->db->query("select peraturan_id,tentang,katalog,abstrak,file_abstrak,noperaturan,
           status,peraturan_category_id,tanggal,download_count,file_zip from ppj_peraturan
           where kondisi='3' and approval_2='1' order by tgl_modifikasi DESC limit " . $limit . "," . $start . "")->result_array();
    }

    function get_jumlah_data()
    {
        $total = 0;
        $kueri = $this->db->query("select count(*) as total from ppj_peraturan
           where kondisi='3' and approval_2='1' order by tgl_modifikasi DESC ")->result_array();
        foreach ($kueri as $rw) {
            $total = $rw['total'];
        }

        return $total;
    }

    function get_produk_populer()
    {
        return $this->db->query("select tipe_dokumen,peraturan_id,tentang,noperaturan,status,peraturan_category_id,tanggal,
           download_count from ppj_peraturan where kondisi='3'  and approval_2='1' order by download_count DESC limit 0,5 ")->result_array();
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

    function cari_singkatan($id)
    {
        $hasil = '';
        $kueri = $this->db->query("select singkatan from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        foreach ($kueri as $hkueri) {
            $hasil = $hkueri['singkatan'];
        }
        echo $hasil;
    }

    function cari_peraturan_id_2($id)
    {
        // $hasil = '';
        // $kueri = $this->db->query("select percategoryname from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        // foreach ($kueri as $hkueri) {
        //     $hasil = $hkueri['percategoryname'];
        // }
        // return $hasil;

        $this->db->select('percategoryname');
        $this->db->from('ppj_peraturan_category');
        $this->db->where('peraturan_category_id', $id);

        $query = $this->db->get();
        $result = $query->row_array();

        if ($result) {
            return $result['percategoryname'];
        } else {
            return '';
        }
    }

    function cari_peraturan_code($id)
    {
        $hasil = '';
        $kueri = $this->db->query("select percategorycode from ppj_peraturan_category where peraturan_category_id='" . $id . "'")->result_array();
        foreach ($kueri as $hkueri) {
            $hasil = $hkueri['percategorycode'];
        }
        echo $hasil;
    }

    function cari_bulan($kode)
    {
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
            $bulan = "";
            break;
        }
        return $bulan;
    }

    function get_kategori($kategoriid)
    {
        // $this->db->where('peraturan_category_id', $kategoriid);
        // $query = $this->db->get('ppj_peraturan_category');
        // return $query->result_array();

        $this->db->select('*');
        $this->db->from('ppj_peraturan_category');
        $this->db->where('peraturan_category_id', $kategoriid);

        $query = $this->db->get();
        return $query->result_array();
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

    function get_widget($id)
    {
        $kueri = $this->db->query("select widgetname,widgetcontent,widgetmore from ppj_widget where widget_id='" . $id . "'")->result_array();
        return $kueri;
    }

    function get_stat_today()
    {
        $total = 0;

        $tgl = date('Ymd');
        $kueri = $this->db->query("select sum(hit) as total from tb_hit_stat where tgl='" . $tgl . "'")->result_array();
        foreach ($kueri as $rw) {
            $total = $rw['total'];
        }
        return $total;
    }

    function get_stat_yesterday()
    {
        $total = 0;
        $date = strtotime("-1 day");
        $tgl = date('Ymd', $date);
        $kueri = $this->db->query("select sum(hit) as total from tb_hit_stat where tgl='" . $tgl . "'")->result_array();
        foreach ($kueri as $rw) {
            $total = $rw['total'];
        }
        return $total;
    }

    function get_stat_total()
    {
        $total = 0;
        $kueri = $this->db->query("select total from tb_hit_total ")->result_array();
        foreach ($kueri as $rw) {
            $total = $rw['total'];
        }
        return $total;
    }

    function ambil_peraturan()
    {
        $query = $this->db->get('ppj_peraturan');
        return $query->result_array();
    }

    function ambil_nama_peraturan($perid)
    {
        $this->db->select('percategoryname');
        $this->db->where('peraturan_category_id', $perid);
        $query = $this->db->get('ppj_peraturan_category');
        return $query->result_array();
    }

    function update_judul($id, $data)
    {
        $this->db->where('peraturan_id', $id);
        $this->db->update('ppj_peraturan', $data);
    }

    function get_pp_count($perid)
    {
        /*$this->db->where('kondisi', '3');
        //$this->db->where('sifat', '1');
        $this->db->where('peraturan_category_id', $perid);
		$query = $this->db->count_all_results('ppj_peraturan');
        return $query;
		*/
        $query = $this->db->query("select ppj_peraturan.peraturan_id 
            from ppj_peraturan, ppj_peraturan_category
            where ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id  and
            ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL OR ppj_peraturan.sifat = '')
            and ppj_peraturan_category.percategorykondisi='1' and
            ppj_peraturan.peraturan_category_id='" . $perid . "'");
        return $query->num_rows();
    }

    function get_unit_count($dept_id)
    {
        /*$this->db->select('*');
        $this->db->from('ppj_peraturan');
        $this->db->join('ppj_departemen', 'ppj_peraturan.dept_id=ppj_departemen.dept_id');
        $this->db->where('kondisi', '3');
        //$this->db->where('sifat', '1');
        $this->db->where('parent_id', $deptid);
        $query = $this->db->get();*/
        $k = '';
        if ($dept_id != '') {
            $kueri3 = $this->db->query("select dept_id,deptname from ppj_departemen
             where parent_id='" . $dept_id . "' order by ppj_departemen.order asc ");
            $k = $k . " and( dept_id='" . $this->db->escape_str($dept_id) . "'";
            foreach ($kueri3->result_array() as $rwdet) {
                $k = $k . "or ppj_peraturan.dept_id = '" . $this->db->escape_str($rwdet['dept_id']) . "'";
                //$a++;
            }
            $k = $k . ")";


            //$k= $k." and dept_id='".$dept_id."'";
        }

        $query = $this->db->query("select ppj_peraturan.peraturan_id from ppj_peraturan, ppj_peraturan_category
          where ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id  and
          ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL OR ppj_peraturan.sifat = '')
          and ppj_peraturan_category.percategorykondisi='1' " . $k . "");

        return $query->num_rows();
    }

    function ambil_nama_unor($deptid)
    {
        $this->db->select('deptname');
        $this->db->where('dept_id', $deptid);
        $query = $this->db->get('ppj_departemen');
        return $query->result_array();
    }

    function ambil_nama_tag($tagid)
    {
        $this->db->select('tagname');
        $this->db->where('tag_id', $tagid);
        $query = $this->db->get('ppj_tags');
        return $query->result_array();
    }

    function ambil_unduh($peraturan_id)
    {
        if ($peraturan_id == "") {
            return "0";
        } else {
            $this->db->where('peraturan_id', $peraturan_id);
            return $this->db->get('ppj_peraturan')->row()->download_count;
        }
    }

    function update_unduh($peraturan_id, $data)
    {
        $this->db->where('peraturan_id', $this->db->escape_str($peraturan_id));
        $this->db->update('ppj_peraturan', $data);
    }
}
