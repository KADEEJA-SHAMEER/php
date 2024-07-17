<?php
require_once ("connect.php");

$search_results = [];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $skills = $_GET['skills'];
    $city = $_GET['city'];
    $title = $_GET['title'];

    $sql = "SELECT * FROM jobs WHERE skills_required LIKE '%$skills%' AND city LIKE '%$city%' AND title 
    LIKE '%$title%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    } else {
        echo "No results found.";
    }
}

$conn->close();
?>

<form action="search_jobs.php" method="get">
    <label>Skills:</label>
    <input type="text" name="skills"><br>
    <label>City:</label>
    <input type="text" name="city"><br>
    <label>Job Title:</label>
    <input type="text" name="title"><br>
    <button type="submit">Search</button>
</form>

<?php if (!empty($search_results)): ?>
    <h2>JOBS:</h2>
    <ul>
        <?php foreach ($search_results as $job): ?>
            <li>
                <h3><?php echo $job['title']; ?></h3>
                <p><?php echo $job['description']; ?></p>
                <p><strong>Skills Required:</strong> <?php echo $job['skills_required']; ?></p>
                <p><strong>City:</strong> <?php echo $job['city']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>