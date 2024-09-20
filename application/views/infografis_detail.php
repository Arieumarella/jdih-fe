<?php $this->load->view("include/header");

$rw = '';
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/OwlCarousel/owl.carousel.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/OwlCarousel/owl.theme.default.min.css" />

<br><br><br><br><?php

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
						<label style="color: #fff;margin-top:10px;margin-left:10px">Info Grafis</label>
					</div>

					<div class="panel-body" style="background-color:#fff;">
						<div class="container">
							<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1">
								<div class="owl-carousel owl-theme">
									<?php for($i = 1; $i <= 5; $i++) : ?>
									<?php if ( !empty(trim(@$get_data["gambar_{$i}"])) ) : ?>
										<div class="item">
											<img class="d-block w-100" src="<?= base_url() ?>internal/assets/assets/infografis/<?= $get_data["gambar_{$i}"]; ?>">
										</div>
									<?php endif; ?>
									<?php endfor; ?>
								</div>

								<div><?= @$get_data["isi"]; ?></div>
							</div>
						</div>
					</div>
				</div>

			</div>



		</div>


	</div>
</div>
<script src="<?php echo base_url(); ?>assets/OwlCarousel/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('.owl-carousel').owlCarousel({
			loop:true,
			margin:10,
			nav:true,
			items : 1
		});
	});
</script>



<?php
$this->load->view("include/footer"); ?>