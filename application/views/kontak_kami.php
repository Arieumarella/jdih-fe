<?php $this->load->view("include/header");
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
						<label style="color: #fff;margin-top:10px;margin-left:10px">Kontak Kami</label>
					</div>
					<div class="text-center mt-2">
						<p class="judul">Kontak Kami</p>

					</div>
					<div class="panel-body" style="background-color:#fff;">
						<div class="container">
							<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1"><br>
								<div class="row mb-3">
									<div class="col">
										<div class="mapouter mb-3">
											<div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=437&amp;height=400&amp;hl=en&amp;q=Jl. Pattimura No.20,  RT.2/RW.1, Selong, Kby. Baru, Kota Jakarta Selatan, DKI Jakarta 12110,  Indonesia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fnfgo.com/">FNF</a></div>

										</div>
									</div>
									<div class="col">
										<div class="form-title mb-3">Saran dan Komentar</div>
										<input type="hidden" name="tipe" value="Kontak Kami" id="tipe">
										<?php $data['tipe'] = "2";
										$this->load->view("widget/komentar", $data); ?>
									</div>
								</div>
								<div class="col ">
									<div class="card w-50">
										<div class=" card-body">
											<div class="text-center">
												<img src="<?php echo base_url() ?>assets/img/google-maps.png" class="icon-google" alt="">

												<p class="card-text">
													<?php
													foreach ($get_data as $rw) {
													?>
												<div class="slogan"><?php echo $rw['widgetcontent']; ?></div>
											</div>
										<?php
													}
										?>
										</p>
										</div>
									</div>
								</div>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div> <?php $this->load->view("widget/subscribe"); ?></div>
		</div>
	</div>
</div>
<style>
	.icon-google {
		width: 42px;
		height: 42px;
		margin: 0 auto;
		text-align: center;
	}

	#btnkomentar {
		font-size: 15px;
		border-radius: 0px;
		border-color: #0096c7;
		background-color: #0096c7;
		color: white;
		text-align: center;
	}



	.shadow-box {
		box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.3);
	}

	.judul {
		font-size: 1.5em;
		color: black;
		padding: 5px;
		font-family: 'Catamaran', sans-serif;
		font-weight: bold;
	}

	.form-title {
		font-size: 1em;
		padding: 5px;
		text-align: center;
		font-family: 'Catamaran', sans-serif;
		color: #005f73;
		font-weight: bold;
	}

	.mapouter {
		position: relative;
		text-align: right;
		width: 100%;
		height: 400px;
		padding: 0 20px;

	}

	.gmap_canvas {
		overflow: hidden;
		background: none !important;
		width: 100%;
		height: 400px;
	}

	.gmap_iframe {
		height: 400px !important;
	}

	@font-face {
		font-family: 'Catamaran', sans-serif;
		src: url("<?php echo base_url() ?>assets/fonts/Catamaran.ttf")format('truetype');
	}

	.hubungi {
		font-family: 'Abel', sans-serif;
		font-weight: bold;
		font-size: 25px;
	}
</style>
<?php

$this->load->view("include/footer") ?>