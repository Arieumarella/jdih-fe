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
<?php
$get_banner = $this->Mdl_home->get_banner();
$get_banner_news = $this->Mdl_home->get_banner_news();
?>

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
    <!-- <div class="hero-post-area" style="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-post-slide" style="margin-top:18px"> -->
    <?php
    // $urut = 1;
    // foreach ($get_banner_news as $hbanner_news) {
    //     $nop = explode("/", $hbanner_news['noperaturan']);
    //     $noperaturan1 = $hbanner_news['noperaturan'];
    //     foreach ($nop as $i => $key) {
    //     }
    //     if ($i <= 0) {
    //         $noperaturan1 = $hbanner_news['noperaturan'] . ' tahun ' . substr($hbanner_news['tanggal'], 0, 4);
    //     }
    ?>
    <!-- <div class="single-slide d-flex align-items-center">
                                <div class="post-number" style="margin-top:-10px">
                                    <p> -->
    <?php
    // echo $urut; 
    ?>
    </p>
    <!-- </div>
                                <div class="post-title"> -->
    <!-- <a href="<?php echo base_url() . 'detail-dokumen/' . $hbanner_news['peraturan_id'] . "/" . $hbanner_news['tipe_dokumen']; ?>"> -->
    <?php
    // if (strlen($hbanner_news['tentang']) > 50) {
    //     echo substr($hbanner_news['tentang'], 0, 50) . "...<br>" . $hbanner_news['noperaturan'];
    // } else {
    //     echo $hbanner_news['tentang'] . "...<br>" . $hbanner_news['noperaturan'];
    // }
    //14 Feb 2020
    // if (strlen($hbanner_news['judul']) > 50) {
    //     echo substr($hbanner_news['judul'], 0, 50) . "...<br>" . $noperaturan1;
    // } else {
    //     echo $hbanner_news['judul'] . "...<br>" . $noperaturan1;
    // }
    ?>
    <!-- </a>
                                </div>
                            </div> -->
    <?php
    //     $urut++;
    // }
    ?>
    <!-- Single Slide -->
    <!-- </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<!-- ********** Hero Area End ********** -->
<script src="<?php echo base_url() ?>assets/css/owlcarousel/owl.carousel.js"></script>