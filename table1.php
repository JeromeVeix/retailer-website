<!DOCTYPE html>
<html>
<body>

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS items (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(20) NOT NULL,
price DECIMAL(7,2) NOT NULL,
quantity INT(40) NOT NULL,
image TEXT NOT NULL) AUTO_INCREMENT=6 DEFAULT CHARSET=utf8";

if ($conn->query($sql) === TRUE) {
echo "Table items created successfully";
} else {
echo "Error creating table: " . $conn->error;
}


?>

</body>
</html>