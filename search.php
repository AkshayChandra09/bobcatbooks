<?php
session_start();?>
<script type="text/javascript">
<?php
if(isset($_SESSION['updateSuccessMessage'])){
			echo "alert ('User details updated successfully.');";
		}
		?>
		</script>
<?php
	$user_id=$_SESSION['user_id'];
include('search-header.php');
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bobcat_books";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

require_once("dbcontroller.php");

$db_handle = new DBController();
	if(!empty($_GET["action"])) {
		switch($_GET["action"]) {
			case "add":
				if(!empty($_POST["quantity"])) {
					$productByCode = $db_handle->runQuery("SELECT * FROM books WHERE bb_isbn='" . $_GET["bb_isbn"] . "'");
					$itemArray = array($productByCode[0]["bb_isbn"]=>array('bb_title'=>$productByCode[0]["bb_title"], 'bb_isbn'=>$productByCode[0]["bb_isbn"], 'quantity'=>$_POST["quantity"], 'bb_price'=>$productByCode[0]["bb_price"],'bb_availability'=>$productByCode[0]["bb_availability"], 'bb_condition_book'=>$productByCode[0]["bb_condition_book"]));
					
					if(!empty($_SESSION["cart_item"])) {
						if(in_array($productByCode[0]["bb_isbn"],array_keys($_SESSION["cart_item"]))) {
							foreach($_SESSION["cart_item"] as $k => $v) {
									if($productByCode[0]["bb_isbn"] == $k) {
										if(empty($_SESSION["cart_item"][$k]["quantity"])) {
											$_SESSION["cart_item"][$k]["quantity"] = 0;
										}
										$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
									}
							}
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
						}
					} 
					else 
					{
						$_SESSION["cart_item"] = $itemArray;
					}
				}
			break;
			case "remove":
				if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($_GET['bb_isbn']== $v['bb_isbn'])  
								unset($_SESSION["cart_item"][$k]);				
							if(empty($_SESSION["cart_item"]))
								unset($_SESSION["cart_item"]);
					}
				}
			break;
			case "empty":
				unset($_SESSION["cart_item"]);
			break;	
		}
	}
?>


<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<center><h2 style="color: Maroon; font-family:'Adobe Garamond W01';">Search Desired Book</h2></center><br>
		<div class="personalInfo" style="margin-left:10em; margin-right:10em; margin-top:0; color=Maroon; font-family:'Adobe Garamond W01';color: Maroon">
			<!--name="search_book" id="search"  action="connect.php"  onsubmit="return validateForm()" method="POST"-->
			<form name = "search_book" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit = "return validateForm();">
				<table>
				<col width="70%">
				<col width="30%">
				<tr>
					<th><input type="text" name="book_title" value="" placeholder="Title" id ="title"/></th>
					<th><input type="text" name="book_author" value="" placeholder="Author"/></th>
				</tr>
				<tr><td><br></td></tr>
				<tr>
					<th><select class="select" id="dicipline" name="book_displine" placeholder="Discipline" "/> 
					<option value="">Select Discipline</option>
					<option value="CS">CS</option>
					<option value="MATH">MATH</option>
					<option value="GEO">GEO</option>
					<option value="CE">CE</option>
					<option value="MGT">MGT</option>
					<option value="AGRI">AGRI</option>
					</th>
					<th><input type="text" name="book_course_id" id="course" value="" placeholder="Course ID"/></th>
				</tr>
				<tr><td><br></td></tr>
				<tr>
				<th><input type="text" name="book_professor" id="Professor" value="" placeholder="Professor"/></th>
				<th><input type="text" name="book_isbn" id="isbn" value="" placeholder="ISBN"/></th>
				<br><br>
				</table>
				</tr>
				<tr><td><br></td></tr>
				<center><input type="submit" name="submit" value="Search" onclick="validat();"></center>
			</form>
		</div> <br><br>
		<!--Shopping Cart-->
		<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="search.php?action=empty" style="font-family:'Adobe Garamond W01';color: Maroon;">Empty Cart</a></div>

		<?php
		if(isset($_SESSION["cart_item"])){
			$item_total = 0;
		?>	
		<table cellpadding="20" cellspacing="20" style="background-color: #F9E79F;color: Maroon; font-family:'Adobe Garamond W01'; border-color: black;">
		<tbody>
		<tr>
		<th style="text-align:left;"><strong>Title</strong></th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th style="text-align:left;"><strong>ISBN</strong></th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th style="text-align:right;"><strong>Quantity</strong></th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th style="text-align:right;"><strong>Price/Item</strong></th>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<th style="text-align:center;"><strong>Action</strong></th>
		</tr>	
		<?php
			foreach ($_SESSION["cart_item"] as $item){
				?>
						<tr>
						<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["bb_title"]; ?></strong></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["bb_isbn"]; ?></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["bb_price"]; ?></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="search.php?action=remove&bb_isbn=<?php echo $item["bb_isbn"]; ?>" class="btnRemoveAction">Remove Item</a></td>
						</tr>
						
						<?php
				$item_total += ($item["bb_price"]*$item["quantity"]);
				}
				?>
				
		<tr>
		<td colspan="5" align=right><strong>Total: <?php echo "$".$item_total; ?></strong></td>
		</tr>
		</tbody>
		</table>			
		  <?php
		}
		?>
		<table style="font-family:'Adobe Garamond W01';color: Maroon; margin-left: 10em">	
			<tr>
				<td> 
					<form action="checkout.php" name="cart" onsubmit="return confirmation()" method="post">
						<input type="hidden" id="shop" name="shop" value="<?php echo htmlentities(serialize($_SESSION["cart_item"])); ?>">
						<input type="hidden" id="" name="amount" value="<?php echo $item_total; ?>"><br>
						<?php if(empty($_SESSION["cart_item"]))
						{				
						?>
							<input type='submit' id='sub' name='submit' value='Checkout' disabled='disabled' align='right'/>
						<?php
						}else{?>
							<input type="submit" id="sub" name="submit" value="Checkout" align="center">
						<?php
						}
						?>
						
					</form>
					<div id="checkout" style="color:red"></div>
				<td>	
			</tr>
		</table> 
		<!--Search Results-->

		<div id="search-grid">
			<div class="txt-heading">Search Results</div>
				<?php
				if(isset($_POST['submit']))
				{
					$book_title = $_POST['book_title'];
					$book_author = $_POST['book_author'];
					$book_subject = $_POST['book_displine'];
					$book_course_id = $_POST['book_course_id'];
					$book_isbn = $_POST['book_isbn'];
					$book_prof = $_POST['book_professor'];
					$isFirst=FALSE;
					$query="SELECT * from books where ";
					
					if($book_title!="")
					{
						$isFirst=TRUE;
						$query = $query."bb_title ='".$book_title."' ";
					}
					
					if($book_author!="")
					{
						if(!$isFirst)
							$query = $query."bb_author ='".$book_author."' ";
						else
							$query = $query."and bb_author ='".$book_author."' ";
						$isFirst=TRUE;
					}
					
					if($book_subject!=""){
						if(!$isFirst)
							$query = $query."bb_discipline_id ='".$book_subject."' ";
						else
							$query = $query."and bb_discipline_id ='".$book_subject."' ";
						$isFirst=TRUE;
					}
					
					if($book_isbn!=""){
						if(!$isFirst)
							$query = $query."bb_isbn ='".$book_isbn."' ";
						else
							$query = $query."and bb_isbn ='".$book_isbn."' ";
						$isFirst=TRUE;
					}
					
					if($book_course_id!=""){
						if(!$isFirst)
							$query = $query."bb_course_id ='".$book_course_id."' ";
						else
							$query = $query."and bb_course_id ='".$book_course_id."' ";
						$isFirst=TRUE;
					}

					if($book_prof!=""){
						if(!$isFirst)
							$query=$query."bb_course_id in (select b.bb_course_id from bb_professor b where bb_professor_name='".$book_prof."')";
					}

					$result = mysqli_query($conn, $query);

					if (mysqli_num_rows($result) > 0) {
						$_SESSION["srch"] = array();
						while($row = mysqli_fetch_assoc($result)) {  
							array_push($_SESSION["srch"], $row);
						}
					}  else {
							unset($_SESSION["srch"]);
							//echo "No Books Matching Your Criteria..";
						} 
				}	
					if(!empty($_SESSION["srch"]))
					{
						
						foreach($_SESSION["srch"] as $key=>$value)
						{	

						?>	
						<div style="float: left; border:#CCC 1px solid;border-radius:4px; width: 300px;height:300px;padding:5px;margin:7px 7px;">
							<form method="post" action="search.php?action=add&bb_isbn=<?php echo $_SESSION["srch"][$key]["bb_isbn"];?>">
							<center><b> <?php echo $_SESSION["srch"][$key]["bb_title"]; ?><br></b></center><br>
							<div style="float: left;">
								<img src="product-images/<?php echo $_SESSION["srch"][$key]["bb_front_page_book"];?>" height="110" width="110" align="middle">
								<br><strong>
							</div>
							<div style="float: center; text-align: left;">	
								&nbsp Author: <?php echo $_SESSION["srch"][$key]["bb_author"];?><br>
								&nbsp Price: <?php echo "$".$_SESSION["srch"][$key]["bb_price"]; ?><br>
								&nbsp Condition: <?php echo $_SESSION["srch"][$key]["bb_condition_book"]; ?><br>
								&nbsp Availability: <?php if($_SESSION["srch"][$key]["bb_availability"]!="Available"){?><em style = "color:red";> <?php echo $_SESSION["srch"][$key]["bb_availability"];?></em><?php  } else echo $_SESSION["srch"][$key]["bb_availability"];?><br>
								&nbsp ISBN: <?php echo $_SESSION["srch"][$key]["bb_isbn"];?><br></strong>
							<br>
							</div>
							<?php  $availability = $_SESSION["srch"][$key]["bb_availability"];
								if($availability != "Available"){
							?>
							<div style="float: center;text-align: center;">
								<center><b>Quantity: </b><input type="text" size="2" name="quantity" value="1" style="width: 50px; background-color: lightgrey"; disabled="disabled"/><br><br>
								<input type="submit" value="Add to cart" class="btnAddAction" style = "background-color: lightgrey"; disabled="disabled"/></center>
							</div>
						<?php 
							} 
							else {
						?>
							<div style="float: center; text-align: center;">
							<center><b>Quantity: </b><input type="text" size="2" name="quantity" value="1" style="width: 50px;"/><br><br>
							<input type="submit" value="Add to cart" class="btnAddAction"/></center>
						</div>	
						<?php 
							}
						?>
						</form>
					</div>
					<?php	
					} 
				}else {
					echo "No Books Matching Your Criteria..";
				} 
			?>
		</div>
		<!--End Search Results-->
		<br><br>
		<div id="product-grid">
			<div class="txt-heading">Products</div>
			<?php
			$product_array = $db_handle->runQuery("SELECT * FROM books ORDER BY bb_isbn ASC");
			if (!empty($product_array)) { 
				//$count=1;
				foreach($product_array as $key=>$value){
			?>
				<div class="product-item">
					<form method="post" action="search.php?action=add&bb_isbn=<?php echo $product_array[$key]["bb_isbn"];?>">
					<div class="product-image"><img src="product-images/<?php echo $product_array[$key]["bb_front_page_book"];?>" height="150" width="150" align="middle"></div>
					<center><div style="color: Maroon;"><strong><?php echo $product_array[$key]["bb_title"]; ?></strong></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["bb_price"]; ?></div>
					<?php  $availability1 = $product_array[$key]["bb_availability"];
					if($availability1 != "Available"){ ?>
					<em style = "color: red;"><?php echo $availability1; ?> </em>
					<div><input type="text" name="quantity" value="1" size="2" style="width: 50px; background-color: lightgrey" disabled="disabled" /><br><br><input type="submit" value="Add to cart" class="btnAddAction" disabled="disabled" style="background-color: lightgrey;" /> </div>
					<?php 
					} 
					else {
					?>
					<div><input type="text" name="quantity" value="1" size="2" style="width: 50px" /><br><br><input type="submit" value="Add to cart" class="btnAddAction" /></div>
					<?php 
						}
					?>
					</center>
					</form>
				</div>
			<?php
					}
			}
			unset($_SESSION['updateSuccessMessage']);
			?>
		</div>
	</body>


<script>
	
	function validateForm() {
	var title = document.forms["search_book"]["book_title"].value;
	var author = document.forms["search_book"]["book_author"].value;	
	var subject = document.forms["search_book"]["book_displine"].value;
    var course_id = document.forms["search_book"]["book_course_id"].value;
	var book_isbn = document.forms["search_book"]["book_isbn"].value;
	var professor = document.forms["search_book"]["book_professor"].value;

		if (title == "" && author == "" && subject=="" && course_id=="" && book_isbn=="" && professor=="") {   
				alert("Please provide at least 1 search criteria...");
				return false;
		}
	}		
</script>


<script>
function confirmation() {
    var txt;
    if (confirm("Confirm Checkout?") == true) {
      
    } else {
        txt = "You pressed Cancel!";
		document.getElementById("checkout").innerHTML = txt;
		return false;
    }
}
</script>
<div id="footer" style="margin-top: 10%;position: relative;padding: 0;width: auto;">
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
