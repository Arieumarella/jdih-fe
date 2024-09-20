<?php $this->load->view("include/header");
?>
<script src="<?php echo base_url() ?>/assets/js/owl.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstraphome.js"></script>
<br><br><br><br>

<div class="main-content-wrapper section-padding-20">
	<div class="container">
		<div class="row">
			<!-- ============= Post Content Area Start ============= -->
			<div class="col-12" style="margin-bottom:10px;">
				<?php $this->load->view("widget/list_monograf"); ?>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="Modal_path" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<center>
					<img src="<?php echo base_url() ?>assets/images/loading1.gif" id="gambar1">
				</center>
				<div id="div_pdf" style="display:none"></div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	function panggil_abstrak(kode) {
		$("#gambar1").show();
		$("#div_pdf").empty();
		var isi = '';
		$('#Modal_path').modal({
			backdrop: 'static',
			keyboard: false
		});

		$.ajax({
			url: "<?php echo base_url() ?>/home/get_path_abstrak",
			type: "GET",
			dataType: "json",
			data: {
				peraturan_id: kode
			},
			success: function(result) {
				if (result.respon == "ok") {
					if (result.path == "tidak ada") {
						isi += '<iframe src="<?php echo base_url() ?>NoFile/index/abstrak" height="570" width="520"></iframe>';
						$("#gambar1").hide();
						$("#div_pdf").show();
						$("#div_pdf").append(isi);
					} else {
						isi += '<iframe src="<?php echo base_url() ?>internal/assets/plugins/pdfjs/web/viewer.html?file=' + result.path + '" height="570" width="100%"></iframe>';
						$("#gambar1").hide();
						$("#div_pdf").show();
						$("#div_pdf").append(isi);
					}
				} else {
					$("#gambar1").hide();
					$("#div_pdf").show();
					$("#div_pdf").append("<h2>Maaf, tidak dapat menampilkan file abstrak</h2>")
				}
			},
			error: function() {
				$("#gambar1").hide();
				$("#div_pdf").show();
				$("#div_pdf").append("<h2>Maaf, tidak dapat menampilkan file abstrak</h2>")
			}
		})


	}
</script>

<?php
$this->load->view("include/footer") ?>