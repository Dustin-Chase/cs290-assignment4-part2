<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Check Out a Video</title>
	</head>
	<body>
<?php
	include('config.php');
	ini_set('display_errors', '1');
	error_reporting(E_ALL);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	
	$id = $mysqli->real_escape_string($_GET['id']);
	$result = $mysqli->query("SELECT rented FROM VideoStore WHERE id=$id");
	$array = $result->fetch_assoc(); 
	$isRented = $array['rented']; 
	if($isRented) {
		$result = $mysqli->query("UPDATE VideoStore SET rented='0' WHERE id=$id");
		if ($result === true) {
			echo 'Click <a href="view.php">here</a> to view the updated inventory.'; 
			}
		else {
			echo "Error: " . $mysqli->error; 
		}
		echo "Video returned.";
	}
	else {
		$result = $mysqli->query("UPDATE VideoStore SET rented='1' WHERE id=$id");
		if ($result === true) {
			
				echo 'Click <a href="view.php">here</a> to view the updated inventory.'; 
			}
	else {
			echo "Error: " . $mysqli->error; 
		}
	}
	
	
}

else {
	echo 'Click <a href="view.php">here</a> to view inventory.'; 
}
?>
	</body>
</html>