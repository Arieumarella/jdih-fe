<!-- owl -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/OwlCarousel/owl.carousel.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/OwlCarousel/owl.theme.default.min.css" />


<div class="panel panel-default" style="width:100%;background-color:#fff">
    <div class="panel-heading" style="border-radius:5px;background-color: #45678d;height:50px;margin-bottom:5px">
        <center>
            <label style="color: #fff;margin-top:10px">Konsultasi Publik</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">
        <div class="text-right mr-3 mt-2 mb-2" style="color: white;">
            <a href="<?php echo base_url() ?>konsultasipublik" class="btn btn-primary" style="border:1px solid #00b4d8;color:#fff;font-size:11px;">
                Lihat Konsultasi Publik
            </a>
        </div>
        <div class="owl-carousel owl-theme">
            <?php
            $get_infografis = $this->Mdl_home->get_konsultasi_publik();
            $get_konsultasi_publik_count = $this->Mdl_home->get_konsultasi_publik_count();

            $awal = 0;
            $akhir = $get_konsultasi_publik_count;
            foreach ($get_konsultasi_publik as $konsultasi_publik) {
            ?>
                <div class="card mx-2 h-100">
                    <div class="card-body">
                        <div class="card-title" style="font-size: 15px;"><b><?php echo $konsultasi_publik['judul']; ?></b></div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>
    </div>
</div>
<br>
<br>
<style>
    .btnlink {
        color: white;
    }

    .btnlink:hover {
        border: blue;
    }

    .image-box {
        position: relative;
        overflow: hidden;
    }

    .image-box img {
        max-width: 100%;
        transition: all 0.3s;
        display: block;
        width: 100%;
        height: auto;
        transform: scale(1);
    }

    .image-box:hover img {
        transform: scale(1.1);
    }
</style>
<!-- owl -->

<script src="<?php echo base_url(); ?>assets/OwlCarousel/owl.carousel.min.js"></script>
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        nav: false,
        dots: false,
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 3
            }
        }
    })
</script>