<?php $this->load->view("include/header");
?><br><br><br><br><?php

//$this->load->view("widget/pencarian_cepat");
?>


<div class="main-content-wrapper section-padding-20" >
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            	<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
					
                    <!-- Catagory Area -->
					<div  id="div_content" style="display:block" >
						<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
							<label style="color: #fff;margin-top:10px;margin-left:10px">Agenda</label>
						</div>
					
						<div class="panel-body" style="background-color:#fff;">
							<div class="container">
								<div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="tab1" >
								
								<?php
								foreach($get_data->result_array() as $rw){
								?>
								  <h4><?php echo $rw['judul'];?></h4>
								  <i class="fa fa-calendar"></i> <?php echo substr($rw['tanggal'],6,2)."/".substr($rw['tanggal'],4,2)."/".substr($rw['tanggal'],0,4)." - ". $rw['jam'];?><br>
								  <?php echo $rw['tempat'];?><br>
								  <?php echo $rw['isi'];?>
								<?php	
								}
								?>
								</div>
							</div>
						</div>
					</div>
                   
                </div>
         


        </div>


    </div>
</div>

<?php
$this->load->view("include/footer")?>