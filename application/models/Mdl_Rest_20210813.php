<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') or exit('No direct script access allowed');



class Mdl_Rest extends CI_Model

{

    function format_tgl($tgl)

    {

        return substr($tgl, 6, 2) . "/" . substr($tgl, 4, 2) . "/" . substr($tgl, 0, 4);

    }

    function format_tgl_dtpicker($tgl)

    {

        return substr($tgl, 6, 4) . "" . substr($tgl, 3, 2) . "" . substr($tgl, 0, 2);

    }

    function format_tgl_full($tgl)

    {

        return substr($tgl, 6, 2) . "/" . substr($tgl, 4, 2) . "/" . substr($tgl, 0, 4) . " - " . substr($tgl, 8, 2) . ":" . substr($tgl, 10, 2) . ":" . substr($tgl, 12, 2);

    }



    function format_tgl_bulan($tgl)

    {

        return substr($tgl, 6, 2) . " " . $this->get_bulan(substr($tgl, 4, 2)) . " " . substr($tgl, 0, 4);

    }



    function getProduk($start, $end)

    {

        $sql = "select ppj_peraturan.peraturan_id, 

						ppj_peraturan_category.percategoryname,

						ppj_peraturan.tentang,

                        ppj_peraturan.nomor,

                        ppj_peraturan.kondisi,

                        ppj_peraturan.sifat,

                        ppj_peraturan.status,

                        ppj_peraturan.view_count,

                        ppj_peraturan.download_count,

						ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

						ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

						ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

						ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category where 	

						ppj_peraturan_category.percategorykondisi='1'

						and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

						ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC  

                        limit $start,$end";

        $query = $this->db->query($sql);

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {

                switch ($hkueri['kondisi']) {

                    case "0":

                        $kondisi = "Draft";

                        break;

                    case "1":

                        $kondisi = "Submit";

                        break;

                    case "2":

                        $kondisi = "Internal";

                        break;

                    case "3":

                        $kondisi = "Publish";

                        break;

                    case "4":

                        $kondisi = "Publish Internal";

                        break;





                    default:

                        $kondisi = '';

                }

                switch ($hkueri['sifat']) {

                    case "0":

                        $sifat = "Rahasia";

                        break;

                    case "1":

                        $sifat = "Umum";

                        break;

                    case "2":

                        $sifat = "Internal";

                        break;

                    default:

                        $sifat = '';

                }



                switch ($hkueri['status']) {
                    
                    case "0":

                        $status = "Aktif";

                        break;

                    case "1":

                        $status = "Tidak Aktif";

                        break;

                    case "2":

                        $status = "Tidak Aktif Sementara";

                        break;

                    case "3":

                        $status = "Tidak Ada Daya Guna";

                        break;

                    default:

                        $status = 'Aktif';

                }
                $tt=str_ireplace("<p>","",$hkueri['judul']);
                $tt2=str_ireplace("</p>","",$tt);
                $s = explode("tentang", $tt2);
                 if(count($s) >= 2){
                    $produk=$s[0];
                    $tentang=$s[1];
                 }else{
                    $produk=$hkueri['judul'];
                    $tentang=$hkueri['tentang'];
                 }

                $tahun = substr($hkueri['tanggal'], 0, 4);

                $bulan = substr($hkueri['tanggal'], 4, 2);

                $tgl = substr($hkueri['tanggal'], 6, 2);

                $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



                $dtktg = $this->Mdl_Rest->get_kategori($hkueri['peraturan_category_id']);

                foreach ($dtktg as $dkt) {

                    $kdkt = $dkt['percategorycode'];

                }

                if ($hkueri['tipe_dokumen'] == "1") {

                    if ($hkueri['file_abstrak'] != "") {

                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    } else {

                        $path_abstrak = "tidak ada";

                    }



                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "2") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "3") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "4") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                }



                $pwds = md5($hkueri['peraturan_id'] . date("YmYmmY"));

                $path_abs = base64_encode($hkueri['peraturan_id']) . "^" . $pwds;

                $detail[] = array(

                    "percategoryname" => $hkueri['percategoryname'],

                    "peraturan_id" => $hkueri['peraturan_id'],

                    "peraturan_category_id" => $hkueri['peraturan_category_id'],

                    "judul" => $hkueri['judul'],

                    "tentang" => $hkueri['tentang'],

                    "nomor" => $hkueri['nomor'],

                    "produk" => $produk,

                    "tentang" => strip_tags($tentang),

                    "tanggal" => $tanggal,

                    "tipe_dokumen" => $hkueri['tipe_dokumen'],

                    "dept_id" => $hkueri['dept_id'],

                    "status" => $hkueri['status'],

                    "file_abstrak" => $hkueri['file_abstrak'],

                    "file_upload" => $hkueri['file_upload'],

                    "path_abstrak" => $path_abstrak,

                    "path_upload" => $path_upload,

                    "path_abs" => $path_abs,

                    "status" => $status,

                    "kondisi" => $kondisi,

                    "sifat" => $sifat,

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }

            $sql2 = "select ppj_peraturan.peraturan_id from  ppj_peraturan,ppj_peraturan_category where 	

                ppj_peraturan_category.percategorykondisi='1'

                and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by
                tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                limit $m,$end";

            //echo $sql2;

            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }

        return $hkueris;

    }



    function getProdukInternal($start, $end)

    {

        $sql = "select ppj_peraturan.peraturan_id, 

						ppj_peraturan_category.percategoryname,

						ppj_peraturan.tentang,

                        ppj_peraturan.nomor,

                        ppj_peraturan.kondisi,

                        ppj_peraturan.sifat,

                        ppj_peraturan.status,

                        ppj_peraturan.view_count,

                        ppj_peraturan.download_count,

						ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

						ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

						ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

						ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category where 	

						ppj_peraturan_category.percategorykondisi='1'

                        and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id  order by 
                        tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                        limit $start,$end";

        $query = $this->db->query($sql);

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {

                switch ($hkueri['kondisi']) {

                    case "0":

                        $kondisi = "Draft";

                        break;

                    case "1":

                        $kondisi = "Submit";

                        break;

                    case "2":

                        $kondisi = "Internal";

                        break;

                    case "3":

                        $kondisi = "Publish";

                        break;

                    case "4":

                        $kondisi = "Publish Internal";

                        break;





                    default:

                        $kondisi = '';

                }

                switch ($hkueri['sifat']) {

                    case "0":

                        $sifat = "Rahasia";

                        break;

                    case "1":

                        $sifat = "Umum";

                        break;

                    case "2":

                        $sifat = "Internal";

                        break;

                    default:

                        $sifat = '';

                }



                switch ($hkueri['status']) {

                    case "0":

                        $status = "Aktif";

                        break;

                    case "1":

                        $status = "Tidak Aktif";

                        break;

                    case "2":

                        $status = "Tidak Aktif Sementara";

                        break;

                    case "3":

                        $status = "Tidak Ada Daya Guna";

                        break;

                    default:

                        $status = 'Aktif';

                }



                $tt=str_ireplace("<p>","",$hkueri['judul']);
                $tt2=str_ireplace("</p>","",$tt);
                $s = explode("tentang", $tt2);
                if(count($s) >= 2){
                   $produk=$s[0];
                   $tentang=$s[1];
                }else{
                   $produk=$hkueri['judul'];
                   $tentang=$hkueri['tentang'];
                }

                $tahun = substr($hkueri['tanggal'], 0, 4);

                $bulan = substr($hkueri['tanggal'], 4, 2);

                $tgl = substr($hkueri['tanggal'], 6, 2);

                $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



                $dtktg = $this->Mdl_Rest->get_kategori($hkueri['peraturan_category_id']);

                foreach ($dtktg as $dkt) {

                    $kdkt = $dkt['percategorycode'];

                }

                if ($hkueri['tipe_dokumen'] == "1") {

                    if ($hkueri['file_abstrak'] != "") {

                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    } else {

                        $path_abstrak = "tidak ada";

                    }



                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "2") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "3") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "4") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                }



                $pwds = md5($hkueri['peraturan_id'] . date("YmYmmY"));

                $path_abs = base64_encode($hkueri['peraturan_id']) . "^" . $pwds;

                $detail[] = array(

                    "percategoryname" => $hkueri['percategoryname'],

                    "peraturan_id" => $hkueri['peraturan_id'],

                    "peraturan_category_id" => $hkueri['peraturan_category_id'],

                    "judul" => $hkueri['judul'],

                    "tentang" => strip_tags($hkueri['tentang']),

                    "nomor" => $hkueri['nomor'],

                    "produk" => strip_tags($produk),

                    "tentang" => strip_tags($tentang),

                    "tanggal" => $tanggal,

                    "view_count" => $hkueri['view_count'],

                    "download_count" => $hkueri['download_count'],

                    "tipe_dokumen" => $hkueri['tipe_dokumen'],

                    "dept_id" => $hkueri['dept_id'],

                    "status" => $hkueri['status'],

                    "file_abstrak" => $hkueri['file_abstrak'],

                    "file_upload" => $hkueri['file_upload'],

                    "path_abstrak" => $path_abstrak,

                    "path_upload" => $path_upload,

                    "path_abs" => $path_abs,

                    "status" => $status,

                    "kondisi" => $kondisi,

                    "sifat" => $sifat,

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }

            $sql2 = "select ppj_peraturan.peraturan_id from  ppj_peraturan,ppj_peraturan_category where 	

                ppj_peraturan_category.percategorykondisi='1'

                and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by
                tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                limit $m,$end";

            //echo $sql2;

            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }

        return $hkueris;

    }

    function get_kategori($kategoriid)

    {

        $this->db->where('peraturan_category_id', $kategoriid);

        $query = $this->db->get('ppj_peraturan_category');

        return $query->result_array();

    }

    function getDeptName($dept_id)

    {

        $this->db->select("deptname");

        $this->db->where("dept_id", $dept_id);

        $query = $this->db->get("ppj_departemen");

        $deptname = '';

        if ($query->num_rows() > 0) {

            $hrow = $query->row();

            $deptname = $hrow->deptname;

        }

        return $deptname;

    }

    function getCategoryName($peraturan_category_id)

    {

        $this->db->select("percategoryname");

        $this->db->where("peraturan_category_id", $peraturan_category_id);

        $query = $this->db->get("ppj_peraturan_category");

        $percategoryname = '';

        if ($query->num_rows() > 0) {

            $hrow = $query->row();

            $percategoryname = $hrow->percategoryname;

        }

        return $percategoryname;

    }

    function getTags($tag_id)

    {

        $this->db->select("tagname");

        $this->db->where("tag_id", $tag_id);

        $query = $this->db->get("ppj_tags");

        $tagname = '';

        if ($query->num_rows() > 0) {

            $hrow = $query->row();

            $tagname = $hrow->tagname;

        }

        return $tagname;

    }

    function getDetail($id)

    {

        $query = $this->db->get_where("ppj_peraturan", array("peraturan_id" => $id));

        if ($query->num_rows() > 0) {



            $row = $query->row();

            $label = explode(",", $row->tags);

            $totTags = count($label) - 1;

            $tag = '';

            foreach ($label as $i => $key) {

                if ($i < $totTags) {

                    $tag = $tag . $this->Mdl_Rest->getTags($key) . ",";

                } else {

                    $tag = $tag . $this->Mdl_Rest->getTags($key);

                }

                //$tagname[]=array($this->Mdl_Rest->getTags($key));

            }

            switch ($row->kondisi) {

                case "0":

                    $kondisi = "Draft";

                    break;

                case "1":

                    $kondisi = "Submit";

                    break;

                case "2":

                    $kondisi = "Internal";

                    break;

                case "3":

                    $kondisi = "Publish";

                    break;

                case "4":

                    $kondisi = "Publish Internal";

                    break;





                default:

                    $kondisi = '';

            }

            switch ($row->sifat) {

                case "0":

                    $sifat = "Rahasia";

                    break;

                case "1":

                    $sifat = "Umum";

                    break;

                case "2":

                    $sifat = "Internal";

                    break;

                default:

                    $sifat = '';

            }



            switch ($row->status) {

                case "0":

                    $status = "Aktif";

                    break;

                case "1":

                    $status = "Tidak Aktif";

                    break;

                case "2":

                    $status = "Tidak Aktif Sementara";

                    break;

                case "3":

                    $status = "Tidak Ada Daya Guna";

                    break;

                    default:

                    $status = 'Aktif';

            }


            $tt=str_ireplace("<p>","", $row->judul);
            $tt2=str_ireplace("</p>","",$tt);
            $s = explode("tentang", $tt2);
            if(count($s) >= 2){
               $produk=$s[0];
               $tentang=$s[1];
            }else{
               $produk=$row->judul;
               $tentang=$row->tentang;
            }
            

            $tahun = substr($row->tanggal, 0, 4);

            $bulan = substr($row->tanggal, 4, 2);

            $tgl = substr($row->tanggal, 6, 2);

            $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



            $dtktg = $this->Mdl_Rest->get_kategori($row->peraturan_category_id);

            foreach ($dtktg as $dkt) {

                $kdkt = $dkt['percategorycode'];

            }





            if ($row->tipe_dokumen == "1") {

                if ($row->file_abstrak != "") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_abstrak);

                } else {

                    $path_abstrak = "tidak ada";

                }



                $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_upload);

            } else if ($row->tipe_dokumen == "2") {

                $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_abstrak);

                $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_upload);

            } else if ($row->tipe_dokumen == "3") {

                $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_abstrak);

                $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_upload);

            } else if ($row->tipe_dokumen == "4") {

                $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_abstrak);

                $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $row->file_upload);

            }



            $pwds = md5($row->peraturan_id . date("YmYmmY"));

            $path_abs = base64_encode($row->peraturan_id) . "^" . $pwds;



            //echo $tagname;

            $detail[] = array(

                "peraturan_id" => $row->peraturan_id,

                "tipe_dokumen" => $row->tipe_dokumen,

                "judul" => $row->judul,

                "teu" => $row->teu,

                "deptname" => $this->Mdl_Rest->getDeptName($row->dept_id),

                "percategoryname" => $this->Mdl_Rest->getCategoryName($row->peraturan_category_id),

                "produk" => strip_tags($produk),

                "tentangProduk" => strip_tags($tentang),

                "tentang" => strip_tags($row->tentang),

                "noperaturan" => $row->noperaturan,

                "tanggal" => $tanggal,

                "lembar_negara" => $row->lembar_negara == "" ? "-" : $row->lembar_negara,

                "lembar_negara_tambahan" => $row->lembar_negara_tambahan == "" ? "-" : $row->lembar_negara_tambahan,

                "berita_negara" => $row->berita_negara == "" ? "-" : $row->berita_negara,

                "file_upload" => $row->file_upload,

                "abstrak" => $row->abstrak,

                "katalog" => $row->katalog,

                "tanggal_penetapan" => $row->tanggal_penetapan == "" ? "-" : $this->Mdl_Rest->format_tgl($row->tanggal_penetapan),

                "tanggal_pengundangan" => $row->tanggal_pengundangan == "" ? "-" : $this->Mdl_Rest->format_tgl_bulan($row->tanggal_pengundangan),

                "tags" => $tag,

                "kondisi" => $kondisi,

                "sifat" => $sifat,

                "status" => $status,

                "nomor_panggil" => $row->nomor_panggil,

                "singkatan" => $row->singkatan,

                "cetakan" => $row->cetakan,

                "tempat_terbit" => $row->tempat_terbit == "" ? "-" : $row->tempat_terbit,

                "penerbit" => $row->penerbit,

                "deskripsi_fisik" => $row->deskripsi_fisik,

                "sumber" => $row->sumber == "" ? "-" : $row->sumber,

                "subjek" => $row->subjek == "" ? "-" : $row->subjek,

                "isbn" => $row->isbn,

                "bahasa" => $row->bahasa == "" ? "-" : $row->bahasa,

                "lokasi" => $row->lokasi == "" ? "-" : $row->lokasi,

                "tautan" => $row->link_url == "" ? "-" : $row->link_url,

                "bidang_hukum" => $row->bidang_hukum == "" ? "-" : $row->bidang_hukum,

                "nomor_induk_buku" => $row->nomor_induk_buku,

                "file_abstrak" => $row->file_abstrak,

                "file_zip" => $row->file_zip,

                "link_url" => $row->link_url,

                "keyword" => $row->keyword == "" ? "-" : $row->keyword,

                "nomor" => $row->nomor,

                "path_abstrak" => $path_abstrak,

                "path_abs" => $path_abs,

                "path_upload" => $path_upload,

                "view_count" => $row->view_count,

                "download_count" => $row->download_count,

                "file_parsial" => $this->ambil_file_parsial($id, $kdkt, $tahun, $bulan),

                "count_file_parsial" => $this->ambil_count_file_parsial($id, $kdkt, $tahun, $bulan),

                "data_cabut" => $this->ambil_peraturan_cabut($id),

                "count_data_cabut" => $this->ambil_count_peraturan_cabut($id),

                "data_dicabut" => $this->ambil_peraturan_mencabut($row->noperaturan),

                "count_data_dicabut" => $this->ambil_count_peraturan_mencabut($row->noperaturan),

                "kdkt" => $kdkt,

                "tahun" => $tahun,

                "bulan" => $bulan,





            );

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => $detail,

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        }

        return $hkueris;

    }

    function getSubstansiLimit($mulai, $akhir, $tipe, $tcari)

    {

        $k = '';

        if ($tipe == "cari") {

            $k = " AND tagname like '%" . $tcari . "%'";

        }

        $sql = "select tag_id,tagname from ppj_tags where tag_id!='MLK' " . $k . " order by tagname asc limit $mulai,$akhir";

        $k1 = $this->db->query($sql);

        $totaldata = $k1->num_rows();

        foreach ($k1->result_array() as $hkueri) {

            $total = 0;

            $cek = "select count(*) as total  from ppj_peraturan,

            ppj_peraturan_category
    
            where kondisi='3'  
    
            AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) 
    
            and  ppj_peraturan_category.percategorykondisi='1'
    
            and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
            and CONCAT(',', tags, ',') like '%," . $hkueri['tag_id'] . ",%'";

           
            $cek_exe = $this->db->query($cek);

            $hcek = $cek_exe->row();

            $total = $hcek->total;

            $detail[] = array(

                "tag_id" => $hkueri['tag_id'],

                "tagname" => $hkueri['tagname'],

                "total" => $total

            );

        }

        if ($mulai > 0) {

            $m = ($mulai + $akhir) ;

        } else {

            $m = ($mulai + $akhir);

        }



        $ceknext = "select tag_id,tagname from  ppj_tags where tag_id!='MLK' " . $k . "  limit $m,$akhir";

        $ck = $this->db->query($ceknext);

        $ttl = $ck->num_rows();



        if ($ttl > 0) {

            if ($ttl >= 10) {

                $nextData = "Y";

                $nextStart = $m;

                $nextEnd = 10;

            } else {

                $nextData = "Y";

                $nextStart = $m;

                $nextEnd = $ttl;

            }

        } else {

            $nextData = "N";

            $nextStart = 0;

            $nextEnd = 0;

        }

        $hkueris = array(

            "respon" => "sukses",

            "nextData" => $nextData,

            "nextStart" => $nextStart,

            "nextEnd" => $nextEnd,

            "totalData" => $totaldata,

            "message_data" => $detail

        );

        return $hkueris;

    }



    function get_bulan($bulan)

    {

        switch ($bulan) {

            case "01":

                $bln = "Januari";

                break;

            case "02":

                $bln = "Februari";

                break;

            case "03":

                $bln = "Maret";

                break;

            case "04":

                $bln = "April";

                break;

            case "05":

                $bln = "Mei";

                break;

            case "06":

                $bln = "Juni";

                break;

            case "07":

                $bln = "Juli";

                break;

            case "08":

                $bln = "Agustus";

                break;

            case "09":

                $bln = "September";

                break;

            case "10":

                $bln = "Oktober";

                break;

            case "11":

                $bln = "November";

                break;

            case "12":

                $bln = "Desember";

                break;

        }

        return $bln;

    }



    function getFavorit($start, $end, $tipe, $tcari, $peraturan_id)

    {

        $k = '';

        if ($tipe == "cari") {

            $k = " AND (judul like '%" . $tcari . "%' OR tentang like '%" . $tcari . "%')";

        }



        $sql = "select ppj_peraturan.peraturan_id, 

            ppj_peraturan_category.percategoryname,

            ppj_peraturan.tentang,

            ppj_peraturan.nomor,

            ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

            ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

            ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

            ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category 

            where 	

            ppj_peraturan.peraturan_id IN('" . $peraturan_id . "')

            AND ppj_peraturan_category.percategorykondisi='1' " . $k . "

            AND ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

            ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by
            tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

            limit $start,$end";

        // echo $sql;

        $query = $this->db->query($sql);

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {
                
                $tt=str_ireplace("<p>","",$hkueri['judul']);
                $tt2=str_ireplace("</p>","",$tt);
                $s = explode("tentang", $tt2);
                if(count($s) >= 2){
                   $produk=$s[0];
                   $tentang=$s[1];
                }else{
                   $produk=$hkueri['judul'];
                   $tentang=$hkueri['tentang'];
                }

                

                $tahun = substr($hkueri['tanggal'], 0, 4);

                $bulan = substr($hkueri['tanggal'], 4, 2);

                $tgl = substr($hkueri['tanggal'], 6, 2);

                $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



                $dtktg = $this->Mdl_Rest->get_kategori($hkueri['peraturan_category_id']);

                foreach ($dtktg as $dkt) {

                    $kdkt = $dkt['percategorycode'];

                }

                if ($hkueri['tipe_dokumen'] == "1") {

                    if ($hkueri['file_abstrak'] != "") {

                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    } else {

                        $path_abstrak = "tidak ada";

                    }



                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "2") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "3") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "4") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                }



                $pwds = md5($hkueri['peraturan_id'] . date("YmYmmY"));

                $path_abs = base64_encode($hkueri['peraturan_id']) . "^" . $pwds;

                switch ($hkueri['status']) {

                    case "0":
    
                        $status = "Aktif";
    
                        break;
    
                    case "1":
    
                        $status = "Tidak Aktif";
    
                        break;
    
                    case "2":
    
                        $status = "Tidak Aktif Sementara";
    
                        break;
    
                    case "3":
    
                        $status = "Tidak Ada Daya Guna";
    
                        break;
    
                        default:
    
                        $status = 'Aktif';
    
                }


                $detail[] = array(

                    "percategoryname" => $hkueri['percategoryname'],

                    "peraturan_id" => $hkueri['peraturan_id'],

                    "peraturan_category_id" => $hkueri['peraturan_category_id'],

                    "judul" => $hkueri['judul'],

                    "tentang" => $hkueri['tentang'],

                    "nomor" => $hkueri['nomor'],

                    "produk" => $produk,

                    "tentang" => $tentang,

                    "tanggal" => $tanggal,

                    "tipe_dokumen" => $hkueri['tipe_dokumen'],

                    "dept_id" => $hkueri['dept_id'],

                    "status" => $status,

                    "file_abstrak" => $hkueri['file_abstrak'],

                    "file_upload" => $hkueri['file_upload'],

                    "path_abstrak" => $path_abstrak,

                    "path_upload" => $path_upload,

                    "path_abs" => $path_abs

                );

            }



            if ($start > 0) {

                $m = ($start + $end);

            } else {

                $m = ($start + $end);

            }

            $sql2 = "select ppj_peraturan.peraturan_id from  ppj_peraturan,ppj_peraturan_category where 

                ppj_peraturan.peraturan_id IN('" . $peraturan_id . "')

                AND ppj_peraturan_category.percategorykondisi='1'  " . $k . "

                and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by 
                tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                limit $m,$end";

            //echo $sql2;

            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }

        return $hkueris;

    }



    function getCariCepat($start, $end, $tcari)

    {

        $k = '';

        if ($tcari != '') {

            if (is_numeric($tcari)) {

                $tcari_satu = (int)$tcari;

                $tcari_dua = "0" . $tcari_satu;

                $tcari_noper = " OR ppj_peraturan.noperaturan like '%" . $tcari_satu . "%' OR ppj_peraturan.noperaturan like '%" . $tcari_dua . "%' )";

            } else {

                $tcari_noper = " OR ppj_peraturan.noperaturan like '%" . $tcari . "%' )";

            }

            $k = $k . " AND (ppj_peraturan.keyword like '%" . $tcari . "%'";

            $k = $k . "   OR ppj_peraturan.judul like '%" . $tcari . "%' ";

            $k = $k . "   OR ppj_peraturan.tentang like '%" . $tcari . "%' ";

            $k = $k . $tcari_noper;

        }

        $sql = "select ppj_peraturan.peraturan_id, 

						ppj_peraturan_category.percategoryname,

						ppj_peraturan.tentang,

						ppj_peraturan.nomor,

						ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

						ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

						ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

						ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category where 	

						ppj_peraturan_category.percategorykondisi='1' " . $k . "

						and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                        ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by 
                        tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                        limit $start,$end";

        $query = $this->db->query($sql);

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {

                $tt=str_ireplace("<p>","",$hkueri['judul']);
                 $tt2=str_ireplace("</p>","",$tt);
                 $s = explode("tentang", $tt2);
                 if(count($s) >= 2){
                    $produk=$s[0];
                    $tentang=$s[1];
                 }else{
                    $produk=$hkueri['judul'];
                    $tentang=$hkueri['tentang'];
                 }
                 
                 

                $tahun = substr($hkueri['tanggal'], 0, 4);

                $bulan = substr($hkueri['tanggal'], 4, 2);

                $tgl = substr($hkueri['tanggal'], 6, 2);

                $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



                $dtktg = $this->Mdl_Rest->get_kategori($hkueri['peraturan_category_id']);

                foreach ($dtktg as $dkt) {

                    $kdkt = $dkt['percategorycode'];

                }

                if ($hkueri['tipe_dokumen'] == "1") {

                    if ($hkueri['file_abstrak'] != "") {

                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    } else {

                        $path_abstrak = "tidak ada";

                    }



                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "2") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "3") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "4") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                }



                $pwds = md5($hkueri['peraturan_id'] . date("YmYmmY"));

                $path_abs = base64_encode($hkueri['peraturan_id']) . "^" . $pwds;
                switch ($hkueri['status']) {

                    case "0":
    
                        $status = "Aktif";
    
                        break;
    
                    case "1":
    
                        $status = "Tidak Aktif";
    
                        break;
    
                    case "2":
    
                        $status = "Tidak Aktif Sementara";
    
                        break;
    
                    case "3":
    
                        $status = "Tidak Ada Daya Guna";
    
                        break;
    
                        default:
    
                        $status = 'Aktif';
    
                }

                $detail[] = array(

                    "percategoryname" => $hkueri['percategoryname'],

                    "peraturan_id" => $hkueri['peraturan_id'],

                    "peraturan_category_id" => $hkueri['peraturan_category_id'],

                    "judul" => $hkueri['judul'],

                    "tentang" => strip_tags($hkueri['tentang'],'<p></p>'),

                    "nomor" => $hkueri['nomor'],

                    "produk" => $produk,

                    "tentang" => $tentang,

                    "tanggal" => $tanggal,

                    "tipe_dokumen" => $hkueri['tipe_dokumen'],

                    "dept_id" => $hkueri['dept_id'],

                    "status" => $status,

                    "file_abstrak" => $hkueri['file_abstrak'],

                    "file_upload" => $hkueri['file_upload'],

                    "path_abstrak" => $path_abstrak,

                    "path_upload" => $path_upload,

                    "path_abs" => $path_abs

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }

            $sql2 = "select ppj_peraturan.peraturan_id from  ppj_peraturan,ppj_peraturan_category where 	

                ppj_peraturan_category.percategorykondisi='1' " . $k . "

                and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by 
                tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                limit $m,$end";

            //echo $sql2;

            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }

        return $hkueris;

    }



    function getCariDetail($start, $end, $category, $substansi, $status, $nomor, $tahun, $judul)

    {

        $k = '';
        
        if ($category != '') {

            $k = $k . " AND ppj_peraturan.peraturan_category_id = '" . $category . "' ";

        }

        if ($substansi != '') {

            $k = $k . " AND (CONCAT(',', ppj_peraturan.tags, ',') like '%," . $substansi . ",%' ) ";

        }

        if ($status != '') {

            $k = $k . " AND ppj_peraturan.status = '" . $status . "' ";

        }

        if ($nomor != '') {
            $ss=str_ireplace("0","",$nomor);
            $p3=strlen($ss);
            $p3_1=$p3+1;
            

            $p=strlen($nomor);
            $p1_1=$p+1;
            $nomor2="0".$nomor;
            $p2=strlen($nomor2);
            $p2_1=$p2+1;
            $k=$k = $k ." AND ((substring(ppj_peraturan.noperaturan,1,$p)='".$nomor."'
                 and (substring(ppj_peraturan.noperaturan,$p1_1,1)=' ' OR substring(ppj_peraturan.noperaturan,$p1_1,1)='/'))
                OR (substring(ppj_peraturan.noperaturan,1,$p2)='".$nomor2."'
                 AND (substring(ppj_peraturan.noperaturan,$p2_1,1)=' ' OR substring(ppj_peraturan.noperaturan,$p2_1,1)='/') ) 
                 OR (substring(ppj_peraturan.noperaturan,1,$p3)='".$ss."'
                 AND (substring(ppj_peraturan.noperaturan,$p3_1,1)=' ' OR substring(ppj_peraturan.noperaturan,$p3_1,1)='/') ))
                 " ;
        }

        if ($tahun != '') {

            $k = $k . " AND ppj_peraturan.tanggal like '%" . $tahun . "%' ";

        }

        if ($judul != '') {

            $k = $k . " AND (ppj_peraturan.judul like '%" . $judul . "%' OR ppj_peraturan.tentang like '%" . $judul . "%') ";

        }

        $sql = "select ppj_peraturan.peraturan_id, 

						ppj_peraturan_category.percategoryname,

						ppj_peraturan.tentang,

						ppj_peraturan.nomor,

						ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

						ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

						ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

						ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category where 	

						ppj_peraturan_category.percategorykondisi='1' " . $k . "

						and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                        ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by 
                        tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                        limit $start,$end";
      //  echo $sql;
        $query = $this->db->query($sql);

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {

                $tt=str_ireplace("<p>","",$hkueri['judul']);
                $tt2=str_ireplace("</p>","",$tt);
                $s = explode("tentang", $tt2);
                //echo "peraturanid=".$hkueri['peraturan_id'].":".count($s)."<br>";
                if(count($s) >= 2){
                   $produk=$s[0];
                   $tentang=$s[1];
                }else{
                   $produk=$hkueri['judul'];
                   $tentang=$hkueri['tentang'];
                }


                $tahun = substr($hkueri['tanggal'], 0, 4);

                $bulan = substr($hkueri['tanggal'], 4, 2);

                $tgl = substr($hkueri['tanggal'], 6, 2);

                $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



                $dtktg = $this->Mdl_Rest->get_kategori($hkueri['peraturan_category_id']);

                foreach ($dtktg as $dkt) {

                    $kdkt = $dkt['percategorycode'];

                }

                if ($hkueri['tipe_dokumen'] == "1") {

                    if ($hkueri['file_abstrak'] != "") {

                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    } else {

                        $path_abstrak = "tidak ada";

                    }



                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "2") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "3") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "4") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                }



                $pwds = md5($hkueri['peraturan_id'] . date("YmYmmY"));

                $path_abs = base64_encode($hkueri['peraturan_id']) . "^" . $pwds;
                switch ($hkueri['status']) {

                    case "0":
    
                        $status = "Aktif";
    
                        break;
    
                    case "1":
    
                        $status = "Tidak Aktif";
    
                        break;
    
                    case "2":
    
                        $status = "Tidak Aktif Sementara";
    
                        break;
    
                    case "3":
    
                        $status = "Tidak Ada Daya Guna";
    
                        break;
    
                        default:
    
                        $status = 'Aktif';
    
                }

                $detail[] = array(

                    "percategoryname" => $hkueri['percategoryname'],

                    "peraturan_id" => $hkueri['peraturan_id'],

                    "peraturan_category_id" => $hkueri['peraturan_category_id'],

                    "judul" => "mlk".$hkueri['judul'],

                    "nomor" => $hkueri['nomor'],

                    "produk" => $produk,

                    "tentang" => $tentang,

                    "tanggal" => $tanggal,

                    "tipe_dokumen" => $hkueri['tipe_dokumen'],

                    "dept_id" => $hkueri['dept_id'],

                    "status" => $status,

                    "file_abstrak" => $hkueri['file_abstrak'],

                    "file_upload" => $hkueri['file_upload'],

                    "path_abstrak" => $path_abstrak,

                    "path_upload" => $path_upload,

                    "path_abs" => $path_abs

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }

            $sql2 = "select ppj_peraturan.peraturan_id from  ppj_peraturan,ppj_peraturan_category where 	

                ppj_peraturan_category.percategorykondisi='1' " . $k . "

                and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

                ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) order by
                tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                limit $m,$end";

            //echo $sql2;

            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }

        return $hkueris;

    }





    function getDataComboPencarian()

    {

        // $det_peraturan='';

        //$det_substansi='';

        $det_status = '';



        $this->db->select("peraturan_category_id,percategoryname");

        $this->db->where('tipe', '1');

        $this->db->order_by("order", "asc");

        $cr_category = $this->db->get("ppj_peraturan_category");

        foreach ($cr_category->result_array() as $hcategory) {

            $det_peraturan[] = array("peraturan_category_id" => $hcategory['peraturan_category_id'], "percategoryname" => $hcategory['percategoryname']);

        }

        $this->db->select("tag_id,tagname");

        $this->db->order_by("tagname", "asc");

        $cr_category = $this->db->get("ppj_tags");

        foreach ($cr_category->result_array() as $hsubs) {

            $det_substansi[] = array("tag_id" => $hsubs['tag_id'], "tagname" => $hsubs['tagname']);

        }



        $posts = array(

            "respon" => "sukses",

            "det_peraturan" => $det_peraturan,

            "det_substansi" => $det_substansi

        );

        return $posts;

    }



    function getProleg($start, $end)

    {

        $sql = "select id, nama_usulan, pengusul, tahun, noperaturan, kondisi, approval, ";

        $sql .= "tgl_buat, pembuat ";

        $sql .= "from tb_proleg ";

        $sql .= "order by id desc ";

        $sql .= "limit $start, $end";

        $query = $this->db->query($sql);

        $total = $query->num_rows();



        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {

                switch ($hkueri['kondisi']) {

                    case '1':

                    case '2':

                        $status = 'Masih Berjalan';

                        $warna = 'grey';

                        break;

                    case '3':

                        $status = 'Selesai';

                        $warna = 'chartreuse';

                        break;

                    default:

                        $status = '';

                        $warna = 'grey';

                        break;

                }



                //$departemen = $this->getDepartemen($hkueri['pengusul']);
                $departemen=$this->getNameDept($hkueri['pengusul']);


                $detail[] = array(

                    "id" => $hkueri['id'],

                    "nama_usulan" => $hkueri['nama_usulan'],

                    "pengusul" => $hkueri['pengusul'],

                    "tahun" => $hkueri['tahun'],

                    "noperaturan" => $hkueri['noperaturan'],

                    "kondisi" => $hkueri['kondisi'],

                    "approval" => $hkueri['approval'],

                    "tgl_buat" => $hkueri['tgl_buat'],

                    "pembuat" => $hkueri['pembuat'],

                    "status" => $status,

                    "warna" => $warna,

                    "departemen" => $departemen

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }



            $sql2 = "select id, nama_usulan, pengusul, tahun, noperaturan, kondisi, approval, ";

            $sql2 .= "tgl_buat, pembuat ";

            $sql2 .= "from tb_proleg ";

            $sql2 .= "order by id desc ";

            $sql2 .= "limit $m, $end";



            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }



        return $hkueris;

    }



    function getIzinPemrakarsa($start, $end)

    {

        $sql = "select id, nama_usulan, pengusul, tahun, noperaturan, kondisi, approval, ";

        $sql .= "tgl_buat, pembuat ";

        $sql .= "from tb_izin_pemrakarsa ";

        $sql .= "order by id desc ";

        $sql .= "limit $start, $end";

        $query = $this->db->query($sql);

        $total = $query->num_rows();



        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {



                switch ($hkueri['kondisi']) {

                    case '1':

                    case '2':

                        $status = 'Masih Berjalan';

                        $warna = 'grey';

                        break;

                    case '3':

                        $status = 'Selesai';

                        $warna = 'chartreuse';

                        break;

                    default:

                        $status = '';

                        $warna = 'grey';

                        break;

                }



                //$departemen = $this->getDepartemen($hkueri['pengusul']);

                $departemen=$this->getNameDept($hkueri['pengusul']);

                $detail[] = array(

                    "id" => $hkueri['id'],

                    "nama_usulan" => $hkueri['nama_usulan'],

                    "pengusul" => $hkueri['pengusul'],

                    "tahun" => $hkueri['tahun'],

                    "noperaturan" => $hkueri['noperaturan'],

                    "kondisi" => $hkueri['kondisi'],

                    "approval" => $hkueri['approval'],

                    "tgl_buat" => $hkueri['tgl_buat'],

                    "pembuat" => $hkueri['pembuat'],

                    "status" => $status,

                    "warna" => $warna,

                    "departemen" => $departemen

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }



            $sql2 = "select id, nama_usulan, pengusul, tahun, noperaturan, kondisi, approval, ";

            $sql2 .= "tgl_buat, pembuat ";

            $sql2 .= "from tb_izin_pemrakarsa ";

            $sql2 .= "order by id desc ";

            $sql2 .= "limit $m, $end";



            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => $total

            );

        }



        return $hkueris;

    }


    function getNameDept($id){
        $sql="select deptname from ppj_departemen where dept_id='".$id."'";
        $kueri=$this->db->query($sql);
        if($kueri->num_rows()>0){
            $result=$kueri->row();
            return $result->deptname;
        }else{
            return "";
        }
    }
    function getDepartemen($userid)

    {

        if (!empty($userid)) :

            $this->db->select('b.deptname');

            $this->db->from('ppj_users as a');

            $this->db->where('a.user_id', $userid);

            $this->db->join('ppj_departemen as b', 'a.dept_id=b.dept_id', 'left');

            $kueri = $this->db->get()->row();

            if (!empty($kueri)) :

                return $kueri->deptname;

            else :

                return $kueri = '';

            endif;

        else :

            return $kueri = '';

        endif;

    }



    function getProlegDetail($id)

    {

        if (!empty($id)) :

            $this->db->where('id_proleg', $id);

            $kueri = $this->db->get('tb_proleg_detail');

            $total = $kueri->num_rows();

            $pengusul = $this->getPengusul($id, 'tb_proleg');

            if ($kueri->num_rows() > 0) :

                foreach ($kueri->result_array() as $k) {

                    //$departemen = $this->getDepartemen($pengusul);
                    $departemen=$this->getNameDept($pengusul);
                    $data_kriteria = $this->getKriteria($id, $k['capaian'], 'tb_proleg_kriteria');

                    $data_data = $this->getDataDetail($k['id'], 'tb_proleg_data');

                    $detail_kriteria = array();

                    $detail_data = array();

                    foreach ($data_kriteria->result_array() as $dk) {

                        $detail_kriteria[] = array(

                            'kriteria' => $dk['kriteria']

                        );

                    }



                    foreach ($data_data->result_array() as $dd) {

                        $detail_data[] = array(

                            'tanggal' => $this->format_tgl_bulan($dd['tanggal']),

                            'file' => $dd['file'],

                            'kegiatan' => $dd['kegiatan'],

                            'instansi_terkait' => $dd['instansi_terkait'],

                            'progres' => $dd['progres'],

                            'path_file' => base_url('internal/assets/assets/proleg/' . $dd['file'])

                        );

                    }



                    $detail[] = array(

                        'capaian' => $k['capaian'],

                        'pengusul' => $departemen,

                        'target' => $k['target_capaian'],

                        'data_kriteria' => $detail_kriteria,

                        'data_data' => $detail_data

                    );

                }

                $hkueris = array(

                    "message_id" => "mlk_0",

                    "message_action" => "TRANSACTION_SUCCESS",

                    "message_desc" => "Transaksi Sukses",

                    "message_data" => $detail,

                    "total" => $total

                );

            else :

                $hkueris = array(

                    "message_id" => "mlk_1",

                    "message_action" => "TRANSACTION_FAILED",

                    "message_desc" => "Tidak Ada Data",

                    "message_data" => "",

                    "total" => 0

                );

            endif;

        else :

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        endif;



        return $hkueris;

    }



    function getIzinPrakarsaDetail($id)

    {

        if (!empty($id)) :

            $this->db->where('id_proleg', $id);

            $kueri = $this->db->get('tb_izin_pemrakarsa_detail');

            $total = $kueri->num_rows();

            $pengusul = $this->getPengusul($id, 'tb_izin_pemrakarsa');

            if ($kueri->num_rows() > 0) :

                foreach ($kueri->result_array() as $k) {

                    //$departemen = $this->getDepartemen($pengusul);
                    $departemen=$this->getNameDept($pengusul);
                    $data_kriteria = $this->getKriteria($id, $k['capaian'], 'tb_izin_pemrakarsa_kriteria');

                    $data_data = $this->getDataDetail($k['id'], 'tb_izin_pemrakarsa_data');

                    $detail_kriteria = array();

                    $detail_data = array();

                    foreach ($data_kriteria->result_array() as $dk) {

                        $detail_kriteria[] = array(

                            'kriteria' => $dk['kriteria']

                        );

                    }



                    foreach ($data_data->result_array() as $dd) {

                        $detail_data[] = array(

                            'tanggal' => $this->format_tgl_bulan($dd['tanggal']),

                            'file' => $dd['file'],

                            'kegiatan' => $dd['kegiatan'],

                            'instansi_terkait' => $dd['instansi_terkait'],

                            'progres' => $dd['progres'],

                            'path_file' => base_url('internal/assets/assets/pemrakarsa/' . $dd['file'])

                        );

                    }



                    $detail[] = array(

                        'capaian' => $k['capaian'],

                        'pengusul' => $departemen,

                        'target' => $k['target_capaian'],

                        'data_kriteria' => $detail_kriteria,

                        'data_data' => $detail_data

                    );

                }

                $hkueris = array(

                    "message_id" => "mlk_0",

                    "message_action" => "TRANSACTION_SUCCESS",

                    "message_desc" => "Transaksi Sukses",

                    "message_data" => $detail,

                    "total" => $total

                );

            else :

                $hkueris = array(

                    "message_id" => "mlk_1",

                    "message_action" => "TRANSACTION_FAILED",

                    "message_desc" => "Tidak Ada Data",

                    "message_data" => "",

                    "total" => 0

                );

            endif;

        else :

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        endif;



        return $hkueris;

    }



    function getPengusul($id, $table)

    {

        if (!empty($id)) :

            $this->db->where('id', $id);

            $kueri = $this->db->get($table)->row();

            if (!empty($kueri)) :

                return $kueri->pengusul;

            else :

                return $kueri = '';

            endif;

        else :

            return $kueri = '';

        endif;

    }



    function getKriteria($idproleg, $kriteria, $table)

    {

        if (!empty($idproleg)) {

            $this->db->where('id_proleg', $idproleg);

        }

        if (!empty($kriteria)) {

            $this->db->where('jenis', $kriteria);

        }

        $kueri = $this->db->get($table);

        return $kueri;

    }



    function getDataDetail($id, $table)

    {

        if (!empty($id)) {

            $this->db->where('id_proleg_detail', $id);

        }

        $kueri = $this->db->get($table);

        return $kueri;

    }



    function getBulan($kode)

    {

        switch ($kode) {

            case '1':

            case '01':

                $nama_bulan = 'Januari';

                break;

            case '2':

            case '02':

                $nama_bulan = 'Februari';

                break;

            case '3':

            case '03':

                $nama_bulan = 'Maret';

                break;

            case '4':

            case '04':

                $nama_bulan = 'April';

                break;

            case '5':

            case '05':

                $nama_bulan = 'Mei';

                break;

            case '6':

            case '06':

                $nama_bulan = 'Juni';

                break;

            case '7':

            case '07':

                $nama_bulan = 'Juli';

                break;

            case '8':

            case '08':

                $nama_bulan = 'Agustus';

                break;

            case '9':

            case '09':

                $nama_bulan = 'September';

                break;

            case '10':

                $nama_bulan = 'Oktober';

                break;

            case '11':

                $nama_bulan = 'November';

                break;

            case '12':

                $nama_bulan = 'Desember';

                break;

            default:

                $nama_bulan = '';

                break;

        }

        return $nama_bulan;

    }



    function getProdukSubstansi($start, $end, $substansi)

    {



        $sql = "SELECT 

        ppj_peraturan.peraturan_id, 

		ppj_peraturan_category.percategoryname,

		ppj_peraturan.tentang,

        ppj_peraturan.nomor,

        ppj_peraturan.kondisi,

        ppj_peraturan.sifat,

        ppj_peraturan.status,

        ppj_peraturan.peraturan_category_id,

        ppj_peraturan.judul,

        ppj_peraturan.tanggal,

        ppj_peraturan.view_count,

        ppj_peraturan.download_count,

        ppj_peraturan.tipe_dokumen,

        ppj_peraturan.peraturan_id,

        ppj_peraturan.dept_id,

        ppj_peraturan.status,

        ppj_peraturan.file_abstrak,

        ppj_peraturan.file_upload

        from ppj_peraturan,

        ppj_peraturan_category

        where kondisi='3'  

        and FIND_IN_SET ('$substansi', tags) 

        AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) 

        and  ppj_peraturan_category.percategorykondisi='1'

        and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id

        ORDER BY tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

        limit $start,$end

        ";

       // echo $sql;

        $nama_substansi = $this->ambil_nama_substansi($substansi);



        $query = $this->db->query($sql);

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $hkueri) {

                switch ($hkueri['kondisi']) {

                    case "0":

                        $kondisi = "Draft";

                        break;

                    case "1":

                        $kondisi = "Submit";

                        break;

                    case "2":

                        $kondisi = "Internal";

                        break;

                    case "3":

                        $kondisi = "Publish";

                        break;

                    case "4":

                        $kondisi = "Publish Internal";

                        break;





                    default:

                        $kondisi = '';

                }

                switch ($hkueri['sifat']) {

                    case "0":

                        $sifat = "Rahasia";

                        break;

                    case "1":

                        $sifat = "Umum";

                        break;

                    case "2":

                        $sifat = "Internal";

                        break;

                    default:

                        $sifat = '';

                }



                switch ($hkueri['status']) {

                    case "0":

                        $status = "Aktif";

                        break;

                    case "1":

                        $status = "Tidak Aktif";

                        break;

                    case "2":

                        $status = "Tidak Aktif Sementara";

                        break;

                    case "3":

                        $status = "Tidak Ada Daya Guna";

                        break;

                    default:

                        $status = '';

                }



                $tt=str_ireplace("<p>","",$hkueri['judul']);
                $tt2=str_ireplace("</p>","",$tt);
                $s = explode("tentang", $tt2);
                if(count($s) >= 2){
                   $produk=$s[0];
                   $tentang=$s[1];
                }else{
                   $produk=$hkueri['judul'];
                   $tentang=$hkueri['tentang'];
                }

                $tahun = substr($hkueri['tanggal'], 0, 4);

                $bulan = substr($hkueri['tanggal'], 4, 2);

                $tgl = substr($hkueri['tanggal'], 6, 2);

                $tanggal = $tgl . " " . $this->Mdl_Rest->get_bulan($bulan) . " " . $tahun;



                $dtktg = $this->Mdl_Rest->get_kategori($hkueri['peraturan_category_id']);

                foreach ($dtktg as $dkt) {

                    $kdkt = $dkt['percategorycode'];

                }

                if ($hkueri['tipe_dokumen'] == "1") {

                    if ($hkueri['file_abstrak'] != "") {

                        $path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    } else {

                        $path_abstrak = "tidak ada";

                    }



                    $path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "2") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "3") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                } else if ($hkueri['tipe_dokumen'] == "4") {

                    $path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_abstrak']);

                    $path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $hkueri['file_upload']);

                }



                $pwds = md5($hkueri['peraturan_id'] . date("YmYmmY"));

                $path_abs = base64_encode($hkueri['peraturan_id']) . "^" . $pwds;

                $detail[] = array(

                    "percategoryname" => $hkueri['percategoryname'],

                    "peraturan_id" => $hkueri['peraturan_id'],

                    "peraturan_category_id" => $hkueri['peraturan_category_id'],

                    "judul" => $hkueri['judul'],

                    "tentang" => $hkueri['tentang'],

                    "nomor" => $hkueri['nomor'],

                    "produk" => $produk,

                    "tentang" => $tentang,

                    "tanggal" => $tanggal,

                    "tipe_dokumen" => $hkueri['tipe_dokumen'],

                    "dept_id" => $hkueri['dept_id'],

                    "status" => $hkueri['status'],

                    "file_abstrak" => $hkueri['file_abstrak'],

                    "file_upload" => $hkueri['file_upload'],

                    "path_abstrak" => $path_abstrak,

                    "path_upload" => $path_upload,

                    "path_abs" => $path_abs,

                    "status" => $status,

                    "kondisi" => $kondisi,

                    "sifat" => $sifat

                );

            }



            if ($start > 0) {

                $m = ($start + $end) ;

            } else {

                $m = ($start + $end);

            }

            $sql2 = "SELECT 

            ppj_peraturan.peraturan_id, 

            ppj_peraturan_category.percategoryname,

            ppj_peraturan.tentang,

            ppj_peraturan.nomor,

            ppj_peraturan.kondisi,

            ppj_peraturan.sifat,

            ppj_peraturan.status,

            ppj_peraturan.peraturan_category_id,

            ppj_peraturan.judul,

            ppj_peraturan.tanggal,

            ppj_peraturan.view_count,

            ppj_peraturan.download_count,

            ppj_peraturan.tipe_dokumen,

            ppj_peraturan.peraturan_id,

            ppj_peraturan.dept_id,

            ppj_peraturan.status,

            ppj_peraturan.file_abstrak,

            ppj_peraturan.file_upload 

            from ppj_peraturan,

            ppj_peraturan_category 

            where kondisi='3'  

            and FIND_IN_SET ('$substansi', tags) 

            AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) 

            and  ppj_peraturan_category.percategorykondisi='1'

            and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id

            ORDER BY tanggal DESC, ppj_peraturan_category.order asc, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC

                limit $m,$end";

            //echo $sql2;

            $kueri2 = $this->db->query($sql2);

            $total1 = $kueri2->num_rows();

            if ($total1 > 0) {

                if ($total1 > 10) {

                    $nextStart = $m;

                    $nextEnd = $total1;

                    $nextdata = "Y";

                } else {

                    $nextStart = $m;

                    $nextEnd = 10;

                    $nextdata = "Y";

                }

            } else {

                $nextdata = "N";

                $nextStart = 0;

                $nextEnd = 0;

            }



            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "nextdata" => $nextdata,

                "nextStart" => $nextStart,

                "nextEnd" => $nextEnd,

                "substansi" => $substansi,

                "message_data" => $detail,

                "nama_substansi" => $nama_substansi,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function getLinkTerkait()

    {

        $this->db->order_by('order');

        $kueri = $this->db->get('ppj_link_terkait');

        $total = $kueri->num_rows();

        if ($total > 0) {



            foreach ($kueri->result_array() as $k) {

                $detail[] = array(

                    'id' => $k['linkterkait_id'],

                    'linkname' => $k['linkname'],

                    'linkurl' => $k['linkurl']

                );

            }

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function getBantuan()

    {

        $kueri = $this->db->get('ppj_widget');

        $total = $kueri->num_rows();

        if ($total > 0) {



            foreach ($kueri->result_array() as $k) {

                $detail[] = array(

                    'id' => $k['widget_id'],

                    'widgetname' => $k['widgetname'],

                    'widgetcontent' => $k['widgetcontent'],

                    'widgetmore' => $k['widgetmore']

                );

            }

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function ambil_nama_substansi($kode)

    {

        if (!empty($kode)) :

            $this->db->where('tag_id', $kode);

            $kueri = $this->db->get('ppj_tags')->row();

            if (!empty($kueri->tagname)) :

                return $kueri->tagname;

            else :

                return $kueri = '';

            endif;

        else :

            return $kueri = '';

        endif;

    }



    function ambil_file_parsial($id, $kdkt, $tahun, $bulan)

    {

        if (!empty($id)) :

            $this->db->where('peraturan_id', $id);

            $kueri = $this->db->get('ppj_peraturan_file');

            if ($kueri->num_rows() > 0) {

                foreach ($kueri->result_array() as $k) {

                    $pwds = md5($k['id'] . date("YmYmmY"));

                    $path_prs = base64_encode($k['id']) . "^" . $pwds;



                    $data[] = array(

                        'id' => $k['id'],

                        'file' => $k['file'],

                        'download_count' => $k['download_count'],

                        'path_file_parsial' => base_url('internal/assets/assets/produk_parsial/' . $kdkt . '/' . $tahun . '/' . $bulan . '/' . $k['file']),

                        'path_prs' => $path_prs

                    );

                }

                return $data;

            } else {

                return $data[] = array();

            }

        else :

            return $data[] = array();

        endif;

    }



    function ambil_count_file_parsial($id, $kdkt, $tahun, $bulan)

    {

        $data = $this->ambil_file_parsial($id, $kdkt, $tahun, $bulan);

        if (!empty($data)) :

            return 1;

        else :

            return 0;

        endif;

    }



    function ambil_peraturan_cabut($peraturan_id)

    {

        if (!empty($peraturan_id)) :

            $this->db->where('peraturan_id', $peraturan_id);

            $kueri = $this->db->get('ppj_peraturan_detail');

            if ($kueri->num_rows() > 0) {

                foreach ($kueri->result_array() as $k) {

                    $data[] = array(

                        'status' => ucfirst($k['status']),

                        'noperaturan' => $k['noperaturan'],

                        'peraturan_id_modifikasi' => $k['peraturan_id_modifikasi'],

                        'tentang' => $k['tentang'],

                        'tanggal' => $k['tanggal']

                    );

                }

                return $data;

            } else {

                return $data[] = array();

            }

        else :

            return $data[] = array();

        endif;

    }



    function ambil_count_peraturan_cabut($peraturan_id)

    {

        $data = $this->ambil_peraturan_cabut($peraturan_id);

        if (!empty($data)) :

            return 1;

        else :

            return 0;

        endif;

    }



    function ambil_peraturan_mencabut($noperaturan)

    {

        if (!empty($noperaturan)) :

            $this->db->where('noperaturan', $noperaturan);

            $kueri = $this->db->get('ppj_peraturan_detail');

            if ($kueri->num_rows() > 0) {

                foreach ($kueri->result_array() as $k) {

                    $data_tentang = $this->ambil_tentang($k['peraturan_id']);

                    if ($data_tentang->num_rows() > 0) {

                        foreach ($data_tentang->result_array() as $dt) {

                            if ($k['status'] == 'mencabut') {

                                $status = 'Dicabut';

                            } elseif ($k['status'] == 'mengubah') {

                                $status = 'Diubah';

                            }

                            $data[] = array(

                                'status' => $status,

                                'peraturan_id' => $k['peraturan_id'],

                                'noperaturan' => $dt['noperaturan'],

                                'tentang' => $dt['tentang'],

                                'tanggal' => $dt['tanggal_pengundangan']

                            );

                        }

                        return $data;

                    } else {

                        return $data[] = array();

                    }

                }

            } else {

                return $data[] = array();

            }

        else :

            return $data[] = array();

        endif;

    }



    function ambil_count_peraturan_mencabut($noperaturan)

    {

        $data = $this->ambil_peraturan_mencabut($noperaturan);

        if (!empty($data)) :

            return 1;

        else :

            return 0;

        endif;

    }



    function ambil_tentang($peraturanid)

    {

        $this->db->select('tipe_dokumen, peraturan_id, noperaturan, tentang, tanggal_pengundangan');

        $this->db->where('peraturan_id', $peraturanid);

        $query = $this->db->get('ppj_peraturan');

        return $query;

    }



    function getLoginAuth($username, $password)

    {

        $this->db->select('username, fullname, email, group_id, dept_id');

        $this->db->where('username', $username);
        $this->db->where('status', '0');
        $this->db->where('password', md5($password));

        $query = $this->db->get('ppj_users');

        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $q) {
                if($q['email']!=""){
                    $length=5;
                    $characters = '0123456789';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $tgl_buat=date("YmdHis");
                    $st=substr($tgl_buat,0,4)."-".substr($tgl_buat,4,2)."-".substr($tgl_buat,6,2)." ".substr($tgl_buat,8,2).":".substr($tgl_buat,10,2).":".substr($tgl_buat,12,2);
        
                    $timestamp = strtotime($st) + 60*60*4;
                    $tgl_exp = date('YmdHis', $timestamp);

                    $this->db->query("update tb_otp set status='f' where user_id='".$username."'");
                    
                    $sp="insert into tb_otp (user_id,email,otp,tgl_buat,tgl_exp,status)
                        values ('".$username."','".$q['email']."','".$randomString."','".$tgl_buat."','".$tgl_exp."','a')";
                    $this->db->query($sp);

                    $kirim=$this->Mdl_Rest->Kirim_email('otp',$randomString,$q['fullname'],$q['email']);
                    if($kirim=="sukses"){
                        $data[] = array(

                            'respon' => 'sukses',
        
                            'username' => $q['username'],
        
                            'fullname' => $q['fullname'],
        
                            'email' => $q['email'],
        
                            'grup' => $this->getGroupId($q['group_id']),
        
                            'departemen' => $this->getDeptId($q['dept_id'])
        
                        );
                    }else{
                        $data[] = array(
                            'respon' => 'email_2'
                        );
                    }
                    
                }else{
                    $data[] = array(
                        'respon' => 'email_1'
                    );
                }
                

            }

        } else {

            $data[] = array(

                'respon' => 'nodata'

            );

        }

        return $data;

    }

    function getLoginOTP($username, $kodeOtp)

    {
        $tgl=date("YmdHis");
        $query=$this->db->query("select otp,tgl_exp from tb_otp where user_id='".$username."' and status='a' order by id desc limit 0,1");
        if ($query->num_rows() > 0) {
            $row=$query->row();
            if($kodeOtp != $row->otp){
                $data[] = array('respon' => 'otpsalah','message'=>'Kode OTP yang dimasukkan tidak sesuai');
            }else if($tgl > $row->tgl_exp){
                $data[] = array('respon' => 'otpexp','message'=>'Kode OTP yang dimasukkan sudah kedaluwarsa');
            }else{
                $this->db->query("update tb_otp set status='f' where user_id='".$username."' and otp='".$kodeOtp."'");
                $data[] = array('respon' => 'sukses','message'=>'Kode OTP cocok');
            }

        } else {

            $data[] = array('respon' => 'otpsalah','message'=>'Kode OTP yang dimasukkan tidak sesuai');

        }

        return $data;

    }

    function getKonfigEmail(){
		return $this->db->get("tb_konfig_email")->row();
	}
    function Kirim_email($tipe,$otp,$nama,$email){
		$konfig=$this->Mdl_Rest->getKonfigEmail();
		$Host = $konfig->nama_host;	
		$Username = $konfig->host_user_name;	// SMTP password
		$Password = $konfig->host_password;						// SMTP username
		
		$From =$konfig->email_from;
		$FromName = $konfig->email_from_name;
		$Body='Dear ';
		switch($tipe){
			case "otp":
                $Subject="Kode OTP PUPR JDIH Mobile";
                $Body=$Body. $nama.", <br>
                Berikut Kode OTP Anda : ".$otp."<br>
                Kode OTP untuk login ke JDIH Mobile Internal dan jangan disebar kesiapapun untuk keamanan akun Anda.
                <br><br>Terima Kasih<br><br>
                Biro Hukum, Sekretariat Jenderal<br>
                Kementerian Umum Dan Perumahan Rakyat<br>
                Jl. Pattimura No.20,<br>
                Selong, Kebayoran Baru,<br>
                Kota Jakarta Selatan, DKI Jakarta 12110,<br>
                Indonesia,<br>

                P : (021) 739-6783 Ext: 1386, (021) 723-5216<br>
                E : jdih@pu.go.id<br>";
				break;
		}
		$To=$email;$ToName=$nama;
		
		$mail = new PHPMailer();
		//echo $Username."\n".$Password;
		$mail->IsSMTP();                 	// send via SMTP
		$mail->Host     = $Host; 
		$mail->SMTPAuth = true;     		// turn on SMTP authentication
		$mail->Username = $Username;  
		$mail->Password = $Password; 
		
		$mail->From     = $From;
		$mail->FromName = $FromName;
        
        $mail->AddAddress($To , $ToName);
		$mail->WordWrap = 50;				// set word wrap
		$mail->Priority = 2;
		$ganti='';
		
		//$mail->Port=$port_email;
		$mail->Subject  =  $Subject;
		$mail->IsHTML(true);
		$mail->MsgHTML($Body);
		
		
		if(!$mail->Send()){
		    $mail_stat_ins = $mail->ErrorInfo;
			return "gagal";
		}
		else{
            //echo "sukses";
            return "sukses";
		}
		
		
		
	

    }


    function getGroupId($groupid)

    {

        if (!empty($groupid)) {

            $this->db->select('nama');

            $this->db->where('id', $groupid);

            $kueri = $this->db->get('tb_group_user')->row();

            if (!empty($kueri->nama)) :

                return $kueri->nama;

            else :

                return $kueri = '';

            endif;

        } else {

            return $kueri = '';

        }

    }



    function getDeptId($deptid)

    {

        if (!empty($deptid)) {

            $this->db->select('deptname');

            $this->db->where('dept_id', $deptid);

            $kueri = $this->db->get('ppj_departemen')->row();

            if (!empty($kueri->deptname)) :

                return $kueri->deptname;

            else :

                return $kueri = '';

            endif;

        } else {

            return $kueri = '';

        }

    }



    function getSliderPeraturan()

    {

        $select = 'a.tipe_dokumen, a.peraturan_id, a.noperaturan, a.download_count, b.percategoryname';

        $this->db->select($select);

        $this->db->from('ppj_peraturan as a');

        $this->db->join('ppj_peraturan_category as b', 'a.peraturan_category_id=b.peraturan_category_id', 'left');

        $this->db->where('a.check_banner', 'y');

        $this->db->order_by('a.tgl_modifikasi', 'DESC');

        $kueri = $this->db->get();

        $total = $kueri->num_rows();

        if ($total > 0) {

            foreach ($kueri->result_array() as $k) {

                $detail[] = array(

                    'peraturan_id' => $k['peraturan_id'],

                    'percategoryname' => $k['percategoryname'],

                    'noperaturan' => $k['noperaturan'],

                    'download_count' => $k['download_count']

                );

            }

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "message_data" => $detail,

                "total" => $total

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "message_data" => "",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function getCountStatus($kode)

    {

        $select = 'peraturan_id';

        $this->db->select($select);

        $this->db->from('ppj_peraturan');
        $k='';
        if ($kode == 1) :
            $k=" AND status='1'";
            $this->db->where('status', strval($kode));
                
        else :
            $k=" AND status !='1'";
            $this->db->where('status', $kode);
            $this->db->or_where('status', '2');
            $this->db->or_where('status', '');

        endif;

        //$kueri = $this->db->get();

        $sql = "select ppj_peraturan.peraturan_id, 

						ppj_peraturan_category.percategoryname,

						ppj_peraturan.tentang,

                        ppj_peraturan.nomor,

                        ppj_peraturan.kondisi,

                        ppj_peraturan.sifat,

                        ppj_peraturan.status,

                        ppj_peraturan.view_count,

                        ppj_peraturan.download_count,

						ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

						ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

						ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

                        ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from 
                        ppj_peraturan,ppj_peraturan_category where 	

						ppj_peraturan_category.percategorykondisi='1'

						and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

						ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) ".$k."";
        $kueri=$this->db->query($sql);

        $total = $kueri->num_rows();

        if ($total > 0) {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "total" => number_format($total, 0, ',', '.')

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function getCountPeraturan()

    {

       // $total = $this->db->count_all_results('ppj_peraturan');
       $sql = "select ppj_peraturan.peraturan_id, 

       ppj_peraturan_category.percategoryname,

       ppj_peraturan.tentang,

       ppj_peraturan.nomor,

       ppj_peraturan.kondisi,

       ppj_peraturan.sifat,

       ppj_peraturan.status,

       ppj_peraturan.view_count,

       ppj_peraturan.download_count,

       ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,

       ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,

       ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,

       ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from 
       ppj_peraturan,ppj_peraturan_category where 	

       ppj_peraturan_category.percategorykondisi='1'

       and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 

       ppj_peraturan.kondisi='3' AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) ";
       $kueri=$this->db->query($sql);
       $total = $kueri->num_rows();
        if ($total > 0) {

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "total" => number_format($total, 0, ',', '.')

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function getCountViewPeraturan()

    {

        $this->db->select_sum('view_count');

        $query = $this->db->get('ppj_peraturan');

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $q) {

                $view_count = $q['view_count'];

            }

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "total" => number_format($view_count, 0, ',', '.')

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "total" => 0

            );

        }

        return $hkueris;

    }



    function getCountDownloadPeraturan()

    {

        $this->db->select_sum('download_count');

        $query = $this->db->get('ppj_peraturan');

        $total = $query->num_rows();

        if ($total > 0) {

            foreach ($query->result_array() as $q) {

                $download_count = $q['download_count'];

            }

            $hkueris = array(

                "message_id" => "mlk_0",

                "message_action" => "TRANSACTION_SUCCESS",

                "message_desc" => "Transaksi sukses",

                "total" => number_format($download_count, 0, ',', '.')

            );

        } else {

            $hkueris = array(

                "message_id" => "mlk_1",

                "message_action" => "TRANSACTION_FAILED",

                "message_desc" => "Tidak Ada Data",

                "total" => 0

            );

        }

        return $hkueris;

    }

}

