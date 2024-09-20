<?php $this->load->view("include/header");
?>
<br><br><br><br>
<?php
$this->load->view("widget/pencarian_cepat");
//echo $status;
?>


<div class="main-content-wrapper section-padding-20" >
    <div class="container">
        <div class="row">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8" style="margin-bottom:10px;">

                <?php $this->load->view("widget/list_pencarian_detail_error"); ?>


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


                </div>
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
$this->load->view("include/footer")?>