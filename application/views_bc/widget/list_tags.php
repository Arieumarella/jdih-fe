<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
        <center>
            <label style="color: #fff;margin-top:10px">Substansi</label>
        </center>
    </div>
    <div class="panel-body" style="background-color:#fff;">
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
				<?php 
				$get_tags = $this->Mdl_home->get_tags();
				foreach ($get_tags as $htags) {
					?>
					
						<!-- Post Content -->
						
							<a href="<?php echo base_url() ?>Pencarian-Unit-Substansi/<?php echo $htags['tag_id']; ?>" class="btn btn-primary btn-xs" style="border:1px solid #45678d;background-color:#45678d;color:#fff;font-size:11px;margin-bottom:5px;margin-left:8px;">
								<?php echo $htags['tagname']; ?>
							</a>
						
					
		<?php } ?>
				 </div>
		</div>
    </div>
</div>
<br>

