<?php
  $dbcon=mysqli_connect("localhost","root","","kadeeja");
  if($dbcon)
    echo "database coonnnected";
  else 
    echo "not connected";
if(issset($_POST['SUBMIT'])){
    $BID=$POST['BOOK_ID'];
    $TIT=$_POST['TITLE'];
    $AUT=$_POST['AUTHOR'];
    $PUB=$_POST['PUBLISHER'];
    $YEAR=$_POST['YEAR'];
    $sql="INSERT INTO book VALUES($BID,'$TIT',$AUT','$PUB',$YEAR)";
    $data=mysqli_query($dbcon,$sql);
    if($data)
      {
        echo "one row inserted";
      }
}
?>