<!DOCTYPE html>
<?php
	

	/*if(session_status()== PHP_SESSION_NONE){
		session_start();
		echo "session started";
	}
	if(!isset($_SESSION['username'])){
		$errormessage="User already exists";
		echo $errormessage;
	}*/
?>
<html>
	<head>
		<title>University Bookstore</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--CSS file-->
		<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Indie+Flower|Pacifico" rel="stylesheet">
		<link rel="stylesheet" href="custom-styles.css">
		<link rel="stylesheet" href="style.css">
		<!--Bootstrap-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	</head>
	
	<body class="body">
<!--Header Section-->
		<section>	
			<div id="container-fluid">
			<div class="row">
			<center>
				<div class="col-sm-12" style="background-color:Maroon;"><h1 class="title" style="color:white; font-family:Pacifico;">Bobcat Books</h1>
				</div>
					<div style="width:auto">
						<ul>
							<li><img src="images/logo.png" alt=""></li>
							<li><a class="active_menu" href="index.html" style="color:black;">Home</a></li>
							<li><a href="about.html" style="color:black;">About us</a></li>
							<li><a href="#" style="color:black;">Account Registration</a></li>
							<li><a href="#" style="color:black;">Login</a></li>
							<li><a href="#" style="color:black;">Help</a></li>
							<li><a href="contact.html" style="color:black;">Contact us</a><li>
						</ul>
					</div>	
			</center>	
			</div> <!--row div-->	
			
			<h1 style="color:Maroon; font-size: 15;font-family:'Adobe Garamond W01';"><center>Registration</center></h1>

			<div class="row search" style="color:Maroon; font-family:'Adobe Garamond W01'; margin-left: 10em;margin-right: 10em; margin-top: 0;">
					<b><h4 id = "error_message" style="color: red; font-size: 5">*Note: All fields are mandatory</h5></b>
					<form name="registration_form" action="Registration.php"  method="post" onsubmit="return validation()">
						<h3>Personal Information:</h3>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10;">
							<col width="30%" align="center">
							<tr>
								<th><input type="text" id="firstName" name="FirstName" placeholder="First Name" value= "<?php if(!empty($_POST['firstName'])) echo $_POST['firstName']?>" /></th>
								<th><input type="text" id="lastName" name="LastName" placeholder="Last Name" value= "<?php if(!empty($_POST['lastName'])) echo $_POST['lastName']?>"/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="mailID" name="MailID" placeholder="email address" value= "<?php if(!empty($_POST['mailID'])) echo $_POST['mailID']?>"/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="userName" name="UserName" placeholder="User ID" value= "<?php if(!empty($_POST['userName'])) echo $_POST['userName']?>"/></th>	
							</tr>
							<tr><th><br></th></tr>
							<tr>							
								<th><input type="Password" id="password" name="Password" placeholder="Password"/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="cPassword" name="CPassword" placeholder="Confirm Password"/></th>
							</tr>
							</table>
						</div>
						<br>
						<h3>Mailing Address:</h3>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10;">
							<col width="30%" align="center">
								<tr>
									<th><input type="text" id="mailing_Line1" name="Mailing_Line1" placeholder="Line 1" style="width: 320px;" value= "<?php if(!empty($_POST['mailing_Line1'])) echo $_POST['mailing_Line1']?>"/></th>
									<th><input type="text" id="mailing_state" name="Mailing_state" placeholder="State" maxlength="2" value= "<?php if(!empty($_POST['mailing_state'])) echo $_POST['Mailing_state']?>"/></th>
								</tr>
								<tr><th><br></th></tr>
								<tr>
									<th><input type="text" id="mailing_city" name="Mailing_city" placeholder="City" value= "<?php if(!empty($_POST['mailing_city'])) echo $_POST['mailing_city']?>"/></th>
									<th><input type="text" id="mailing_zip" name="Mailing_Zip" placeholder="Zip Code" maxlength="5" value= "<?php if(!empty($_POST['mailing_zip'])) echo $_POST['mailing_zip']?>"/></th>
								</tr>
							</table>
						</div>
						<br>
						<h3>Billing Address:</h3>
						<input type="checkbox" id = "chk_prop" name="address" value="address" onclick="propogate();">Same as Mailing address
						</br>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10px;">
							<col width="30%" align="center">
								<tr>
									<th><input type="text" id="billing_Line1" name="Billing_Line1" placeholder="Line 1" style="width: 320px;"/></th>
									<th><input type="text" id="billing_state" name="Billing_state" placeholder="State" maxlength="2" /></th>
								</tr>
								<tr><th><br></th></tr>
								<tr>
									<th><input type="text" id="billing_city" name="Billing_city" placeholder="City"/></th>
									<th><input type="text" id="billing_zip" name="Billing_Zip" placeholder="Zip Code" maxlength="5" /></th>
								</tr>
							</table>
						</div>
						<br>
						<h3>Credit card Information:</h3>
						<div class="personalInfo">
						<table>
							<tr>
								<th>Card Type:</th>
								<th><select id="cardType" name="CardType">
									<option value=""> </option>
									<option value="Visa">Visa</option>
									<option value="Master Card">Master Card</option>
									<option value="Discover">Discover</option>
									<option value="American Express">American Express</option>
								</select>
								</th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th>Card Number:</th>
								<th><input id="cardNumber" type="text" name="CardNumber" maxlength="16" /></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th>Expiry:</th>
							</tr>
						</table>
						<table>
							<tr>
								<th>Month:</th>
								<th><input type="text" id="cardExpiryMonth" name="CardExpiryMonth" value="" style="width: 80px" maxlength="2" /></th>
								<th>   Year:</th>
								<th><input type="text" id="cardExpiryYear" name="CardExpiryYear" value="" style="width: 80px" maxlength="4" /></th>
							</tr>
							<tr><th><br></th></tr>
						</table>
						</div>
						<br><br>
						<b><h4 id = "error_message2" style="color: red; font-size: 5"><?php if(isset($_POST['error'])) echo $_POST['error'];?>
						</h4></b>
						<center><button type="submit" value="submit">Register</button></center>
					</form>
			</div>	
			</div> <!--div container-->
		</section>
		
		<div id="footer" style="margin-top: 100%;">
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

		
		
	</body>
</html>


<script type="text/javascript">
function validation(){
	//var fname = document.getElementById('firstName')
	var fields=["firstName","lastName","mailID","userName","password","cPassword","mailing_Line1","mailing_city","mailing_state","mailing_zip","billing_Line1","billing_city","billing_state","billing_zip","cardType","cardNumber","cardExpiryYear","cardExpiryMonth"];
	var isCorrect=true;
	var str="Highlighted fields cannot be null<br>";
	var bzip = document.forms["registration_form"]["billing_zip"].value;
	var mzip = document.forms["registration_form"]["mailing_zip"].value;
	var cardnum = document.forms["registration_form"]["CardNumber"].value;
	var emonth = document.forms["registration_form"]["cardExpiryMonth"].value;
	var eyear = document.forms["registration_form"]["cardExpiryYear"].value;
	var pwd = document.forms["registration_form"]["password"].value;
	var cpwd = document.forms["registration_form"]["cPassword"].value;

	var i,l=fields.length;
	var fieldName;
	for(i=0;i<l;i++){
		fieldName=fields[i];
		if(document.forms["registration_form"][fieldName].value == ""){
			//alert(fieldName);
			isCorrect=false;
			document.forms["registration_form"][fieldName].style.borderColor = "red";	
		}
	}

	if((pwd.length>0)&&(cpwd.length>0)&&(pwd!=cpwd)){
			isCorrect=false;
			str+="Confirm password does not match<br>";
	}

	if (isNaN(mzip)){
		str+="Zip code in Mailing address should be a number <br>";
		isCorrect = false;
	}
	else if(mzip>0&&mzip<5){
		str+="zip code in Mailing address should have 5 digits <br>";
		isCorrect = false;
	}

	if (isNaN(bzip)){
		str+="Zip code in Billing address should be a number <br>";
		isCorrect = false;
	}
	else if(bzip>0&&bzip<5){
		str+="Zip code in Billing address should have 5 digits <br>";
		isCorrect = false;
	}

	if (isNaN(cardnum)){
		str+="Card Number should be a number <br>";
		isCorrect = false;
	}
	else if(cardnum>0&&cardnum<16){
		str+="Card Number should have 16 digits <br>";
		isCorrect = false;
	}

	if (isNaN(emonth)){
		str+="Month should be a number <br>";
		isCorrect = false;
	}
	else if(emonth>0&&emonth<2){
		str+="Month should have 2 digits <br>";
		isCorrect = false;
	}

	if (isNaN(eyear)){
		str+="Year should be a number <br>";
		isCorrect = false;
	}
	else if(eyear>0&&eyear<2){
		str+="Year should have 2 digits <br>";
		isCorrect = false;
	}

	if (!isCorrect){
		document.getElementById("error_message").innerHTML=str;
		document.getElementById("error_message2").innerHTML=str;
		return false;
	}
}

function propogate(){
	var line1=document.getElementById("mailing_Line1").value;
	var City = document.getElementById("mailing_city").value;
	var state=document.getElementById("mailing_state").value;
	var zip = document.getElementById("mailing_zip").value;
	

	if (document.getElementById("chk_prop").checked){
		document.getElementById("billing_Line1").value=line1;
		document.getElementById("billing_city").value=City;
		document.getElementById("billing_state").value=state;
		document.getElementById("billing_zip").value=zip;
	}
}
</script>