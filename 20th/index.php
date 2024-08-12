<?php
include 'connection.php';

// Handle search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Fetch all students from the database with an optional search query
$sql = "SELECT s.id, s.name, s.date_of_birth, s.gender, s.email, b.batch_name, b.year
        FROM students s
        JOIN batches b ON s.batch_id = b.id
        WHERE s.name LIKE '%$search_query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
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

        .search-box {
            margin-bottom: 20px;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>View All Students</h1>

    <div class="search-box">
        <form method="get" action="index.php">
            <input type="text" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search_query); ?>">
            <input type="submit" value="Search">
        </form>
    </div>

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['date_of_birth'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['batch_name'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>
                            <a href='edit_student.php?id=" . $row['id'] . "'> Edit</a> |
                            <a href='delete_student.php?student_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No students found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="addstudent.php">Add Student</a>

    <!-- Form for selecting batch year and batch name -->
    <form method="get" action="report_batch_students.php" style="display:inline;">
        <label for="batch_year">Select Year:</label>
        <select id="batch_year" name="batch_year">
            <option value="">-- Select Year --</option>
            <?php
            // Fetch all unique batch years to populate the year dropdown
            $year_sql = "SELECT DISTINCT year FROM batches ORDER BY year";
            $year_result = $conn->query($year_sql);
            while ($year_row = $year_result->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($year_row['year']) . "'>" . htmlspecialchars($year_row['year']) . "</option>";
            }
            ?>
        </select>

        <label for="batch_name">Select Batch:</label>
        <select id="batch_name" name="batch_name">
            <option value="">-- Select Batch --</option>
            <?php
            // Fetch all unique batch names to populate the batch name dropdown
            $name_sql = "SELECT DISTINCT batch_name FROM batches ORDER BY batch_name";
            $name_result = $conn->query($name_sql);
            while ($name_row = $name_result->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($name_row['batch_name']) . "'>" . htmlspecialchars($name_row['batch_name']) . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Generate Batch Report">
    </form>
</body>

</html>

<?php
$conn->close();
?>
