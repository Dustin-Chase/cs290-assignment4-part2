<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add a New Video</title>
	</head>
	<body>
<?php
	include('config.php');
	ini_set('display_errors', '1');
	error_reporting(E_ALL);
?>
	<form action="" method="post">
	Name:
	<input type="text" name="name" maxlength="255">
	<br>
	Category:
	<input type="text" name="category" maxlength="255">
	<br>
	Length:
	<input type="text" name="length">
	<br>
	<input type="submit" name="submit" value="Add Video">
	</form>

<?php
if (isset($_POST['submit'])) {
	$name = $mysqli->real_escape_string($_POST['name']);
	$category = $mysqli->real_escape_string($_POST['category']);
	$length = $mysqli->real_escape_string($_POST['length']);
	
	$result = $mysqli->query("SELECT name FROM VideoStore WHERE name ='$name'");
	if (!$result)
		echo "Query failed.";
	$array = $result->fetch_assoc(); 
	
	if ($name == '') {
		echo "A name is required.";
	}
	else if (!is_numeric($length)) {
		echo '<script language="javascript">';
		echo 'alert("Length must be an integer.")';
		echo '</script>';
		echo "Length must be an integer."; 
	}
	else if (mysqli_num_rows($result) > 0) {
		echo "That video is already in the database.";
		echo '<script language="javascript">';
		echo 'alert("That video is already in the database.")';
		echo '</script>';
		echo '<br> Click <a href="view.php">here</a> to view the inventory.'; 
	}
	else {
		$sql = "INSERT INTO VideoStore (name, category, length, rented) VALUES ('$name', '$category', '$length', 0)";
		if ($mysqli->query($sql) === true) {
			echo "New record created successfully.";
		}
		else {
			echo "Error: " . $sql . "<br>" . $mysqli->error; 
		}
	}
}
else {
echo '<br> Click <a href="view.php">here</a> to view the inventory.'; 
}
?>
	</body>
</html>