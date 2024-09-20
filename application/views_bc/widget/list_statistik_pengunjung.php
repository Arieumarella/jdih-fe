<?php
$stat_today=$this->Mdl_home->get_stat_today();
$stat_yesterday=$this->Mdl_home->get_stat_yesterday();
$stat_online=$this->Mdl_fungsi->get_user_online();
$stat_total=$this->Mdl_home->get_stat_total();
?>
<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
	<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
		<center>
			<label style="color: #fff;margin-top:10px">Statistik Pengunjung</label>
		</center>
	</div>
	<div class="panel-body" style="background-color:#fff;">
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
				<i class="fa fa-bar-chart"></i> Hari ini : <?php echo number_format($stat_today); ?>
            </div>
        </div>
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
				<i class="fa fa-bar-chart"></i> Kemarin : <?php echo  number_format($stat_yesterday); ?>
            </div>
        </div>
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
				<i class="fa fa-bar-chart"></i> Online : <?php echo  number_format($stat_online); ?>
            </div>
        </div>				  
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
				<i class="fa fa-bar-chart"></i> Total Pengunjung * : <?php echo number_format($stat_total); ?>
				<br> <i>Sejak November 2019</i>
			</div>
       </div>
	</div>
</div>
<br>