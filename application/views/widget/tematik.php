<div class="panel panel-default mt-5" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div class="panel-heading" style="border-radius:5px;background-color: #45678d;height:50px;margin-bottom:5px">
        <center>
            <label style="color: #fff;margin-top:10px">Tematik</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
                <div class="row">
                    <?php 
                        $get_tags = $this->Mdl_home->get_tags_fe(); 
                        foreach ($get_tags as $row) {
                    ?>
                        <div class="col-md-2">
                            <a href="">
                                <div
                                    class="rounded-circle text-center"
                                    style="
                                        background-color: #45678d;
                                        font-size:16px;
                                        margin-bottom:10px;
                                        color: #fff;
                                        margin-left:20px;
                                        width: 50px;height: 50px;
                                        overflow: hidden;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    ">
                                        <?php if ( preg_match("/\.jpg|\.jpeg|\.png/", $row["icon"]) ) : ?>
                                        <img
                                            src="<?= base_url("internal/assets/assets/tags/{$row["icon"]}"); ?>"
                                            style="object-fit: cover;width: 27px;height: 27px;"
                                        >
                                        <?php else : ?>
                                        <i class="<?= $row['icon']; ?> fa-lg"></i>
                                        <?php endif; ?>
                                    <br>
                                </div>
                                <p class="text-secondary text-center" style="font-size: 14px;"><?= $row['name']; ?></p>
                            </a>
                        </div>
                    <?php } ?>
                </div>
			</div>
		</div>
    </div>
</div>
<br>

