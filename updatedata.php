<html>
    <head> <title> update</title>
</head>
<body>
<form action="" method="post">
        <label> enter the book's id you want to update:</label><input type="text"
        name="bkid"><br>
        enter the new values:<br>
        <label> Book id:</label><input type="text" name="BOOK_ID"><br>
        <label> title: </label><input type="text" name="TITLE"><br>
        <label> Author: </label><input type="text" name="AUTHOR"><br>
        <label> publisher: </label><input type="text" name="PUBLISHER"><br>
        <label> year: </label><input type="text" name="YEAR"><br>
        <input type="submit" name="update"><br>
</form>
<?php
$dbcon = mysqli_connect("localhost", "root", "", "kadeeja")or die("Error");
if(isset($_POST['update'])){
    $BKID=$_POST['bkid'];
    $BID=$_POST['BOOK_ID'];
    $TIT=$_POST['TITLE'];
    $AUT=$_POST['AUTHOR'];
    $PUB=$_POST['PUBLISHER'];
    $YEAR=$_POST['YEAR'];
    $sql="SELECT * FROM book WHERE BOOK_ID='$BKID'";
    $data=mysqli_query($dbcon,$sql);
     if($data)
       {
        echo "book exist";
       /* $sqll=" UPDATE book SET BOOK_ID='$BID', TITLE='$TIT', AUTHOR='$AUT',
        PUBLISHER='$PUB',YEAR='$YEAR' WHERE BOOK_ID='$BKID'";
        $res=mysqli_query($dbcon,$sqll);
        if($res)
          {
            echo "record updated";
          }*/
       }
     else 
       echo " no such book exist";
    }
?>
</body>
</html>


