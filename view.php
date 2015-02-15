<?php

include('config.php');
$table = "CREATE TABLE IF NOT EXISTS VideoStore (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255), 
	category VARCHAR(255), 
	length INT(6) UNSIGNED, 
	rented INT(1) UNSIGNED 
)";


if ($mysqli->query($table) === TRUE) {
	echo "Table created successfully";
}
else {
	echo "Error creating table: " . $mysqli->error; 
}



$sql = "SELECT * FROM VideoStore";

$result = $mysqli->query($sql);

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
	}
	else {
		$rentedText = "available";
	}
	echo '<td>' . $rentedText . '</td>';
	echo '<td><a href="checkout.php?id=' . $row['id'] .'">Check Out</a></td>';
	echo '<td><a href="delete.php?id=' . $row['id'] .'">Delete</a></td>';
	echo "</tr>";
}

echo "</table>";
echo '<p><a href="insert.php">Add a Video</a></p>'; 
echo '<p><a href="deleteall.php">Delete All Videos</a></p>'; 
$mysqli->close(); 
//mysqli object has a query() method. Likely use this to query the database
//returns false on failure
//SELECT, SHOW, DESCRIBE, or EXPLAIN queries returns a mysqli_result object
//for other successful queries returns true

//Create table using CREATE TABLE. Generally don't want to use hard-coded strings but seems to be 
//ok for this assignment. 

//Write query leaving question marks where the query is variable. Only allowed in comparisons or inserted values
//SELECT model FROM cars WHERE make = ? AND capacity > 4

//$stmt = $mysqli->prepare("SELECT model FROM cars WHERE make = ? AND capacity > 4");
//prepare will return false on an error and the error should be stored in the mysqli object 

//bind the parameters (question marks are variable)

//$stmt->bind_param("s", $userMake);
//s is a string indicating variable's type (i for integer, d for double, s for string, b for blob)
//"isi" means, integer, string, integer respectively
//returns TRUE on success 

//parameters are passed by reference

//bind results by providing a variable for each selected attribute: $stmt->bind($resultModel)

//while($stmt->fetch()) {
//	echo $resultModel . "<br>"; 
//}

//$stmt->close(); 
?>