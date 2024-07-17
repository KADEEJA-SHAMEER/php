<?php
include 'connection.php';

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    
    // Directly construct and execute the delete statement
    $sql = "DELETE FROM students WHERE id = $student_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error deleting student: " . $conn->error;
    }
}

$conn->close();
?>
