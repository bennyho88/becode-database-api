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

// Select data 

$sql = "SELECT title, note, author, tijd FROM notes_tb";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    //output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $dataArray = array("title: " . $row["title"] . " - Name: " . $row["note"] . " " . $row["author"]. " " . $row["tijd"] . "<br>");
    }
} else {
    echo "0 results";
};

echo json_encode($dataArray);

mysqli_close($conn);

?>