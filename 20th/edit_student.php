<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch student details from the database
    $sql = "SELECT s.id, s.name, s.date_of_birth, s.gender, s.email, b.batch_name, b.year, b.id AS batch_id
            FROM students s
            JOIN batches b ON s.batch_id = b.id
            WHERE s.id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        die("Student not found");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $batch_id = $_POST['batch_id'];
    $student_id = $_POST['student_id'];

    // Update student details in the database
    $sql = "UPDATE students SET name='$name', date_of_birth='$date_of_birth', gender='$gender', email='$email', batch_id=$batch_id WHERE id=$student_id";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        die("Error updating student: " . $conn->error . "<br>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student Details</h1>
    <form method="post" action="edit_student.php">
        <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required><br><br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $student['date_of_birth']; ?>" required><br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php echo $student['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo $student['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo $student['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
        </select><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>
        <label for="batch_id">Batch:</label>
        <select id="batch_id" name="batch_id" required>
            <?php
            $batch_sql = "SELECT id, batch_name FROM batches";
            $batch_result = $conn->query($batch_sql);
            while ($batch_row = $batch_result->fetch_assoc()) {
                echo "<option value='" . $batch_row['id'] . "' " . ($batch_row['id'] == $student['batch_id'] ? 'selected' : '') . ">" . $batch_row['batch_name'] . "</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" name="update" value="Update">
    </form>

    <br>
    <a href="index.php">Back to View Students</a>
</body>
</html>

<?php
$conn->close();
?>
