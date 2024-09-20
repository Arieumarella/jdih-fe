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
				<?php $this->load->view("widget/list_SiMPeL"); ?>
			</div>
		</div>
	</div>
</div>

<!-- Modal Proleg dan Progsun-->
<div class="modal fade" id="Modal_progres" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body" >
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung B03</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_b03">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung B06</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_b06">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung B09</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_b09">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung B12</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_b12">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal IP-->
<div class="modal fade" id="Modal_progres_ip" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body" >
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung Perencanaan</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_perencanaan">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung Penyusunan</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_penyususnan">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung Pembahasan</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_pembahasan">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung Penetapan</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_progres_penetapan">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal UU -->
<div class="modal fade" id="Modal_progres_uu" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body" >
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung B03</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_uu_b03">
							
						</tbody>
					</table>

					<br>

					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Data Dukung B06 - B12</th>
							</tr>
						</thead>
						<tbody id="modal_tabel_uu_b06">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


</div>
<script>
	$( document ).ready(function() {
		shwoModal = function (idPeraturan) {
			let kd_jns_peraturan = '<?= $kd_jns_peraturan; ?>';

			$.ajax({
				url: "<?php echo base_url() ?>/SiMPeL/getDataDukung",
				type: "POST",
				dataType: "json",
				data: {
					idPeraturan,
					kd_jns_peraturan
				},
				success: function(res) {
					let tbl1 = '',
					tbl2 = '',
					tbl3 = '',
					tbl4 = '';

					// Progsun & Proleg
					if (kd_jns_peraturan == '1' || kd_jns_peraturan == '2') {

						$.each(res.b03, function(key, val) {

							tbl1 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b06, function(key, val) {

							tbl2 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b09, function(key, val) {

							tbl3 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b12, function(key, val) {

							tbl4 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$('#modal_tabel_progres_b03').html(tbl1);
						$('#modal_tabel_progres_b06').html(tbl2);
						$('#modal_tabel_progres_b09').html(tbl3);
						$('#modal_tabel_progres_b12').html(tbl4);

						$('#Modal_progres').modal('show');

					}

					// IP
					if (kd_jns_peraturan == '3' || kd_jns_peraturan == '4') {

						$.each(res.b03, function(key, val) {

							tbl1 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b06, function(key, val) {

							tbl2 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b09, function(key, val) {

							tbl3 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b12, function(key, val) {

							tbl4 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$('#modal_tabel_progres_perencanaan').html(tbl1);
						$('#modal_tabel_progres_penyususnan').html(tbl2);
						$('#modal_tabel_progres_pembahasan').html(tbl3);
						$('#modal_tabel_progres_penetapan').html(tbl4);

						$('#Modal_progres_ip').modal('show');

					}


					// UU
					if (kd_jns_peraturan == '5') {

						$.each(res.b03, function(key, val) {

							tbl1 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});

						$.each(res.b06, function(key, val) {

							tbl2 += `<tr><td class="text-${val.path && val.path.trim() !== '' ? 'success' : 'danger'}"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><i class=" ${val.path && val.path.trim() !== '' ? 'fas fa-check' : 'fas fa-times'}"></i> ${val.nama}</td></tr>`;
							
						});


						$('#modal_tabel_uu_b03').html(tbl1);
						$('#modal_tabel_uu_b06').html(tbl2);

						$('#Modal_progres_uu').modal('show');

					}



				},
				error: function() {
					alert('Error.!');
				}
			})
}
});


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