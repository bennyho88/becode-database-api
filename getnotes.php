<?php

include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error()); 
} 

// Parameters - Sanitizing

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

// Select data individually JSON


$sql = "SELECT * FROM notes_tb WHERE title='$secured_title'";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed";
} else {
    mysqli_stmt_bind_param($stmt, "sss", $secured_title, $secured_note, $secured_author );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $errors['status'] = array("title: " . $row["title"] . " - Note: " . $row["note"] . " - Author: " . $row["author"]. " - Time: " . $row["tijd"] . "<br>");
    }
}

/*
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    //output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $errors['status'] = array("title: " . $row["title"] . " - Note: " . $row["note"] . " - Author: " . $row["author"]. " - Time: " . $row["tijd"] . "<br>");
    }
} else {
    $errors['status'] = "0 results";
};
*/

$errors_json = json_encode($errors);

echo json_encode($errors_json);



?>