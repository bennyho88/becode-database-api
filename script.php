<?php

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
/*
echo $_GET['title'];
echo $_POST['note'];
*/
$stmt = $conn->prepare("INSERT INTO notes_tb (title, note) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $note);

// set parameters and execute
$title = $_GET['title'];
$note = $_GET['note'];

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();

/*
// SANITIZE
$title = test_input($_GET['title']);
$note = test_input($_GET['note']);
$author = test_input($_GET['author']);
$time = test_input($_GET['created_at']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// validation

    if (empty($_GET['title'])) {
       echo 'Title is required';
    } else if(!preg_match("/^[a-zA-Z' ]*$/", $title)) {
        echo  "Only letters and white space allowed";
    }
    
    
    if (empty($_GET['note'])) {
        echo 'note is required'; 
    } else {
        echo 'ok';
    }

    if (empty($_GET['author'])) {
         echo 'Address is required'; 
    } else if (!preg_match("/^[a-zA-Z' ]*$/", $author)) {
        echo  "Only letters and white space allowed";
    }
    
    if (empty($_GET['created_at'])) {
        echo 'Time is required'; 
    } else {
        echo 'time';
    }
*/
$conn->close();



?>
