<?php $query = $this->db->get("tb_recaptcha")->result_array();
$sitekey = $query[0]['sitekey']; ?>

<script src='https://www.google.com/recaptcha/api.js'></script>
<div id="isi_komentar">
    <form id="myForm">
        <div id="result_komentar">
            <center>
                <div class="alert alert-danger mb-4" style="display:none" id="alert_danger" role="alert">Komentar gagal dikirim!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
                <div class="alert alert-success mb-4" style="display:none" id="alert_success" role="alert">Komentar berhasil dikirim!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
            </center>
        </div>
        <div class="group">
            <input type="text" name="email_komentar" id="email_komentar" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Email <b class="text-danger">*</b></label>
        </div>
        <div class="group">
            <input type="text" name="name_komentar" id="name_komentar" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Nama <b class="text-danger">*</b></label>
        </div>
        <div class="group">
            <input type="hidden" name="peraturan_id" id="peraturan_id" value="<?php echo @$peraturan_id; ?>">
            <input type="hidden" id="appi" value="">
            <input type="hidden" name="tipe" value=<?php echo $tipe ?> id="tipe">
            <textarea name="komentar" id="komentar" cols="30" rows="10"></textarea>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Saran / Komentar</label>
        </div>
        <div <?php if ($tipe == "2") { ?> style="display: none;" <?php } ?>>
            <div class="form-group">
                <label style="font-size: 13px;">Berkas <b class="text-danger"></b></label>
                <input type="file" class="form-control-file" name="berkas" id="berkas" accept=".pdf">
            </div>
        </div>
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="<?= $sitekey ?>"></div>
        </div>
        <br>
        <label id="lblinfo_komentar" style="color:red;"></label>
        <div class="text-center">
            <button id="btnkomentar" class="btn btn-primary" type="submit">Kirim Komentar</button>&nbsp;&nbsp;
        </div>

    </form>
</div>
<div id="modal-komentar" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-komentar"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Baik</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            var nama = document.getElementById("name_komentar").value;
            var email = document.getElementById("email_komentar").value;
            var komentar = document.getElementById("komentar").value;
            var tipe = document.getElementById("tipe").value;
            var file = document.getElementById("berkas").value;
            var peraturan_id = document.getElementById("peraturan_id").value;

            document.getElementById("lblinfo_komentar").innerHTML = '';
            if (nama == "") {
                document.getElementById("lblinfo_komentar").innerHTML = "Nama tidak boleh kosong";
            } else if (email == "") {
                document.getElementById("lblinfo_komentar").innerHTML = "Email tidak boleh kosong";
            } else if (komentar == "") {
                document.getElementById("lblinfo_komentar").innerHTML = "Komentar tidak boleh kosong";
            } else if ((email.indexOf('@', 0) == -1) || (email.indexOf('.', 0) == -1)) {
                document.getElementById("lblinfo_komentar").innerHTML = "Format Email Salah";
            } else if (grecaptcha.getResponse() == "") {
                document.getElementById("lblinfo_komentar").innerHTML = "g-recaptcha tidak boleh kosong";
            } else {
                if (tipe == "1") {
                    if ($('#berkas').get(0).files.length != 0) {
                        var file_size = $('#berkas')[0].files[0].size;
                        if (file_size > 6143000) {
                            document.getElementById("lblinfo_komentar").innerHTML = "File Tidak Boleh Lebih Dari 5 MB";
                            $('#berkas').val('');
                        } else if (!(/\.(pdf)$/i).test(file)) {
                            document.getElementById("lblinfo_komentar").innerHTML = "File Harus Pdf";
                            $('#berkas').val('');
                        } else {
                            document.getElementById("appi").value = "<?php echo base_url(); ?>internal/assets/api/kirim_komentar.php?email=" + email + "&nama=" + nama + "&peraturan_id=" + peraturan_id + "&komentar=" + encodeURIComponent(komentar) + "";
                            ambil_data(new FormData(this));
                        }
                    } else {
                        ambil_data(new FormData(this));
                    }

                } else {
                    document.getElementById("appi").value = "<?php echo base_url(); ?>internal/assets/api/kirim_komentar.php?email=" + email + "&nama=" + nama + "&peraturan_id=" + peraturan_id + "&komentar=" + encodeURIComponent(komentar) + "";
                    ambil_data(new FormData(this));
                }
            }
        });
    });

    function ambil_data(data) {
        $("#btnkomentar").html('Mohon Menunggu...');
        $("#btnkomentar").prop('disabled', true);
        $.ajax({
            url: "<?php echo base_url(); ?>produk_hukum/kirim_komentar",
            dataType: "JSON",
            type: "post",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(result) {
                if (result.respon == "ok") {
                    $('#modal-komentar').modal('show');
                    $('.text-komentar').text('Terima kasih, komentar Anda telah berhasil dikirim.');
                    // alert('berhasil');
                    $(document).ajaxStop(function() {
                        window.location.reload();
                    });
                } else {
                    $('#modal-komentar').modal('show');
                    $('.text-komentar').text('Komentar Anda telah gagal dikirim.');
                    // alert('gagal');
                }

                // $('#name_komentar').val('');
                // $('#email_komentar').val('');
                // $('#komentar').val('');

                $("#btnkomentar").html('Kirim Komentar');
                $("#btnkomentar").prop('disabled', false);
            },
            error: function(request, status, error) {
                $('#img1').css("display", "none");
                $('#alert_success').css("display", "none");
                $('#alert_danger').css("display", "block");
                $("#alert_danger").html(result.message);
                $("#btnkomentar").html('Kirim Komentar');
                $("#btnkomentar").prop('disabled', false);

            }
        })
    }
</script>