<?php
require_once ("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_COOKIE['user_id'] = $row['id'];
            $_COOKIE['username'] = $row['username'];
            $_COOKIE['user_type'] = $row['user_type'];

            setcookie("user_id", $row['id'], time() + (86400 * 30), "/");
            setcookie("username", $row['username'], time() + (86400 * 30), "/");
            setcookie("user_type", $row['user_type'], time() + (86400 * 30), "/");
            echo "<script>alert('Login successful!');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="login.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>

        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</body>

</html>