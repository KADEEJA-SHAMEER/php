<html>
    <head>
        <title>delete row</title>
    </head>
<body>
    <form action="" method="post">
        <label>enter the book id you want to delete: </label><input type="text" name="BOOK_ID"><BR>
        <input type="submit" name="submit"><br>
</form>
<?php
 $dbcon=mysqli_connect("localhost","root","","kadeeja");
 if($dbcon)
   echo "database coonnnected";
 else 
   echo "not connected";
if(issset($_POST['submit'])){
   $BID=$POST['BOOK_ID'];
   $sql=" DELETE FROM boob WHERE BOOK_ID='$BID'";
   $data=mysqli_query($dbcon,$sql);
   if($data)
       echo "one row deleted from table";
}
?>
</body>
</html>
