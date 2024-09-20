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
						<label style="color: #fff;margin-top:10px;margin-left:10px">Struktur Organisasi</label>
					</div>

					<div class="panel-body" style="background-color:#fff;">
						<div class="container">
							<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1"><br>
								<h2>JDIH KEMENTERIAN PUPR</h2>
								<br>
								<p>Organisasi JDIH Kementerian PUPR sesuai dengan Peraturan Menteri Pekerjaan Umum dan Perumahan Rakyat Nomor 31/PRT/M/2016 Tentang Jaringan Dokumentasi dan Informasi Hukum Kementerian Pekerjaan Umum dan Perumahan Rakyat, terdiri dari:</p>
								<p>1. Pusat JDIH yaitu Biro Hukum Sekretariat Jenderal.</p>
								<p>2. Anggota JDIH yaitu Unit Kerja yang memiliki tugas dan fungsi pengelolaan JDIH PUPR di Unit Organisasi.</p>
								<br>
								<a><img border="0" alt="strukturorganisasi" src="<?php echo base_url() ?>assets/img/StrukturOrganisasi.png"></a>
							</div>
						</div>
					</div>
				</div>

			</div>


			<div> <?php $this->load->view("widget/subscribe"); ?></div>
		</div>


	</div>
</div>


<?php
$this->load->view("include/footer") ?>