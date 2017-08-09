<?php

//Load PHPMailer dependencies
require_once 'PHPMailerAutoload.php';
require_once 'class.phpmailer.php';
require_once 'class.smtp.php';
session_start();
/* CONFIGURATION */
$crendentials = array(
    'email'     => 'akshay.chandrachood@gmail.com',    //Your GMail adress
    'password'  => 'nimbus99'               //Your GMail password
    );

/* SPECIFIC TO GMAIL SMTP */
$smtp = array(

'host' => 'smtp.gmail.com',
'port' => 587,
'username' => $crendentials['email'],
'password' => $crendentials['password'],
'secure' => 'tls' //SSL or TLS

);

/* TO, SUBJECT, CONTENT */
$to         = $_POST['email-id'];//'akshay.chandrachood@gmail.com'; //The 'To' field
$subject    = 'BobcatBooks eReceipt';
$content    = "Beloved Customers,<br><br>BobcatBooks highly appreciate your purchase<br>Please download the receipt for your record.<br><br><br>Regards,<br>BobcatBooks Team";



$mailer = new PHPMailer();

//SMTP Configuration
$mailer->isSMTP();
$mailer->SMTPAuth   = true; //We need to authenticate
$mailer->Host       = $smtp['host'];
$mailer->Port       = $smtp['port'];
$mailer->Username   = $smtp['username'];
$mailer->Password   = $smtp['password'];
$mailer->SMTPSecure = $smtp['secure']; 

//Now, send mail :
//From - To :
$mailer->From       = $crendentials['email'];
$mailer->FromName   = 'Akshay'; //Optional
$mailer->addAddress($to);  // Add a recipient

//Subject - Body :
$mailer->Subject        = $subject;
$mailer->Body           = $content;
$mailer->isHTML(true); //Mail body contains HTML tags
$file_to_attach = 'C:/xampp/htdocs/test/email/eReceipt.pdf';

$mailer->AddAttachment( $file_to_attach , 'eReceipt.pdf' );
//Check if mail is sent :
if(!$mailer->send()) {
    echo 'Error sending mail : ' . $mailer->ErrorInfo;
} else {
    $msg= 'Email Has Been Message Sent !';
	$_SESSION['email_sent'] = $msg;
	header("Location: checkout.php?action=$msg");
}
?>