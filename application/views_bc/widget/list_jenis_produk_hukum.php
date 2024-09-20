<style>
	/* unvisited link */
	.panel a:link {
		color: #000;
	}

	/* visited link */
	.panel a:visited {
		color: #000;
	}

	/* mouse over link */
	.panel a:hover {
		color: #45678d;
	}

	/* selected link */
	.panel a:active {
		color: #45678d;
	}
</style>
<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
	<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
		<center>
			<label style="color: #fff;margin-top:10px">Jenis Produk Hukum</label>
		</center>
	</div>
	<div class="panel-body" style="background-color:#fff;">
		<div class="panel box box-primary">
			<div class="box-header with-border" style="display:none;border-bottom: 1px solid #e8e8e8;">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color:#000;margin-left:20px;">
						Peraturan Perundangan <i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
					</a>
				</h4>
			</div>
			<div id="collapse1" class="panel-collapse">
				<div class="box-body">
					<?php
					$get_pp = $this->Mdl_home->get_pp('1');
					foreach ($get_pp as $hpp) {
						$jumlah = $this->Mdl_home->get_pp_count($hpp['peraturan_category_id']);
					?>
						<div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<!-- Post Content -->
							<div class="post-content" style="">
								<a href="<?php echo base_url(); ?>Pencarian-produk-hukum/1/<?php echo $hpp['peraturan_category_id']; ?>" class="headline" title="Total : <?= $jumlah ?>" data-toggle="tooltip" data-placement="right">
									<i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="panel box box-primary" style="display:none">
			<div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="color:#000;margin-left:20px;">
						Monografi<i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
					</a>
				</h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					$get_pp = $this->Mdl_home->get_pp('2');
					foreach ($get_pp as $hpp) {
					?>
						<div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<!-- Post Content -->
							<div class="post-content">
								<a href="<?php echo base_url(); ?>Pencarian-produk-hukum/2/<?php echo $hpp['peraturan_category_id']; ?>" class="headline">
									<i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="panel box box-primary" style="display:none">
			<div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style="color:#000;margin-left:20px;">
						Artikel / Majalah <i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
					</a>
				</h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					$get_pp = $this->Mdl_home->get_pp('3');
					foreach ($get_pp as $hpp) {
					?>
						<div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<!-- Post Content -->
							<div class="post-content">
								<a href="<?php echo base_url(); ?>Pencarian-produk-hukum/3/<?php echo $hpp['peraturan_category_id']; ?>" class="headline">
									<i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="panel box box-primary" style="display:none">
			<div class="box-header with-border" style="border-bottom: 1px solid #e8e8e8;">
				<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse4" style="color:#000;margin-left:20px;">
						Putusan Pengadilan<i class="fa fa-plus" style="float:right;margin-right:20px;margin-top:15px"></i>
					</a>
				</h4>
			</div>
			<div id="collapse4" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					$get_pp = $this->Mdl_home->get_pp('4');
					foreach ($get_pp as $hpp) {
					?>
						<div class="container" style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
							<!-- Post Content -->
							<div class="post-content">
								<a href="<?php echo base_url(); ?>Pencarian-produk-hukum/4/<?php echo $hpp['peraturan_category_id']; ?>" class="headline">
									<i class="fa fa-list"></i> <?php echo $hpp['percategoryname']; ?>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<br>