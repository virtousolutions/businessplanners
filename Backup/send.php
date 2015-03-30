<?php
session_start();

$data = $_POST;

if($_SESSION['captcha']["code"] != $data['captcha'])
{
  echo json_encode(array("msg"=>"Captcha did not match.","code"=>1));

}
else if(isset($data))
{

	include "classes/class.phpmailer.php"; // include the class name
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);

	$mail->Username = "marvz73@gmail.com";
	$mail->Password = "nhbykrathctdkgyk";//App password generated

	$mail->SetFrom($data['email']);//from

	$mail->Subject = "Biz Planner Contact Us: "  . $data['name'];

	$mail->Body = "<b>Hi, your first SMTP mail via gmail server has been received. Great Job!.. <br/><br/></b>";

	$mail->AddAddress("info@thebusinessplanners.co.uk");//to

	if(!$mail->Send()){
	    echo  json_encode(array("msg"=>"Something went wrong.","code"=>1));
	}
	else{
	    echo json_encode(array("msg"=>"Thank you for contacting us. We'll be in touch shortly.","code"=>0));
	}

}




?>