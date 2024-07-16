<?php
require_once ("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE['user_id']) && $_COOKIE['user_type'] == 'jobprovider') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $skills_required = $_POST['skills_required'];
    $city = $_POST['city'];
    $provider_id = $_COOKIE['user_id'];

    $sql = "INSERT INTO jobs (title, description, skills_required, city, provider_id) VALUES ('$title', '$description', '$skills_required', '$city', '$provider_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<scirpt>alert('Job posted successfully!')</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Post Job</title>
</head>

<body>
    <form action="post_job.php" method="post">
        <label>Job Title:</label>
        <input type="text" name="title" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Skills Required:</label>
        <input type="text" name="skills_required" required><br>
        <label>City:</label>
        <input type="text" name="city" required><br>
        <button type="submit">Post Job</button>
    </form>
</body>

</html>