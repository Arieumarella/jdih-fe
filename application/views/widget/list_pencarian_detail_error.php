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

<?php $url = base_url('pencarian/create_json_detail/' . $tipe_dokumen . '/' . $peraturan_category_id . '/' . $noperaturan . '/' . $tahun . '/' . $judul . '/' . $status . '/' . $dept_id . '/' . $tag_id); ?>
<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div id="div_prod" class="panel-heading" style="background-color: #45678D;border-bottom:3px solid #fcfcfc; color: #fff">
        <div class="col-md-12" id="noperaturan-colomn" style="padding-bottom: 10px">
            <div class="row">
                <div class="col-md-7 text-bold">
                    <?php
                    $uri_pencarian_jenis = $this->uri->segment(3);
                    if (isset($uri_pencarian_jenis)) {
                        $data_jenis = $this->Mdl_home->ambil_nama_peraturan($uri_pencarian_jenis);
                        foreach ($data_jenis as $dj) {
                            $namaperaturan = "Filter Berdasarkan \"" . $dj['percategoryname'] . "\"";
                        }
                    } else {
                        $namaperaturan = 'Hasil Pencarian';
                    }
                    if ($dept_id != 'kosong_field') {
                        $uri_pencarian_unor = $this->uri->segment(2);
                        $data_pencarian_unor = $this->Mdl_home->ambil_nama_unor($uri_pencarian_unor);
                        foreach ($data_pencarian_unor as $dpu) {
                            
                            $namaperaturan = "Filter Berdasarkan \"" . $dpu['deptname'] . "\"";
                        }
                    }
                    ?>
                    <label style="color: #fff;margin-top:10px;margin-left:10px;font-size: 14px;"><?= $namaperaturan ?></label>
                </div>
                <div class="col-md-5" style="margin-top:12px;font-size: 13px" align="right">
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
                 <h2>Maaf, Pencarian yang Anda cari terdapat karakter yang tidak diperbolehkan<br>Silahkan lakukan pencarian kembali.</h2>
            </div>
        </div>
    </div>
</div>
<?php //echo $url;    ?>
<script type="text/javascript">
    $(document).ready(function () {
       



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
