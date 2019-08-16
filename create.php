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

//SQL injection
$secured_title = mysqli_real_escape_string($conn, $clean_title);
$secured_note = mysqli_real_escape_string($conn, $clean_note);
$secured_author = mysqli_real_escape_string($conn, $clean_author);


// Validating

$errors=[];

if (empty($secured_title)) {
    $errors['title'] = 'a title is required';
} else {
    $errors['title'] ='title is valid';
}

if (empty($secured_note)) {
    $errors['note'] ='a note is required';
} else {
    $errors['note'] = 'note is valid';
}

if (empty($secured_author)) {
    $errors['author'] = 'an author is required';
} else {
    $errors['author'] ='author is valid';
}
// INSERT INTO


// $sql = "INSERT INTO notes_tb (title, note, author) VALUES ('$secured_title','$secured_note','$secured_author')";

$sql = "INSERT INTO notes_tb (title, note, author) VALUES (?,?,?)";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    $errors['status'] = "SQL error";
} else {
   $errors['status'] = mysqli_stmt_bind_param($stmt, "sss",$secured_title,$secured_note,$secured_author);
   $errors['status'] = mysqli_stmt_execute($stmt);
}

/*
if ($conn->query($sql)) {
    $errors['status'] = "New record created successfully";
} else {
    $errors['status'] =  "Error: " . $sql . "<br>" . $conn->error;
}
*/

$errors_json = json_encode($errors);

echo $errors_json;

$conn->close();


?>