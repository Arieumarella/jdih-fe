<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
        <center>
            <label style="color: #fff;margin-top:10px">Produk Hukum Terkait</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">

        <?php
        foreach ($data_per_terkait->result_array() as $dpt) {
            $data_peraturan = $this->Mdl_produk_hukum->ambil_detail_peraturan($dpt['peraturan_terkait']);
            ?>
            <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                <div class="post-content">
                    <?php
                    foreach ($data_peraturan as $dp) {
                        $id_peraturan = $dp['peraturan_id'];
                        $noperaturan = $dp['noperaturan'];
                        $tipe_dokumen = $dp['tipe_dokumen'];
                        $data_nama_peraturan = $this->Mdl_produk_hukum->get_namakategori($dp['peraturan_category_id']);
                        foreach ($data_nama_peraturan->result_array() as $dnp) {
                            $nama_peraturan = $dnp['percategoryname'];
                        }
                        ?>
                        <a href="<?php echo base_url('detail-dokumen/' . $id_peraturan . "/" . $tipe_dokumen); ?>" class="headline">
                            <i class="fa fa-angle-double-right"></i>
                            <?php
                            echo $nama_peraturan . ' Nomor ' . $noperaturan;
                            ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

    </div>

</div>
<br/>