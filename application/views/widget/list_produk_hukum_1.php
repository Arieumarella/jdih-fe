<div class="post-content-area mb-100">
    <!-- Catagory Area -->
    <?php
    $myString = '';
    foreach ($get_awal_produk as $hproduk) {
        $datakategori = $this->Mdl_produk_hukum->get_namakategori($hproduk['peraturan_category_id']);
        foreach ($datakategori->result_array() as $dk) {
            $kodekat = $dk['percategorycode'];
        }
        $file_abstrak = $hproduk['file_abstrak'];
        $tahun = substr($hproduk['tanggal'], 0, 4);
        $bulan = substr($hproduk['tanggal'], 4, 2);
    ?>
        <div id="div_prod"></div>
        <div id="tmptable">

        </div>
        <div class="world-catagory-area">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php
                $nop = explode("/", $hproduk['noperaturan']);
                $noperaturan = $hproduk['noperaturan'];
                foreach ($nop as $i => $key) {
                }
                if ($i <= 0) {
                    $noperaturan = $hproduk['noperaturan'] . ' tahun ' . substr($hproduk['tanggal'], 0, 4);
                }

                ?>
                <li class="title"><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id']) ?> nomor <?php echo $noperaturan; ?></li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1" id="div_produk_hukum">
                    <p><i class="fa fa-clock-o"> <?php
                                                    $bln = substr($hproduk['tanggal_penetapan'], 4, 2);
                                                    $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                                    echo substr($hproduk['tanggal_penetapan'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal_penetapan'], 0, 4);
                                                    ?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count']; ?> kali</i> <i class="fa fa-eye"> <?php echo $hproduk['view_count']; ?> kali</i></p>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td width="30%">Tipe Dokumen</td>
                            <td width="70%">Peraturan Perundang-undangan</td>
                        </tr>
                        <tr>
                            <td width="30%">Judul</td>
                            <td width="70%"><?php echo $hproduk['judul']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">T.E.U. Badan / Pengarang</td>
                            <td width="70%">Indonesia.Kementerian Pekerjaan Umum dan Perumahan Rakyat</td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor</td>
                            <td width="70%"><?php echo $hproduk['noperaturan']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Peraturan</td>
                            <td><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id']); ?></td>
                        </tr>
                        <tr>
                            <td>Singkatan Jenis</td>
                            <td><?php echo $this->Mdl_home->cari_singkatan($hproduk['peraturan_category_id']); ?></td>
                        </tr>
                        <tr>
                            <td>Tempat Penetapan</td>
                            <td><?php echo $hproduk['tempat_terbit']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Ditetapkan</td>
                            <td><?php
                                if ($hproduk['tanggal_penetapan'] != null) {
                                    $bln = substr($hproduk['tanggal_penetapan'], 4, 2);
                                    $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                    echo substr($hproduk['tanggal_penetapan'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal_penetapan'], 0, 4);
                                }
                                ?></td>
                        </tr>
                        <?php if ($hproduk['peraturan_category_id'] <= 8) {
                        ?><tr>
                                <td>Tanggal Pengundangan</td>
                                <td>
                                    <?php
                                    if ($hproduk['tanggal_pengundangan'] != null) {
                                        $bln = substr($hproduk['tanggal_pengundangan'], 4, 2);
                                        $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                        echo substr($hproduk['tanggal_pengundangan'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal_pengundangan'], 0, 4);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        } ?>

                        <tr>
                            <td width="30%">Sumber</td>
                            <td width="70%"><?php echo $hproduk['sumber']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Subjek</td>
                            <td width="70%"><?php echo $hproduk['subjek']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Status</td>
                            <td width="70%">
                                <?php
                                if ($hproduk['status'] == '0') {
                                    echo 'Berlaku';
                                } elseif ($hproduk['status'] == '1') {
                                    echo 'Tidak Berlaku';
                                } elseif ($hproduk['status'] == '2') {
                                    echo 'Tidak Aktif Sementara';
                                } elseif ($hproduk['status'] == '3') {
                                    echo 'Tidak ada daya guna';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">Bahasa</td>
                            <td width="70%"><?php echo $hproduk['bahasa']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Lokasi</td>
                            <td width="70%"><?php echo $hproduk['lokasi']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Bidang Hukum</td>
                            <td><?php echo $hproduk['bidang_hukum']; ?></td>
                        </tr>
                        <?php if ($hproduk['peraturan_category_id'] <= 7) {
                        ?><tr>
                                <td width="30%">Lembar Negara</td>
                                <td width="70%"><?php echo $hproduk['lembar_negara']; ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Tambahan Lembar Negara</td>
                                <td width="70%"><?php echo $hproduk['lembar_negara_tambahan']; ?></td>
                            </tr>

                            <tr>
                                <td width="30%">Berita Negara</td>
                                <td width="70%"><?php echo $hproduk['berita_negara']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td width="30%">Abstrak</td>
                            <td width="70%">
                                <input type="hidden" id="path_abstrak" value=<?php echo $kodekat . '/' . $tahun . '/' . $bulan . '/' . $hproduk['file_abstrak'];
                                                                                ?>>
                                <?php
                                if (!empty($hproduk['file_abstrak'])) {
                                ?>
                                    <i class="fa fa-download"></i> <?php echo $hproduk['file_abstrak']; ?>
                                    <button type="button" class="btn btn-success btn-sm" onclick="pindah('abstrak');"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        if ($data_detail->num_rows() == '0' and $data_detail_dua->num_rows() == '0') {
                        ?>

                        <?php
                        }
                        ?>

                    </table>
                    <br />
                    <?php
                    if ($data_detail->num_rows() > 0) {
                    ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Keterangan Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data_detail->result_array() as $dd) {
                                ?>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td><?php echo $dd['status'] == 'mencabut' ? 'Mencabut' : 'Mengubah'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Nomor Peraturan</b></td>
                                        <td>
                                            <?php
                                            if ($dd['peraturan_id_modifikasi'] == "") {
                                                echo $dd['noperaturan'];
                                            } else {
                                                $dataperaturanid = $this->Mdl_produk_hukum->get_peraturanid_byID($dd['peraturan_id_modifikasi']);
                                                foreach ($dataperaturanid->result_array() as $dperid) { ?>
                                                    <a href="<?php echo base_url('detail-dokumen/' . $dperid['peraturan_id'] . '/' . $dperid['tipe_dokumen']) ?>" class="link_menu" style="color:blue;"><?php echo $dd['noperaturan']; ?></a>
                                            <?php

                                                }
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Tentang</b></td>
                                        <td><?php echo $this->Mdl_fungsi->getKetStatus($dd['peraturan_id_modifikasi']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Pengundangan</b></td>
                                        <td><?php echo $dd['tanggal']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php }
                    ?>

                    <?php
                    if ($data_detail_dua->num_rows() > 0) {
                    ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data_detail_dua->result_array() as $ddd) {
                                ?>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td>
                                            <?php
                                            if ($ddd['status'] == 'mencabut') {
                                                echo 'Dicabut';
                                            } elseif ($ddd['status'] == 'mengubah') {
                                                echo 'Diubah';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $datatentang = $this->Mdl_produk_hukum->get_tentang($ddd['peraturan_id']);
                                    foreach ($datatentang->result_array() as $dt) {
                                    ?>
                                        <tr>
                                            <td><b>Nomor peraturan</b></td>
                                            <td>
                                                <a href="<?php echo base_url('detail-dokumen/' . $dt['peraturan_id'] . '/' . $dt['tipe_dokumen']) ?>" class="link_menu" style="color:blue;"><?php echo $dt['noperaturan']; ?></a>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Tentang</b></td>
                                            <td><?php echo $dt['tentang']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Pengundangan</b></td>
                                            <td><?php echo substr($dt['tanggal_pengundangan'], 6, 2) . '/' . substr($dt['tanggal_pengundangan'], 4, 2) . '/' . substr($dt['tanggal_pengundangan'], 0, 4); ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <!-- <th colspan="2">Berkas Lengkap</th> -->
                                <th colspan="2">Berkas Lengkap</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td>Lampiran Utuh</td> -->
                                <td colspan="2">
                                    <?php
                                    $myString = '';
                                    if (!empty($hproduk['file_upload'])) {
                                        $myString = $hproduk['file_upload'];

                                        if (strstr($myString, '.pdf')) {
                                    ?> <i class="fa fa-download"></i> <?php echo $hproduk['file_upload']; ?>
                                            <input type="hidden" id="path_upload" value="<?php echo $kodekat . '/' . $tahun . '/' . $bulan . '/' . $hproduk['file_upload']; ?>">
                                            <button type="button" class="btn btn-success" onclick="pindah('produk_hukum');"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>&nbsp;
                                        <?php
                                        } else {
                                        }
                                        ?>


                                        <a href="<?php echo base_url() ?>internal/assets/assets/produk/<?php echo $kodekat . "/" . $tahun . "/" . $bulan . "/" . $hproduk['file_upload']; ?>" class="btn btn-primary" target="_blank" download onclick="klikunduh(<?= $peraturan_id ?>)"><i class="fa fa-download"></i> Unduh</a>
                                    <?php
                                    } else {
                                        echo 'Tidak ada File';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Berkas Parsial</b></td>
                            </tr>
                            <tr>
                                <td>No</td>
                                <td>PDF</td>
                            </tr>
                            <?php
                            if ($data_file->num_rows() > 0) {
                                $i = 0;
                                foreach ($data_file->result_array() as $df) {
                                    $i++;
                                    echo '<tr>';
                                    echo '<td>' . $i . '</td>';
                                    echo '<td>';
                            ?>
                                    <i class="fa fa-download"></i> <?php echo $df['file']; ?>
                                    <button type="button" class="btn btn-success btn-sm" onclick="window.open('<?php echo base_url(); ?>internal/assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url("internal/assets/assets/produk_parsial/" . $kodekat . "/" . $tahun . "/" . $bulan . "/" . $df['file'] . "") ?>', '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>
                                    </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<tr>';
                                echo '<td colspan="2">Tidak ada data parsial</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Saran dan Komentar</h5>
                    <?php $data['tipe'] = "1";
                    $this->load->view("widget/komentar", $data); ?>
                </div>
            </div>
        </div>
        <div>
            <?php $this->load->view("widget/subscribe"); ?>
        </div>
    <?php
    }
    if ($myString != '') {
    ?>
        <div id="div share" align="right" class="mt-5">
            Bagikan : <br>
            <img src="<?php echo base_url(); ?>assets/img/core-img/icn_email.png" style="width:60px;height:50px" onclick="tampil_share();">
        </div><br>
    <?php
    }
    ?>
</div>

<script>
    function pindah(kode) {
        if (kode == "abstrak") {
            var isi = document.getElementById("path_abstrak").value;

            var url = '<?php echo base_url(); ?>internal/assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url("internal/assets/assets/produk_abstrak") ?>/' + isi + '';
            window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        } else if (kode == "produk_hukum") {
            var isi = document.getElementById("path_upload").value;

            var url = '<?php echo base_url(); ?>internal/assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url("internal/assets/assets/produk") ?>/' + isi + '';
            window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
        }
    }

    function klikunduh(peraturan_id) {
        $.ajax({
            url: "<?php echo base_url(); ?>produk_hukum/tambah_unduh",
            type: "POST",
            dataType: "json",
            data: {
                "peraturan_id": peraturan_id
            },
            success: function(data) {
                // do something
            },
            error: function(data) {
                // do something
            }
        });
    }
</script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>