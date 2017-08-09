<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bobcat_books";
	$smessage = "Reset password successful";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if(!$conn)
		echo "error!";

	$uname = $_POST['bb_user_id'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	function update_database($userID,$rstPwd){
		global $conn,$smessage;
		$query = "UPDATE bb_Accounts SET bb_pwd = '".$rstPwd."' WHERE bb_user_id = '".$userID."'";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			session_start();
			$_SESSION["successMessage"]=$smessage;
			header('Location: login.php?successMessage='.$smessage);
			exit();
		}
	}

	if(!empty($uname))
	{
		// code to input new password
		update_database($uname,$pwd);
	}
	else if($email)
	{
		$query = "SELECT * from bb_Accounts where bb_mail_id = '" .$email. "'";
		$result = mysqli_query($conn,$query);
			
		while($row = $result->fetch_assoc()) 
		{	
			update_database($row["bb_user_id"],$pwd);
			echo $row["bb_email_id"];	
    	}	
	}
?>
