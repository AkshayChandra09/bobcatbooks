<script type="text/javascript">
<?php 
		session_start();
		if(isset($_SESSION['uname']))
			echo "alert('Incorrect user id..');";
		if(isset($_SESSION['email']))
			echo "alert('Incorrect email id..');";
				
	?>
</script>
<?php include 'header.php';?>
<section>
		<div class="row search" style="color:Maroon; font-size: 15;font-family:'Adobe Garamond W01';">
			<center>
				<h1>Forgot Password</h1>
			</center>
			</div>
			<div class="forgot-pwd" style="size: 30; font-family: 'Adobe Garamond W01';color: Maroon; margin-left: 20em;margin-right: 20em;margin-top: 0;">
			<form action="forgotpwd.php" name="forgot_form" method="post" onsubmit="return forgot_validation();">
				<table style="margin-left: 9em;">
					<col width="50%">
						<tr>
							<th align="right" style="color: Maroon">User ID:</th>
  							<th><input type="text" name="bb_user_id" id="bb_user_id" value="" size="35" placeholder="User ID"><p id="uname"></p></th> 
  						</tr>
  						<tr>
  							<th style="color: Maroon"> OR <br></th>
  						</tr>
  						<tr>
  							<th align="right" style="color: Maroon">Email ID:</th>
  							<th><input type="email" name="email" id="email" value=""  size="27" placeholder="Email ID"><p id="email" ></p></th>
  						</tr>
  						<tr><th><br></th></tr>
  				</table>
  				<center><input type="submit" name="forgotbtn" value="Submit" style="color: Maroon">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
  				<button name="forgotCancelBtn" style="color: Maroon;" onclick="window.location='Login.php';return false;">Cancel</button></center>
  			</form>
			<?php session_destroy();?>
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

 </body>
 </html>

 <script type="text/javascript"> 
 function forgot_validation()
 {
 	var uID = document.forms['forgot_form']['bb_user_id'].value;
 	var eID = document.forms['forgot_form']['email'].value;
			
 	if(uID=="" && eID==""){
 		alert("Enter User ID or Email ID");
 		return false;
 	}
}
</script>