<?php
//$userID = $_POST['userID'];
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];
$email_id = $_POST['mailID'];
//$username = $_POST['userName'];
//$password = $_POST['Password'];
//$confirm_password = $_POST['CPassword'];
$mailing_line_1 = $_POST['mailing_Line1'];
$mailing_city = $_POST['mailing_city'];
$mailing_state = $_POST['mailing_state'];
$mailing_zip = $_POST['mailing_zip'];
$billing_line_1 = $_POST['billing_Line1'];
$billing_city = $_POST['billing_city'];
$billing_state = $_POST['billing_state'];
$billing_zip = $_POST['billing_zip'];
$card_num = $_POST['cardNumber'];
$card_type = $_POST['cardType'];
$card_expiry_month = $_POST['CardExpiryMonth'];
$card_expiry_year = $_POST['cardExpiryYear'];
$password=$_POST['password'];
$updated = false;
$updateerror = "Update unsuccessful. Please enter valid details to update again.";
$successMessage = "User information has been updated successfully";

//Database connection variables.
$servername = 'localhost';
$user = "root";
$pwd="";
$dbname = 'bobcat_books';
$isUserPresent = false;

session_start();
$userID = $_SESSION['user_id'];
$conn = new mysqli($servername,$user,$pwd,$dbname);

if($conn->connect_error){
	die(" connection failed: ".$conn->connect_error);
}

$userID = $_SESSION['user_id'];

$sql = "SELECT * from bb_accounts where bb_user_id='".$userID."'";

$result = $conn->query($sql);
while($row=$result->fetch_assoc())
{
	
	$res = "UPDATE bb_accounts 
			SET bb_first_name = '".$first_name."',
				bb_last_name = '".$last_name."', 
				bb_mail_id = '".$email_id."',
				bb_mailing_address_line1 = '".$mailing_line_1."',
				bb_mailing_address_city = '".$mailing_city."',
				bb_mailing_address_state = '".$mailing_state."',
				bb_mailing_address_zip = '".$mailing_zip."',
				bb_billing_address_line1 = '".$billing_line_1."',
				bb_billing_address_city = '".$billing_city."',
				bb_billing_address_zip = '".$billing_zip."',
				bb_credit_card_type = '".$card_type."',
				bb_card_expiration_year = '".$card_expiry_year."',
				bb_card_expiration_month = '".$card_expiry_month."'";
			if($password!="")
				$res=$res.",bb_pwd = '".$password."'";
			$res=$res." WHERE bb_user_id = '".$userID."'";

			echo $res;
	$res1 = $conn->query($res);
	echo $res1;
	$updated = true;
}
if($res1){
	$_SESSION["updateSuccessMessage"] = $successMessage;
	header('Location: search.php?updateSuccessMessage='.$successMessage);
	exit();
}
else{
	$_SESSION["updateerror"] = $updateerror;
    header('Location: UpdateAccount.php?updateerror='.$updateerror);
    exit();
}

?>
