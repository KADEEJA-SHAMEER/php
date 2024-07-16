<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE['user_id']) && $_COOKIE['user_type'] == 'jobprovider') {
    $job_id = $_POST['job_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $skills_required = $_POST['skills_required'];
    $city = $_POST['city'];

    $sql = "UPDATE jobs SET title='$title', description='$description', skills_required='$skills_required', city='$city' WHERE id='$job_id' AND provider_id='{$_COOKIE['user_id']}'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Job updated successfully!')</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch the job details to pre-fill the form
if (isset($_GET['job_id']) && isset($_COOKIE['user_id']) && $_COOKIE['user_type'] == 'jobprovider') {
    $job_id = $_GET['job_id'];
    $sql = "SELECT * FROM jobs WHERE id='$job_id' AND provider_id='{$_COOKIE['user_id']}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
    } else {
        echo "No job found or you are not authorized to edit this job.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Job</title>
</head>
<body>
    <form action="edit_job.php" method="post">
        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['id']); ?>">
        <label>Job Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($job['description']); ?></textarea><br>
        <label>Skills Required:</label>
        <input type="text" name="skills_required" value="<?php echo htmlspecialchars($job['skills_required']); ?>" required><br>
        <label>City:</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($job['city']); ?>" required><br>
        <button type="submit">Update Job</button>
    </form>
</body>
</html>
