<?php
$this->load->view("include/header");
?><br><br><br><br><?php

                    //$this->load->view("widget/pencarian_cepat");
?>

<style type="text/css">
    /* unvisited link */
    .panel a:link {
        color: #000;
    }

    /* visited link */
    .panel a:visited {
        color: #000;
    }

    /* mouse over link */
    .panel a:hover {
        color: #45678d;
    }

    /* selected link */
    .panel a:active {
        color: #45678d;
    }
</style>

<div class="main-content-wrapper section-padding-20">
    <div class="container">
        <div class="row">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-12" style="margin-bottom:10px;">

                <?php $this->load->view("widget/list_berita_home"); ?>
                <?php $this->load->view("widget/subscribe"); ?>

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