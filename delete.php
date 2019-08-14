<?php

include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection 
if (!conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "connection succeed";
}

// GET parameters

$title_input = $_GET['title'];
// sql to delete a record

$sql = "DELETE FROM notes_tb WHERE title='$title_input'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted succesfully <br>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

// feedback



?>