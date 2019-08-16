<?php

include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "connection succeed";
}

// Parameters - sanitizing

$clean_title = filter_var($_GET['title'], FILTER_SANITIZE_STRING);
$clean_note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
$clean_author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);

//SQL injection
$secured_title = mysqli_real_escape_string($conn, $clean_title);
$secured_note = mysqli_real_escape_string($conn, $clean_note);
$secured_author = mysqli_real_escape_string($conn, $clean_author);


// Validating

$errors=[];

if (empty($secured_title )) {
    $errors['title'] = 'a title is required <br>';
} else {
    $errors['title'] ='title is valid <br>';
}

if (empty($secured_note)) {
    $errors['note'] ='a note is required <br>';
} else {
    $errors['note'] = 'note is valid <br>';
}

if (empty($secured_author)) {
    $errors['author'] = 'an author is required <br>';
} else {
    $errors['author'] ='author is valid <br>';
}

// sql to delete a record

$sql = "DELETE FROM notes_tb WHERE title='$secured_title'";
if (mysqli_query($conn, $sql)) {
    $errors['status'] = "Record deleted succesfully <br>";
} else {
    $errors['status'] = "Error deleting record: " . mysqli_error($conn);
}


$errors_json = json_encode($errors);

echo $errors_json;

mysqli_close($conn);


?>