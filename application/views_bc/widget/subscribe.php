<br>
<br>
<div class="panel panel-default" style="width:100%;">
    <div class="panel-heading" style="border-radius:5px;background-color: #45678d;height:50px;margin-bottom:5px">
        <center>
            <label style="color: #fff;margin-top:10px">Berlangganan</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">
        <div class="container">
            <center>
                <div class="alert alert-danger mb-4" style="display:none" id="alert-bahaya" role="alert"><span class="text-error" id="text-bahaya"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
                <div class="alert alert-success mb-4" style="display:none" id="alert-berhasil" role="alert"><span class="text-success" id="text-berhasil"></span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>
            </center>
            <div class="text-center mt-2 mb-2">
                <img src="<?php echo base_url() ?>assets/img/mailbox.png" class="icon-mail" alt="">
                <div class="mt-2 text-muted">
                    <h6 class="judul">Berlangganan</h6>
                    <p>Anda dapat berlangganan untuk mendapatkan notifikasi dan info penting di bidang pekerjaan umum dan perumahan rakyat dari pengelola JDIH PUPR langsung lewat inbox email Anda. </p>
                </div>
            </div>
            <div class="justify-content-center align-items-center mb-3">
                <div class="form-group">
                    <div class="col-auto">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-auto">
                        <label for="">Email</label>
                        <input type="email" name="email_1" id="email_1" class="form-control" placeholder="Masukkan Email" required />
                    </div>
                </div>
                <div class="text-right">
                    <div class="form-group">
                        <div class="col-auto">
                            <button type="button" class="btn button2" id="save_subs">Langganan Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
<div id="modal-subs" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi Berlangganan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-subs"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Baik</button>
            </div>
        </div>
    </div>
</div>
<style>
    .icon-mail {
        width: 150px;
        height: 150px;
        margin-top: 20px;
    }

    .judul {
        color: #45678d;
        font-weight: bold;
        font-size: 16pt;
    }

    .button2 {
        border-radius: 16px;
        background-color: #5DC6E9;
        color: white;
    }

    .button2:hover {
        background-color: #1DA9D7;
        color: white;
    }
</style>
<script>
    $(document).ready(function() {
        // $('#modal-subs').modal('show');
        $("#save_subs").click(function() {
            var email_1 = $('#email_1').val();
            var nama = $('#nama').val();
            $('#alert-bahaya').hide();
            $('#alert-berhasil').hide();
            if (nama == '') {
                $('#text-bahaya').text('Nama Harus diisi!');
                $('#alert-bahaya').show();

            } else if (email_1 == '') {
                $('#text-bahaya').text('Email harus diisi!');
                $('#alert-bahaya').show();
            } else if ((email_1.indexOf('@', 0) == -1) || (email_1.indexOf('.', 0) == -1)) {
                $('#text-bahaya').text('Format email salah!');
                $('#alert-bahaya').show();
            } else {
                $("#save_subs").html('Mohon Menunggu..');
                $("#save_subs").prop('disabled', true);
                $.ajax({
                    url: "<?php echo base_url(); ?>home/post_subs",
                    dataType: "JSON",
                    type: 'POST',
                    data: {
                        email_1: email_1,
                        nama: nama,
                    },
                    success: function(data) {
                        if (data.respon == 'ok') {
                            $('#modal-subs').modal('show');
                            $('.text-subs').text('Terima kasih, Anda telah berhasil berlangganan.');
                        } else {
                            $('#modal-subs').modal('show');
                            $('.text-subs').text('Mohon maaf, Anda gagal berlangganan.');
                        }

                        $('#nama').val('');
                        $('#email_1').val('');

                        $("#save_subs").html('Langganan Sekarang');
                        $("#save_subs").prop('disabled', false);
                    },
                    error: function(data) {
                        $("#save_subs").html('Langganan Sekarang');
                        $("#save_subs").prop('disabled', false);
                        $('#alert-bahaya').show();
                        $('#text-bahaya').text('Mohon maaf, Anda gagal berlangganan');
                        $('#alert-berhasil').hide();
                    }
                })
            }
        });
    });
</script>