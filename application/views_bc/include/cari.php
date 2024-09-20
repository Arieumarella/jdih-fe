<section class="contact-area section-padding-20" >
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-20 col-md-100 col-lg-40" id="div_cari_detail">
                <div class="contact-form">
                    <div style="width:100%;">
                        <a href="#"  style="color:#000;font-size:18px" onclick="tampil_cari('1')"> Pencarian Detail</a> &nbsp; | &nbsp; 
                        <a href="#" class="linka" onclick="tampil_cari('2')"> Pencarian Cepat</a>
                    </div>
                    <!-- Contact Form --><br>

                    <div class="row">
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <select class="form-control" id="peraturan_id">
                                    <option value="">Semua Jenis</option>
                                    <?php
                                    foreach ($get_pp as $combo_pp) {
                                        ?><option value="<?php echo $combo_pp['peraturan_category_id']; ?>"><?php echo $combo_pp['percategoryname']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="nomor" id="nomor"  class="form-control" placeholder="nomor">

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="tahun" id="tahun" class="form-control" placeholder="tahun" >

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <input type="text" name="judul" id="judul" class="form-control" placeholder="judul">

                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="group">
                                <select class="form-control" id="status">
                                    <option value="">Semua Status</option>
                                    <option value="0">Masih Berlaku</option>
                                    <option value="1">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="#"  class="btn btn-primary" onclick="get_cari_detail();"><i class="fa fa-search"></i> CARI</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="" id="div_cari_cepat" style="display:none;width:100%">
                <div class="contact-form">
                    <div style="width:100%;">
                        <a href="#" class="linka" onclick="tampil_cari('1')"> Pencarian Detail</a> &nbsp; | &nbsp; 
                        <a href="#"  style="color:#000;font-size:18px" onclick="tampil_cari('2')"> Pencarian Cepat</a>
                    </div>
                    <!-- Contact Form --><br>

                    <div class="row">
                        <div class="col">
                            <div class="group">
                                <select class="form-control" id="status2">
                                    <option value="">Semua Status</option>
                                    <option value="0">Masih Berlaku</option>
                                    <option value="1">Tidak Berlaku</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="group">
                                <input type="text" name="tcari" id="tcari" placeholder="masukan kata pencarian" class="form-control">

                            </div>
                        </div>

                        <div class="col">
                            <a href="#"  class="btn btn-primary" onclick="get_cari_cepat();"><i class="fa fa-search"></i> CARI</a>
                        </div>
                    </div>

                </div>


            </div>
        </div>
</section>