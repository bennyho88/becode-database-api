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

// Validating

$errors=[];

if (empty($clean_title )) {
    $errors['clean_title'] = 'a title is required <br>';
} else {
    $errors['clean_title'] ='title is valid <br>';
}

if (empty($clean_note)) {
    $errors['clean_note'] ='a note is required <br>';
} else {
    $errors['clean_note'] = 'note is valid <br>';
}

if (empty($clean_author)) {
    $errors['clean_author'] = 'an author is required <br>';
} else {
    $errors['clean_author'] ='author is valid <br>';
}

// sql to delete a record

$sql = "DELETE FROM notes_tb WHERE title='$clean_title'";
if (mysqli_query($conn, $sql)) {
    $errors['confirm'] = "Record deleted succesfully <br>";
} else {
    $errors['confirm'] = "Error deleting record: " . mysqli_error($conn);
}


$errors_json = json_encode($errors);

echo $errors_json;

mysqli_close($conn);


?>