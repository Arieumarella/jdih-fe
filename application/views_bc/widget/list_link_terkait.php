<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
        <center>
            <label style="color: #fff;margin-top:10px">Link Terkait</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">
        <?php $get_link_terkait = $this->Mdl_home->get_link_terkait();
        foreach ($get_link_terkait as $hterkait) {
            ?>
            <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                <!-- Post Content -->
                <div class="post-content" >
                    <a href="<?php echo $hterkait['linkurl']; ?>" target="_blank">
                        <i class="fa fa-link"></i> <?php echo $hterkait['linkname']; ?>
                    </a>
                </div>
            </div>
<?php } ?>
    </div>
</div>
<br>

