<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
        <center>
            <label style="color: #fff;margin-top:10px">Produk Hukum Terpopuler</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">
        <?php
        $get_produk_populer = $this->Mdl_home->get_produk_populer();
        foreach ($get_produk_populer as $hpopuler) {
            ?>
            <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">

                <div class="post-content">
                    <a href="<?php echo base_url(); ?>detail-dokumen/<?php echo $hpopuler['peraturan_id']; ?>/<?php echo $hpopuler['tipe_dokumen']; ?>" class="headline">
                        <?php echo $this->Mdl_home->cari_peraturan_id($hpopuler['peraturan_category_id']) ?> nomor <?php echo $hpopuler['noperaturan']; ?>
                        <i class="fa fa-download"> <?php echo $hpopuler['download_count']; ?> kali</i>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<br>