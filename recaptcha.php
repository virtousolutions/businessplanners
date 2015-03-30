<?php
session_start();

$_SESSION = array();
include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

$captcha = $_SESSION['captcha']['image_src'];

echo json_encode(array('mgs'=>"Recaptcha ". $_SESSION['captcha']["code"] ,'src'=>$captcha,"code"=>0));

?>