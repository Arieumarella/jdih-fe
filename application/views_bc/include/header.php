<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>JDIH - Jaringan Dokumentasi dan Informasi Hukum PUPR</title>

    <!-- Favicon  -->
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">


    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>internal/assets/font-awesome-4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>internal/assets/font-awesome-5.15.4/css/all.min.css">
    <script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/valdo.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/valdo.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="preload-content">
            <div id="world-load"></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- ***** Header Area Start ***** -->

    <header class="header-area" style="background-color: #45678d;margin-top:0;box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); border-color: #45678d;font-size:12px;">
        <div align="right" style="color:#fff;margin-right:20px;height:3px;">
            <?php

            //setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID');

            //$date = strftime( "%A, %d %B %Y %H:%M", time());

            //echo $date;

        ?><div id="tgl"></div>
    </div>
    <center>
        <div class="head1">

            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo -->
                        <a class="navbar-brand" href="http://jdihn.go.id/">
                            <img src="<?php echo base_url(); ?>assets/img/core-img/logojdih.png" alt="Logo" class="logo_jdih" style="object-fit:cover;width:200px;height:50px">
                        </a>
                        <a class="navbar-brand" href="http://pu.go.id">
                            <img src="<?php echo base_url(); ?>assets/img/core-img/logopupr2.png" alt="Logo" class="logo_pupr" style="object-fit:cover;width:200px;height:50px">
                        </a>

                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Navbar -->
                        <div class="collapse navbar-collapse" id="worldNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item <?php if ($dataaktif == "home") {
                                    echo "active";
                                } ?>">
                                <a class="nav-link" href="<?php echo base_url(); ?>">Beranda <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown <?php if ($dataaktif == "produk_hukum") {
                                echo "active";
                            } ?>">
                            <a class="nav-link dropdown-toggle" href="<?php echo base_url(); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jenis Produk Hukum</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                $query = $this->db->query("select peraturan_category_id,percategoryname from ppj_peraturan_category where percategorykondisi='1'  and tipe='1' order by ppj_peraturan_category.order ASC")->result_array();
                                foreach ($query as $rw) {
                                    echo anchor('Pencarian-produk-hukum/1/' . $rw['peraturan_category_id'], $rw['percategoryname'], 'class="dropdown-item"');
                                }
                                ?>
                                            <!--<a class="dropdown-item" href="">Peraturan Perundangan</a>
                                                <a class="dropdown-item" href="index.html">Monografi</a>
                                                <a class="dropdown-item" href="index.html">Artikel / Majalah</a>
                                                <a class="dropdown-item" href="index.html">Putusan Pengadilan</a>
                                            -->
                                        </div>
                                    </li>
                                    <?php $kueri = $this->db->get("ppj_widget")->result_array();
                                    $pustaka_hukum = $kueri[4]['widgetlink'];
                                    $putusan_pengadilan = $kueri[5]['widgetlink'];
                                    ?>
                                    <li class="nav-item dropdown  <?php if ($dataaktif == "informasi_hukum") {
                                        echo "active";
                                    } ?>">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informasi Hukum</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= $pustaka_hukum ?>">Pustaka Hukum</a>
                                        <a class="dropdown-item" href="<?= $putusan_pengadilan ?>">Putusan Pengadilan</a>
                                        <a class="dropdown-item" href="<?php echo base_url() ?>Berita">Berita</a>
                                        <a class="dropdown-item" href="<?php echo base_url() ?>Agenda">Agenda</a>
                                    </div>
                                </li>
                                <li class="nav-item  <?php if ($dataaktif == "statistik") {
                                    echo "active";
                                } ?>">
                                <a class="nav-link" href="<?php echo base_url() ?>statistik">Statistik</a>
                            </li>
                            <li class="nav-item dropdown  <?php if ($dataaktif == "tentang_jdih") {
                                echo "active";
                            } ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tentang JDIH</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo base_url() ?>Tentang-kami">Tentang Kami</a>
                                <!-- 9 Juni 2021 Menambah struktur organisasi  -->
                                <a class="dropdown-item" href="<?php echo base_url() ?>Struktur_organisasi">Struktur Organisasi</a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>Prasyarat">Prasyarat</a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>Kontak-kami">Kontak Kami</a>
                            </div>
                        </li>


                    </ul>
                    <!-- Search Form  -->
                                <!--<div id="search-wrapper">
                                        <form action="#">
                                            <input type="text" id="search" placeholder="Pencarian Cepat">
                                            <div id="close-icon"></div>
                                            <input class="d-none" type="submit" value="">
                                        </form>
                                    </div>-->
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </center>
        </header>
        <!-- ***** Header Area End ***** -->

        <script type="text/javascript">
            $(document).ready(function() {
                var d = new Date();
                var tgl = formatDate(d, 1);
                $("#tgl").empty();
                $("#tgl").append("<?php echo $this->Mdl_fungsi->get_tanggal(); ?> " + tgl);
            })

            function formatDate(dateObj, format) {
                var monthNames = ["Januari", "Februari", "Maret", "April", "Mai", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                var curr_date = dateObj.getDate();
                var curr_month = dateObj.getMonth();
                var bulan = monthNames[curr_month];
            //alert(bulan)
                curr_month = curr_month + 1;
                var curr_year = dateObj.getFullYear();
                var curr_min = dateObj.getMinutes();
                var curr_hr = dateObj.getHours();
                var curr_sc = dateObj.getSeconds();
                if (curr_month.toString().length == 1)
                    curr_month = '0' + curr_month;
                if (curr_date.toString().length == 1)
                    curr_date = '0' + curr_date;
                if (curr_hr.toString().length == 1)
                    curr_hr = '0' + curr_hr;
                if (curr_min.toString().length == 1)
                    curr_min = '0' + curr_min;

            if (format == 1) //dd-mm-yyyy
            {
                return curr_date + " " + bulan + " " + curr_year + " " + curr_hr + ":" + curr_min;
            } else if (format == 2) //yyyy-mm-dd
            {
                return curr_year + "" + curr_month + "" + curr_date;
            } else if (format == 3) //dd/mm/yyyy
            {
                return curr_hr + "" + curr_min + "" + curr_sc;
            } else if (format == 4) // MM/dd/yyyy HH:mm:ss
            {
                return curr_year + "" + curr_month + "" + curr_date + "" + curr_hr + "" + curr_min + "" + curr_sc;
            } else if (format == 9) //dd/mm/yyyy
            {
                // return curr_year + "" + curr_month + "" + curr_date  + "" + curr_hr + "" +curr_min + "" + curr_sc;  
            }
        }
    </script>