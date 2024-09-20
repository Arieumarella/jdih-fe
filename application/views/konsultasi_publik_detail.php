<?php $this->load->view("include/header");
$rw = '';
function get_nama_hari($hari)
{
		$nama_hari = '';

		switch ($hari) {
				case 'Sun':
						$nama_hari = "Minggu";
				break;
 
				case 'Mon':			
						$nama_hari = "Senin";
				break;
 
				case 'Tue':
						$nama_hari = "Selasa";
				break;
 
				case 'Wed':
						$nama_hari = "Rabu";
				break;
 
				case 'Thu':
						$nama_hari = "Kamis";
				break;
 
				case 'Fri':
						$nama_hari = "Jumat";
				break;
 
				case 'Sat':
						$nama_hari = "Sabtu";
				break;
		}
		return $nama_hari;
}
?><br><br><br><br><?php

					//$this->load->view("widget/pencarian_cepat");
					?>
<style>
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    overflow-y : scroll;
}

</style>
<div class="main-content-wrapper section-padding-20">
	<div class="container">
		<div class="row justify-content-center">
			<!-- ============= Post Content Area Start ============= -->
			<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">

				<!-- Catagory Area -->
				<div id="div_content" style="display:block">
					<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
					<h5 class="p-2 text-white" style="background-color: #45678d;">Konsultasi Publik</h5>
					</div>

					<div class="panel-body" style="background-color:#fff;">
						<div class="container">
							<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1">
								<?php $data_durasi = $this->db->query("SELECT * from tb_konsultasi_publik_durasi")->row();
										$durasi = !empty($data_durasi) ? $data_durasi->durasi : 0;
									 foreach ($get_data->result_array() as $rw) : 
								?>
									<div style="font-size:20px;">
										<strong> <?php echo $rw['judul']; ?> </strong>
									</div>
									<br style="font-size:13px;">
									<?php echo $rw['pokok_pikiran']; ?>
									<br>
									<strong>Konsultasi publik akan di tutup pada hari
									<?php
										$date = date('D', strtotime($rw['durasi']));
										echo get_nama_hari($date);
									?> Tanggal <?=date('d/m/Y', strtotime($rw['durasi']));?>
									</strong>
								<?php endforeach ?>
							</div>
							<hr>
							<div>
									<h5 class="p-2 text-white" style="background-color: #45678d;">Daftar File</h5>
									<table class="table table-bordered table-striped">
											<thead>
													<tr>
															<th width="40%">Name</th>
															<th>Keterangan</th>
													</tr>
											</thead>
											<tbody id="table">
											<?php 
													$konsultasi_publik_file = $this->db->query("SELECT * FROM tb_konsultasi_publik_file WHERE id_konsultasi_publik=$id")->result_array();
													if(!empty($konsultasi_publik_file)){ foreach($konsultasi_publik_file as $key => $row){
											?>
											<tr id="<?=$key+1?>">
													<td>
															<input type="hidden" id="con" value="<?=$key+1?>">
															<button type="button" class="btn btn-primary openModal" data-file="<?=$row['file']?>"><i class="fas fa-file-pdf"></i></button>&nbsp;&nbsp; <?= substr($row['file'], 14);?>
													</td>
													<td>
														<?=$row['keterangan']?>
													</td>
											</tr>
											<?php }} ?>
											</tbody>
									</table>
							</div>
							<hr>
							<div>
								<h5 class="p-2 text-white" style="background-color: #45678d;">Daftar Komentar</h5>
								<ul class="list-group mb-2">
										<?php foreach ($get_komentar as $item) : ?> 
												<li class="list-group-item">
														<div class="font-weight-bold"><i class="fas fa-user-alt"></i>&nbsp;&nbsp;<?= $item['nama'] ?></div> 
														<p class="" style="border-bottom: 1px solid lightgray; border-radius : 3px; padding: 2px 4px 2px 4px"><?= $item['komentar'] ?></p>
														<?php foreach ($this->Mdl_fungsi->get_balasan_komentar($item['id']) as $balasan) : ?>
																<p style="border-bottom: 1px solid lightgray; border-radius : 3px; padding-left: 30px">
																		<strong><i class="fas fa-user-alt"></i>&nbsp;&nbsp; JDIH Kementerian PUPR</strong>
																		<?= $balasan['komentar'] ?>
																</p>
														<?php endforeach ?>
													<!-- <div class="text-right d-flex justify-content-start">
																<button type="button" class="btn btn-sm btn-info">Balas</button>
														</div> -->
												</li>
										<?php endforeach ?>
								</ul>
							</div>
							<hr>
							<?php
								$konsultasiPubliId = $id; 
								$this->load->view('widget/komentar_konsultasi_publik'); ?>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal">
	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
					<div class="modal-header pb-0">
							<h4 class="card-title" style="margin-top:-10px;">
									Preview
									<small class="card-subtitle">
											<span class="fill-doc-name"
													style="display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px;"></span>
									</small>

							</h4>
							<button type="button" class="close" id="closeModal">
									<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body pt-0">

							<!-- <div class="preview-placeholder card-body pdf-viewer">
									<div class="pdf-link"></div>
							</div>

							<div class="preview-placeholder card-body pdf-viewer">
									<div class="pdf-link"></div>
							</div> -->

							<!-- HTML View PDF Using Canvas -->
							<div id="pdfSection" class="pdf-viewer">
									<div id="pdfContentViewer" style="display: none;">
											<div class="row mb-4">
													<div class="col-md-12 text-center">
													<canvas id="the-canvas" style="border-radius: 10px; border: 1px solid black; direction: ltr;"></canvas>
													</div>
											</div>

											<div class="row my-4">
													<div class="col-sm-4 text-center text-sm-start">
															<span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
													</div>
													<div class="col-sm-8 text-center text-sm-end">
													<button id="prev" class="btn btn-sm btn-primary">Previous</button>
													<button id="zoomOut" class="btn btn-sm"><i class="fa fa-minus"></i></button>
													<button id="zoomIn" class="btn btn-sm"><i class="fa fa-plus"></i></button>
													<button id="next" class="btn btn-sm btn-primary">Next</button>
													</div>
											</div>
									</div>
									<div id="pdfContentNotFound" style="display: none;">
											<div class="row mb-4">
													<div class="col-12 text-center">
													<span class="text-muted">Dokumen tidak ditemukan</span>
													</div>
											</div>
									</div>
							</div>
							<!-- HTML View PDF Using Canvas -->

					</div>
			</div>
	</div>
</div>
<script src="<?php echo base_url() ?>internal/assets/plugins/pdfjs-3.9.179-dist/build/pdf.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/pdfjs-3.9.179-dist/build/initiate.js"></script>
<script>
	    const modal = document.getElementById("modal");
    const closeModalButton = document.getElementById("closeModal");

    $('.openModal').click(function (e){
        $('#modal').show();
        setPDFUrl("<?php echo base_url(); ?>internal/assets/assets/konsultasi_publik/"+e.target.getAttribute("data-file"));
        $('.fill-doc-name').html(e.target.getAttribute("data-file"))
    });

    closeModalButton.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    pdfjsLib.GlobalWorkerOptions.workerSrc = "<?php echo base_url() ?>internal/assets/plugins/pdfjs-3.9.179-dist/build/pdf.worker.js"; 
    
    function setPDFUrl(urlContent = ''){
        if(urlContent == '') {
            $('#pdfContentNotFound').show();
            $('#pdfContentViewer').hide();
            return false;
        }

        url = urlContent;

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });

        $('#pdfContentViewer').show();
    }
</script>
<?php
$this->load->view("include/footer"); ?>