<?php
	session_start();
	require('search-header.php');
	unset($_SESSION["cart_item"]);
	unset($_SESSION["srch"]);
	if(isset($_SESSION['email_sent'])){
		echo "<script type='text/javascript'>alert('Email Has Been Message Sent !');</script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>University Bookstore</title>
	</head>
	<body>
	<div align="center" style="background-color: #F9E79F; color: Maroon;font-family:'Adobe Garamond W01';margin: 5em 10em 10em;">
			<h2>e-Receipt</h2>
			<h4>Receipt No: <?php echo date("ymdhis")?></h4>
			<?php $recpt_no = "Receipt No: BB".date("ymdhis");?>
			
<?php
	//require('header.php');
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bobcat_books";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$passed_array = unserialize($_POST['shop']);
	$total = $_POST['amount'];
	$user_id=$_SESSION['user_id'];
	$query="SELECT * FROM bb_accounts WHERE bb_user_id='" . $user_id . "'";
	$result = mysqli_query($conn, $query);
	$user_details=array();
	$line="______________________________________________________";
	
	if (mysqli_num_rows($result) > 0) {
		//$row = mysqli_fetch_array($result);	
		while($row = mysqli_fetch_assoc($result)) {
			echo "<h3>User Details<br>User-Id: " . $row["bb_user_id"] ."<br>";
			echo " Name: " . $row["bb_first_name"]. " " . $row["bb_last_name"]. "<br>";
			echo " e-mail: " . $row["bb_mail_id"]. "<br>";
			echo " Address: ";
			echo $row["bb_mailing_address_line1"]. "<br>";
			echo $row["bb_mailing_address_city"].", ".$row["bb_mailing_address_state"].", ",$row["bb_mailing_address_zip"] ."<br>";
			echo " Card Type: ". $row["bb_credit_card_type"]. "<br>";
			$card_no = $row["bb_credit_card_number"];
			$array  = array_map('intval', str_split($card_no));
			for($i=0;$i<12;$i++)
			{
				$card_no[$i]="*";
			}
			print_r("Card: ".$card_no. "</h3>");

			
			//for pdf
			$user_id= "User-id: ".$row["bb_user_id"];
			$name= "Name: ".$row["bb_first_name"]. " " . $row["bb_last_name"];
			$email= "Email: ".$row["bb_mail_id"];
			$address= "Address: ".$row["bb_mailing_address_line1"];
			$city = $row["bb_mailing_address_city"].", ".$row["bb_mailing_address_state"].", ".$row["bb_mailing_address_zip"];
			$card= "Card: ".$card_no;
			array_push($user_details, $user_id);
			array_push($user_details, $name);
			array_push($user_details, $email);
			array_push($user_details, $address);
			array_push($user_details, $city);
			array_push($user_details, $card);
		}

		array_push($user_details, $line);
	}
	
	$books_array=array();
	
	foreach($passed_array as $k => $v)
	{
		$books=array();
		echo "<h3>Title: ".$v["bb_title"]."<br>"; 
		echo "ISBN: ". $v["bb_isbn"]."<br>";
		echo "Quantity: ". $v["quantity"]."<br>";
		echo "Price: ". $v["bb_price"]. "<br></h3>";
		echo "______________________________________________________";
		//for pdf
		$title = "Title: ".$v["bb_title"];
		array_push($books, $title);
		$isbn = "ISBN: ".$v["bb_isbn"];
		array_push($books, $isbn);
		$quantity = "Quantity: ".$v["quantity"];
		array_push($books, $quantity);
		$price = "Price: $".$v["bb_price"];
		array_push($books, $price);
		array_push($books, $line);
		array_push($books_array,$books);
	}
		
	$total = (float)$total;
	echo "<br><h3>Total: ". $total."</h3>";
	
?>
			<form action="fpdf181/mypdf.php" method="post">
				<input type="hidden" name="recpt_no" value='<?php echo $recpt_no;?>'>
				<input type="hidden" name="user" value='<?php echo json_encode($user_details);?>'>
				<input type="hidden" name="books" value='<?php  echo json_encode($books_array);?>'>
				<input type="hidden" name="total" value='<?php echo "$".$total;?>'>
				<input type="submit" name="pdf" Value="Download Recipt">
			</form>
			<br>

			<form action="email.php" method="POST">
				<input type="text" id="email" name="email-id" value=""/>
				<input type="submit" name="submit" value="Email Recipt"/>
			</form>	
			<h2>Thank you for shopping with us!</h2>	
				
			<form action="search.php?action=empty" method="post">
				<input type="submit" name="shop_more" value="Continue Shopping"/>
			</form><br><br>	
		</div>	
		
	</body>
	<div id="footer" >
				<div class="connect">
					<div>
						<h1>FOLLOW US ON</h1>
							<div>
								<a href="https://www.facebook.com/txstateu/" class="facebook" target="_blank">facebook</a>
								<a href="https://twitter.com/txst" class="twitter" target="_blank">twitter</a>
							</div>
					</div>
				</div>
				<div class="footnote">
					<div>
						<p>&copy; 2017 BY Akshay Harika Srinithi | ALL RIGHTS RESERVED</p>
					</div>
				</div>
			</div>
</html>

<script type="text/javascript">
	function emailCheck()
	{
		var email = document.getElementById('email').value;
		if(email=="")
		{
			alert("Please Enter email id..");
			return false;
		}
	}
</script>
