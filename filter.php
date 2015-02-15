<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Filter Inventory</title>
	</head>
	<body>
<?php
	include('config.php');
	ini_set('display_errors', '1');
	error_reporting(E_ALL);
	$result = $mysqli->query("SELECT DISTINCT category FROM VideoStore WHERE category != ''");
	if (!$result)
		echo "Query failed.";
	echo '<select name="category" form="categoryform">';
	while ($row = $result->fetch_assoc()) {
	echo '<option value=' . $row['category'] . '>' . $row['category']. '</option>';
	}
	echo '<option value=all>All Videos</option>';
	echo '</select>';
	echo 'Select Category <br> <form action="" type="submit" name="submit" id="categoryform" method="post">';
	echo '<input type="submit"><br>';
	echo '</form>';
	
if (isset($_POST['category'])) {
	$category = $mysqli->real_escape_string($_POST['category']);
	$sql = ""; 
	if($category === 'all') {
		$sql = "SELECT * FROM VideoStore";
	}
	else {
		$sql = "SELECT id, name, category, length, rented FROM VideoStore WHERE category ='$category'";
	}
	
	$result = $mysqli->query($sql);
	if (!$result)
		echo "Query failed.";
	/*Build Table to View Video Results */ 
	//build table header
	
	echo "<table border ='1' cellpadding='10'>"; 
		echo "<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Category</th>
		<th>Length</th>
		<th>Rented</th>
		<th>Check Out</th>
		<th>Delete</th>
		</tr>";
	
	//build table body
	
	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo '<td>' . $row['id'] . '</td>';
		echo '<td>' . $row['name'] . '</td>';
		echo '<td>' . $row['category'] . '</td>';
		echo '<td>' . $row['length'] . '</td>';
		if ($row['rented'] == 1) {
			$rentedText = "checked out";
			$checkedOutText = "Return";
		}
		else {
			$rentedText = "available";
			$checkedOutText = "Check Out";
		}
		echo '<td>' . $rentedText . '</td>';
		echo '<td><a href="checkout.php?id=' . $row['id'] .'">' . $checkedOutText . '</a></td>';
		echo '<td><a href="delete.php?id=' . $row['id'] .'">Delete</a></td>';
		echo "</tr>";
	}
	
}
?>
	</body>
</html>