<?php $this->load->view("include/header") ?>
<style>
	.dataTables_paginate {
		float: right;margin-top:-20px
	}
</style>
<link rel="stylesheet" href="<?php echo base_url()?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
	 <!-- ********** Hero Area Start ********** -->
    <div class="hero-area" style="margin-top:70px;">

        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel"  id="owl-example">
            <!-- Single Slide -->
			
			<?php
			foreach($get_banner as $hbanner){
				
			?>
				<div class="single-hero-slide bg-img" style="background-image: url(<?php echo base_url();?>assets/assets/banner/<?php echo $hbanner['gambar'];?>);"></div>
            
			<?php	
			}
			?>
            
				
        </div>

        <!-- Hero Post Slide -->
        <div class="hero-post-area" style="">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-post-slide" style="margin-top:18px">
							<?php $urut=1;
							foreach($get_banner_news as $hbanner_news){
								?>
								<div class="single-slide d-flex align-items-center" >
                                <div class="post-number" style="margin-top:-10px">
                                    <p><?php echo $urut;?></p>
                                </div>
                                <div class="post-title">
                                    <a href="single-blog.html"><?php if(strlen($hbanner_news['tentang']) >50){echo substr($hbanner_news['tentang'],0,50)."...<br>".$hbanner_news['noperaturan'];} else{echo $hbanner_news['tentang']."...<br>".$hbanner_news['noperaturan'];}?> </a>
                                </div>
								</div>
								<?php $urut++;
							}
							?>
                            <!-- Single Slide -->
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
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
										
										foreach($get_pp as $combo_pp){
											?><option value="<?php echo $combo_pp['peraturan_category_id'];?>"><?php echo $combo_pp['percategoryname'];?></option>
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
   
    <div class="main-content-wrapper section-padding-20" div="div_isi">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- Catagory Area -->
                        <?php foreach($get_awal_produk as $hproduk){ ?>
						<div class="world-catagory-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="title"><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id'])?> nomor <?php echo $hproduk['noperaturan'];?></li>

                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="div_produk_hukum" role="tabpanel" aria-labelledby="tab1">
                                  <p><i class="fa fa-clock-o"> <?php $bln=substr($hproduk['tanggal'],4,2);
									$bln2=$this->Mdl_produk_hukum->cari_bulan($bln);
									echo substr($hproduk['tanggal'],6,2)." ".$bln2." ".substr($hproduk['tanggal'],0,4);
									?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count'];?> kali</i> <i class="fa fa-eye"> <?php echo $hproduk['view_count'];?> kali</i></p>  
									<table class="table table-striped table-bordered">
									<tr>
									<td width="30%">Nomor</td> 
									<td width="70%"><?php echo $hproduk['noperaturan'];?></td>
									</tr>
									<tr>
									<td>Jenis Peraturan</td> 
									<td><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id']);?></td>
									</tr>
									<tr>
									<td>Tanggal Ditetapkan</td> 
									<td><?php 
									if($hproduk['tanggal_penetapan']!=null){
										$bln=substr($hproduk['tanggal_penetapan'],4,2);
										$bln2=$this->Mdl_produk_hukum->cari_bulan($bln);
										echo substr($hproduk['tanggal_penetapan'],6,2)." ".$bln2." ".substr($hproduk['tanggal_penetapan'],0,4);
									}
									?></td>
									</tr>
									<tr>
									<td>Tanggal Pengundangan</td> 
									<td>
									<?php
										if($hproduk['tanggal_pengundangan']!=null){
										$bln=substr($hproduk['tanggal_pengundangan'],4,2);
										$bln2=$this->Mdl_produk_hukum->cari_bulan($bln);
										echo substr($hproduk['tanggal_pengundangan'],6,2)." ".$bln2." ".substr($hproduk['tanggal_pengundangan'],0,4);
										}
									?>
									</td>
									</tr>
									<tr>
									<td width="30%">Lembar Negara</td> 
									<td width="70%"><?php echo $hproduk['lembar_negara'];?></td>
									</tr>
									<tr>
									<td width="30%">Tambahan Lembar Negara</td> 
									<td width="70%"><?php echo $hproduk['lembar_negara_tambahan'];?></td>
									</tr>
									<tr>
									<td width="30%">Berita Negara</td> 
									<td width="70%"><?php echo $hproduk['berita_negara'];?></td>
									</tr>
									<tr>
									<td width="30%">Tentang</td> 
									<td width="70%"><?php echo $hproduk['tentang'];?></td>
									</tr>
									<tr>
									<td width="30%">Abstrak</td> 
									<td width="70%"><?php echo $hproduk['abstrak'];?></td>
									</tr>
									<tr>
									<td width="30%">Katalog</td> 
									<td width="70%"><?php echo $hproduk['katalog'];?></td>
									</tr>
									<tr>
									<td width="30%">Status</td> 
									<td width="70%">
									<?php
									if($hproduk['status_dicabut_id']!=''){
										echo "<strong>Dicabut :</strong><br>".$hproduk['status_dicabut_id']."<br>".$hproduk['status_dicabut_tentang']."<br>";
									}
									if($hproduk['status_diubah_id']!=''){
										echo "<strong>Diubah :</strong><br>".$hproduk['status_diubah_id']."<br>".$hproduk['status_diubah_tentang']."<br>";
									}
									if($hproduk['status_mencabut_id']!=''){
										echo "<strong>Mencabut :</strong><br>".$hproduk['status_mencabut_id']."<br>".$hproduk['status_mencabut_tentang']."<br>";
									}
									if($hproduk['status_mengubah_id']!=''){
										echo "<strong>Mengubah :</strong><br>".$hproduk['status_mengubah_id']."<br>".$hproduk['status_mengubah_tentang']."<br>";
									}
									?>
									</td>
									</tr>
									<tr>
									<td colspan="2">Pratinjau<br>
								
									<?php
									$p=substr($hproduk['tanggal'],0,4);
									$p2=substr($hproduk['tanggal'],4,2);
									?>
									<iframe src="<?php echo base_url();?>internal/assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url();?>internal/assets/assets/files/peraturan/PermenPUPR/<?php echo $p."/".$p2;?>/<?php echo $hproduk['file_upload'];?>" style="width:100%; height:600px;" frameborder="0"></iframe>
									</td>
									</tr>
									
									</table>
									

                                    
                                </div>

                            </div>
                        </div>
						<?php
						}
						?>
                    </div>
                </div>

                <!-- ========== Sidebar Area ========== -->
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="post-sidebar-area">
						 <!-- Widget Area -->
                        <div class="sidebar-widget-area" id="jenis_produk_hukum">
                            <h5 class="title">Jenis Produk Hukum</h5>
                            <div class="widget-content">
								<?php
								foreach($get_pp as $hpp){
									?>
									<div class="single-blog-post post-style-2 d-flex align-items-center widget-post"  style="min-height:50px">
									<!-- Post Content -->
                                    <div class="post-content" >
                                        <a href="#" class="headline" onclick="cari_jenis('<?php echo $hpp['peraturan_category_id'];?>')">
                                            <h5 class="mb-0"><?php echo $hpp['percategoryname'];?></h5>
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
                        <div class="sidebar-widget-area">
                            <h5 class="title">Produk Hukum Terpopuler</h5>
                            <div class="widget-content">
								<?php
								foreach($get_produk_populer as $hpopuler){
									?>
									<div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
									<!-- Post Thumbnail -->
									<div class="post-thumbnail">
										<img src="<?php echo base_url();?>assets/img/core-img/icon3.png" alt="">
									</div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="#" class="headline">
                                            <h5 class="mb-0"><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hpopuler['peraturan_category_id'])?> nomor <?php echo $hpopuler['noperaturan'];?></h5>
											<i class="fa fa-download"> <?php echo $hpopuler['download_count'];?> kali</i>
                                        </a>
                                    </div>
									</div>
									<?php
								}
								?>
                                
                            </div>
                        </div>
                        <!-- Widget Area -->
                        <div class="sidebar-widget-area">
                            <h5 class="title">Unit Organisasi dan Kerja</h5>
                            <div class="widget-content">
                                <!-- Single Blog Post -->
								<?php
								foreach($get_unit as $hunit){
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
	$(document).ready(function() {
		
		   
	} );
</script>
<script src="<?php echo base_url()?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
$this->load->view("include/footer")?>