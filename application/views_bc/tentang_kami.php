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
						<label style="color: #fff;margin-top:10px;margin-left:10px">Tentang Kami</label>
					</div>

					<div class="panel-body" style="background-color:#fff;">
						<div class="container">
							<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1"><br>

								<?php
								foreach ($get_data as $rw) {
								?>
									<div style="font-size:40px;"><?php echo $rw['widgetcontent']; ?></div><br>
									<?php echo $rw['widgetmore']; ?><br>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div>
				<?php $this->load->view("widget/subscribe"); ?>
			</div>

		</div>

	</div>
</div>


<?php
$this->load->view("include/footer") ?>