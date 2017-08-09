<script type="text/javascript">
<?php
	session_start();
	if(isset($_SESSION['loginerror'])){
		echo "alert ('Invalid User id or password');";
	}
	if(isset($_SESSION['successMessage'])){
		echo "alert ('Password has been reset successfully');";
	}
	if(isset($_SESSION['registrationSuccecss'])){
		echo "alert ('User Registered successfully');";
	}
?>
</script>
<!DOCTYPE html>
<html>
	<head>
		<title>Account Login</title>
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
			<div class="row" style="background-color:#A93226;">

			<center>
				<div class="col-sm-12" style="background-color:Maroon;"><h1 class="title" style="color:white; font-family:Adobe Garamond W01;">Bobcat Books </h1></div>
				<form action="login_page.php" name="login_form" method="post" onsubmit="return login_validation()">
					<table align="right" cellpadding="50" style="margin-top: 10px; background-color:#A93226;margin-right: 50px;color: Maroon;">
					<div class="col-sm-12" style="background-color:Maroon;">
						<tr style="font-weight: bold;color: Maroon">
							<td><input type="text" name="b_user_id" id="b_user_id" value="" placeholder="User ID"></td>
  							<td> &nbsp &nbsp</td>
  							<td><input type="password" name="b_password" id="b_password" value="" placeholder="Password"></td>
  							<td> &nbsp &nbsp</td>
  							<td><input type="submit" name="loginbtn" value="Log In" style="size:15;font-size: 14"></td>
						</tr>
						<tr>
							<td colspan="1" align="left" style="color: White;font-size: 15;">New User? Register below</td>
							<td colspan="2" align="left"><a href="forgotpassword.php" style="font-size: 13;color: White;" /><u>Forgot Password?</u></td><br>
						</tr>	
					</div>
					</table>
				</form>
				</div>
				<div class="row" style="width:auto">
						<ul>
							<li><img src="images/txst-primary.png" width ="200" height="50" alt="" align="left"></li>
							<li><b><a class="active_menu" href="login.php" style="color:black; font-family:Adobe Garamond W01;">Home</a></b></li>
							<li><b><a href="about.php" style="color:black; font-family:Adobe Garamond W01;">About us</a></b></li>
							<li><b><a href="Help.php" style="color:black; font-family:Adobe Garamond W01;">Help</a></b></li>
							<li><b><a href="contact.php" style="color:black; font-family:Adobe Garamond W01;">Contact us</a></b><li>
						</ul>
					</div>
					<div style="margin-top:0;">
						<h3 style="background-color:Maroon; color:white; position: relative;"></h3>
					</div>	
			</center>	
				
			</div> <!--row div-->	
			</div> <!--div container-->
		</section>
			
			<h1 style="color:Maroon; font-family:'Adobe Garamond W01';"><center>Registration</center></h1>

			<div class="row search" style="color:Maroon; font-family:'Adobe Garamond W01'; margin-left: 10em;margin-right: 10em; margin-top: 0;">
					<b><h4 id = "error_message" style="color: red;">*Note: All fields are mandatory</h5></b>
					<form name="registration_form" action="Registration.php"  method="post" onsubmit="return accValidation()">
						<h3>Personal Information:</h3>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10;">
							<col width="30%" align="center">
							<tr>
								<th><input type="text" id="firstName" name="FirstName" placeholder="First Name" value= ""></th>
								<th><input type="text" id="lastName" name="LastName" placeholder="Last Name" value= ""/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="mailID" name="MailID" placeholder="email address" value= ""/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="userName" name="UserName" placeholder="User ID" value= ""/></th>	
							</tr>
							<tr><th><br></th></tr>
							<tr>							
								<th><input type="Password" id="password" name="Password" placeholder="Password"/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="Password" id="cPassword" name="CPassword" placeholder="Confirm Password"/></th>
							</tr>
							</table>
						</div>
						
						<h3>Mailing Address:</h3>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10;">
							<col width="30%" align="center">
								<tr>
									<th><input type="text" id="mailing_Line1" name="Mailing_Line1" placeholder="Line 1" style="width: 320px;" value= ""/></th>
									<th><input type="text" id="mailing_state" name="Mailing_state" placeholder="State" maxlength="2" value= ""/></th>
								</tr>
								<tr><th><br></th></tr>
								<tr>
									<th><input type="text" id="mailing_city" name="Mailing_city" placeholder="City" value= ""/></th>
									<th><input type="text" id="mailing_zip" name="Mailing_Zip" placeholder="Zip Code" maxlength="5" value= ""/></th>
								</tr>
							</table>
						</div>
						
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
						
						<h3>Credit card Information:</h3>
						<div class="personalInfo">
						<table>
							<tr>
								<th>Card Type:</th>
								<th><select id="cardType" name="CardType" style="width: 200px">
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
								<th><select id="cardExpiryMonth" name="CardExpiryMonth" value="" style="width: 80px">
									<option value=""> </option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>									
								</select>
								</th>
								<th>   Year:</th>
								<th><input type="text" id="cardExpiryYear" name="CardExpiryYear" value="" style="width: 80px" maxlength="4" /></th>
							</tr>
							<tr><th><br></th></tr>
						</table>
						</div>
						<b><h4 id = "error_message2" style="color: red;"><?php if(isset($_SESSION['error'])) echo $_SESSION['error'];?>
						</h4></b>
						<center><button type="submit" value="submit">Register</button></center>
					</form>
			</div>	
			</div> <!--div container-->
		</section>


			<div id="footer" style="margin-top: 100%;position: relative;padding: 0;width: auto;">
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
		<?php session_destroy();?>
	</body>
</html>

<script type="text/javascript">
function login_validation()
 {
	var bb_user_id = document.forms["login_form"]["b_user_id"].value;
	var password = document.forms["login_form"]["b_password"].value;

	if(bb_user_id == "" || password == "")
	 {
	 		alert("Blank username or Password. Please ensure you enter userID and Password.");
	 		//document.document.forms["login_form"]["b_user_id"].style.borderColor = "red";
	 		//document.document.forms["login_form"]["b_password"].style.borderColor = "red";
        	return false;
	 }

}

function accValidation(){
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
	else if(mzip.length>0&&mzip.length<5){
		str+="zip code in Mailing address should have 5 digits <br>";
		isCorrect = false;
	}

	if (isNaN(bzip)){
		str+="Zip code in Billing address should be a number <br>";
		isCorrect = false;
	}
	else if(bzip.length>0&&bzip.length<5){
		str+="Zip code in Billing address should have 5 digits <br>";
		isCorrect = false;
	}

	if (isNaN(cardnum)){
		str+="Card Number should be a number <br>";
		isCorrect = false;
	}
	else if(cardnum.length>0&&cardnum.length<16){
		str+="Card Number should have 16 digits <br>";
		isCorrect = false;
	}

	if (isNaN(emonth)){
		str+="Month should be a number <br>";
		isCorrect = false;
	}
	else if(emonth.length>0&&emonth.length<2){
		str+="Month should have 2 digits <br>";
		isCorrect = false;
	}

	if (isNaN(eyear)){
		str+="Year should be a number <br>";
		isCorrect = false;
	}
	else if(eyear.length>0&&eyear.length<4){
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
