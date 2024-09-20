<?php $this->load->view("include/header");
$rw = '';
?><br><br><br><br><?php

									//$this->load->view("widget/pencarian_cepat");
									?>

<div class="main-content-wrapper section-padding-20">
	<div class="container">
		<div class="row justify-content-center">
			<!-- ============= Post Content Area Start ============= -->
			<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">

				<!-- Catagory Area -->
				<div id="div_content" style="display:block">
					<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
						<label style="color: #fff;margin-top:10px;margin-left:10px">Berita</label>
					</div>

					<div class="panel-body" style="background-color:#fff;">
						<div class="container">
							<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1">

								<?php
								foreach ($get_data->result_array() as $rw) {
								?>
									<div style="font-size:20px;">
										<img src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rw['gambar_1']; ?>" style="width:100%;object-fit:cover"><strong>
											<?php echo $rw['judul']; ?></strong>
									</div><br style="font-size:13px;">
									<?php echo $rw['isi']; ?><br>

									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="display:none">
										<ol class="carousel-indicators">
											<?php if ($rw['gambar_1'] != '') { ?><li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
											<?php } ?>
											<?php if ($rw['gambar_2'] != '') { ?><li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
											<?php } ?>
											<?php if ($rw['gambar_3'] != '') { ?><li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
											<?php } ?>
											<?php if ($rw['gambar_4'] != '') { ?><li data-target="#carouselExampleIndicators" data-slide-to="3" class=""></li>
											<?php } ?>
											<?php if ($rw['gambar_5'] != '') { ?><li data-target="#carouselExampleIndicators" data-slide-to="4" class=""></li>
											<?php } ?>

										</ol>
										<div class="carousel-inner">
											<?php
											if ($rw['gambar_1'] != '') {
											?>
												<div class="carousel-item active">
													<img class="d-block w-100" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rw['gambar_1']; ?>">
												</div>
											<?php
											}
											?>
											<?php
											if ($rw['gambar_2'] != '') {
											?>
												<div class="carousel-item">
													<img class="d-block w-100" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rw['gambar_2']; ?>">
												</div>
												<?php
											}
												?><?php
											if ($rw['gambar_3'] != '') {
											?>
												<div class="carousel-item">
													<img class="d-block w-100" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rw['gambar_3']; ?>">
												</div>
												<?php
											}
												?><?php
											if ($rw['gambar_4'] != '') {
											?>
												<div class="carousel-item">
													<img class="d-block w-100" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rw['gambar_4']; ?>">
												</div>
												<?php
											}
												?><?php
											if ($rw['gambar_5'] != '') {
											?>
												<div class="carousel-item">
													<img class="d-block w-100" src="<?php echo base_url() ?>internal/assets/assets/berita/<?php echo $rw['gambar_5']; ?>">
												</div>
											<?php
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

								<?php
								}
								?>



							</div>
						</div>
					</div>
				</div>

			</div>



		</div>


	</div>
</div>



<?php
$this->load->view("include/footer"); ?>