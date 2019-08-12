<?php

// CONNECTION WORKS
$servername = "localhost";
$username = "admin";
$password = "eP325IJeAZmR";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// GET parameters;

$title = $_GET['title'];
$note = $_POST['note'];
$author = $_POST['author'];

// Sanitizing

$clean_title = filter_var($_GET['title'], FILTER_SANITIZE_STRING);
$clean_note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
$clean_author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);


// Validating

if ($clean_title === false) {
    echo 'a title is required';
} else {
    echo 'title is valid';
}

if ($clean_note === false) {
    echo 'a note is required';
} else {
    echo 'note is valid';
}

if ($clean_author === false) {
    echo 'an author is required';
} else {
    echo 'author is valid';
}
// INSERT INTO


$sql = "INSERT INTO notes_tb (title, note, author) VALUES ('$title','$note','$author')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// JSON


$conn->close();



?>
