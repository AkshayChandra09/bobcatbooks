<?php
	
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
	
	
	
	/*$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bobcat_books";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);*/
	$loginerror = "Invalid username or password";
	// Check connection
	if($conn->connect_error){
		die(" connection failed: ".$conn->connect_error);
	}

	$user_id = $_POST['b_user_id'];
	$pwd = $_POST['b_password'];
	$query = "SELECT bb_pwd,bb_user_id,bb_first_name FROM bb_Accounts WHERE bb_user_id = '".$user_id."'"; 
				
	$result=$conn->query($query);

	session_start();
	while($row=$result->fetch_assoc()){
		//session_start();
		if($row['bb_pwd']==$pwd){
			$_SESSION["user_id"]=$user_id;
			$_SESSION["user_name"]=$row["bb_first_name"];
			header('Location: search.php?user_id='.$user_id.'&user_name='.$row["bb_first_name"]);
			exit();
		}
		else{
			$_SESSION["loginerror"] = $loginerror;
        	header('Location: login.php?loginerror='.$loginerror);
        	exit();
		}
	}

	$_SESSION["loginerror"] = $loginerror;
    header('Location: login.php?loginerror='.$loginerror);
    exit();				
?>