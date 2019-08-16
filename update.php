<?php
include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
    die ("Connection failed: " . mysqli_connect_error());
} else {
    $errors = "connection succeed";
}

// Sanitizing

$clean_title = filter_var($_GET['title'], FILTER_SANITIZE_STRING);
$clean_note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
$clean_author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);

//SQL injection
$secured_title = mysqli_real_escape_string($conn, $clean_title);
$secured_note = mysqli_real_escape_string($conn, $clean_note);
$secured_author = mysqli_real_escape_string($conn, $clean_author);


// Validating

$errors=[];

if (empty($secured_title)) {
    $errors['title'] = 'a title is required';
} else {
    $errors['title'] = 'title is valid';
}

if (empty($secured_note)) {
    $errors['note'] = 'a note is required';
} else {
    $errors['note'] = 'note is valid';
}

if (empty($secured_author)) {
    $errors['author'] = 'an author is required';
} else {
    $errors['author'] = 'author is valid';
}

// Update 

$sql = "UPDATE notes_tb SET note='$secured_note', author='$secured_author' WHERE title='$secured_title'";

if (mysqli_query($conn, $sql)) {
    $errors['status'] = "Record updated successfully";
} else {
    $errors['status'] =  "Error updating record: " . mysqli_error($conn);
};

$errors_json = json_encode($errors);

echo $errors_json;

mysqli_close($conn);

?>