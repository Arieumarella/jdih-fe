<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
    <div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
        <center>
            <label style="color: #fff;margin-top:10px">Unit Organisasi</label>
		</center>
	</div>
    <div class="panel-body" style="background-color:#fff;">
        <?php $get_unit = $this->Mdl_home->get_unit();
			foreach ($get_unit as $hunit) {
				$jml_unor = $this->Mdl_home->get_unit_count($hunit['dept_id']);
			?>
            <div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
                <!-- Post Content -->
                <div class="post-content" >
                    <a href="<?php echo base_url() ?>Pencarian-Unit-Organisasi/<?php echo $hunit['dept_id']; ?>" class="headline" title="Total : <?=$jml_unor?>" data-toggle="tooltip" data-placement="right">
                        <i class="fa fa-angle-double-right"></i> <?php echo $hunit['deptname']; ?>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<br>