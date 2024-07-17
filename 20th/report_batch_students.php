<?php
include 'connection.php';

// Get the batch year and batch name from the query string
$batch_year = isset($_GET['batch_year']) ? $_GET['batch_year'] : '';
$batch_name = isset($_GET['batch_name']) ? $_GET['batch_name'] : '';

// Fetch students based on the selected batch year and batch name
$sql = "SELECT s.id, s.name, s.date_of_birth, s.gender, s.email, b.batch_name, b.year
        FROM students s
        JOIN batches b ON s.batch_id = b.id
        WHERE b.year = $batch_year AND b.batch_name = '$batch_name'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // No need to fetch batch_info as it was redundant
    $batch_name = htmlspecialchars($batch_name);
    $batch_year = htmlspecialchars($batch_year);
} else {
    echo "Batch not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Students Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Students Report for Batch: <?php echo htmlspecialchars($batch_name) . " (Year: " . htmlspecialchars($batch_year) . ")"; ?></h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Batch</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Move the pointer back to the start of the result set
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date_of_birth']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['batch_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No students found in this batch</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="index.php">Back to Student List</a>
</body>

</html>

<?php
$result->free();
$conn->close();
?>
