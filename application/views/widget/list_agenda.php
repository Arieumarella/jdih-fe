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
				<a href="<?php echo base_url() ?>agenda" class="btn btn-primary translatable" style="border:1px solid #00b4d8;color:#fff;font-size:11px;"><u> Lihat semua agenda</u></a>
			</div>
			<?php

			foreach ($get_agenda as $ragenda) { ?>
				<div class="" style="background-color:#fff; margin: 10px; border-left:4px;">
					<h4 style="font-size:16px;"><?php echo $ragenda['judul']; ?></h4>
					<p style="font-size: 14px;"><i class="fa fa-calendar"></i> <?php echo substr($ragenda['tanggal'], 6, 2) . "/" . substr($ragenda['tanggal'], 4, 2) . "/" . substr($ragenda['tanggal'], 0, 4) . " - " . $ragenda['jam']; ?></p>
					<a href="<?php echo base_url() ?>agenda/detail/<?php echo $ragenda['id']; ?>" class="btn btn-primary" style="color:#fff;">Detail</a>
				</div>
			<?php }	?>
		</div>
	</div>
	<br>
	<br>
</div>