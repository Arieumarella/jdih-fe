<?php
ini_set('max_execution_time', '0'); // for infinite time of execution
class Mdl_fungsi extends CI_Model
{

    function get_peraturan_kategori()
    {
        $this->db->select("peraturan_category_id,percategoryname");
        $this->db->order_by("order", "ASC");
        return $this->db->get("ppj_peraturan_category");
    }

    function get_detail_berita($id)
    {
        return $this->db->query("select * from tb_berita where id='" . $id . "'");
    }

    function get_detail_agenda($id)
    {
        return $this->db->query("select * from tb_agenda where id='" . $id . "'");
    }


    function produk_count_result()
    {

        $total = 0;
        $sql = "select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category where 	
									ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL) and ppj_peraturan_category.percategorykondisi=?
									and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id";
        $kueri = $this->db->query($sql, array('3', '1', '1'));
        return $total = $kueri->num_rows();
    }

    function produk_limit($limit, $start)
    {

        if ($limit == 0 or $limit == "") {

            $sql = "select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,
						 ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,
						 ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,
						 ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category where 	
						 ppj_peraturan_category.percategorykondisi=?
						 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 
						 ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL) 
                         order by SUBSTRING(tanggal,1,8) DESC,CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC";
            $kueri = $this->db->query($sql, array('1', '3', '1'));
        } else {
            $start = $this->db->escape_str($start);
            $limit = $this->db->escape_str($limit);
            $sql = "select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,ppj_peraturan.tanggal,
						 ppj_peraturan.view_count,ppj_peraturan.download_count,ppj_peraturan.tipe_dokumen,
						 ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,
						 ppj_peraturan.status,ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from  ppj_peraturan,ppj_peraturan_category where 	
						 ppj_peraturan_category.percategorykondisi=?
						 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id and 
						 ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL) 
                         order by SUBSTRING(tanggal,1,8) DESC, CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC limit $start,$limit";
            $kueri = $this->db->query($sql, array('1', '3', '1'));
        }

        return $kueri;
    }

    function berita_count($limit, $start)
    {
        $this->db->select("id,judul,isi,gambar_1,tgl_modifikasi");
        $this->db->order_by("tgl_modifikasi", "DESC");

        $this->db->limit($limit, $start);
        $kueri = $this->db->get("tb_berita");
        return $total = $kueri->num_rows();
    }

    function berita_count_result()
    {
        $total = 0;
        $kueri = $this->db->query("select id from tb_berita");
        return $total = $kueri->num_rows();
    }

    function berita_limit($limit, $start)
    {
        $this->db->select("id,judul,isi,gambar_1,tgl_modifikasi");
        $this->db->order_by("tgl_modifikasi", "DESC");
        $this->db->limit($limit, $start);
        $kueri = $this->db->get("tb_berita");
        return $kueri;
    }

    function agenda_count($limit, $start)
    {
        $this->db->select("id,judul,isi,tanggal,jam,tempat,tgl_modifikasi");
        $this->db->order_by("tgl_modifikasi", "DESC");

        $this->db->limit($limit, $start);
        $kueri = $this->db->get("tb_agenda");
        return $total = $kueri->num_rows();
    }

    function agenda_count_result()
    {
        $total = 0;
        $kueri = $this->db->query("select id from tb_agenda");
        return $total = $kueri->num_rows();
    }

    function agenda_limit($limit, $start)
    {
        $this->db->select("id,judul,isi,tanggal,jam,tempat,tgl_modifikasi");
        $this->db->order_by("tgl_modifikasi", "DESC");
        $this->db->limit($limit, $start);
        $kueri = $this->db->get("tb_agenda");
        return $kueri;
    }

    function simpan_session($jenis)
    {
        //session_start();
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = htmlspecialchars($_SERVER['HTTP_CLIENT_IP']);
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = htmlspecialchars($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            $ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
        }

        $session = session_id();
        $waktu = time();
        $hitung_mundur = $waktu - 600;
        $kueri = $this->db->query("select * from tb_online where session='" . $session . "'");
        $hitungan = $kueri->num_rows();
        if ($hitungan == 0) {
            $this->db->query("insert into tb_online (ip,session,waktu) values
							('" . $this->db->escape_str($ip) . "','" . $this->db->escape_str($session) . "','" . $waktu . "')");
        } else {
            $this->db->query("update tb_online set waktu='" . $this->db->escape_str($waktu) . "' where session='" . $this->db->escape_str($session) . "'");
        }

        $this->db->query("delete from tb_online where waktu < " . $this->db->escape_str($hitung_mundur) . "");

        $form = '';
        $tgl = date("Ymd");
        switch ($jenis) {
            case "1":
                $form = 'Halaman Utama JDIH';
                break;
            case "2":
                $form = 'Pencarian Cepat';
                break;
            case "3":
                $form = 'Pencarian Detail';
                break;
            case "4":
                $form = "Pencarian Produk Hukum Tipe Dokumen";
                break;
            case "5":
                $form = "Pencarian Produk Hukum Unit Oganisasi";
                break;
            case "6":
                $form = "Detail Produk Hukum";
                break;
            case "7":
                $form = "Pencarian Produk Hukum Substansi";
                break;
        }
        $this->db->query("insert into tb_hit_stat 
						(tgl,form,ip,hit,session,waktu) 
						values 
						('" . $this->db->escape_str($tgl) . "','" . $this->db->escape_str($form) . "','" . $this->db->escape_str($ip) . "','1','" . $this->db->escape_str($session) . "','" . $this->db->escape_str($waktu) . "')
						");
        $this->db->query("update tb_hit_total set total=total + 1");
    }

    function get_user_online()
    {
        //$tgl=date("Ymd")
        $kueri2 = $this->db->query("select * from tb_online");
        $user_online = $kueri2->num_rows();

        return $user_online;
    }

    function cari_cepat_count_result($tcari)
    {


        $total = 0;
        $k = '';
        $tcari = str_ireplace("^", "/", $tcari);
        $tcari = str_ireplace("%5E", "/", $tcari);
        $tcari = str_ireplace("%20", " ", $tcari);
        $tcari = str_ireplace("kosong_field", "", $tcari);
        /*if ($tcari != '') {
			$k= $k. " AND (ppj_peraturan.keyword like '%" . $this->db->escape_like_str($tcari) . "%' ESCAPE '!'";
			$k= $k. "   OR ppj_peraturan.judul like '%" . $this->db->escape_like_str($tcari) . "%' ESCAPE '!'";
			$k= $k. "   OR ppj_peraturan.tentang like '%" . $this->db->escape_like_str($tcari) . "%' ESCAPE '!'";
			$k = $k. " OR ppj_peraturan.noperaturan like '%" . $this->db->escape_like_str($tcari) . "%' ESCAPE '!')";
        }
		
        $kueri = $this->db->query("select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
				 where ppj_peraturan.kondisi='3' " . $k . " AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL)
				 and ppj_peraturan_category.percategorykondisi='1'
				 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id");*/
        $k2 = array();
        if ($tcari != '') {
            $k = $k . " AND (ppj_peraturan.keyword like ?";
            $k = $k . "   OR ppj_peraturan.judul like ? ";
            $k = $k . "   OR ppj_peraturan.tentang like ? ";
            $k = $k . " OR ppj_peraturan.noperaturan like ? )";

            $sql = "select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
				 where ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL)
				 and ppj_peraturan_category.percategorykondisi=?
				 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id " . $k . "";

            $kueri = $this->db->query($sql, array('3', '1', '1', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%'));
        } else {
            // $sql = "select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
            // 	 where ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL)
            // 	 and ppj_peraturan_category.percategorykondisi=?
            // 	 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id ";
            // 	 $kueri=$this->db->query($sql,array('3','1','1'));


            //include produk eselon 1 -- 28072020
            $sql = "select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
                 where ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL)
                 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id ";
            $kueri = $this->db->query($sql, array('3', '1'));
        }




        return $total = $kueri->num_rows();
    }

    function cari_cepat_limit($limit2, $start2, $tcari2)
    {
        $k = '';
        $limit = '';
        $start = '';
        $tcari = '';
        $limit = $limit2;
        $start = $start2;
        $tcari = $tcari2;

        $tcari = str_ireplace("^", "/", $tcari);
        $tcari = str_ireplace("%5E", "/", $tcari);
        $tcari = str_ireplace("%20", " ", $tcari);
        $tcari = str_ireplace("kosong_field", "", $tcari);

        if ($tcari != '') {
            $k = $k . " AND (ppj_peraturan.keyword like ?";
            $k = $k . "   OR ppj_peraturan.judul like ? ";
            $k = $k . "   OR ppj_peraturan.tentang like ? ";
            $k = $k . " OR ppj_peraturan.noperaturan like ? )";
        }
        if ($limit == 0 or $limit == "") {
            $sql = "select ppj_peraturan.peraturan_id, ppj_peraturan.keyword,ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
						  ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
						  ppj_peraturan.tipe_dokumen,ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,
						  ppj_peraturan.status,ppj_peraturan.file_abstrak,
						  ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category where 
						  ppj_peraturan.kondisi= ?  AND (ppj_peraturan.sifat= ? OR ppj_peraturan.sifat IS NULL)
						  and  ppj_peraturan_category.percategorykondisi= ? 
						  and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
						  " . $k . "
						  ORDER BY SUBSTRING(tanggal,1,4) DESC, CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC";

            if ($k == "") {
                $kueri = $this->db->query($sql, array('3', '1', '1'));
            } else {

                $kueri = $this->db->query($sql, array('3', '1', '1', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%'));
            }
            //echo $kueri;

        } else {
            // $sql="select ppj_peraturan.peraturan_id, ppj_peraturan.keyword,ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
            // 			  ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
            // 			  ppj_peraturan.tipe_dokumen,ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,
            // 			  ppj_peraturan.status,ppj_peraturan.file_abstrak,
            // 			  ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category where 
            // 			  ppj_peraturan.kondisi= ? AND (ppj_peraturan.sifat= ? OR ppj_peraturan.sifat IS NULL)
            // 			  and  ppj_peraturan_category.percategorykondisi= ?
            // 			  and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
            // 			  " . $k . " 
            // 			  ORDER BY SUBSTRING(tanggal,1,4) DESC, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC limit $start,$limit";


            // if($k==""){
            // 	$kueri=$this->db->query($sql,array('3','1','1'));
            // }else{
            // 	$kueri=$this->db->query($sql,array('3','1','1','%' . $this->db->escape_like_str($tcari) . '%','%' . $this->db->escape_like_str($tcari) . '%','%' . $this->db->escape_like_str($tcari) . '%','%' . $this->db->escape_like_str($tcari) . '%' ));
            // }


            // include produk eselon 1 -- 28072020
            $sql = "select ppj_peraturan.peraturan_id, ppj_peraturan.keyword,ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
                          ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
                          ppj_peraturan.tipe_dokumen,ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,
                          ppj_peraturan.status,ppj_peraturan.file_abstrak,
                          ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category where 
                          ppj_peraturan.kondisi= ? AND (ppj_peraturan.sifat= ? OR ppj_peraturan.sifat IS NULL)
                          and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
                          " . $k . " 
                          ORDER BY SUBSTRING(tanggal,1,4) DESC,CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC limit $start,$limit";

            if ($k == "") {
                $kueri = $this->db->query($sql, array('3', '1'));
            } else {
                $kueri = $this->db->query($sql, array('3', '1', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%', '%' . $this->db->escape_like_str($tcari) . '%'));
            }
        }
        //echo $sql;
        //echo '<br';
        //echo $kueri;
        return $kueri;
    }

    function cari_detail_count_result($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id)
    {

        $tipe_dokumen = htmlspecialchars($tipe_dokumen);
        $peraturan_category_id = htmlspecialchars($peraturan_category_id);
        $noperaturan = htmlspecialchars($noperaturan);
        $tahun = htmlspecialchars($tahun);
        $judul = htmlspecialchars($judul);
        $status = htmlspecialchars($status);
        $dept_id = htmlspecialchars($dept_id);
        $tag_id = htmlspecialchars($tag_id);

        $total = 0;
        $k = '';

        $tipe_dokumen = str_ireplace("^", "/", $tipe_dokumen);
        $tipe_dokumen = str_ireplace("%5E", "/", $tipe_dokumen);
        $tipe_dokumen = str_ireplace("kosong_field", "", $tipe_dokumen);

        $peraturan_category_id = str_ireplace("^", "/", $peraturan_category_id);
        $peraturan_category_id = str_ireplace("%5E", "/", $peraturan_category_id);
        $peraturan_category_id = str_ireplace("kosong_field", "", $peraturan_category_id);

        $noperaturan = str_ireplace("^", "/", $noperaturan);
        $noperaturan = str_ireplace("%5E", "/", $noperaturan);
        $noperaturan = str_ireplace("kosong_field", "", $noperaturan);

        $tahun = str_ireplace("^", "/", $tahun);
        $tahun = str_ireplace("%5E", "/", $tahun);
        $tahun = str_ireplace("kosong_field", "", $tahun);


        $judul = str_ireplace("^", "/", $judul);
        $judul = str_ireplace("%5E", "/", $judul);
        $judul = str_ireplace("%20", " ", $judul);
        $judul = str_ireplace("kosong_field", "", $judul);

        $tag_id = str_ireplace("^", "/", $tag_id);
        $tag_id = str_ireplace("%5E", "/", $tag_id);
        $tag_id = str_ireplace("kosong_field", "", $tag_id);


        $status = str_ireplace("^", "/", $status);
        $status = str_ireplace("%5E", "/", $status);
        $status = str_ireplace("kosong_field", "", $status);

        $dept_id = str_ireplace("^", "/", $dept_id);
        $dept_id = str_ireplace("%5E", "/", $dept_id);
        $dept_id = str_ireplace("kosong_field", "", $dept_id);


        if ($tipe_dokumen != '') {
            $k = $k . " and ppj_peraturan.tipe_dokumen='" . $this->db->escape_str($tipe_dokumen) . "'";
        }
        if ($peraturan_category_id != '') {
            $k = $k . " and ppj_peraturan.peraturan_category_id='" . $this->db->escape_str($peraturan_category_id) . "'";
        }
        if ($noperaturan != '') {
            $k = $k . " and ppj_peraturan.noperaturan like '" . $this->db->escape_str($noperaturan) . "%' ESCAPE '!'";
        }
        if ($tahun != '') {
            $k = $k . " and ppj_peraturan.tanggal like '%" . $this->db->escape_like_str($tahun) . "%' ESCAPE '!'";
        }
        if ($tag_id != '') {
            $k = $k . " and FIND_IN_SET ('$tag_id', tags)";
        }
        if ($judul != '') {
            $k = $k . " and ppj_peraturan.judul like '%" . $this->db->escape_like_str($judul) . "%'  ESCAPE '!'";
        }
        if ($status != '') {
            $k = $k . " and ppj_peraturan.status='" . $this->db->escape_str($status) . "'";
        }
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
        //echo $k;


        // $sql="select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
        // 	 where ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL)
        // 	 and ppj_peraturan_category.percategorykondisi=?
        // 	 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id ".$k."";

        // echo $sql;         
        // $kueri=$this->db->query($sql,array('3','1','1'));

        //include produk eselon 1 --28072020
        $sql = "select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
                 where ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL OR ppj_peraturan.sifat='')
                 and ppj_peraturan_category.percategorykondisi=?
                 and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id " . $k . "";

        //echo $sql."<br><br>";         
        $kueri = $this->db->query($sql, array('3', '1', '1'));
        //print_r($kueri);


        //  echo '<br>';
        // var_dump($kueri);
        return $total = $kueri->num_rows();
    }

    function cari_detail_limit($limit, $start, $tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id)
    {
        $k = '';

        $tipe_dokumen = str_ireplace("^", "/", $tipe_dokumen);
        $tipe_dokumen = str_ireplace("%5E", "/", $tipe_dokumen);
        $tipe_dokumen = str_ireplace("kosong_field", "", $tipe_dokumen);

        $peraturan_category_id = str_ireplace("^", "/", $peraturan_category_id);
        $peraturan_category_id = str_ireplace("%5E", "/", $peraturan_category_id);
        $peraturan_category_id = str_ireplace("kosong_field", "", $peraturan_category_id);

        $noperaturan = str_ireplace("^", "/", $noperaturan);
        $noperaturan = str_ireplace("%5E", "/", $noperaturan);
        $noperaturan = str_ireplace("kosong_field", "", $noperaturan);

        $tahun = str_ireplace("^", "/", $tahun);
        $tahun = str_ireplace("%5E", "/", $tahun);
        $tahun = str_ireplace("kosong_field", "", $tahun);


        $judul = str_ireplace("^", "/", $judul);
        $judul = str_ireplace("%5E", "/", $judul);
        $judul = str_ireplace("%20", " ", $judul);
        $judul = str_ireplace("kosong_field", "", $judul);

        $tag_id = str_ireplace("^", "/", $tag_id);
        $tag_id = str_ireplace("%5E", "/", $tag_id);
        $tag_id = str_ireplace("kosong_field", "", $tag_id);


        $status = str_ireplace("^", "/", $status);
        $status = str_ireplace("%5E", "/", $status);
        $status = str_ireplace("kosong_field", "", $status);

        $dept_id = str_ireplace("^", "/", $dept_id);
        $dept_id = str_ireplace("%5E", "/", $dept_id);
        $dept_id = str_ireplace("kosong_field", "", $dept_id);

        if ($tipe_dokumen != '') {
            $k = $k . " and ppj_peraturan.tipe_dokumen='" . $this->db->escape_str($tipe_dokumen) . "'";
        }
        if ($peraturan_category_id != '') {
            $k = $k . " and ppj_peraturan.peraturan_category_id='" . $this->db->escape_str($peraturan_category_id) . "'";
        }
        if ($noperaturan != '') {
            $k = $k . " and ppj_peraturan.noperaturan like '" . $this->db->escape_str($noperaturan) . "%' ESCAPE '!'";
        }
        if ($tahun != '') {
            $k = $k . " and ppj_peraturan.tanggal like '%" . $this->db->escape_like_str($tahun) . "%' ESCAPE '!'";
        }
        if ($tag_id != '') {
            $k = $k . " and FIND_IN_SET ('$tag_id', tags)";
        }
        if ($judul != '') {
            $k = $k . " and ppj_peraturan.judul like '%" . $this->db->escape_like_str($judul) . "%'  ESCAPE '!'";
        }
        if ($status != '') {
            $k = $k . " and ppj_peraturan.status='" . $this->db->escape_str($status) . "'";
        }
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

        if ($limit == 0 or $limit == "") {
            $sql = "select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
						  ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
						  ppj_peraturan.tipe_dokumen,
						  ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,ppj_peraturan.status,
						  ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category 
						  where ppj_peraturan.kondisi=? AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL OR ppj_peraturan.sifat='')
						  and ppj_peraturan_category.percategorykondisi=?
						  and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
						  " . $k . "
						  ORDER BY SUBSTRING(tanggal,1,8) DESC, CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC ";
            if ($k == "") {
                $kueri = $this->db->query($sql, array('3', '1', '1'));
            } else {
                $kueri = $this->db->query($sql, array('3', '1', '1'));
            }
        } else {
            //          $sql ="select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
            // 		ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
            // 		ppj_peraturan.tipe_dokumen,
            // 		ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,ppj_peraturan.status,
            // 		ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category 
            // 		where kondisi=?   AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL OR ppj_peraturan.sifat='') and  ppj_peraturan_category.percategorykondisi= ?
            // 		and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
            // 		" . $k . "
            // 		ORDER BY SUBSTRING(tanggal,1,4) DESC, LEFT (noperaturan,4) DESC, RIGHT (noperaturan,4) DESC  limit " . $this->db->escape_str($start) . "," . $this->db->escape_str($limit) . "";
            // if($k ==""){
            // 	$kueri= $this->db->query($sql,array('3','1','1'));
            // }else{
            // 	$kueri= $this->db->query($sql,array('3','1','1'));
            // }

            //include produk eselon1 --28072020
            $sql = "select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
                    ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
                    ppj_peraturan.tipe_dokumen,
                    ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,ppj_peraturan.status,
                    ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category 
                    where kondisi=?   AND (ppj_peraturan.sifat=? OR ppj_peraturan.sifat IS NULL OR ppj_peraturan.sifat='')
                    and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
                    " . $k . " 
                    ORDER BY SUBSTRING(tanggal,1,8) DESC, 
                    CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC  limit " . $this->db->escape_str($start) . "," . $this->db->escape_str($limit) . "";
            if ($k == "") {
                $kueri = $this->db->query($sql, array('3', '1'));
            } else {
                $kueri = $this->db->query($sql, array('3', '1'));
            }
        }
        // echo $sql."<br><br>";  
        // var_dump($sql,array('3','1','1'));
        return $kueri;
    }

    function cari_tag_count_result($tag_id)
    {
        $total = 0;
        $k = '';

        $tag_id = str_ireplace("^", "/", $tag_id);
        $tag_id = str_ireplace("%5E", "/", $tag_id);
        $tag_id = str_ireplace("kosong_field", "", $tag_id);


        if ($tag_id != '') {
            $k = $k . " and FIND_IN_SET ('$tag_id', tags)";
        }

        $kueri = $this->db->query("select ppj_peraturan.peraturan_id from ppj_peraturan,ppj_peraturan_category 
						  where ppj_peraturan.kondisi='3' " . $k . "
						  AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL)
						  and ppj_peraturan_category.percategorykondisi='1'
						  and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
						  order by peraturan_id DESC");

        return $total = $kueri->num_rows();
    }

    function cari_tag_limit($limit, $start, $tag_id)
    {
        $k = '';

        $tag_id = str_ireplace("^", "/", $tag_id);
        $tag_id = str_ireplace("%5E", "/", $tag_id);
        $tag_id = str_ireplace("kosong_field", "", $tag_id);

        if ($tag_id != '') {
            $k = $k . " and FIND_IN_SET ('$tag_id', tags)";
        }

        if ($limit == 0 or $limit == "") {
            $kueri = $this->db->query("select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
						  ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
						  ppj_peraturan.tipe_dokumen,
						  ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,ppj_peraturan.status,
						  ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category 
						  where kondisi='3'  " . $k . " AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) and  ppj_peraturan_category.percategorykondisi='1'
						  and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
						  ORDER BY SUBSTRING(tanggal,1,4) DESC, CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC ");
        } else {
            $kueri = $this->db->query("select ppj_peraturan.peraturan_id, ppj_peraturan.peraturan_category_id,ppj_peraturan.judul,
						  ppj_peraturan.tanggal,ppj_peraturan.view_count,ppj_peraturan.download_count,
						  ppj_peraturan.tipe_dokumen,
						  ppj_peraturan.peraturan_id,ppj_peraturan.dept_id,ppj_peraturan.status,
						  ppj_peraturan.file_abstrak,ppj_peraturan.file_upload from ppj_peraturan,ppj_peraturan_category 
						  where kondisi='3'  " . $k . " AND (ppj_peraturan.sifat='1' OR ppj_peraturan.sifat IS NULL) and  ppj_peraturan_category.percategorykondisi='1'
						  and ppj_peraturan.peraturan_category_id=ppj_peraturan_category.peraturan_category_id
						  ORDER BY SUBSTRING(tanggal,1,4) DESC, CAST(LEFT (noperaturan,4) AS UNSIGNED) DESC, CAST(RIGHT (noperaturan,4) AS UNSIGNED) DESC  limit $start,$limit");
        }

        return $kueri;
    }

    function get_bidang_hukum($id)
    {
        $bidang_hukum = '';
        $kueri = $this->db->query("select nama from tb_bidang_hukum where nama='" . $id . "'")->result_array();
        foreach ($kueri as $rw) {
            $bidang_hukum = $rw['nama'];
        }
        return $bidang_hukum;
    }

    function get_tanggal()
    {
        $tanggal = date("Y-m-d-h-i");
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split       = explode('-', $tanggal);
        $num = date('N', strtotime($tanggal));
        $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0] . ' - ' . $split[3] . ':' . $split[4];
        //return $hari[$num] . ', ' . $tgl_indo;
        return $hari[$num] . ', ';
    }
    function encript($token)
    {
        $cipher_method = 'aes-128-ctr';
        $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
        $crypted_token = openssl_encrypt($token, $cipher_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);

        return $crypted_token;
    }
    function decript($crypted_token)
    {
        list($crypted_token, $enc_iv) = explode("::", $crypted_token);;
        $cipher_method = 'aes-128-ctr';
        $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
        $token = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
        return $token;
    }

    function get_token($tipe)
    {
        if ($tipe == "1") {
            $dt = date("mYd/dmY/Ymd");
            $dt2 = "MLKPupR2045!";
            $yip = $this->Mdl_fungsi->getUserIpAddr();
            $kode = $dt . $dt2 . $yip;
            $token = '';
            $token = md5($kode);
            return $token;
        }
    }
    function cek_token($tipe, $token)
    {
        $tok = $this->Mdl_fungsi->get_token($tipe);
        if ($token == $tok) {
            return "sama";
        } else {
            return "beda";
        }
    }

    function encrypt_data($str)
    {
        $kunci = '979a218e0632df2935317f98d47956c7';
        $hasil = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $karakter = substr($str, $i, 1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
            $karakter = chr(ord($karakter) + ord($kuncikarakter));
            $hasil .= $karakter;
        }
        return urlencode(base64_encode($hasil));
    }
    function decrypt_data($str)
    {
        $str = base64_decode(urldecode($str));
        $hasil = '';
        $kunci = '979a218e0632df2935317f98d47956c7';
        for ($i = 0; $i < strlen($str); $i++) {
            $karakter = substr($str, $i, 1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
            $karakter = chr(ord($karakter) - ord($kuncikarakter));
            $hasil .= $karakter;
        }
        return $hasil;
    }

    function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function sendEmail($email, $nama, $tipe, $data)
    {
        $this->load->library('Kirim_email_baru');

        $token = $this->Mdl_fungsi->encript($email . 'JDIH');

        $konfig = $this->db->get("tb_konfig_email")->row();

        $Host = $konfig->nama_host;
        $Username = $konfig->host_user_name;    // SMTP password
        $Password = $konfig->host_password;                        // SMTP username

        $From = $konfig->email_from;
        $FromName = $konfig->email_from_name;
        $Body = 'Dear ' . $nama;
        switch ($tipe) {
            case 'subscribe':
                $Body = $Body . '<br> Terima kasih telah berlangganan produk hukum JDIH Kementerian PUPR.<br><br>
                      Untuk berhenti berlangganan, silahkan klik link berikut : <br>' . base_url('subscribe/stop?email=' . $email . '&token=' . base64_encode($token)) . '<br>
                      <br>Salam';
                $Subject = 'Berlangganan Produk Hukum JDIH PUPR';
                break;
            case 'sk':
                $mesg = $this->load->view('widget/email_template', $data, true);
                $Body = $mesg;
                $Subject = 'Saran dan Komentar Produk Hukum JDIH PUPR';
                $email = $From;
                $nama = $FromName;
                break;
            case 'notifikasi':
                $Body = $Body . '<br> Ada produk hukum terbaru dari kementrian PUPR silahkan klik link dibawah ini untuk melihat produk hukum tersebut.id ini adalah' . $data . '<br>Salam';
                $Subject = 'Berlangganan Produk Hukum JDIH PUPR';
                break;
        }

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
        // $mail->show_php_errors = E_ALL & ~E_DEPRECATED;

        $mail->From     = $From;
        $mail->FromName = $FromName;

        $mail->AddAddress($To, $ToName);
        $mail->WordWrap = 50;                // set word wrap
        $mail->Priority = 2;
        //$mail->SMTPDebug=2;
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
            return "nok2";
        } else {
            return "ok";
        }
    }
    function StopSubs($email, $token)
    {
        $dek = $email . 'JDIH';
        if ($this->decript($token) == $dek) {
            $this->db->set('status', '1');
            $this->db->where('email', $email);
            $this->db->update('tb_subscribe');
            return 'ok';
        } else {
            return 'nok';
        }
    }

    function getKetStatus($peraturan_id)
    {
        $this->db->select('judul');
        $this->db->from('ppj_peraturan');
        $this->db->where('peraturan_id', $peraturan_id);
        $kueri = $this->db->get();
        $nm = '';
        if ($kueri->num_rows() > 0) {
            $rw = $kueri->row();
            return $rw->judul;
        } else {
            return $nm;
        }
    }
}
