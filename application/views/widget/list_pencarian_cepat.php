<link rel="stylesheet" href="<?php echo base_url() ?>internal/assets/plugins/datatables/buttons.dataTables.min.css">
<style>
    .dataTables_info {
        font-size:12px;margin-left:10px;
    }
    #example2_paginate{float:right;margin-bottom:20px;margin-top:10px;margin-left:10px;width:100%;}

    .pagination li a {
        font-size: 12px;
    }
    .pagination ul {
        float:right;width:100%;
    }
    @media (min-width:640px){
        #div_prod{height:100px;}
    }
    @media (min-width: 760px) {
        #div_prod{height:50px;}
    }

    @media (min-width: 880px) {
        #div_prod{height:50px;}

    }
    @media (min-width: 920px) {
        #div_prod{height:50px;}
    }
    table#example2.dataTable tbody tr:hover {
        background-color: #e8e8e8;box-shadow: 0 0 13px rgba(33,33,33,.2); 
    }

    table#example2.dataTable tbody tr:hover > .sorting_1 {
        background-color: #e8e8e8;box-shadow: 0 0 13px rgba(33,33,33,.2); 
    }
</style>



<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div id="div_prod" class="panel-heading" style="background-color: #45678d;border-bottom:3px solid #fcfcfc;">
        <div class="col-md-12" id="noperaturan-colomn" style="padding-bottom: 10px">
            <div class="row">
                <div class="col-md-7 text-bold">
                    <?php
                    if ($tcari == 'kosong_field') {
                        $kata_cari = ' ';
                    } else {
                        $tcari_replace = str_ireplace("^", "/", $tcari);
                        if (strlen($tcari) >= 30) {
                            $kata_cari = substr($tcari_replace, 0, 25) . "...";
                        } else {
                            $kata_cari = $tcari_replace;
                        }
                    }
                    ?>
                    <label style="color: #fff;margin-top:10px;margin-left:10px">Hasil Pencarian "<?= $kata_cari ?>"</label>
                </div>
                <div class="col-md-5" style="margin-top:12px;color: #fff" align="right">
                    <img src="<?php echo base_url(); ?>assets/img/core-img/icon2.png" style="width:20px;height:20px"> Tidak Berlaku
                    <img src="<?php echo base_url(); ?>assets/img/core-img/icon1.png" style="width:20px;height:20px"> Masih Berlaku
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body" style="background-color:#fff;">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="div_produk_hukum" role="tabpanel" aria-labelledby="tab1">
                <!-- Single Blog Post -->
               <div id="tmptable">
				
				</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
		get_data('cepat');
    });
	
	function klikunduh(peraturan_id) {
        $.ajax({
            url: "<?php echo base_url(); ?>pencarian/tambah_unduh",
            type: "POST",
            dataType: "json",
            data: {"peraturan_id": peraturan_id},
            success: function (data) {
                // do something
            },
            error: function (data) {
                // do something
            }
        });
    }


</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
