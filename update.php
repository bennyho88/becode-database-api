<?php
include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
} else {
    echo "connection succeed";
}
/*
// GET parameters

$note_input = $_POST['note'];
*/
// Update 

$sql = "UPDATE notes_tb SET author='hallo' WHERE title='test'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>