<?php
	require('header.php');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bobcat_books";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$query="SELECT * from books";
	$result = mysqli_query($conn, $query);
	
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_array($result);
	} 

?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<h1>DB Connection</h1>
		<div style="border-style: solid; padding: 12px; width: 400px;">
			<form name="search_book" action="connect.php" target="_blank" onsubmit="return validateForm()" method="POST">	
				Title: <input type="text" name="book_title" value=""/>
				<br><br>
				Author: <input type="text" name="book_author" value=""/>
				<br><br>
				Subject: <input type="text" name="book_displine" value=""/> <!--drop down: CE, CS, MATH, AGRI-->
				<br><br>
				Course ID: <input type="text" name="book_course_id" id="course" value=""/>
				<br><br>
				Professor: <input type="text" name="book_professor" id="Professor" value=""/>
				<br><br>
				ISBN: <input type="text" name="book_isbn" id="isbn" value=""/>
				<br><br>
				<input type="submit" value="Submit">
			</form>
		</div>
		<div>
			<br><br>
			<table>
				<tr>
					<td style="padding: 10px;">
						<?php 
							while($row = mysqli_fetch_assoc($result)) {
								$img = "images/books/".$row["bb_front_page_book"]; 
								echo "<img src = ".$img.">";
								echo "  Title: " . $row["bb_title"]. "  Author: " . $row["bb_author"]. "<br>";
							}						
						?>
					</td>
				</tr>	
			</table>
		</div>
	</body>
</html>

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