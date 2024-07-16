<?php
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];
    $skills = $_POST['skills'];
    $city = $_POST['city'];

    $sql = "INSERT INTO users (username, password, user_type, skills, city) VALUES ('$username', '$password', '$user_type', '$skills', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo "<script><alert>User registered successfully!</alert></script>";
        header("Location: login.php");
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
    <title>Register</title>
</head>

<body>
    <form action="register.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>User Type:</label>
        <select name="user_type">
            <option value="jobseeker">Job Seeker</option>
            <option value="jobprovider">Job Provider</option>
        </select><br>
        <label>Skills:</label>
        <input type="text" name="skills"><br>
        <label>City:</label>
        <input type="text" name="city"><br>
        <button type="submit">Register</button>

        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</body>

</html>