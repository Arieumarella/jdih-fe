<?php $this->load->view("include/header") ?>
<style>
    .dataTables_paginate {
        float: right;margin-top:-20px
    }

    @media (min-width: 760px) {
        .w-100{margin-top:-150px;}
    }

    @media (min-width: 880px) {
        .w-100{margin-top:-250px;}
    }
    @media (min-width: 920px) {
        .w-100{margin-top:-600px;}
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

    .carousel-inner .carousel-item > img {
        -webkit-animation: zoom 20s;
        animation: zoom 20s;
        opacity:0.9

    }
    .carousel-caption {
        width:100%;
        height:100%;
        left:0 !important;
    }


    @media screen and (max-width: 479px) {
        .carousel-caption p {
            margin-top:25%;color:#fff;font-weight:bold;width:100%;text-align:center; background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
        }
    }

    @media screen and (min-width: 480px) and (max-width: 640px){
        .carousel-caption p {
            margin-top:25%;color:#fff;font-weight:bold;width:90%;text-align:center; background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
        }
    }

    @media screen and (min-width: 641px) {
        .carousel-caption p {
            margin-top:56%;color:#fff;font-size:25px;font-weight:bold;width:80%;text-align:center; background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
        }
    }
</style>

<link rel="stylesheet" href="<?php echo base_url() ?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.theme.default.min.css">

<!-- ********** Hero Area Start ********** -->
<div id="carouselExampleControls" class="carousel slide" data-interval="20000" data-ride="carousel" style="margin-top:70px">
    <div class="carousel-inner" >
        <?php
        $n = 1;
        foreach ($get_banner as $hbanner) {
            if ($n == 1) {
                ?>
                <div class="carousel-item active" >
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/assets/banner/<?php echo $hbanner['gambar']; ?>" >
                    <div class="carousel-caption" align="center"><center>
                            <p style="">Selamat Datang<br>di Website Jaringan Dokumentasi dan Informasi Hukum Kementerian PUPR</p></center>

                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/assets/banner/<?php echo $hbanner['gambar']; ?>"  >

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
<div class="hero-area" >



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
                            <div class="single-slide d-flex align-items-center" >
                                <div class="post-number" style="margin-top:-10px">
                                    <p><?php echo $urut; ?></p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html"><?php
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
                <div class="contact-form">
                    <div style="width:100%;">
                        <a href="#"  style="color:#000;font-size:18px" onclick="tampil_cari('1')"> Pencarian Detail</a> &nbsp; | &nbsp; 
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
                                <input type="text" name="nomor" id="nomor"  class="form-control" placeholder="nomor">

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="tahun" id="tahun" class="form-control" placeholder="tahun" >

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
                            <a href="#"  class="btn btn-primary" onclick="get_cari_detail();"><i class="fa fa-search"></i> CARI</a>
                        </div>
                    </div>

                </div>
            </div>

            <div id="div_cari_cepat" style="display:none;width:100%" >
                <div class="contact-form">
                    <div style="width:100%;">
                        <a href="#" class="linka" onclick="tampil_cari('1')"> Pencarian Detail</a> &nbsp; | &nbsp; 
                        <a href="#"  style="color:#000;font-size:18px" onclick="tampil_cari('2')"> Pencarian Cepat</a>
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
                            <a href="#"  class="btn btn-primary" onclick="get_cari_cepat();"><i class="fa fa-search"></i> CARI</a>
                        </div>
                    </div>

                </div>


            </div>
        </div>
</section>



<div class="main-content-wrapper section-padding-20" >
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div class="post-content-area mb-100">
                    <!-- Catagory Area -->
                    <div class="world-catagory-area wow fadeInUpBig" data-wow-delay="0.1s" >
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="title">PRODUK HUKUM TERBARU</li>

                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="div_produk_hukum" role="tabpanel" aria-labelledby="tab1">
                                <!-- Single Blog Post -->
                                <table id="example2"  width="100%" border=0> 
                                    <thead style="font-size:14px"> 
                                        <tr> 
                                            <th   height="50"valign="top" >No Peraturan

                                                <div align="right" style="margin-top:-30px"><img src="<?php base_url(); ?>assets/img/core-img/icon2.png" style="width:20px;height:20px"> Tidak Berlaku
                                                    <img src="<?php base_url(); ?>assets/img/core-img/icon1.png" style="width:20px;height:20px"> Masih Berlaku
                                                </div>
                                            </th>


                                        </tr> 
                                    </thead> 
                                    <tbody>
                                        <?php
                                        foreach ($get_awal_produk as $hproduk) {
                                            ?>
                                            <tr>
                                                <td  style="border-top:0px;min-height:150px">
                                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                                        <!-- Post Thumbnail -->

                                                        <!-- Post Content -->
                                                        <div class="post-content" style="margin-left:10px;min-height:150px;margin-bottom:20px;margin-top:10px">
                                                            <a href="<?php echo base_url(); ?>produk_hukum/view/<?php echo $hproduk['peraturan_id']; ?>" class="headline">
                                                                <h5><?php echo $this->Mdl_home->cari_peraturan_id($hproduk['peraturan_category_id']) ?> nomor <?php echo $hproduk['noperaturan']; ?><?php if ($hproduk['status'] == "0") { ?><img src="<?php echo base_url() ?>assets/img/core-img/icon1.png" style="width:15px;height:15px;margin-left:10px"><?php } else if ($hproduk['status'] == "1") { ?><img src="<?php echo base_url() ?>assets/img/core-img/icon2.png" style="width:15px;height:15px;margin-left:10px"><?php } ?></h5>

                                                            </a>
                                                            <p> <?php echo $hproduk['tentang']; ?></p>
                                                            <!-- Post Meta -->
                                                            <div class="post-meta">
                                                                <p><i class="fa fa-clock-o"> <?php
                                                                        $bln = substr($hproduk['tanggal'], 4, 2);
                                                                        $bln2 = $this->Mdl_home->cari_bulan($bln);
                                                                        echo substr($hproduk['tanggal'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal'], 0, 4)
                                                                        ?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count']; ?> kali</i></p>
                                                            </div>
                                                        </div>
                                                        <div style="position: absolute;right:0;bottom:0;margin-bottom:10px;margin-right:10px">
                                                            <a href="#" class="btn btn-primary" style=""><i class="fa fa-eye"></i> Abstrak</a> | 
                                                            <a href="#" class="btn btn-primary" style=""><i class="fa fa-download"></i> Unduh</a><br>
                                                        </div>

                                                    </div><br>
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
            </div>

            <!-- ========== Sidebar Area ========== -->
            <div class="col-12 col-md-8 col-lg-4">
                <div class="post-sidebar-area">
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.2s" id="jenis_produk_hukum">
                        <h5 class="title">Jenis Produk Hukum</h5>
                        <div class="widget-content">
                            <?php
                            foreach ($get_pp as $hpp) {
                                ?>
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post"  style="min-height:50px">
                                    <!-- Post Content -->
                                    <div class="post-content" >
                                        <a href="#" class="headline" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
                                            <h5 class="mb-0"><?php echo $hpp['percategoryname']; ?></h5>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <!-- Widget Area -->

                    <!-- Widget Area -->
                    <div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.3s">
                        <h5 class="title">Produk Hukum Terpopuler</h5>
                        <div class="widget-content">
                            <?php
                            foreach ($get_produk_populer as $hpopuler) {
                                ?>
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <img src="<?php echo base_url(); ?>assets/img/core-img/icon3.png" alt="">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0"><?php echo $this->Mdl_home->cari_peraturan_id($hpopuler['peraturan_category_id']) ?> nomor <?php echo $hpopuler['noperaturan']; ?></h5>
                                            <i class="fa fa-download"> <?php echo $hpopuler['download_count']; ?> kali</i>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.4s">
                        <h5 class="title">Unit Organisasi dan Kerja</h5>
                        <div class="widget-content">
                            <!-- Single Blog Post -->
                            <?php
                            foreach ($get_unit as $hunit) {
                                ?>
                                <div class="single-blog-post post-style-2 d-flex align-items-center widget-post" style="min-height:50px">
                                    <!-- Post Thumbnail -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0"><?php echo $hunit['deptname']; ?></h5>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                    </div>
                    <!-- Widget Area -->

                    <!-- Widget Area -->

                </div>
            </div>
        </div>


    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').dataTable({
            "paging": true,
            "ordering": false, "searching": false,
            dom: "<'row'<'col-sm-12'tr><'col-sm-4'l><'col-sm-8'p>>"
        });



    });
</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/css/owlcarousel/owl.carousel.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
$this->load->view("include/footer")?>