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
	table#example2.dataTable tbody tr:hover {
	  background-color: #e8e8e8;box-shadow: 0 0 13px rgba(33,33,33,.2); 
	}
	 
	table#example2.dataTable tbody tr:hover > .sorting_1 {
	  background-color: #e8e8e8;box-shadow: 0 0 13px rgba(33,33,33,.2); 
	}

	body{background-color:#e8e8e8;}
	
</style>

<link rel="stylesheet" href="<?php echo base_url() ?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.theme.default.min.css">
<!-- ********** Hero Area Start ********** -->
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
<!-- ********** Form Pencarian Detail dan Pencarian cepat ********** -->
<section class="contact-area section-padding-20" >
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-20 col-md-100 col-lg-40" id="div_cari_detail">
                <div class="contact-form" style="background-color:#fff;border-radius:5px;">
                    <div style="width:100%;border-bottom:2px solid #ffcc00;">
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

            <div class="" id="div_cari_cepat" style="display:none;width:100%">
                <div class="contact-form" style="background-color:#fff;border-radius:5px;">
                    <div style="width:100%;border-bottom:3px solid #ffcc00;">
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
<!-- ********** End Form Pencarian Detail dan Pencarian cepat ********** -->

<div class="main-content-wrapper section-padding-20" >
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8" style="background-color:#fff;">
                <div class="post-content-area mb-100">
                    <!-- Catagory Area -->
                    <?php
                    foreach ($get_awal_produk as $hproduk) {
                        $datakategori = $this->Mdl_produk_hukum->get_namakategori($hproduk['peraturan_category_id']);
                        foreach ($datakategori->result_array() as $dk) {
                            $kodekat = $dk['percategorycode'];
                        }
                        $file_abstrak = $hproduk['file_abstrak'];
                        $tahun = substr($hproduk['tanggal'], 0, 4);
                        $bulan = substr($hproduk['tanggal'], 4, 2);
                        ?>
                        <div class="world-catagory-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title"><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id']) ?> nomor <?php echo $hproduk['noperaturan']; ?></li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="tab1" id="div_produk_hukum">
                                    <p><i class="fa fa-clock-o"> <?php
                                            $bln = substr($hproduk['tanggal'], 4, 2);
                                            $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                            echo substr($hproduk['tanggal'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal'], 0, 4);
                                            ?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count']; ?> kali</i> <i class="fa fa-eye"> <?php echo $hproduk['view_count']; ?> kali</i></p>  
                                    <table class="table table-striped table-bordered">
                                         <tr>
                                            <td width="30%">Judul</td> 
                                            <td width="70%"><?php echo $hproduk['tentang']; ?></td>
                                        </tr>
										<tr>
                                            <th width="30%">Nomor</th> 
                                            <td width="70%"><?php echo $hproduk['noperaturan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Peraturan</td> 
                                            <td><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Ditetapkan</td> 
                                            <td><?php
                                                if ($hproduk['tanggal_penetapan'] != null) {
                                                    $bln = substr($hproduk['tanggal_penetapan'], 4, 2);
                                                    $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                                    echo substr($hproduk['tanggal_penetapan'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal_penetapan'], 0, 4);
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pengundangan</td> 
                                            <td>
                                                <?php
                                                if ($hproduk['tanggal_pengundangan'] != null) {
                                                    $bln = substr($hproduk['tanggal_pengundangan'], 4, 2);
                                                    $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                                    echo substr($hproduk['tanggal_pengundangan'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal_pengundangan'], 0, 4);
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Lembar Negara</td> 
                                            <td width="70%"><?php echo $hproduk['lembar_negara']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Tambahan Lembar Negara</td> 
                                            <td width="70%"><?php echo $hproduk['lembar_negara_tambahan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Nomor Panggil</td> 
                                            <td width="70%"><?php echo $hproduk['nomor_panggil']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">ISBN</td> 
                                            <td width="70%"><?php echo $hproduk['isbn']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Bahasa</td> 
                                            <td width="70%"><?php echo $hproduk['bahasa']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Lokasi</td> 
                                            <td width="70%"><?php echo $hproduk['lokasi']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Berita Negara</td> 
                                            <td width="70%"><?php echo $hproduk['berita_negara']; ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td width="30%">Abstrak</td> 
                                            <td width="70%">
                                                <?php
                                                if (!empty($hproduk['file_abstrak'])) {
                                                    echo anchor('produk_hukum/download_abstrak/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $hproduk['file_abstrak'], '<i class="fa fa-download"></i> ' . $hproduk['file_abstrak'], 'target=_blank');
                                                    echo '&nbsp;&nbsp;<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-abstrak"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td width="30%">Katalog</td> 
                                            <td width="70%"><?php echo $hproduk['katalog']; ?></td>
                                        </tr>-->
                                        <?php
                                        if ($data_detail->num_rows() == '0' and $data_detail_dua->num_rows() == '0') {
                                            ?>
                                            <tr>
                                                <td width="30%">Status</td> 
                                                <td width="70%">
                                                    <?php
                                                    if ($hproduk['status'] == '0') {
                                                        echo 'Aktif';
                                                    } elseif ($hproduk['status'] == '1') {
                                                        echo 'Tidak Aktif';
                                                    } elseif ($hproduk['status'] == '2') {
                                                        echo 'Tidak Aktif Sementara';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </table>
                                    <br/>
                                    <?php
                                    if ($data_detail->num_rows() > 0) {
                                        ?>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($data_detail->result_array() as $dd) {
                                                    ?>
                                                    <tr>
                                                        <td><b>Status</b></td>
                                                        <td><?php echo $dd['status'] == 'mencabut' ? 'Mencabut' : 'Mengubah'; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nomor Peraturan</b></td>
                                                        <td>
                                                            <?php
                                                            $dataperaturanid = $this->Mdl_produk_hukum->get_peraturanid($dd['noperaturan']);
                                                            foreach ($dataperaturanid->result_array() as $dperid) {
                                                                echo anchor(base_url('produk_hukum/view/' . $dperid['peraturan_id']), $dd['noperaturan']);
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tentang</b></td>
                                                        <td><?php echo $dd['tentang']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tanggal Pengundangan</b></td>
                                                        <td><?php echo $dd['tanggal']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if ($data_detail_dua->num_rows() > 0) {
                                        ?>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($data_detail_dua->result_array() as $ddd) {
                                                    ?>
                                                    <tr>
                                                        <td><b>Status</b></td>
                                                        <td>
                                                            <?php
                                                            if ($ddd['status'] == 'mencabut') {
                                                                echo 'Dicabut';
                                                            } elseif ($ddd['status'] == 'mengubah') {
                                                                echo 'Diubah';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $datatentang = $this->Mdl_produk_hukum->get_tentang($ddd['peraturan_id']);
                                                    foreach ($datatentang->result_array() as $dt) {
                                                        ?>
                                                        <tr>
                                                            <td><b>Nomor peraturan</b></td>
                                                            <td><?php echo anchor(base_url('produk_hukum/view/' . $dt['peraturan_id']), $dt['noperaturan']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tentang</b></td>
                                                            <td><?php echo $dt['tentang']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Pengundangan</b></td>
                                                            <td><?php echo substr($dt['tanggal_pengundangan'], 6, 2) . '/' . substr($dt['tanggal_pengundangan'], 4, 2) . '/' . substr($dt['tanggal_pengundangan'], 0, 4); ?></td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                    }
                                    ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Berkas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Berkas Zip</td>
                                                <td>
                                                    <?php
                                                    if (!empty($hproduk['file_zip'])) {
                                                        echo anchor('produk_hukum/download/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $hproduk['file_zip'], '<i class="fa fa-download"></i> ' . $hproduk['file_zip'], 'target=_blank');
                                                    } else {
                                                        echo 'Tidak ada File Zip';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><b>Berkas Parsial</b></td>
                                            </tr>
                                            <tr>
                                                <td>No</td>
                                                <td>PDF</td>
                                            </tr>
                                            <?php
                                            if ($data_file->num_rows() > 0) {
                                                $i = 0;
                                                foreach ($data_file->result_array() as $df) {
                                                    $i++;
                                                    echo '<tr>';
                                                    echo '<td>' . $i . '</td>';
                                                    echo '<td>';
                                                    echo anchor('produk_hukum/download_parsial/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $df['file'], '<i class="fa fa-download"></i> ' . $df['file'], 'target=_blank');
                                                    echo '&nbsp;&nbsp;<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-file' . $i . '"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                            } else {
                                                echo '<tr>';
                                                echo '<td colspan="2">Tidak ada data parsial</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div id="div share" align="right">
                        Share : <br>
                        <img src="<?php echo base_url(); ?>assets/img/core-img/icn_email.png" style="width:60px;height:50px" onclick="tampil_share();">
                    </div><br>
                    <div>
                        Peraturan Terkait:<br>
                        <?php
                        $cr = $this->Mdl_produk_hukum->get_artikel_terkait($hproduk['peraturan_id'], $hproduk['peraturan_category_id']);

                        //echo $hcr['peraturan_id']."<br>";
                        ?>
                        <div class="hero-area" style="margin-top:10px;height:120px;color:#000;">
                            <div class="hero-post-area2" style="background-color:#fff;color:#000">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="hero-post-slide" style="margin-top:18px;color:#000">
                                                <?php
                                                $urut = 1;
                                                foreach ($cr->result_array() as $hcr) {
                                                    ?>
                                                    <div class="single-slide d-flex align-items-center" >
                                                        <div class="post-number" style="color:#000">
                                                            <p><?php echo $urut; ?></p>
                                                        </div>
                                                        <div class="post-title" style="color:#000">
                                                            <a href="#" style="color:#000;"><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hcr['peraturan_category_id']) . "<br>" . $hcr['noperaturan']; ?> </a>
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
                        </div><br><br>
                        <?php ?>
                    </div>
                </div>

            </div>

            <!-- ========== Sidebar Area ========== -->
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
								$get_pp=$this->Mdl_home->get_pp('1');
								foreach ($get_pp as $hpp) {
									?>
									<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
										<!-- Post Content -->
										<div class="post-content" >
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
								$get_pp=$this->Mdl_home->get_pp('2');
								foreach ($get_pp as $hpp) {
									?>
									<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
										<!-- Post Content -->
										<div class="post-content" >
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
								$get_pp=$this->Mdl_home->get_pp('3');
								foreach ($get_pp as $hpp) {
									?>
									<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
										<!-- Post Content -->
										<div class="post-content" >
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
								$get_pp=$this->Mdl_home->get_pp('4');
								foreach ($get_pp as $hpp) {
									?>
									<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
										<!-- Post Content -->
										<div class="post-content" >
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
                                <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                               
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
                                <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                    <!-- Post Content -->
                                    <div class="post-content" >
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
                                <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                    <!-- Post Content -->
                                    <div class="post-content" >
                                        <a href="<?php echo $hutama['linkurl'];?>" target="_blank">
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
                                <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                                    <!-- Post Content -->
                                    <div class="post-content" >
                                        <a href="<?php echo $hterkait['linkurl'];?>" target="_blank">
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
						  <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<div class="post-content" >
								<a href="<?php echo $hterkait['linkurl'];?>" target="_blank">
									<i class="fa fa-bar-chart"></i> Hari ini : <?php echo number_format($stat_today); ?>
                                </a>
                            </div>
                          </div>
						
						<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<div class="post-content" >
								<a href="<?php echo $hterkait['linkurl'];?>" target="_blank">
									<i class="fa fa-bar-chart"></i> Kemarin : <?php echo  number_format($stat_yesterday); ?>
                                </a>
                            </div>
                          </div>
						  
						<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<div class="post-content" >
								<a href="<?php echo $hterkait['linkurl'];?>" target="_blank">
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
<div id="Modal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header"><h4 class="modal-title">Share with email </h4></div>
            <div class="modal-body">
                <div class="group">
                    <input type="text" name="name" id="name" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Enter your name</label>
                </div>

                <div class="group">
                    <input type="text" name="email" id="email" required >
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Enter your mail</label>
                </div>
            </div>
            <div class="modal-footer">

                <p style="font-size:20px;text-align:left" id="lbl_modal1"></p>
                <button type="button" id="btn1"  class="btn btn-primary" data-dismiss="modal" style="width:90px;float:right;">Cancel</button>&nbsp;&nbsp;
                <button type="button" id="btn2"  class="btn btn-primary" data-dismiss="modal" style="width:90px;float:right;">OK</button>&nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-abstrak">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Abstrak</h4>
            </div>
            <div class="modal-body">
                <iframe src="<?php echo site_url('internal/assets/plugins/pdfjs/web/viewer.html?file=') . base_url('internal/assets/assets/produk_abstrak/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $file_abstrak); ?>" style="width:100%; height:600px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
if ($data_file->num_rows() > 0) {
    $i = 0;
    foreach ($data_file->result_array() as $dtfile) {
        $i++;
        ?> 
        <div class="modal fade" id="modal-file<?php echo $i; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">PDF Parsial</h4>
                    </div>
                    <div class="modal-body">
                        <iframe src="<?php echo site_url('internal/assets/plugins/pdfjs/web/viewer.html?file=') . base_url('internal/assets/assets/produk_parsial/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $dtfile['file']); ?>" style="width:100%; height:600px;" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <?php
    }
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').dataTable({
            "paging": true,
            "ordering": false, "searching": false,
            dom: "<'row'<'col-sm-12'tr><'col-sm-4'l><'col-sm-8'p>>"
        });


        window.location = '#div_cari_detail';

    });
    function tampil_share() {
        $('#Modal1').modal({backdrop: 'static', keyboard: false});
    }
</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/css/owlcarousel/owl.carousel.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
$this->load->view("include/footer")?>