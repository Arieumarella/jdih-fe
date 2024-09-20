<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>
<?php
$t2 = str_ireplace("^", "/", $noperaturan);
$noperaturan = str_ireplace("kosong_field", "", $t2);
?>
<?php
$t2 = str_ireplace("^", "/", $tahun);
$tahun = str_ireplace("kosong_field", "", $t2);
?>
<?php
$t2 = str_ireplace("^", "/", $judul);
$judul = str_ireplace("kosong_field", "", $t2);
?>
<input type="hidden" id="tipecari" value="<?php echo $tipe_cari; ?>">
<section class="contact-area section-padding-20">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-20 col-md-100 col-lg-40" id="div_cari_detail" style="display:none">
                <div class="contact-form" style="background-color:#fff;border-radius:5px;">
                    <div style="width:100%;border-bottom:2px solid #ffcc00;">
                        <a href="#" class="linka translatable" style="color:black;" onclick="tampil_cari('2')">Pencarian Cepat</a>
                        &nbsp; | &nbsp;
                        <a href="#" style="color:#000;font-size:18px" onclick="tampil_cari('1')" class="translatable">Pencarian Detail</a>
                    </div>
                    <!-- Contact Form --><br>



                    <div class="row">
                        <div class="col-12 col-md-2" style="display: none;">
                            <div class="group">
                                <select class="form-control" id="tipe_dokumen" name="tipe_dokumen">
                                    <option value="1" <?php
                                    if ($tipe_dokumen == "1") {
                                        echo "Selected";
                                    } else {
                                        echo "Selected";
                                    }
                                ?>>Peraturan Perundangan</option>
                                <option value="2" <?php
                                if ($tipe_dokumen == "2") {
                                    echo "Selected";
                                }
                            ?>>Monografi</option>
                            <option value="3" <?php
                            if ($tipe_dokumen == "3") {
                                echo "Selected";
                            }
                        ?>>Artikel / Majalah</option>
                        <option value="4" <?php
                        if ($tipe_dokumen == "4") {
                            echo "Selected";
                        }
                    ?>>Putusan Pengadilan</option>
                    <option value="" <?php
                    if ($tipe_dokumen == "") {
                        echo "Selected";
                    }
                ?>>Semua Tipe</option>
            </select>

        </div>
    </div>

    <div class="col-12 col-md-2">
        <div class="group">
            <select class="form-control" name="peraturan_category_id" id="peraturan_category_id">
                <option value="">Semua Jenis</option>
                <?php
                $get_pp = $this->Mdl_home->get_pp('1');
                foreach ($get_pp as $combo_pp) {
                    ?><option value="<?php echo $combo_pp['peraturan_category_id']; ?>" <?php
                    if ($combo_pp['peraturan_category_id'] == $peraturan_category_id) {
                        echo "selected";
                    }
                ?>><?php echo $combo_pp['percategoryname']; ?></option>
                <?php
            }
            ?>
        </select>
        <input type="hidden" id="peraturan_category_id_tmp" value="<?php echo $peraturan_category_id; ?>">
    </div>
</div>
<div class="col-12 col-md-2">
    <div class="group">
        <select class="form-control" name="tag_id" id="tag_id">
            <option value="">Pilih Substansi</option>
            <?php
            $get_tags = $this->Mdl_home->get_tags();
            foreach ($get_tags as $htags) {
                ?><option value="<?php echo $htags['tag_id']; ?>" <?php
                if ($htags['tag_id'] == $tag_id) {
                    echo "selected";
                }
            ?>><?php echo $htags['tagname']; ?></option>
            <?php
        }
        ?>
    </select>
    <input type="hidden" id="tag_id_tmp" value="<?php echo $tag_id; ?>">
</div>
</div>
<div class="col-12 col-md-2">
    <div class="group">
        <select class="form-control" id="status" name="status">
            <option value="">Semua Status</option>
            <option value="0" <?php
            if ($status == "0") {
                echo "Selected";
            }
        ?>>Masih Berlaku</option>
        <option value="1" <?php
        if ($status == "1") {
            echo "Selected";
        }
    ?>>Tidak Berlaku</option>
</select>
<input type="hidden" id="status_tmp" value="<?php echo $status; ?>">
<input type="hidden" id="tipe_dokumen_tmp" value="<?php echo $tipe_dokumen; ?>">
</div>
</div>

<div class="col-12 col-md-2">
    <div class="group">
        <input type="text" name="noperaturan" id="noperaturan" value="<?php echo $noperaturan; ?>" class="form-control" placeholder="nomor" onkeypress="return runScript(event,'2')">
        <input type="hidden" name="dept_id" id="dept_id" value="<?php echo $dept_id; ?>" class="form-control" placeholder="dept_id" onkeypress="return runScript(event,'2')">
    </div>
</div>
<div class="col-12 col-md-1">
    <div class="group">
        <input type="number" name="tahun" id="tahun" value="<?php echo $tahun; ?>" class="form-control" placeholder="tahun" style="100%" onkeypress="return runScript(event,'2')">

    </div>
</div>
<div class="col-12 col-md-3">
    <div class="group">
        <input type="text" name="judul" id="judul" class="form-control" value="<?php echo $judul; ?>" placeholder="judul" onkeypress="return runScript(event,'2')">

    </div>
</div>

<br>
<div align="right" style="width:100%">
    <button class="btn btn-primary" style="width:200px" onclick="get_data('caridetail')"><i class="fa fa-search"></i> <span class="translatable">CARI</span></button>
</div>
</div>

</div>
</div>

<div id="div_cari_cepat" style="display:block;width:100%">
    <div class="contact-form" style="background-color:#fff;border-radius:5px;">
        <div style="width:100%;border-bottom:3px solid #ffcc00;">
            <a href="#" style="color:#000;font-size:18px" onclick="tampil_cari('2')" class="translatable">Pencarian Cepat</a> &nbsp; | &nbsp; <a href="#" class="linka translatable" style="color:black;" onclick="tampil_cari('1')">Pencarian Detail</a>

        </div>
        <!-- Contact Form --><br>

        <div class="row">
            <div class="col-10">
                <div class="group">
                    <?php
                    $t2 = str_ireplace("^", "/", $tcari);
                    $t3 = str_ireplace("kosong_field", "", $t2);
                    ?>
                    <input type="text" name="tcari" id="tcari" placeholder="masukan kata pencarian" class="form-control translatable_placeholder" value="<?php echo $t3; ?>" onkeypress="return runScript(event,'1')">

                </div>
            </div>

            <div class="col">
                <button class="btn btn-primary" style="width:100%" onclick="get_data('cepat')"><i class="fa fa-search"></i> <span class="translatable">CARI</span></button>
            </div>
        </div>


    </div>


</div>
</div>
</section>
<script>
    $(document).ready(function() {
        if (document.getElementById("tipecari").value == "detail") {
            tampil_cari("1");
        } else {
            tampil_cari("2");
        }

    })
</script>