<html>
    <head>
        <title>insert data</title>
</head>
<body>
    <form action="" method="post">
        <label> Book id:</label><input type="text" name="BOOK_ID"><br>
        <label> title: </label><input type="text" name="TITLE"><br>
        <label> Author: </label><input type="text" name="AUTHOR"><br>
        <label> publisher: </label><input type="text" name="PUBLISHER"><br>
        <label> year: </label><input type="text" name="YEAR"><br>
        <input type="submit" name="SUBMIT"><br>
</form>
</body>
</html>
<?php
  $dbcon=mysqli_connect("localhost","root","","kadeeja");
  if($dbcon){
  if(isset($_POST['SUBMIT'])){
    $BID=$_POST['BOOK_ID'];
    $TIT=$_POST['TITLE'];
    $AUT=$_POST['AUTHOR'];
    $PUB=$_POST['PUBLISHER'];
    $YEAR=$_POST['YEAR'];
    $sql="INSERT INTO book VALUES($BID,'$TIT','$AUT','$PUB',$YEAR)";
    $data=mysqli_query($dbcon,$sql);
    if($data)
      {
        echo "one row inserted";
      }
}
  }
  else
    echo "not connected";
?>

