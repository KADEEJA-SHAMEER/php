<!--program to set cookie of last visited time and print it --> 
<?php
if(isset($_COOKIE['last_visited'])){
 $last_visited = $_COOKIE['last_visited'];
 echo "Last visited on: " . $last_visited;
}
else{
    echo "welcome!!";
}
$current_date = date("Y-m-d H:i:s");
setcookie("last_visited", $current_date, time() + (86400 * 30));
?>