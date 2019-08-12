<?php


// sql to delete a record

$sql = "DELETE FROM notes_tb WHERE title='maandag'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted succesfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
$conn->close();
mysqli_close($conn);

?>