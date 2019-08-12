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
    echo 'a title is required <br>';
} else {
    echo 'title is valid <br>';
}

if ($clean_note === false) {
    echo 'a note is required <br>';
} else {
    echo 'note is valid <br>';
}

if ($clean_author === false) {
    echo 'an author is required <br>';
} else {
    echo 'author is valid <br>';
}
// INSERT INTO


$sql = "INSERT INTO notes_tb (title, note, author) VALUES ('$title','$note','$author')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// JSON

$sql = "SELECT * FROM notes_tb";
$result = mysqli_query($conn, $sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result)) {
$json_array[] = $row;
}
echo json_encode($json_array);

$conn->close();




?>
