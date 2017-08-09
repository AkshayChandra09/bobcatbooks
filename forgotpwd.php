<html>
	<body>
	<?php 
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bobcat_books";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if(!$conn)
			echo "error!";

		$uname = $_POST['bb_user_id'];
		$email = $_POST['email'];
		session_start();

		$invalid_uname="Incorrect user ID..";
		
		if($uname!="")
		{
			$query = "select * from bb_accounts	where bb_user_id='".$uname."'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) == 0) {
				$_SESSION['uname']=$invalid_uname;	
				header('Location: forgotpassword.php?uname='.$invalid_uname);
			}
		}
		else if($email!="")
		{
			$query = "select * from bb_accounts	where bb_mail_id='".$email."'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) == 0) {
				$_SESSION['email']=$invalid_uname;	
				header('Location: forgotpassword.php?email='.$invalid_uname);
			}
			
		}
		
	?>
	<?php include 'header.php';?>
		<section>
			<div class="row search" style="color:Maroon; font-size: 15;font-family:'Adobe Garamond W01';">
				<center>
					<h1>Reset Password</h1>
				</center>
			</div>
			<div class="forgot-pwd" style="size: 30; font-family: 'Adobe Garamond W01';color: Maroon;margin-left: 20em;margin-right: 20em">
				<center>
				<form action = 'pwdreset.php' name = 'login_form' method = 'post' onsubmit="return login_validation()">
				<table> 
				<col width = '50%'> 
					<tr>
  						<th align = 'right' style = 'color:maroon'> Enter New Password:</th>
  						<th><input type = 'password' name = 'pwd' id = 'pwd' value = '' style = 'color:maroon;' size = '35' placeholder = 'Password'></th>
  					</tr>
  					<th><br></th>
  					<tr>
  						<th align = 'right' style = 'color:maroon'> Confirm Password:</th>
  						<th><input type = 'password' name = 'confirmPwd' id = 'confirmPwd' value = '' style = 'color:maroon;' size = '35' placeholder = 'Confirm Password'></th>
  					</tr>
  					<tr>
  					<th><br></th>
  					</tr>
  				</table>
  				<center>
  					<input type = 'submit' name = 'resetbtn' value = 'Reset' style = 'size:10; color: Maroon;'/>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  					<button name="resetCancelBtn" style="color: Maroon;size:10; color: Maroon;" onclick="window.location='Login.php';return false;">Cancel</button>
  				</center>
  				<input type="hidden" name = "bb_user_id" value= "<?php echo $_POST['bb_user_id'] ?>">
  				<input type="hidden" name = "email" value = "<?php echo $_POST['email'] ?>">  					
  				</form>
  				</center>
  			</div>
  		</section>
  		<div id="footer" style="margin-top:250px;">
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
  		function login_validation(){
  			var pwd= document.forms['login_form']['pwd'].value;
  			var cpwd=document.forms['login_form']['confirmPwd'].value;

  			if((pwd.length==0) || (cpwd.length==0)){
  				alert("Password and Confirm Password can not be empty");
  				return false;
  			}

  			if(pwd!=cpwd){
  				alert("Password and Confirm Password does not match");
  				return false;
  			}
  			return confirmation();
  		}

  		function confirmation() {
    		var txt;
    		if (confirm("Reset Password?") != true) {
				return false;
    		}
}
  	</script>