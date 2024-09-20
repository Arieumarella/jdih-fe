<div class="post-content-area mb-100">
    <!-- Catagory Area -->
    <?php
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
                <li class="title"><?php echo $hproduk['judul']; ?></li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1" id="div_produk_hukum">
                    <p><i class="fa fa-clock-o"> <?php
                                                    $bln = substr($hproduk['tanggal'], 4, 2);
                                                    $bln2 = $this->Mdl_produk_hukum->cari_bulan($bln);
                                                    echo substr($hproduk['tanggal'], 6, 2) . " " . $bln2 . " " . substr($hproduk['tanggal'], 0, 4);
                                                    ?></i> <i class="fa fa-download"> <?php echo $hproduk['download_count']; ?> kali</i> <i class="fa fa-eye"> <?php echo $hproduk['view_count']; ?> kali</i></p>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td width="30%">Tipe Dokomen</td>
                            <td width="70%">Monografi</td>
                        </tr>
                        <tr>
                            <td width="30%">Judul</td>
                            <td width="70%"><?php echo $hproduk['judul']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Monografi</td>
                            <td><?php echo $this->Mdl_produk_hukum->cari_peraturan_id($hproduk['peraturan_category_id']); ?></td>
                        </tr>
                        <tr>
                            <td>Singkatan Jenis</td>
                            <td><?php echo $this->Mdl_home->cari_singkatan($hproduk['peraturan_category_id']); ?></td>
                        </tr>

                        <tr>
                            <td width="30%">T.E.U. Badan / Pengarang</td>
                            <td width="70%"><?php echo $hproduk['teu']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Panggil</td>
                            <td width="70%"><?php echo $hproduk['nomor_panggil']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Cetakan / Edisi</td>
                            <td width="70%"><?php echo $hproduk['cetakan']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Tempat Terbit</td>
                            <td width="70%"><?php echo $hproduk['tempat_terbit']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Penerbit</td>
                            <td width="70%"><?php echo $hproduk['penerbit']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Tahun Terbit</td>
                            <td width="70%"><?php echo substr($hproduk['tanggal_pengundangan'], 0, 4); ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Deskripsi Fisik</td>
                            <td width="70%"><?php echo $hproduk['deskripsi_fisik']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Subjek</td>
                            <td width="70%"><?php echo $hproduk['subjek']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">ISBN</td>
                            <td width="70%"><?php echo $hproduk['isbn']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Bahasa</td>
                            <td width="70%"><?php echo $hproduk['bahasa']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Bidang Hukum</td>
                            <td><?php echo $hproduk['bidang_hukum']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Induk Buku</td>
                            <td width="70%"><?php echo $hproduk['nomor_induk_buku']; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Lokasi</td>
                            <td width="70%"><?php echo $hproduk['lokasi']; ?></td>
                        </tr>


                        <tr>
                            <td width="30%">Abstrak</td>
                            <td width="70%">
                                <?php
                                if (!empty($hproduk['file_abstrak'])) {
                                    echo anchor('produk_hukum/download_abstrak/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $hproduk['file_abstrak'], '<i class="fa fa-download"></i> ' . $hproduk['file_abstrak'], 'target=_blank');
                                    echo '&nbsp;&nbsp;<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-abstrak"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>';
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
                                    <th colspan="2">Status</th>
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
                                            $dataperaturanid = $this->Mdl_produk_hukum->get_peraturanid($dd['noperaturan']);
                                            foreach ($dataperaturanid->result_array() as $dperid) {
                                                echo anchor(base_url('produk_hukum/view/' . $dperid['peraturan_id']), $dd['noperaturan']);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Tentang</b></td>
                                        <td><?php echo $dd['tentang']; ?></td>
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
                    <?php
                    } ?>

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
                                            <td><?php echo anchor(base_url('produk_hukum/view/' . $dt['peraturan_id']), $dt['noperaturan']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tentang</b></td>
                                            <td><?php echo $dt['tentang']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Pengundangan</b></td>
                                            <td><?php echo substr($dt['tanggal_pengundangan'], 6, 2) . '/' . substr($dt['tanggal_pengundangan'], 4, 2) . '/' . substr($dt['tanggal_pengundangan'], 0, 4); ?></td>
                                        </tr>
                                <?php }
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
                                <th colspan="2">Berkas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lampiran Utuh</td>
                                <td>
                                    <?php
                                    if (!empty($hproduk['file_upload'])) {
                                    ?>
                                        <a href="<?php echo base_url() ?>internal/assets/assets/produk/monografi/<?php echo $kodekat . "/" . $tahun . "/" . $bulan . "/" . $hproduk['file_upload']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-eye"></i> Lihat PDF</a>&nbsp;
                                        <a href="<?php echo base_url() ?>internal/assets/assets/produk/monografi/<?php echo $kodekat . "/" . $tahun . "/" . $bulan . "/" . $hproduk['file_upload']; ?>" class="btn btn-primary" target="_blank" download><i class="fa fa-download"></i> Unduh PDF</a>
                                    <?php
                                    } else {
                                        echo 'Tidak ada File';
                                    } ?>
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
                                    echo anchor('produk_hukum/download_parsial/' . $kodekat . '/' . $tahun . '/' . $bulan . '/' . $df['file'], '<i class="fa fa-download"></i> ' . $df['file'], 'target=_blank');
                                    echo '&nbsp;&nbsp;<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-file' . $i . '"><i class="fa fa-file-pdf-o"></i> Pratinjau</button>';
                                    echo '</td>';
                                    echo '</tr>';
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
    ?>
    <div id="div share" align="right">
        Bagikan : <br>
        <img src="<?php echo base_url(); ?>assets/img/core-img/icn_email.png" style="width:60px;height:50px" onclick="tampil_share();">
    </div><br>
</div>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>internal/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>