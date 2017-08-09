
<script type="text/javascript">
	<?php
		session_start();
		if(isset($_SESSION['updateerror'])){
			echo "alert ('Entered details do not match.');";
	}
	?>
</script>
<?php 
	include 'search-header.php';
	$servername = 'localhost';
	$user = "root";
	$pwd="";
	$dbname = 'bobcat_books';
	
	$conn = new mysqli($servername,$user,$pwd,$dbname);

	if($conn->connect_error){
		die(" connection failed: ".$conn->connect_error);
	}
	$userID = $_SESSION['user_id'];
	
	$sql = "SELECT * from bb_accounts where bb_user_id='".$userID."'";
	$result = $conn->query($sql);
	while($row=$result->fetch_assoc())
	{
		$first_name = $row['bb_first_name'];
		$last_name = $row['bb_last_name'];
		$email_id = $row['bb_mail_id'];
		$username = $row['bb_user_id'];
		$mailing_line_1 = $row['bb_mailing_address_line1'];
		$mailing_city = $row['bb_mailing_address_city'];
		$mailing_state = $row['bb_mailing_address_state'];
		$mailing_zip = $row['bb_mailing_address_zip'];
		$billing_line_1 = $row['bb_billing_address_line1'];
		$billling_city = $row['bb_billing_address_city'];
		$billing_state = $row['bb_billing_address_state'];
		$billing_zip = $row['bb_billing_address_zip'];
		$card_num = $row['bb_credit_card_number'];
		$card_type = $row['bb_credit_card_type'];
		$card_expiry_month = $row['bb_card_expiration_month'];
		$card_expiry_year = $row['bb_card_expiration_year'];
	}
?>

<html>
		
	<body class="body">
<!--Header Section-->
		<section>	
			<div id="container-fluid">
			<div class="row">

			<h1 style="color:Maroon; font-family:'Adobe Garamond W01';"><center>Update Account Details</center></h1>

			<div class="row search" style="color:Maroon; font-family:'Adobe Garamond W01'; margin-left: 10em;margin-right: 10em; margin-top: 0;">
					<b><h4 id = "error_message" style="color: red;">*Note: All fields are mandatory</h5></b>
					<form name="update_account_form" action="UpdateAcc.php" method="post" onsubmit="return Validation()">
						<h3>Personal Information:</h3>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10;">
							<col width="30%" align="center">
							<tr>
								<th><input type="text" id="firstName" name="firstName" placeholder="First Name" value= "<?php echo $first_name;?>"/></th>
								<th><input type="text" id="lastName" name="lastName" placeholder="Last Name" value= "<?php echo $last_name;?>"/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="mailID" name="mailID" placeholder="email address" value= "<?php echo $email_id;?>"/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="text" id="userName" name="userName" placeholder="User ID" value= "<?php echo $username;?>" disabled/></th>	 
							</tr>
							<tr><th><br></th></tr>
							<tr>							
								<th><input type="Password" id="password" name="password" placeholder="Password" value=""/></th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th><input type="Password" id="cPassword" name="cPassword" placeholder="Confirm Password" value=""/></th>
							</tr>
							<tr><th><br></th></tr>
							</table>
						</div>
						
						<h3>Mailing Address:</h3>
						<div class="personalInfo">
							<table>
							<col width="70%" style="margin-left: 10;">
							<col width="30%" align="center">
								<tr>
									<th><input type="text" id="mailing_Line1" name="mailing_Line1" placeholder="Line 1" style="width: 320px;" value= "<?php echo $mailing_line_1;?>"/></th>
									<th><input type="text" id="mailing_state" name="mailing_state" placeholder="State" maxlength="2" value= "<?php echo $mailing_state;?>"/></th>
								</tr>
								<tr><th><br></th></tr>
								<tr>
									<th><input type="text" id="mailing_city" name="mailing_city" placeholder="City" value= "<?php echo $mailing_city;?>"/></th>
									<th><input type="text" id="mailing_zip" name="mailing_zip" placeholder="Zip Code" maxlength="5" value= "<?php echo $mailing_zip;?>"/></th>
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
									<th><input type="text" id="billing_Line1" name="billing_Line1" placeholder="Line 1" style="width: 320px;" value = "<?php echo $billing_line_1;?>"/></th>
									<th><input type="text" id="billing_state" name="billing_state" placeholder="State" maxlength="2" value = "<?php echo $billing_state; ?>"/></th>
								</tr>
								<tr><th><br></th></tr>
								<tr>
									<th><input type="text" id="billing_city" name="billing_city" placeholder="City" value = "<?php echo $billling_city; ?>"/></th>
									<th><input type="text" id="billing_zip" name="billing_zip" placeholder="Zip Code" maxlength="5" value = "<?php echo $billing_zip;?>" /></th>
								</tr>
							</table>
						</div>
						
						<h3>Credit card Information:</h3>
						<div class="personalInfo">
						<table>
							<tr>
								<th>Card Type:</th>
								<th><select id="cardType" name="cardType" value="<?php echo $card_type;?>">
									<option value=""> </option>
									<option value="Visa" <?php if($card_type=="Visa") echo "selected";?>>Visa</option>
									<option value="Master Card" <?php if($card_type=="Master Card") echo "selected";?>>Master Card</option>
									<option value="Discover" <?php if($card_type=="Discover") echo "selected";?>>Discover</option>
									<option value="American Express" <?php if($card_type=="American Express") echo "selected";?>>American Express</option>
								</select>
								</th>
							</tr>
							<tr><th><br></th></tr>
							<tr>
								<th>Card Number:</th>
								<th><input id="cardNumber" type="text" name="cardNumber" maxlength="16" value = "<?php echo $card_num;?>" /></th>
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
									<option value="01" <?php if($card_expiry_month=="01") echo "selected";?>>01</option>
									<option value="02" <?php if($card_expiry_month=="02") echo "selected";?>>02</option>
									<option value="03" <?php if($card_expiry_month=="03") echo "selected";?>>03</option>
									<option value="04" <?php if($card_expiry_month=="04") echo "selected";?>>04</option>
									<option value="05" <?php if($card_expiry_month=="05") echo "selected";?>>05</option>
									<option value="06" <?php if($card_expiry_month=="06") echo "selected";?>>06</option>
									<option value="07" <?php if($card_expiry_month=="07") echo "selected";?>>07</option>
									<option value="08" <?php if($card_expiry_month=="08") echo "selected";?>>08</option>
									<option value="09" <?php if($card_expiry_month=="09") echo "selected";?>>09</option>
									<option value="10" <?php if($card_expiry_month=="10") echo "selected";?>>10</option>
									<option value="11" <?php if($card_expiry_month=="11") echo "selected";?>>11</option>
									<option value="12" <?php if($card_expiry_month=="12") echo "selected";?>>12</option>									
								</select>
								</th>
								<th>   Year:</th>
								<th><input type="text" id="cardExpiryYear" name="cardExpiryYear" value="<?php echo $card_expiry_year;?>" style="width: 80px" maxlength="4" /></th>
							</tr>
							<tr><th><br></th></tr>
						</table>
						</div>
						<b><h4 id = "error_message2" style="color: red;"><?php if(isset($_SESSION['error'])) echo $_SESSION['error'];?>
						</h4></b>
						<b><center><button type="submit" value="Submit"> Update </button> &nbsp;&nbsp;
						&nbsp;	&nbsp;<button type="button" value="Reset" onclick="ClearFields();"> Reset </button></center></b>
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
		<?php unset($_SESSION['updateerror'])?>
	</body>
</html>

<script type="text/javascript">
function ClearFields() {

     document.getElementById("firstName").value = "";
     document.getElementById("lastName").value = "";
     document.getElementById("mailID").value = "";
     document.getElementById("mailing_Line1").value = "";
     document.getElementById("mailing_state").value = "";
     document.getElementById("mailing_city").value = "";
     document.getElementById("mailing_zip").value = "";
     document.getElementById("billing_Line1").value = "";
     document.getElementById("billing_city").value = "";
     document.getElementById("billing_state").value = "";
     document.getElementById("billing_zip").value = "";
     document.getElementById("cardNumber").value = "";
     document.getElementById("cardType").value = "";
     document.getElementById("cardExpiryYear").value = "";
     document.getElementById("cardExpiryMonth").value = "";

}
function Validation(){

	//var fname = document.getElementById('firstName')
	var fields=["firstName","lastName","mailID","userName","mailing_Line1","mailing_city","mailing_state","mailing_zip","billing_Line1","billing_city","billing_state","billing_zip","cardType","cardNumber","cardExpiryYear","cardExpiryMonth"];
	var isCorrect=true;
	var str="Highlighted fields cannot be null<br>";
	var bzip = document.forms["update_account_form"]["billing_zip"].value;
	var mzip = document.forms["update_account_form"]["mailing_zip"].value;
	var cardnum = document.forms["update_account_form"]["cardNumber"].value;
	var emonth = document.forms["update_account_form"]["cardExpiryMonth"].value;
	var eyear = document.forms["update_account_form"]["cardExpiryYear"].value;
	var pwd = document.forms["update_account_form"]["password"].value;
	var cpwd = document.forms["update_account_form"]["cPassword"].value;
	var i,l=fields.length;
	var fieldName;
	for(i=0;i<l;i++){
		fieldName=fields[i];
		//document.forms["update_account_form"][fieldName].style.borderColor = "grey";	
		if(document.forms["update_account_form"][fieldName].value == ""){
			
			isCorrect=false;
			document.forms["update_account_form"][fieldName].style.borderColor = "red";	
		}
	}

	if(pwd!=cpwd){
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