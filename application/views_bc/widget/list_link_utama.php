<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
	<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
		<center>
			<label style="color: #fff;margin-top:10px">Link Utama</label>
		</center>
	</div>
	<div class="panel-body" style="background-color:#fff;">
		<?php $get_link_utama = $this->Mdl_home->get_link_utama();
        foreach ($get_link_utama as $hutama) { ?>
			<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
				<!-- Post Content -->
                <div class="post-content" >
					<a href="<?php echo $hutama['linkurl'];?>" target="_blank">
						<i class="fa fa-link"></i> <?php echo $hutama['linkname']; ?>
                    </a>
                </div>
            </div>
		<?php  } ?>
	</div>
</div>
<br>