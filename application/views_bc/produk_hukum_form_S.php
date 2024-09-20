<?php $this->load->view("include/header") ?>
<style>
    .dataTables_paginate {
        float: right;margin-top:-20px
    }
	
	
    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(1.8,1.8);
        }
        to {
            -webkit-transform: scale(1, 1);
        }
    }

    @keyframes zoom {
        from {
            transform: scale(1.8,1.8);
        }
        to {
            transform: scale(1, 1);
        }
    }
	
	@media screen and (max-width: 479px) {
        .img_banner{object-fit: cover;-webkit-animation: zoom 20s;animation: zoom 20s;width:100%;height:300px;}
		.caption{
			margin-top:-180px;color:#fff;font-size:14px;font-weight:bold;width:80%;text-align:center; background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
		}
    }

    @media screen and (min-width: 480px) and (max-width: 640px){
        .img_banner{object-fit: cover;-webkit-animation: zoom 20s;animation: zoom 20s;width:100%;height:300px;}
		.caption{
			margin-top:-180px;color:#fff;font-size:14px;font-weight:bold;width:80%;text-align:center; background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
		}
    }

    @media screen and (min-width: 641px) {
        .img_banner{object-fit: cover;-webkit-animation: zoom 20s;animation: zoom 20s;width:100%;height:600px;}
		.caption{
			margin-top:-350px;color:#fff;font-size:25px;font-weight:bold;width:80%;text-align:center; background-image: url("<?php echo base_url(); ?>assets/img/core-img/footer_caption.png");
		}
    }
</style>
<style>
/* unvisited link */
 a.linka:link {
  color: blue;font-size:14px;
}

/* visited link */
 a.linka:visited {
  color: black;font-size:14px;
}

/* mouse over link */
a.linka:hover {
  color: blue;font-size:14px;
}

/* selected link */
 a.linka:active {
  color: blue;font-size:14px;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/swipe/css/swiper.css">
<script src="<?php echo base_url();?>assets/plugin/swipe/js/swiper.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owlcarousel/assets/owl.theme.default.min.css">
<!-- ********** Hero Area Start ********** -->
<div class="swiper-container">
  <div class="swiper-wrapper">
        <?php
        $n = 1;
        foreach ($get_banner as $hbanner) {
            if ($n == 1) {
                ?>
                <div class="swiper-slide">
					 
					<img  class="img_banner" src="<?php echo base_url(); ?>assets/assets/banner/<?php echo $hbanner['gambar']; ?>" >
                   <center>
						<div class="caption"  data-swiper-parallax="-100">Selamat Datang<br>di Website Jaringan Dokumentasi dan Informasi Hukum Kementerian PUPR</div>
                   </center>

                   
                </div>
                <?php
            } else {
                ?>
                <div class="swiper-slide">
					<img  class="img_banner"  src="<?php echo base_url(); ?>assets/assets/banner/<?php echo $hbanner['gambar']; ?>">
					
                </div>
                <?php
            }
            $n++;
            ?>


            <?php
        }
        ?>


    </div>
    <div class="swiper-pagination"></div>
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
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
                                    <a href="<?php echo base_url().'produk_hukum/view/'.$hbanner_news['peraturan_id']; ?>"><?php
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
<section class="contact-area section-padding-20" >
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

            <div class="" id="div_cari_cepat" style="display:none;width:100%">
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
<?php foreach ($get_awal_produk as $hproduk) { ?>
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
                                            <td width="30%">Nomor</td> 
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
                                            <td width="30%">Berita Negara</td> 
                                            <td width="70%"><?php echo $hproduk['berita_negara']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Tentang</td> 
                                            <td width="70%"><?php echo $hproduk['tentang']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Abstrak</td> 
                                            <td width="70%"><?php echo $hproduk['abstrak']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Katalog</td> 
                                            <td width="70%"><?php echo $hproduk['katalog']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Status</td> 
                                            <td width="70%">
                                                <?php
                                                if ($hproduk['status_dicabut_id'] != '') {
                                                    echo "<strong>Dicabut :</strong><br>" . $hproduk['status_dicabut_id'] . "<br>" . $hproduk['status_dicabut_tentang'] . "<br>";
                                                }
                                                if ($hproduk['status_diubah_id'] != '') {
                                                    echo "<strong>Diubah :</strong><br>" . $hproduk['status_diubah_id'] . "<br>" . $hproduk['status_diubah_tentang'] . "<br>";
                                                }
                                                if ($hproduk['status_mencabut_id'] != '') {
                                                    echo "<strong>Mencabut :</strong><br>" . $hproduk['status_mencabut_id'] . "<br>" . $hproduk['status_mencabut_tentang'] . "<br>";
                                                }
                                                if ($hproduk['status_mengubah_id'] != '') {
                                                    echo "<strong>Mengubah :</strong><br>" . $hproduk['status_mengubah_id'] . "<br>" . $hproduk['status_mengubah_tentang'] . "<br>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Pratinjau<br>

                                                <?php
                                                $p = substr($hproduk['tanggal'], 0, 4);
                                                $p2 = substr($hproduk['tanggal'], 4, 2);
                                                ?>
                                                <iframe src="<?php echo base_url(); ?>internal/assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url(); ?>internal/assets/assets/files/peraturan/PermenPUPR/<?php echo $p . "/" . $p2; ?>/<?php echo $hproduk['file_upload']; ?>" style="width:100%; height:600px;" frameborder="0"></iframe>
                                            </td>
                                        </tr>

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
 <div class="col-12 col-md-8 col-lg-4" >
                <div class="post-sidebar-area">
                    <!-- Widget Area -->
                    <div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.2s" id="jenis_produk_hukum">
                       
						 <div class="card">
							<div class="card-header" id="headingOne">
							  <h2 class="mb-0">
								<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         
								   <h5><label style="color:#000">Jenis Produk Hukum</label></h5>
								</button>
							  </h2>
							</div>
							 <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
    		<div class="card-body">
									
										<?php
										foreach ($get_pp as $hpp) {
											?>
												<div style="border-bottom:1px solid #f5f2f2">
													<a href="#" class="linka" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
														<?php echo $hpp['percategoryname']; ?>
													</a><br>
												</div>
											<?php
										}
										?>

									
							  </div>
							</div>
						  </div>
		  
                       
                    </div>
					
					<div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.4s">
							 <div class="card">
								<div class="card-header" id="heading2">
								  <h2 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
			 
									   <h5><label style="color:#000">Unit Organisasi dan Kerja</label></h5>
									</button>
								  </h2>
								</div>
								 <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordionExample">
								<div class="card-body">
										
											<?php
											foreach ($get_unit as $hunit) {
												?>
												<div style="border-bottom:1px solid #f5f2f2">
														<a href="#" class="linka" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id']; ?>')">
															<?php echo $hunit['deptname']; ?>
														</a><br>
												</div>	
												<?php
											}
											?>

										
								  </div>
								</div>
							  </div>
			  
						   
					</div>
					<br>
					<div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.4s">
							 <div class="card">
								<div class="card-header" id="heading3">
								  <h2 class="mb-0">
									<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
        
									   <h5><label style="color:#000">Link Utama</label></h5>
									</button>
								  </h2>
								</div>
								<div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
									<div class="card-body">
										
											<?php
											foreach ($get_link_utama as $hutama) {
												?>
												<div style="border-bottom:1px solid #f5f2f2">
														<a href="<?php echo $hutama['linkurl']; ?>" class="linka" style="color:#000;">
															<?php echo $hutama['linkname']; ?>
														</a><br>
												</div>	
												<?php
											}
											?>

										
								  </div>
								</div>
							  </div>
			  
						   
					</div>
					
					<div class="sidebar-widget-area wow fadeInUpBig" data-wow-delay="0.4s">
						<script type="text/javascript" src="//codice.shinystat.com/cgi-bin/getcod.cgi?USER=sandyjdih"></script>
						<noscript>
						<h6><a href="http://www.shinystat.com">
						<img src="//www.shinystat.com/cgi-bin/shinystat.cgi?USER=sandyjdih" alt="Free web counters" style="border:0px" /></a></h6>
						</noscript>
					</div>
					
                    <!-- Widget Area -->

                    <!-- Widget Area -->
                   
					
                    <!-- Widget Area -->

                    <!-- Widget Area -->

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
<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').dataTable({
            "paging": true,
            "ordering": false, "searching": false,
            dom: "<'row'<'col-sm-12'tr><'col-sm-4'l><'col-sm-8'p>>"
        });


        window.location = '#div_cari_detail';
		var swiper = new Swiper('.swiper-container', {
		zoom:true,
		effect:"fade",
		spaceBetween: 50,
		centeredSlides: true,
		 autoplay: {
			delay: 14000,
		  },
		
		  pagination: {
			el: '.swiper-pagination',
			clickable: true,
		  },
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },loop: true,
		  fadeEffect: {
			crossFade: true
		  }
		
		});
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