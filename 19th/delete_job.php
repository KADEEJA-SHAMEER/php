<?php
require_once("connect.php");

if (isset($_GET['job_id']) && isset($_COOKIE['user_id']) && $_COOKIE['user_type'] == 'jobprovider') {
    $job_id = $_GET['job_id'];
    $sql = "DELETE FROM jobs WHERE id='$job_id' AND provider_id='{$_COOKIE['user_id']}'";

    if ($conn->query($sql) === TRUE) {
        echo "Job deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
header("Location: index.php");  // Redirect back to dashboard after deletion
exit();
?>
