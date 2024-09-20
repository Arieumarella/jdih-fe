<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JDIH PUPR Internal | Login</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/libs/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/valdo.css">
 <!-- <script src='https://www.google.com/recaptcha/api.js'></script>-->

</head>
<body class="hold-transition login-page" style="background-color:#fff;">

  <header>
    <nav class="navbar navbar-static-top" style="background-color:#0d2d6c;border-bottom-style:solid;border-bottom-width:5px;border-bottom-color:#ffcc00;height:60px">
       <img src="<?php echo base_url();?>assets/images/icon.png" style="margin-top:10px;margin-left:15px;">
	  <label style="color:#fff;margin-top:13px;margin-left:10px;font-size:20px;position:fixed">JDIH PUPR Internal</label>
    </nav>
  </header>
  
  <br><br>
  
  <!-- /.login-logo -->
  <div class="div_login_det">
	<center>
		<img src="<?php echo base_url();?>assets/images/logo2.png">
	</center>
  </div>
  <div class="div_login_det">
  
  <center>
  <div  class="div_login_isi" style="width:75%">
   
	
	<label style="font-size:25px">FORM LOGIN</label>
	
    <form action="<?php echo base_url();?>login/auth" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="User ID" required style="border-radius:25px;height:40px;">
        <span class="glyphicon glyphicon-envelope form-control-feedback" style="height:30px;margin-right:15px;margin-top:4px;"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required style="border-radius:25px;height:40px;">
        <span class="glyphicon glyphicon-lock form-control-feedback" style="height:30px;margin-right:15px;margin-top:4px;"></span>
      </div>
	 <div class="form-group has-feedback" style="display:none">
                            <select name="tipe_2" class="form-control" style="border-radius:25px;height:40px;">
                                <option value="1">JDIH</option>
                                <option value="2">e-HRM</option>
                            </select>
                            <span class="glyphicon glyphicon-th-large form-control-feedback" style="height:30px;margin-right:15px;margin-top:4px;"></span>
                        </div>
		<input type="hidden" name="tipe" value="1">				
      <div class="form-group has-feedback">
		
		<!--<div >
			<div class="g-recaptcha" data-sitekey="6LcVtvwUAAAAAMuGCgV5A7osDZW1BYNsosXl352G"></div>
							
		</div>-->
						
        <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius:25px;height:40px">Sign In</button>
		
        
		<br>
		<br>
		<!-- /.col -->
      </div>
	  
    </form>
	<a href="<?php echo base_url()?>lupa-password" style="font-size:20px"><i class="fa fa-lock"></i> Lupa Password ?</a>
   <?php
  
  if($nr=="p3"){
	  ?>
	  <br><br>
	  <div class="login-logo" style="font-size:16px;color:red">
			<b>Email, Password anda salah atau Akun anda belum teraktivasi</b>
	  </div>
	  <?php
  }
  if($respon=="recaptcha"){
	  ?>
	  <br><br>
	  <div class="login-logo" style="font-size:16px;color:red">
			<b>Anda belum memilih captcha</b>
	  </div>
	  <?php
  }
  ?>
  </div>
   </center>
  </div>
  <!-- /.login-box-body -->

<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
