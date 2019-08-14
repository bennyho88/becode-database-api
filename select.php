<?php

include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 
} else {
    echo "connection succeed";
}

// Select all data in JSON

$sql = "SELECT * FROM notes_tb";
$result = mysqli_query($conn, $sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result)) {
$json_array[] = $row;
}
// echo json_encode($json_array);

echo '<pre>';
print_r($json_array);

mysqli_close($conn);

?>