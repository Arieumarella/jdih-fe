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
                                <table id="example2" class=" " width="100%" border=0	> 
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
                                        <?php $urut=1;
                                        foreach ($get_awal_produk as $hproduk) {
                                            ?>
                                            <tr>
                                                <td  style="border-top:0px;min-height:50px">
                                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                                        <!-- Post Thumbnail -->

                                                        <!-- Post Content -->
                                                        <div class="post-content" style="margin-left:10px;min-height:50px;margin-top:5px">
                                                            <a href="<?php echo base_url(); ?>produk_hukum/view/<?php echo $hproduk['peraturan_id']; ?>" class="headline">
                                                                <h6><?php echo $this->Mdl_home->cari_peraturan_id($hproduk['peraturan_category_id']) ?> nomor <?php echo $hproduk['noperaturan']; ?>
																<?php if ($hproduk['status_mencabut_id'] == "") { ?><img src="<?php echo base_url() ?>assets/img/core-img/icon1.png" style="width:15px;height:15px;margin-left:10px"><?php } else { ?><img src="<?php echo base_url() ?>assets/img/core-img/icon2.png" style="width:15px;height:15px;margin-left:10px"><?php } ?></h6>

                                                            </a>
                                                            <?php echo $hproduk['tentang']; ?>
                                                            <!-- Post Meta -->
                                                            <div class="post-meta">
                                                                <p><i class="fa fa-clock-o"> <?php
                                                                        $bln = substr($hproduk['tanggal'], 4, 2);
                                                                        $bln2 = $this->Mdl_home->cari_bulan($bln);
                                                                        echo substr($hproduk['tanggal'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal'], 0, 4)
                                                                        ?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count']; ?> kali</i></p>
                                                            </div>
                                                        </div>
														<input type="hidden" id="peraturan_<?php echo $urut;?>" value="<?php echo $this->Mdl_home->cari_peraturan_id($hproduk['peraturan_category_id']);?>">
														<input type="hidden" id="noperaturan_<?php echo $urut;?>" value="<?php echo $hproduk['noperaturan'];?>">
														<input type="hidden" id="katalog_<?php echo $urut;?>" value="<?php echo $hproduk['katalog'];?>">
														<input type="hidden" id="abstrak_<?php echo $urut;?>" value="<?php echo $hproduk['abstrak'];?>"><br>
                                                        <div style="position: absolute;right:0;bottom:0;margin-bottom:5px;margin-right:10px">
                                                            <a href="#" class="btn btn-primary" style="font-size:12px" onclick="get_katalog('<?php echo $urut;?>')"><i class="fa fa-list"></i> Katalog</a> | 
															<a href="#" class="btn btn-primary" style="font-size:12px" onclick="get_abstrak('<?php echo $urut;?>')"><i class="fa fa-eye"></i> Abstrak</a> | 
                                                            <a href="#" class="btn btn-primary" style="font-size:12px"><i class="fa fa-download"></i> Unduh</a><br>
                                                        </div>

                                                    </div><br>
                                                </td>
                                            </tr>
                                            <?php
											$urut++;
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

                </div>
            </div>
        </div>


    </div>
</div>
<div id="modal1" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width:90%">
				<!-- Modal content-->
		<div class="modal-content" >
		  <div class="modal-header"><h4 class="modal-title">Abstrak </h4></div>
		  <div class="modal-body">
			
				<div id="isi_abstrak"></div>
			
		  </div>
		  <div class="modal-footer">
			   <button type="button"  class="btn btn-primary" data-dismiss="modal"  style="">Tutup</button>
		  </div>
		</div>
	</div>
  </div>
  
  
  <div id="modal2" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width:90%">
				<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header"><h4 class="modal-title">Katalog </h4></div>
		  <div class="modal-body">
			
				<div id="isi_katalog"></div>
			
		  </div>
		  <div class="modal-footer">
			   <button type="button"  class="btn btn-primary" data-dismiss="modal"  style="">Tutup</button>
		  </div>
		</div>
	</div>
  </div>
<script type="text/javascript">
	function get_abstrak(urut){
		$('#modal1').modal({backdrop: 'static',keyboard: false});
        $("#isi_abstrak").empty();
		var isi=document.getElementById("abstrak_"+urut+"").value;
		$("#isi_abstrak").append(isi);
		
		
	}
	
	function get_katalog(urut){
		$('#modal2').modal({backdrop: 'static',keyboard: false});
        $("#isi_katalog").empty();
		var isi='';
		isi +=document.getElementById("peraturan_"+urut+"").value +"<br>";
		isi +=document.getElementById("noperaturan_"+urut+"").value +"<br>";
		isi +=document.getElementById("katalog_"+urut+"").value;
		$("#isi_katalog").append(isi);
		
		
	}
	
    $(document).ready(function () {
		$('#example2').dataTable({
            "paging": true,
            "ordering": false, "searching": false,
            dom: "<'row'<'col-sm-12'tr><'col-sm-4'l><'col-sm-8'p>>"
        });
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
</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/css/owlcarousel/owl.carousel.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
$this->load->view("include/footer")?>