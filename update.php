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


// GET parameters

$note_input = $_POST['note'];
$author_input = $_POST['author'];
$title_input = $_GET['title'];
// Update 

$sql = "UPDATE notes_tb SET note='$note_input', author='$author_input' WHERE title='test'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>