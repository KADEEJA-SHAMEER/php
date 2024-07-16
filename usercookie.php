<html>
    <body>
<form action="" method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Login">
</form>
</body>
</html>
<?php
// Create a cookie with user IDs and passwords
$user_data = array(
    'user1' => 'pwd1',
    'user2' => 'pwd2',
    'user3' => 'pwd3',
    'user4' => 'pwd4'
);
setcookie("users", serialize($user_data), time() + (86400 * 30)); // expire in 30 days

// Login form submission handler
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Read the cookie and unserialize the data
    if(isset($_COOKIE['users'])){
        $users = unserialize($_COOKIE['users']);
        
        // Authenticate the user
        if(isset($users[$username]) && $users[$username] == $password){
            echo "Welcome, $username!";
        } else {
            echo "You are not an authenticated user.";
        }
    }
}

// Login form
?>

