<?php
$this->load->view("include/header");
$kodekat = '';
$tahun = '';
$bulan = '';
$file_abstrak = '';
echo "<br><br><br><br>";
$this->load->view("widget/pencarian_cepat");
?>
<script src="<?php echo base_url() ?>/assets/js/owl.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstraphome.js"></script>

<!-- ********** End Form Pencarian Detail dan Pencarian cepat ********** -->

<div class="main-content-wrapper section-padding-20">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8" style="background-color:#fff;">
                <?php
                if ($tipe_dokumen == "1") {
                    $this->load->view("widget/list_produk_hukum_1");
                } else if ($tipe_dokumen == "2") {
                    $this->load->view("widget/list_produk_hukum_2");
                } else if ($tipe_dokumen == "3") {
                    $this->load->view("widget/list_produk_hukum_3");
                } else if ($tipe_dokumen == "4") {
                    $this->load->view("widget/list_produk_hukum_4");
                }
                ?>
            </div>

            <!-- ========== Sidebar Area ========== -->
            <div class="col-12  col-lg-4" style="width:100%">
                <div style="width:100%">
                    <?php $this->load->view("widget/list_jenis_produk_hukum"); ?>
                    <?php if ($data_per_terkait->num_rows() > 0) { ?>
                        <?php $this->load->view("widget/list_peraturan_terkait"); ?>
                    <?php } ?>
                    <?php $this->load->view("widget/list_produk_hukum_populer"); ?>
                    <?php $this->load->view("widget/list_unit_kerja"); ?>
                    <?php $this->load->view("widget/list_tags"); ?>
                    <?php $this->load->view("widget/list_link_terkait"); ?>
                    <?php $this->load->view("widget/list_statistik_pengunjung"); ?>
                </div>
            </div>
        </div>


    </div>
</div>

<div id="Modal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
                <h4 class="modal-title">Kirim email </h4>
            </div>
            <div class="modal-body">
                <div id="isi_email" style="display:block">
                    <div class="group">
                        <input type="text" name="name" id="nama" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nama Penerima</label>
                    </div>

                    <div class="group">
                        <input type="text" name="email" id="email" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Email Penerima</label>
                    </div>
                    <br>
                    <label id="lblinfo" style="color:red;"></label>
                </div>
                <div id="result_email" style="display:none">
                    <center>
                        <img src="<?php echo base_url(); ?>assets/images/loading1.gif" id="img1">
                        <label id="lblnotif"></label>
                    </center>
                </div>
                <input type="hidden" id="peraturan_id" value="<?php echo $peraturan_id; ?>">
                <input type="hidden" id="appi" value="">

            </div>
            <div class="modal-footer">

                <p style="font-size:20px;text-align:left" id="lbl_modal1"></p>
                <button type="button" id="btn1" class="btn btn-primary" data-dismiss="modal" style="width:120px;float:right;">Batal</button>&nbsp;&nbsp;
                <button type="button" id="btn2" class="btn btn-primary" style="width:120px;float:right;" onclick="kirim_email();">Kirim Email</button>&nbsp;&nbsp;
                <button type="button" id="btn3" class="btn btn-primary" data-dismiss="modal" style="width:120px;float:right;">Tutup</button>&nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-abstrak">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Abstrak</h4>
            </div>
            <div class="modal-body">
                <iframe src="<?php echo site_url('internal/assets/plugins/pdfjs/web/viewer.html?file=') . base_url('internal/assets/assets/produk_abstrak/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $file_abstrak); ?>" style="width:100%; height:600px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
if ($data_file->num_rows() > 0) {
    $i = 0;
    foreach ($data_file->result_array() as $dtfile) {
        $i++;
?>
        <div class="modal fade" id="modal-file<?php echo $i; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">PDF Parsial</h4>
                    </div>
                    <div class="modal-body">
                        <iframe src="<?php echo site_url('internal/assets/plugins/pdfjs/web/viewer.html?file=') . base_url('internal/assets/assets/produk_parsial/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $dtfile['file']); ?>" style="width:100%; height:600px;" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php
    }
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example2').dataTable({
            "paging": true,
            "ordering": false,
            "searching": false,
            dom: "<'row'<'col-sm-12'tr><'col-sm-4'l><'col-sm-8'p>>"
        });


        window.location = '#div_cari_detail';



    });

    function kirim_email() {
        var nama = document.getElementById("nama").value;
        var email = document.getElementById("email").value;

        var peraturan_id = document.getElementById("peraturan_id").value;
        document.getElementById("lblnotif").innerHTML = '';
        document.getElementById("lblinfo").innerHTML = '';

        if (nama == "") {
            document.getElementById("lblinfo").innerHTML = "Nama tidak boleh kosong";
        } else if (email == "") {
            document.getElementById("lblinfo").innerHTML = "Email tidak boleh kosong";
        } else if ((email.indexOf('@', 0) == -1) || (email.indexOf('.', 0) == -1)) {
            document.getElementById("lblinfo").innerHTML = "Format Email Salah";
        } else {

            document.getElementById("btn1").style.display = "none";
            document.getElementById("btn2").style.display = "none";
            document.getElementById("btn3").style.display = "none";

            document.getElementById("isi_email").style.display = "none";
            document.getElementById("result_email").style.display = "block";
            document.getElementById("appi").value = "<?php echo base_url(); ?>internal/assets/api/kirim_email.php?email=" + email + "&nama=" + nama + "&peraturan_id=" + peraturan_id + "";
            $.ajax({
                url: "<?php echo base_url(); ?>produk_hukum/kirim_email",
                dataType: "JSON",
                type: "GET",
                data: {
                    email: email,
                    nama: nama,
                    peraturan_id: peraturan_id
                },
                success: function(result) {
                    $.each(result, function(i, item) {
                        if (item.respon == "ok") {
                            document.getElementById("img1").style.display = "none";
                            document.getElementById("lblnotif").innerHTML = 'Email berhasil Dikirim';
                            document.getElementById("btn1").style.display = "none";
                            document.getElementById("btn2").style.display = "none";
                            document.getElementById("btn3").style.display = "block";

                        } else {
                            document.getElementById("img1").style.display = "none";
                            document.getElementById("lblnotif").innerHTML = 'Email gagal kirim';
                            document.getElementById("btn1").style.display = "none";
                            document.getElementById("btn2").style.display = "none";
                            document.getElementById("btn3").style.display = "block";
                        }
                    });
                },
                error: function() {
                    document.getElementById("img1").style.display = "none";
                    document.getElementById("lblnotif").innerHTML = 'Email gagal kirim';
                    document.getElementById("btn1").style.display = "none";
                    document.getElementById("btn2").style.display = "none";
                    document.getElementById("btn3").style.display = "block";
                }
            })
        }
    }


    function tampil_share() {
        document.getElementById("isi_email").style.display = "block";
        document.getElementById("result_email").style.display = "none";
        document.getElementById("nama").value = "";
        document.getElementById("email").value = "";

        document.getElementById("btn1").style.display = "block";
        document.getElementById("btn2").style.display = "block";
        document.getElementById("btn3").style.display = "none";
        // document.getElementById("peraturan_id").value = "";

        $('#Modal1').modal({
            backdrop: 'static',
            keyboard: false
        });
    }
</script>

<?php
$this->load->view("include/footer") ?>