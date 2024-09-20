<?php $this->load->view("include/header") ?>
<style>
    .dataTables_paginate {
        float: right;
        margin-top: -20px
    }

    @media (min-width: 760px) {
        .w-100 {
            margin-top: -150px;
        }
    }

    @media (min-width: 880px) {
        .w-100 {
            margin-top: -250px;
        }
    }

    @media (min-width: 920px) {
        .w-100 {
            margin-top: -600px;
        }
    }



    table#example2.dataTable tbody tr:hover {
        background-color: #e8e8e8;
        box-shadow: 0 0 13px rgba(33, 33, 33, .2);
    }

    table#example2.dataTable tbody tr:hover>.sorting_1 {
        background-color: #e8e8e8;
        box-shadow: 0 0 13px rgba(33, 33, 33, .2);
    }

    body {
        background-color: #e8e8e8;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(1.5, 1.5);
        }

        to {
            -webkit-transform: scale(1, 1);
        }
    }

    @keyframes zoom {
        from {
            transform: scale(1.5, 1.5);
        }

        to {
            transform: scale(1, 1);
        }
    }

    .carousel-inner .carousel-item>img {
        -webkit-animation: zoom 20s;
        animation: zoom 20s;
        opacity: 0.9
    }

    .carousel-caption {
        width: 100%;
        height: 100%;
        left: 0 !important;
    }


    @media screen and (max-width: 479px) {
        .carousel-caption p {
            margin-top: 25%;
            color: #fff;
            font-weight: bold;
            width: 100%;
            text-align: center;
            background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
        }
    }

    @media screen and (min-width: 480px) and (max-width: 640px) {
        .carousel-caption p {
            margin-top: 25%;
            color: #fff;
            font-weight: bold;
            width: 90%;
            text-align: center;
            background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
        }
    }

    @media screen and (min-width: 641px) {
        .carousel-caption p {
            margin-top: 56%;
            color: #fff;
            font-size: 25px;
            font-weight: bold;
            width: 80%;
            text-align: center;
            background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
        }
    }
</style>

<link rel="stylesheet" href="<?php echo base_url() ?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.theme.default.min.css">

<!-- ********** Hero Area Start ********** -->
<div id="carouselExampleControls" class="carousel slide" data-interval="20000" data-ride="carousel" style="margin-top:70px">
    <div class="carousel-inner">
        <?php
        $n = 1;
        foreach ($get_banner as $hbanner) {
            if ($n == 1) {
        ?>
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/assets/banner/<?php echo $hbanner['gambar']; ?>">
                    <div class="carousel-caption" align="center">
                        <center>
                            <p style="">Selamat Datang<br>di Website Jaringan Dokumentasi dan Informasi Hukum Kementerian PUPR</p>
                        </center>

                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/assets/banner/<?php echo $hbanner['gambar']; ?>">

                </div>
            <?php
            }
            $n++;
            ?>


        <?php
        }
        ?>


    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="hero-area">



    <!-- Hero Post Slide -->
    <div class="hero-post-area" style="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-post-slide" style="margin-top:18px">
                        <?php
                        $urut = 1;
                        foreach ($get_banner_news as $hbanner_news) {
                        ?>
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number" style="margin-top:-10px">
                                    <p><?php echo $urut; ?></p>
                                </div>
                                <div class="post-title">
                                    <a href="<?php echo base_url() . 'produk_hukum/view/' . $hbanner_news['peraturan_id']; ?>"><?php
                                                                                                                                if (strlen($hbanner_news['tentang']) > 50) {
                                                                                                                                    echo substr($hbanner_news['tentang'], 0, 50) . "...<br>" . $hbanner_news['noperaturan'];
                                                                                                                                } else {
                                                                                                                                    echo $hbanner_news['tentang'] . "...<br>" . $hbanner_news['noperaturan'];
                                                                                                                                }
                                                                                                                                ?> </a>
                                </div>
                            </div>
                        <?php
                            $urut++;
                        }
                        ?>
                        <!-- Single Slide -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ********** Hero Area End ********** -->

<section class="contact-area section-padding-20">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-20 col-md-100 col-lg-40" id="div_cari_detail">
                <div class="contact-form" style="background-color:#fff;border-radius:5px;">
                    <div style="width:100%;border-bottom:2px solid #ffcc00;">
                        <a href="#" style="color:#000;font-size:18px" onclick="tampil_cari('1')"> Pencarian Detail</a> &nbsp; | &nbsp;
                        <a href="#" class="linka" onclick="tampil_cari('2')"> Pencarian Cepat</a>
                    </div>
                    <!-- Contact Form --><br>

                    <div class="row">
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <select class="form-control" id="peraturan_id">
                                    <option value="">Semua Jenis</option>
                                    <?php
                                    foreach ($get_pp as $combo_pp) {
                                    ?><option value="<?php echo $combo_pp['peraturan_category_id']; ?>"><?php echo $combo_pp['percategoryname']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="nomor" id="nomor" class="form-control" placeholder="nomor">

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="tahun" id="tahun" class="form-control" placeholder="tahun">

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="judul" id="judul" class="form-control" placeholder="judul">

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <select class="form-control" id="status">
                                    <option value="">Semua Status</option>
                                    <option value="0">Masih Berlaku</option>
                                    <option value="1">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="#" class="btn btn-primary" onclick="get_cari_detail();" style="width:100%"><i class="fa fa-search"></i> CARI</a>
                        </div>
                    </div>

                </div>
            </div>

            <div id="div_cari_cepat" style="display:none;width:100%">
                <div class="contact-form" style="background-color:#fff;border-radius:5px;">
                    <div style="width:100%;border-bottom:3px solid #ffcc00;">
                        <a href="#" class="linka" onclick="tampil_cari('1')"> Pencarian Detail</a> &nbsp; | &nbsp;
                        <a href="#" style="color:#000;font-size:18px" onclick="tampil_cari('2')"> Pencarian Cepat</a>
                    </div>
                    <!-- Contact Form --><br>

                    <div class="row">
                        <div class="col">
                            <div class="group">
                                <select class="form-control" id="status2">
                                    <option value="">Semua Status</option>
                                    <option value="0">Masih Berlaku</option>
                                    <option value="1">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="group">
                                <input type="text" name="tcari" id="tcari" placeholder="masukan kata pencarian" class="form-control">

                            </div>
                        </div>

                        <div class="col">
                            <a href="#" class="btn btn-primary" onclick="get_cari_cepat();" style="width:100%"><i class="fa fa-search"></i> CARI</a>
                        </div>
                    </div>

                </div>


            </div>
        </div>
</section>



<div class="main-content-wrapper section-padding-20">
    <div class="container">
        <div class="row">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8" style="margin-bottom:10px;">
                <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">

                    <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                        <label style="color: #000;margin-top:10px;margin-left:10px">PRODUK HUKUM TERBARU</label>
                        <div align="right" style="margin-top:-30px;margin-right:10px"><img src="<?php base_url(); ?>assets/img/core-img/icon2.png" style="width:20px;height:20px"> Tidak Berlaku
                            <img src="<?php base_url(); ?>assets/img/core-img/icon1.png" style="width:20px;height:20px"> Masih Berlaku
                        </div>
                    </div>
                    <div class="panel-body" style="background-color:#fff;">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="div_produk_hukum" role="tabpanel" aria-labelledby="tab1">
                                <!-- Single Blog Post -->
                                <table id="example2" class="table table-bordered	 table-striped" width="100%" border=0>
                                    <thead style="display:none">
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nomor = 0;
                                        foreach ($get_awal_produk as $hproduk) {
                                            $nomor++;
                                            $dtktg = $this->Mdl_home->get_kategori($hproduk['peraturan_category_id']);
                                            foreach ($dtktg as $dkt) {
                                                $kdkt = $dkt['percategorycode'];
                                            }
                                            $thn = substr($hproduk['tanggal'], 0, 4);
                                        ?>
                                            <tr>
                                                <td style="border-top:0px;">

                                                    <!-- Post Thumbnail -->

                                                    <!-- Post Content -->
                                                    <div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px">
                                                        <a href="<?php echo base_url(); ?>produk_hukum/view/<?php echo $hproduk['peraturan_id']; ?>" class="headline">
                                                            <h5><?php echo $this->Mdl_home->cari_peraturan_id($hproduk['peraturan_category_id']) ?> nomor <?php echo $hproduk['noperaturan']; ?><?php if ($hproduk['status'] == "0") { ?><img src="<?php echo base_url() ?>assets/img/core-img/icon1.png" style="width:15px;height:15px;margin-left:10px"><?php } else if ($hproduk['status'] == "1") { ?><img src="<?php echo base_url() ?>assets/img/core-img/icon2.png" style="width:15px;height:15px;margin-left:10px"><?php } ?></h5>

                                                        </a>
                                                        <p style="color:#000;"> <?php echo substr($hproduk['tentang'], 0, 170) ?></p>
                                                        <!-- Post Meta -->

                                                        <div class="post-meta">
                                                            <p><i class="fa fa-clock-o"> <?php
                                                                                            $bln = substr($hproduk['tanggal'], 4, 2);
                                                                                            $tahun = substr($hproduk['tanggal'], 0, 4);
                                                                                            $bln2 = $this->Mdl_home->cari_bulan($bln);
                                                                                            echo substr($hproduk['tanggal'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal'], 0, 4)
                                                                                            ?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count']; ?> kali</i></p>
                                                        </div>
                                                        <input type="hidden" id="peraturan_<?php echo $nomor; ?>" value="<?php echo $this->Mdl_home->cari_peraturan_id($hproduk['peraturan_category_id']) ?>">
                                                        <input type="hidden" id="peraturan_code_<?php echo $nomor; ?>" value="<?php echo $this->Mdl_home->cari_peraturan_code($hproduk['peraturan_category_id']) ?>">
                                                        <input type="hidden" id="noperaturan_<?php echo $nomor; ?>" value="<?php echo $hproduk['noperaturan']; ?>">
                                                        <input type="hidden" id="thn_<?php echo $nomor; ?>" value="<?php echo $thn; ?>">
                                                        <input type="hidden" id="bln_<?php echo $nomor; ?>" value="<?php echo $bln; ?>">
                                                        <input type="hidden" id="file_<?php echo $nomor; ?>" value="<?php echo $hproduk['file_abstrak']; ?>">

                                                        <input type="hidden" id="katalog_<?php echo $nomor; ?>" value="<?php echo $hproduk['katalog']; ?>">
                                                        <input type="hidden" id="abstrak_<?php echo $nomor; ?>" value="<?php echo $hproduk['file_abstrak']; ?>">

                                                        <div style="margin-top:5px;">
                                                            <!--<a href="#" class="btn btn-primary" onclick="get_katalog(<?php echo $nomor; ?>)" style="font-size:12px"><i class="fa fa-list"></i> Katalog</a> |-->
                                                            <a href="#" class="btn btn-primary" onclick="get_pdf(<?php echo $nomor; ?>)" style="font-size:12px"><i class="fa fa-eye"></i> Abstrak</a> |
                                                            <?php
                                                            if (!empty($hproduk['file_zip'])) {
                                                                $url = base_url('home/download/' . $kdkt . '/' . $thn . '/' . $bln . '/' . $hproduk['file_zip']);
                                                            } else {
                                                                $url = '#';
                                                            }
                                                            ?>
                                                            <a href="<?php echo $url; ?>" class="btn btn-primary" style="font-size:12px"><i class="fa fa-download"></i> Unduh</a><br>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="panel panel-default" style="width:100%">
                    <div class="panel-heading" style="border-radius:5px;background-color: #D2D6DE;height:50px;margin-bottom:5px">
                        <center>

                            <label style="color: #000;margin-top:10px">Berita Terbaru</label>

                        </center>
                    </div>
                    <div class="panel-body">
                        <center>
                            <div class="row" style="width:95%">

                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php $awal = 0;
                                        $akhir = $get_berita_count;
                                        for ($awal; $awal < $akhir; $awal++) {
                                            if ($awal == 1) {
                                        ?><li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $awal; ?>" class="active"></li><?php
                                                                                                                                        } else {
                                                                                                                                            ?><li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $awal; ?>" class="active"></li><?php
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                            ?>

                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <?php
                                        $dt = 0;
                                        foreach ($get_berita as $rberita) {
                                            if ($dt == 0) {
                                        ?>
                                                <div class="carousel-item active">
                                                    <img class="d-block img-fluid" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rberita['gambar_1']; ?>">
                                                    <div class="carousel-caption d-none d-md-block  bg-dark" style="color:#fff;">

                                                        <p style="color:#fff;">
                                                            <a href="<?php echo base_url() ?>berita/detail/<?php echo $rberita['id']; ?>" style="color:#fff;">
                                                                <?php echo $rberita['judul']; ?>
                                                            </a>

                                                        </p>
                                                    </div>
                                                </div>
                                            <?php
                                            } else {
                                            ?>

                                                <div class="carousel-item">
                                                    <img class="d-block img-fluid" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rberita['gambar_1']; ?>">
                                                    <div class="carousel-caption d-none d-md-block bg-dark" style="color:#fff;">

                                                        <p style="color:#fff;">
                                                            <a href="<?php echo base_url() ?>berita/detail/<?php echo $rberita['id']; ?>" style="color:#fff;">
                                                                <?php echo $rberita['judul']; ?>
                                                            </a>

                                                        </p>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                            $dt++;
                                        }
                                        ?>


                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>


                            </div>
                        </center>
                    </div>
                </div>
                <br>

                <br>
                <div class="panel panel-default" style="width:100%">
                    <div class="panel-heading" style="border-radius:5px;background-color: #D2D6DE;height:50px;margin-bottom:5px">
                        <center>

                            <label style="color: #000;margin-top:10px">Agenda Terbaru</label>

                        </center>
                    </div>
                    <div class="panel-body">
                        <?php
                        foreach ($get_agenda as $ragenda) {
                        ?>
                            <div class="callout callout-info" style="background-color:#fff;border-left:4px solid #5bc0de">
                                <h4><?php echo $ragenda['judul']; ?></h4>
                                <i class="fa fa-calendar"></i> <?php echo substr($ragenda['tanggal'], 6, 2) . "/" . substr($ragenda['tanggal'], 4, 2) . "/" . substr($ragenda['tanggal'], 0, 4) . " - " . $ragenda['jam']; ?><br>
                                <?php echo $ragenda['isi']; ?><br>
                                <a href="<?php echo base_url() ?>agenda/detail/<?php echo $ragenda['id']; ?>" class="btn btn-primary" style="color:#fff;">Detail</a>
                            </div>

                        <?php }
                        ?>


                    </div>
                </div>
            </div>

            <!-- ========== Sidebar Area ========== -->
            <div class="col-12  col-lg-4" style="width:100%">
                <div style="width:100%">
                    <!-- Widget Area -->

                    <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                        <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                            <center>
                                <label style="color: #000;margin-top:10px">Jenis Produk Hukum</label>
                            </center>
                        </div>
                        <div class="panel-body" style="background-color:#fff;">
                            <div class="panel box box-primary">
                                <div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:#8d8d8d;margin-left:20px;">
                                            Peraturan Perundangan <i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <?php
                                        $get_pp = $this->Mdl_home->get_pp('1');
                                        foreach ($get_pp as $hpp) {
                                        ?>
                                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                                <!-- Post Content -->
                                                <div class="post-content">
                                                    <a href="#" class="headline" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
                                                        <i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="panel box box-primary">
                                <div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color:#8d8d8d;margin-left:20px;">
                                            Monografi<i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <?php
                                        $get_pp = $this->Mdl_home->get_pp('2');
                                        foreach ($get_pp as $hpp) {
                                        ?>
                                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                                <!-- Post Content -->
                                                <div class="post-content">
                                                    <a href="#" class="headline" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
                                                        <i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel box box-primary">
                                <div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="color:#8d8d8d;margin-left:20px;">
                                            Artikel / Majalah <i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <?php
                                        $get_pp = $this->Mdl_home->get_pp('3');
                                        foreach ($get_pp as $hpp) {
                                        ?>
                                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                                <!-- Post Content -->
                                                <div class="post-content">
                                                    <a href="#" class="headline" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
                                                        <i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="panel box box-primary">
                                <div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="color:#8d8d8d;margin-left:20px;">
                                            Putusan Pengadilan<i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <?php
                                        $get_pp = $this->Mdl_home->get_pp('4');
                                        foreach ($get_pp as $hpp) {
                                        ?>
                                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                                <!-- Post Content -->
                                                <div class="post-content">
                                                    <a href="#" class="headline" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
                                                        <i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                        <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                            <center>
                                <label style="color: #000;margin-top:10px">Produk Hukum Terpopuler</label>
                            </center>
                        </div>
                        <div class="panel-body" style="background-color:#fff;">
                            <?php
                            foreach ($get_produk_populer as $hpopuler) {
                            ?>
                                <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">

                                    <div class="post-content">
                                        <a href="<?php echo base_url(); ?>produk_hukum/view/<?php echo $hpopuler['peraturan_id']; ?>" class="headline">
                                            <?php echo $this->Mdl_home->cari_peraturan_id($hpopuler['peraturan_category_id']) ?> nomor <?php echo $hpopuler['noperaturan']; ?>
                                            <i class="fa fa-download"> <?php echo $hpopuler['download_count']; ?> kali</i>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>

                    <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                        <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                            <center>

                                <label style="color: #000;margin-top:10px">Unit Organisasi dan Kerja</label>

                            </center>
                        </div>
                        <div class="panel-body" style="background-color:#fff;">

                            <?php
                            foreach ($get_unit as $hunit) {
                            ?>
                                <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline" onclick="cari_dept('<?php echo $hunit['dept_id']; ?>')">
                                            <i class="fa fa-angle-double-right"></i> <?php echo $hunit['deptname']; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <br>
                    <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                        <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                            <center>
                                <label style="color: #000;margin-top:10px">Link Utama</label>
                            </center>
                        </div>
                        <div class="panel-body" style="background-color:#fff;">

                            <?php
                            foreach ($get_link_utama as $hutama) {
                            ?>
                                <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="<?php echo $hutama['linkurl']; ?>" target="_blank">
                                            <i class="fa fa-link"></i> <?php echo $hutama['linkname']; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <br>
                    <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                        <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                            <center>

                                <label style="color: #000;margin-top:10px">Link Terkait</label>

                            </center>
                        </div>
                        <div class="panel-body" style="background-color:#fff;">

                            <?php
                            foreach ($get_link_terkait as $hterkait) {
                            ?>
                                <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="<?php echo $hterkait['linkurl']; ?>" target="_blank">
                                            <i class="fa fa-link"></i> <?php echo $hterkait['linkname']; ?>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <br>

                    <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                        <div class="panel-heading" style="background-color: #D2D6DE;height:50px;border-bottom:3px solid #fcfcfc;">
                            <center>

                                <label style="color: #000;margin-top:10px">Statistik Pengunjung</label>

                            </center>
                        </div>
                        <div class="panel-body" style="background-color:#fff;">
                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                <div class="post-content">
                                    <a href="<?php echo $hterkait['linkurl']; ?>" target="_blank">
                                        <i class="fa fa-bar-chart"></i> Hari ini : <?php echo number_format($stat_today); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                <div class="post-content">
                                    <a href="<?php echo $hterkait['linkurl']; ?>" target="_blank">
                                        <i class="fa fa-bar-chart"></i> Kemarin : <?php echo  number_format($stat_yesterday); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                <div class="post-content">
                                    <a href="<?php echo $hterkait['linkurl']; ?>" target="_blank">
                                        <i class="fa fa-bar-chart"></i> Total : <?php echo number_format($stat_total); ?>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <br>


                </div>
            </div>
        </div>


    </div>
</div>

<div id="modalkatalogcari"></div>

<div id="modal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width:90%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Katalog </h4>
            </div>
            <div class="modal-body">

                <div id="isi_katalog"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_abstrak" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width:90%">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Abstrak </h4>
            </div>
            <div class="modal-body">
                <div id="div_frame"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example2').dataTable({
            "paging": true,
            "ordering": false,
            "searching": false,
            dom: "<'row'<'col-sm-12'tr><'col-sm-4'l><'col-sm-8'p>>"
        });



    });

    function get_pdf(urut) {
        $('#modal_abstrak').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#div_frame").empty();

        var kdt = document.getElementById("peraturan_code_" + urut + "").value;
        var thn = document.getElementById("thn_" + urut + "").value;
        var bln = document.getElementById("bln_" + urut + "").value;
        var file_abstrak = document.getElementById("file_" + urut + "").value;
        if (file_abstrak != "") {
            isi = '<iframe src="' + m_url2 + 'internal/assets/plugins/pdfjs/web/viewer.html?file=' + m_url2 + 'internal/assets/assets/produk_abstrak/' + kdt + '/' + thn + '/' + bln + '/' + file_abstrak + '" style="width:100%; height:600px;" frameborder="0"></iframe>';
            $("#div_frame").append(isi);
        } else {
            isi = '<h1>File PDF tidak ada</h1>';
            $("#div_frame").append(isi);
        }


    }

    function get_katalog(urut) {
        $('#modal2').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#isi_katalog").empty();
        var isi = '';
        isi += document.getElementById("peraturan_" + urut + "").value + "<br>";
        isi += document.getElementById("noperaturan_" + urut + "").value + "<br>";
        isi += document.getElementById("katalog_" + urut + "").value;
        $("#isi_katalog").append(isi);


    }
</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/css/owlcarousel/owl.carousel.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
$this->load->view("include/footer") ?>