<?php

include 'dbdetails.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


// Sanitizing

$clean_title = filter_var($_GET['title'], FILTER_SANITIZE_STRING);
$clean_note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
$clean_author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);


// Validating

$errors=[];

if (empty($clean_title )) {
    $errors['clean_title'] = 'a title is required';
} else {
    $errors['clean_title'] ='title is valid';
}

if (empty($clean_note)) {
    $errors['clean_note'] ='a note is required';
} else {
    $errors['clean_note'] = 'note is valid';
}

if (empty($clean_author)) {
    $errors['clean_author'] = 'an author is required';
} else {
    $errors['clean_author'] ='author is valid';
}
// INSERT INTO


$sql = "INSERT INTO notes_tb (title, note, author) VALUES ('$clean_title','$clean_note','$clean_author')";

if ($conn->query($sql)) {
    $errors['confirm'] = "New record created successfully";
} else {
    $errors['confirm'] =  "Error: " . $sql . "<br>" . $conn->error;
}

$errors_json = json_encode($errors);

echo $errors_json;

$conn->close();


?>