<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add a New Video</title>
	</head>
	<body>
<?php
	include('config.php');
?>
	<form action="" method="post">
	Name:
	<input type="text" name="name">
	<br>
	Category:
	<input type="text" name="category">
	<br>
	Length:
	<input type="number" name="length">
	<br>
	<input type="submit" name="submit" value="Add Video">
	</form>

<?php
if (isset($_POST['submit'])) {
	$name = $mysqli->real_escape_string($_POST['name']);
	$category = $mysqli->real_escape_string($_POST['category']);
	$length = $mysqli->real_escape_string($_POST['length']);
	if ($name == '') {
		echo "A name is required.";
	}
	else if (!is_int(intval($length))) {
		echo "Length must be an integer."; 
	}
	else {
		$sql = "INSERT INTO VideoStore (name, category, length, rented) VALUES ('$name', '$category', '$length', 0)";
		if ($mysqli->query($sql) === true) {
			echo "New record created successfully.";
			echo 'Click <a href="view.php">here</a> to view the updated inventory.'; 
		}
		else {
			echo "Error: " . $sql . "<br>" . $mysqli->error; 
		}
	

	}
	
	
}
?>
	</body>
</html>