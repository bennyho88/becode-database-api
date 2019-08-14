<?php

include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error()); 
} else {
    $errors = "connection succeed";
}

// Sanitizing

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

// Select all data in JSON

$sql = "SELECT * FROM notes_tb";
$result = mysqli_query($conn, $sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result)) {
$json_array[] = $row;
}
$arrayJson = json_encode($json_array);


echo $arrayJson;

mysqli_close($conn);

?>