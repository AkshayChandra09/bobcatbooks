<!DOCTYPE html>
<!--?php
	session_start();
?-->
<html>
	<head>
		<title>University Bookstore</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--CSS file
		<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Indie+Flower|Pacifico" rel="stylesheet">-->
		<link rel="stylesheet" href="custom-styles.css">
		<!--Bootstrap-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href="style.css" type="text/css" rel="stylesheet" />

	</head>
	
	<body class="body">
<!--Header Section-->
		<section>	
			<div id="container-fluid">
			<div class="row">

			<center>
				<div class="col-sm-12" style="background-color:Maroon;"><h1 class="title" style="color:white; font-family:Adobe Garamond W01;">Bobcat Books </h1></div>
					<div style="width:auto; background-color: #B8860B;">
						<ul style="float: left">
							<li><img src="images/txst-primary.png" width ="200" height="50" alt="" align="left"></li>
							<li><b><a href="search.php" style="color:black; font-family:Adobe Garamond W01;">Home</a></b></li>
							<li><b><a href="search-about.php" style="color:black; font-family:Adobe Garamond W01;">About us</a></b></li>
							<li><b><a href="search-help.php" style="color:black; font-family:Adobe Garamond W01;">Help</a></b></li>
							<li><b><a href="search-contact.php" style="color:black; font-family:Adobe Garamond W01;">Contact us</a></b><li>
							</ul>
							<!--li><b><a href="UpdateAccount.php" style="color:black; font-family:Adobe Garamond W01;">Update Account</a></b><li>
							<a href="Logout.php" style="color:black; font-family:Adobe Garamond W01;">Logout</a>
							</b></li>
							
							<li><b><a style="color:black; font-family:Adobe Garamond W01;"><b><u> Hello <?php //echo $_SESSION['user_id'];?></u></a></p><li-->
							<div class="dropdown"><b>
								<button href="#" class="dropbtn" style="color:black; font-family:Adobe Garamond W01;"> Hello <?php echo $_SESSION['user_name'];?></button>
								<ul class="dropdown-content">
									<li><a href="UpdateAccount.php" style="color:black; font-family:Adobe Garamond W01;">Update Account</a></li>
									<li><a href="Logout.php" style="color:black; font-family:Adobe Garamond W01;">Logout</a></li>
								</ul>
							</b></div>
						
						
					</div>
					<div style="margin-top:0;">
						<h3 style="background-color:Maroon; color:white; position: fixed;"></h3>
					</div>	
			</center>	
				
			</div> <!--row div-->	
			</div> <!--div container-->
		</section>
	</body>
</html>