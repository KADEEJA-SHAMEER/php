<?php
// Unset all of the cookies
setcookie("user_id", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("user_type", "", time() - 3600, "/");

// Redirect to the login page
header("Location: login.php");
exit();
?>
