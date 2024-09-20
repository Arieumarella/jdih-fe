<!-- owl -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/OwlCarousel/owl.carousel.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/OwlCarousel/owl.theme.default.min.css" />


<div class="panel panel-default" style="width:100%;background-color:#fff">
    <div class="panel-heading" style="border-radius:5px;background-color: #45678d;height:50px;margin-bottom:5px">
        <center>
            <label style="color: #fff;margin-top:10px">Berita Terbaru</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">

        <!-- <div class="flexslider" style="background-color:#fff;">
            <ul class="slides" style="background-color:#fff;">
                <?php
                $get_berita = $this->Mdl_home->get_berita();
                $get_berita_count = $this->Mdl_home->get_berita_count();

                $awal = 0;
                $akhir = $get_berita_count;
                foreach ($get_berita as $rberita) {
                ?>
                    <li>
                        <img src="<?php echo base_url() ?>/internal/assets/assets/berita/<?php echo $rberita['gambar_1']; ?>" style="width:100%" />
                        <p class="flex-caption"><?php echo $rberita['judul']; ?>
                            <br><br>
                            <a href="<?php echo base_url() ?>berita/detail/<?php echo $rberita['id']; ?>" class="btn btn-primary" style="color:#fff">Selengkapnya</a>
                        </p>

                    </li><?php }
                            ?>
            </ul>

        </div> -->
        <!-- <div class="card-deck">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div> -->
        <div class="text-right mr-3 mt-2 mb-2" style="color: white;">
            <a href="<?php echo base_url() ?>berita" class="btn btn-primary" style="border:1px solid #00b4d8;color:#fff;font-size:11px;">
                Lihat Semua Berita
            </a>
        </div>
        <div class="owl-carousel owl-theme">
            <?php
            $get_berita = $this->Mdl_home->get_berita();
            $get_berita_count = $this->Mdl_home->get_berita_count();

            $awal = 0;
            $akhir = $get_berita_count;
            foreach ($get_berita as $rberita) {
            ?>
                <div class="card mx-2">
                    <div class="image-box">
                        <img src="<?php echo base_url() ?>/internal/assets/assets/berita/<?php echo $rberita['gambar_1']; ?>" class="card-img-top " alt="..." style="height:200px;object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <div class="card-title" style="font-size: 15px;"><b><?php echo substr_replace($rberita['judul'], " ...", 30); ?></b></div>
                        <p class="card-text"><small class="text-muted">Update <?php echo substr($rberita['tgl_modifikasi'], 6, 2) . '/' . substr($rberita['tgl_modifikasi'], 4, 2) . '/' . substr($rberita['tgl_modifikasi'], 0, 4); ?></small></p>
                        <div class="text-center">
                            <a href="<?php echo base_url() ?>berita/detail/<?php echo $rberita['id']; ?>" class="btn btn-primary btn-sm" style="border:1px solid #00b4d8;color:#fff;font-size:11px;white-space: normal;">
                                Lihat Selengkapnya
                            </a>
                        </div>

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