<?php
include "class.phpmailer.php";
include "class.smtp.php";

$mail = new PHPMailer();
					
					$To='sandyvaldo90@gmail.com';
					$ToName='sandy';
					//$this->db->where("tipe","Feedback_Pengirim");
					//$this->db->limit(0,1);
					//$tmp=$this->db->get("tb_email_template")->result_array();
					
					$gambar='email_1.jpg';
					$g_path='email_1.jpg';
					//echo $g_path;
					$g_cid='gpromo';
					$g_name=$gambar;
					$encoding = 'base64';
					$g_type = 'application/octet-stream';
					//$mail->AddEmbeddedImage('test.gif','testImage','test.gif');
					$mail->AddEmbeddedImage($g_path, $g_cid, $g_name,$encoding, $g_type,$disposition = 'inline');
					$ganti='<img src="cid:gpromo">';
					$body=$ganti;
					
					

					$mail->IsSMTP();                 	// send via SMTP
					$mail->Host     = 'www.melkhior.co'; 
					$mail->SMTPAuth = true;     		// turn on SMTP authentication
					$mail->Username = 'demo@melkhior.co';  
					$mail->Password = 'AdminMlk123#'; 
					
					$mail->From     = 'demo@melkhior.co';
					$mail->FromName = 'Digital Lounge Campus';
					
					$mail->AddAddress($To , $ToName);

					$mail->WordWrap = 50;				// set word wrap
					$mail->Priority = 2; 
					
					$mail->Subject  =  $Subject;
					//$mail->AddAttachment("email_1.jpg.","promo.jpg",$encoding = 'base64',$type = 'application/octet-stream'); 
					
					$mail->Body     = $body;
					
					//$mail->msgHTML($body);
					$mail->IsHTML(true);  
					$mail->SMTPDebug = 2;
					//$mail->Port = 465;
					
					
					if(!$mail->Send()){
						$mail_stat_ins = $mail->ErrorInfo;
						echo $mail_stat_ins;
					}
					else{
						echo "sukses";
						
					}
?>