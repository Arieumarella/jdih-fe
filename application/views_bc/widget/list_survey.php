<link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/star/style.css" />
<?php
//$stat_today=$this->Mdl_home->list_survey();
?>

<div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
	<div class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
		<center>
			<label style="color: #fff;margin-top:10px">Tingkat Kepuasan</label>
		</center>
	</div>
	<div class="panel-body" style="background-color:#fff;">
		<div class="container"  style="min-height:35px;border-bottom: 1px solid #e8e8e8;margin-top:10px;color:#000;">
			<div class="post-content" >
				<a href="#" class="btn btn-primary" onclick="tampil_share();">Isi Survey</a>
            </div>
        </div>
		
	</div>
</div>
<br>

<div id="Modal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header"><h4 class="modal-title">Kirim email </h4></div>
            <div class="modal-body">
				<div id="isi_email" style="display:block">
				
					<div class="group">
						<input type="text" name="name" id="nama" required>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label>Nama Pengirim</label>
					</div>
					<div class="group">
						<textarea name="komentar" id="komentar" class="form-control" rows="5" required></textarea>
						<span class="highlight"></span>
						<span class="bar"></span>
						<label>Komentar</label>
						
						
					</div>
					
						<label style="float:left">Tingkat Kepuasan</label><br>
					<div class="rating">
						
						<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
						<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
						<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
						<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
						<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
					</div>
					<br><br><br>
					<label id="lblinfo" style="color:red;float:left"></label>
				</div>
				<div id="result_email" style="display:none">
					<center>
						<img src="<?php echo base_url();?>assets/images/loading1.gif" id="img1">
						<label id="lblnotif" ></label>
					</center>
				</div>
				<input type="hidden" id="appi" value="">
				
            </div>
            <div class="modal-footer">

                <p style="font-size:20px;text-align:left" id="lbl_modal1"></p>
                <button type="button" id="btn1"  class="btn btn-primary" data-dismiss="modal" style="width:120px;float:right;">Tutup</button>&nbsp;&nbsp;
                <button type="button" id="btn2"  class="btn btn-primary" style="width:120px;float:right;" onclick="kirim_survey();">Kirim Survey</button>&nbsp;&nbsp;
				<button type="button" id="btn3"  class="btn btn-primary" style="width:120px;float:right;display:none" onclick="sukses();">OK</button>&nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>

<script>
	function kirim_survey() {
		document.getElementById("lblnotif").innerHTML='';
		var nama=document.getElementById("nama").value;
		var komentar=document.getElementById("komentar").value;
		var star5=document.getElementById("star5");
		var star4=document.getElementById("star4");
		var star3=document.getElementById("star3");
		var star2=document.getElementById("star2");
		var star1=document.getElementById("star1");
		var star='';
		if(star5.checked==true){star="5"}
		else if(star4.checked==true){star="4"}
		else if(star3.checked==true){star="3"}
		else if(star2.checked==true){star="2"}
		else if(star1.checked==true){star="1"}
		document.getElementById("btn1").style.display="block";
		document.getElementById("btn2").style.display="block";
		document.getElementById("btn3").style.display="none";
		
		if(nama==""){
			document.getElementById("isi_email").style.display="block";
			document.getElementById("result_email").style.display="none";
			document.getElementById("img1").style.display="none";
			document.getElementById("lblinfo").innerHTML='Nama masih kosong';
			document.getElementById("btn1").style.display="block";
			document.getElementById("btn2").style.display="block";
			document.getElementById("btn3").style.display="none";
		
		}
		else if(komentar==""){
			document.getElementById("isi_email").style.display="block";
			document.getElementById("result_email").style.display="none";
			document.getElementById("img1").style.display="none";
			document.getElementById("lblinfo").innerHTML='Komentar masih kosong';
			document.getElementById("btn1").style.display="block";
			document.getElementById("btn2").style.display="block";
			document.getElementById("btn3").style.display="none";
		
		}
		else if(star==""){
			document.getElementById("isi_email").style.display="block";
			document.getElementById("result_email").style.display="none";
			document.getElementById("img1").style.display="none";
			document.getElementById("lblinfo").innerHTML='Tingkat kepuasan belum dipilih';
			document.getElementById("btn1").style.display="block";
			document.getElementById("btn2").style.display="block";
			document.getElementById("btn3").style.display="none";
		
		}
		else{
			document.getElementById("isi_email").style.display="none";
			document.getElementById("result_email").style.display="block";
			document.getElementById("img1").style.display="block";
			document.getElementById("lblnotif").innerHTML='';
			document.getElementById("btn1").style.display="block";
			document.getElementById("btn2").style.display="block";
			document.getElementById("btn3").style.display="none";
		
		
			$.ajax({
				url: "<?php echo base_url();?>internal/assets/api/kirim_survey.php",
				dataType:"json",
				type:"POST",
				data:{guid:guid,gukey:gukey,nama:nama,rating:star,komentar:komentar},
				success:function(result){
					$.each(result,function(i,item){
						if(item.respon=="ok"){
							document.getElementById("isi_email").style.display="none";
							document.getElementById("result_email").style.display="block";
							document.getElementById("img1").style.display="none";
							document.getElementById("lblnotif").innerHTML='Terima kasih telah berpartisipasi untuk mengisi tingkat kepuasan terhadap JDIH Kementerian Pekerjaan Umum dan Perumahan Rakyat';
							document.getElementById("btn1").style.display="none";
							document.getElementById("btn2").style.display="none";
							document.getElementById("btn3").style.display="block";
		
						}else{
							document.getElementById("isi_email").style.display="none";
							document.getElementById("result_email").style.display="block";
							document.getElementById("img1").style.display="none";
							document.getElementById("lblnotif").innerHTML='Maaf tingkat kepuasan yang Anda kirim gagal tersimpan, silahkan coba kembali';
							document.getElementById("btn1").style.display="block";
							document.getElementById("btn2").style.display="none";
							document.getElementById("btn3").style.display="none";
						}
					})
				},timeout:30000,
				error:function(){
					document.getElementById("isi_email").style.display="none";
					document.getElementById("result_email").style.display="block";
					document.getElementById("img1").style.display="none";
					document.getElementById("lblnotif").innerHTML='Maaf tingkat kepuasan yang Anda kirim gagal tersimpan, silahkan coba kembali';
					document.getElementById("btn1").style.display="block";
					document.getElementById("btn2").style.display="none";
					document.getElementById("btn3").style.display="none";
				}
			})
		}
		
    }
	function sukses(){
		location.reload();
	}
	function tampil_share() {
		document.getElementById("isi_email").style.display="block";
		document.getElementById("result_email").style.display="none";
		document.getElementById("nama").value="";
		document.getElementById("komentar").value="";
		document.getElementById("star1").checked=false;
		document.getElementById("star2").checked=false;
		document.getElementById("star3").checked=false;
		document.getElementById("star4").checked=false;
		document.getElementById("star5").checked=false;
		
        $('#Modal1').modal({backdrop: 'static', keyboard: false});
    }
</script>