 <html>
    <head> <title> update</title>
</head>
<body>
<form action="" method="post">
        <label> enter the book's id you want to update:</label><input type="text"
        name="bkid"><br><br>
        <input type="submit"  name="submit"><br>
<?php
$dbcon = mysqli_connect("localhost", "root", "", "kadeeja")or die("Error");
if($dbcon){
if(isset($_POST['submit'])){
    $BKID=$_POST['bkid'];
    $sql="SELECT * FROM book";
    $data=mysqli_query($dbcon,$sql);
    if(!$data){
        echo "query failed!";
    }else{
      $book = [];
      while($row=mysqli_fetch_array($data)){
        if($BKID == $row['BOOK_ID']){
          $book=$row;
        }
      }
      if(!$book){
         echo "no book found";
      }else{
         echo "<input type='text' name='book_id' value=".$book['BOOK_ID']." readonly> <br>";
         echo "<input type='text' name='title' value=".$book['TITLE']."><BR>";
         echo "<input type='text' name='author' value=".$book['AUTHOR']."><BR>";
         echo "<input type='text' name='publisher' value=".$book['PUBLISHER']."><BR>";
         echo "<input type='text' name='year' value=".$book['YEAR']."><BR>";
         echo "<button type='submit' name='update'>UPDATE</button>";
      }
    }
  }
}else{
     echo "not connected";
  }
  if(isset($_POST['update'])){
    $BID=$_POST['book_id'];
    $TIT=$_POST['title'];
    $AUT=$_POST['author'];
    $PUB=$_POST['publisher'];
    $YEAR=$_POST['year'];
    $sql_updated="UPDATE `book` SET `TITLE`='$TIT',`AUTHOR`='$AUT',
    `PUBLISHER`='$PUB',`YEAR`=$YEAR WHERE BOOK_ID=$BID";
    $data_updated=mysqli_query($dbcon,$sql_updated);
    if($data_updated){
      echo " row updated";
    }

  }
  include("display.php");
?>
</form>
</body>
</html>


