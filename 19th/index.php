<?php

if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['user_type'])) {
    echo "Welcome, " . htmlspecialchars($_COOKIE['username']) . "!<br>";
    echo "Your user ID is: " . htmlspecialchars($_COOKIE['user_id']) . "<br>";
    echo "Your user type is: " . htmlspecialchars($_COOKIE['user_type']) . "<br>";
} else {
    header("Location: login.php");
    exit();
}
?>

<a href="logout.php">Logout</a>

<?php if ($_COOKIE['user_type'] == 'jobprovider'): ?>
    <a href="post_job.php">Add Job</a>

    <?php

    require_once ("connect.php");


    $sql = "SELECT * FROM jobs WHERE provider_id='{$_COOKIE['user_id'] }'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $jobs = [];
        while ($row = $result->fetch_assoc()) {
            $jobs[] = $row;
        }
    } else {
        echo "No jobs found.";
    }
    $conn->close();
    ?>

    <ul>
        <?php foreach ($jobs as $job): ?>
            <li>
                <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                <p><?php echo htmlspecialchars($job['description']); ?></p>
                <p><strong>Skills Required:</strong> <?php echo htmlspecialchars($job['skills_required']); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($job['city']); ?></p>
                <a href="edit_job.php?job_id=<?php echo $job['id']; ?>">Edit</a>
                <a href="delete_job.php?job_id=<?php echo $job['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this job?');" >Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>
    <?php require ('search_jobs.php'); ?>
<?php endif; ?>