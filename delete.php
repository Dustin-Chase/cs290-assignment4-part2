<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Delete a Video</title>
	</head>
	<body>
<?php
	include('config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $mysqli->real_escape_string($_GET['id']);
	$result = $mysqli->query("DELETE FROM VideoStore WHERE id=$id");
	if ($result === true) {
				echo "Record deleted successfully.";
				echo 'Click <a href="view.php">here</a> to view the updated inventory.'; 
			}
	else {
			echo "Error: " . $mysqli->error; 
		}
}

else if(isset($_GET['id']) && $_GET['id'] == 'all') {
	$result = $mysqli->query("DELETE FROM VideoStore");

	if ($result === true) {
				echo "All records deleted successfully.";
				echo 'Click <a href="view.php">here</a> to view the updated inventory.'; 
			}
	else {
			echo "Error: " . $mysqli->error; 
		}
}
else {
	echo 'Click <a href="view.php">here</a> to view inventory.'; 
}
?>
	</body>
</html>