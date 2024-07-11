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
 if($dbcon){  
if(isset($_POST['submit'])){
   $BID=$_POST['BOOK_ID'];
   $sqll="SELECT * FROM book WHERE BOOK_ID=$BID";
   $res=mysqli_query($dbcon,$sqll);
   if(mysqli_num_rows($res)>0){
   $sql=" DELETE FROM book WHERE BOOK_ID='$BID'";
   $data=mysqli_query($dbcon,$sql);
   if($data){
       echo "<br>";
       echo "one row deleted from table";
   }
   }
   else{
    echo "no such book exist";
   }
}
 }else{
    echo " database not connected";
 }
?>
</body>
</html>
