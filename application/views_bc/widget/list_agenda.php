<?php
$get_agenda = $this->Mdl_home->get_agenda();
?>
<div <?php if ($get_agenda == null) { ?> style="display: none;" <?php	} ?>>
	<div class="panel panel-default" style="width:100%;">
		<div class="panel-heading" style="border-radius:5px;background-color: #45678d;height:50px;margin-bottom:5px">
			<center>
				<label style="color: #fff;margin-top:10px">Agenda Terbaru</label>
			</center>
		</div>
		<div class="panel-body" style="background-color:#fff;">
			<div align="right">
				<a href="<?php echo base_url() ?>agenda" style="margin-right:15px;margin-top:10px;"><u> Lihat semua agenda</u></a>
			</div>
			<?php

			foreach ($get_agenda as $ragenda) { ?>
				<div class="callout callout-info" style="background-color:#fff;border-left:4px solid #5bc0de">
					<h4><?php echo $ragenda['judul']; ?></h4>
					<i class="fa fa-calendar"></i> <?php echo substr($ragenda['tanggal'], 6, 2) . "/" . substr($ragenda['tanggal'], 4, 2) . "/" . substr($ragenda['tanggal'], 0, 4) . " - " . $ragenda['jam']; ?><br>
					<?php echo $ragenda['isi']; ?><br>

					<a href="<?php echo base_url() ?>agenda/detail/<?php echo $ragenda['id']; ?>" class="btn btn-primary" style="color:#fff;">Detail</a>
				</div>
			<?php }	?>
		</div>
	</div>
	<br>
	<br>
</div>