<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get batch details from the form
    $batch_name = $_POST['batch_name'];
    $year = $_POST['year'];

    // Check if batch already exists
    $sql = "SELECT id FROM batches WHERE batch_name = '$batch_name' AND year = $year";
    $result = $conn->query($sql);

    $batch_id;

    if ($result->num_rows > 0) {
        // Batch exists, get the ID
        $row = $result->fetch_assoc();
        $batch_id = $row['id'];
    } else {
        // Insert new batch into the database
        $sql = "INSERT INTO batches (batch_name, year) VALUES ('$batch_name', $year)";
        if ($conn->query($sql) === TRUE) {
            $batch_id = $conn->insert_id; // Get the ID of the newly inserted batch
        } else {
            die("Error inserting batch: " . $conn->error . "<br>");
        }
    }

    // Get student details from the form
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];

    // Insert student into the database
    $sql = "INSERT INTO students (name, date_of_birth, gender, email,batch_id) VALUES ('$name', '$date_of_birth', '$gender', '$email', $batch_id)";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        die("Error inserting student: " . $conn->error . "<br>");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="addstudent.php" method="post">
        <h2>Batch Information</h2>
        <label for="batch_name">Batch Name:</label>
        <input type="text" id="batch_name" name="batch_name" required><br><br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>
        
        <h2>Student Information</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
