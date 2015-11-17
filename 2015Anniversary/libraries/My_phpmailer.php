<?php
require_once ("PHPMailer/PHPMailerAutoload.php");//載入PHPMailer類別 
class My_phpmailer {

	public function send($to, $subject, $body ,$senter, $sentname){
		  $mail = new PHPMailer();
		  $mail->IsSMTP();

		  $mail->SMTPAuth = true;//使用Gmail的SMTP需要驗證，所以這裡要設true
		  $mail->SMTPSecure = "ssl";

		  //Gmail的SMTP是使用465port
		  $mail->Host = "smtp.gmail.com";
		  $mail->Port = 465;
		  $mail->Username = '';//帳號
		  $mail->Password ='';//密碼

		  $mail->From = $senter;//寄件者
		  $mail->FromName = $sentname;//寄件者姓名

		  $to_mails = explode(',', $to);
		  foreach ($to_mails as $usermail) {
			  $mail->AddAddress($usermail);//收件者
		  }

		  $mail->CharSet = "utf-8";
		  $mail->Encoding = "base64";
		  $mail->IsHTML(true);
		  $mail->WordWrap = 50;

		  $mail->Subject = $subject;//主旨
		  $mail->Body = $body;//內文
		  $mail->AltBody = "Your browser does not support HTML";

		  $mail->Send();
	}

}	
?>