<?php

include 'dbdetails.php';

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 
} else {
    echo "connection succeed";
}

// get parameters

$title_input = $_GET['title'];

// Select data individually JSON


$sql = "SELECT * FROM notes_tb WHERE title='$title_input'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    //output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $dataArray = array("title: " . $row["title"] . " - Note: " . $row["note"] . " - Author: " . $row["author"]. " - Time: " . $row["tijd"] . "<br>");
    }
} else {
    echo "0 results";
};

echo json_encode($dataArray);



?>