<?php
$first_name = $_POST['FirstName'];
$last_name = $_POST['LastName'];
$email_id = $_POST['MailID'];
$username = $_POST['UserName'];
$password = $_POST['Password'];
$confirm_password = $_POST['CPassword'];
$mailing_line_1 = $_POST['Mailing_Line1'];
$mailing_city = $_POST['Mailing_city'];
$mailing_state = $_POST['Mailing_state'];
$mailing_zip = $_POST['Mailing_Zip'];
$billing_line_1 = $_POST['Billing_Line1'];
$billling_city = $_POST['Billing_city'];
$billing_state = $_POST['Billing_state'];
$billing_zip = $_POST['Billing_Zip'];
$card_num = $_POST['CardNumber'];
$card_type = $_POST['CardType'];
$card_expiry_month = $_POST['CardExpiryMonth'];
$card_expiry_year = $_POST['CardExpiryYear'];

//Database connection variables.
$servername = 'localhost';
$user = "root";
$pwd="";
$dbname = 'bobcat_books';
$isUserPresent = false;

$conn = new mysqli($servername,$user,$pwd,$dbname);

if($conn->connect_error){
	die(" connection failed: ".$conn->connect_error);
}

$sql = "SELECT * from bb_accounts where bb_user_id='".$username."'";

$result = $conn->query($sql);

while($row=$result->fetch_assoc()){
	//echo("User already present");
	//session_start();
	$_SESSION['username'] = $username;
	$isUserPresent=true;
	echo("
	<form action='Registration1.php' method='POST'>
		<input type='hidden' name='error' value='User already exists'/>
		<input type='submit'>
	</form>"

	);
	//header('Location: Registration1.php');
	exit();
}

if(!$isUserPresent){

	$sql="INSERT INTO bb_accounts VALUES ('".$username."','"
									   .$password."','"
									   .$first_name."','"
									   .$last_name."','"
									   .$email_id."','"
									   .$mailing_line_1."','"
									   .$mailing_city."','"
									   .$mailing_state."',"
									   .$mailing_zip.",'"
									   .$billing_line_1."','"
									   .$billling_city."','"
									   .$billing_state."',"
									   .$billing_zip.",'"
									   .$card_num."','"
									   .$card_type."',"
									   .$card_expiry_year.","
									   .$card_expiry_month.
									   ")";


	if($conn->query($sql)===TRUE){

		header('Location: Login.php');
	}
	else{
		echo("Database connection error");
	}
}

?>
