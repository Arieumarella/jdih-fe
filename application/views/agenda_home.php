<?php
$this->load->view("include/header");
?><br><br><br><br><?php
                    //$this->load->view("widget/pencarian_cepat");
?>

<style>
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

                <?php $this->load->view("widget/list_agenda_home"); ?>
                <?php $this->load->view("widget/subscribe"); ?>

            </div>

            <!-- ========== Sidebar Area ========== -->

        </div>


    </div>
</div>



<?php
$this->load->view("include/footer") ?>