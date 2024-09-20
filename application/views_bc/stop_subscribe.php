<center>
    <div style="background-color: #45678D;position: fixed; top: 0; left: 0;width: 100%;">
        <br>
        <?php
        $data_img = array(
            'src' => 'assets/img/core-img/logo.png'
        );
        echo img($data_img);
        echo br(2);
        ?>

    </div>
    <div style="font-size:25px;margin-top:160px;font-family:sans-serif">
        <?php if ($res == "ok") {
            echo "Anda berhasil berhenti berlangganan Produk Hukum JDIH Kementerian PUPR";
        } else {
            echo "<font color='red'>Anda gagal berhenti berlangganan Produk Hukum JDIH Kementerian PUPR</font>";
        } ?>

    </div>
    <div style="background-color: #45678D;position: fixed; bottom: 0;left: 0;width: 100%;">
        <?php
        echo br(3);
        ?>
    </div>
</center>