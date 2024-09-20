<?php
$this->load->view("include/header");
?><br><br><br><br><?php

                    //$this->load->view("widget/pencarian_cepat");
                    ?>


<div class="main-content-wrapper section-padding-20">
    <div class="container">
        <div class="row">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8" style="margin-bottom:10px;">

                <?php $this->load->view("widget/list_berita_home"); ?>
                <?php $this->load->view("widget/subscribe"); ?>

            </div>

            <!-- ========== Sidebar Area ========== -->
            <div class="col-12  col-lg-4" style="width:100%">
                <div style="width:100%">
                    <!-- Widget Area -->
                    <?php $this->load->view("widget/list_jenis_produk_hukum"); ?>
                    <?php $this->load->view("widget/list_produk_hukum_populer"); ?>
                    <?php $this->load->view("widget/list_unit_kerja"); ?>
                    <?php $this->load->view("widget/list_tags"); ?>
                    <?php $this->load->view("widget/list_link_terkait"); ?>
                    <?php $this->load->view("widget/list_statistik_pengunjung"); ?>
                    <!-- ============= 08122020 kuesioner ============= -->
                    <a target="_blank" href="https://forms.gle/tE4yg1AdTdgRaVXU8"><img border="0" alt="kuesioner" src="<?php echo base_url() ?>assets/img/kuesioner.png"></a>



                </div>
            </div>
        </div>


    </div>
</div>

<div id="modal_abstrak" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Abstrak </h4>
            </div>
            <div class="modal-body">
                <div id="div_frame"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    function panggil_abstrak(kode) {
        var isi = document.getElementById("abstrak_" + kode + "").value;
        if (isi == "tidak ada") {
            var url = "<?php echo base_url('NoFile/index/abstrak') ?>";
            window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        } else {
            var url = '<?php echo base_url(); ?>internal/assets/plugins/pdfjs/web/viewer.html?file=' + isi + '';
            window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        }
        //window.open(document.URL, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
    }
</script>

<?php
$this->load->view("include/footer") ?>