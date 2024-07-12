<html>
    <head>
        <title> BOOK MANAGEMENT</title>
    </head>
 <body>
     <h2> LIBRARY MANAGEMENT </h2 >
     <h3> Do you want to </h3><br>
      <form action="insert.php" method="post">
       <button type="submit" name="insert">INSERT</button> <br><br>
      </form>
      <form action="delete.php" method="post">
      <button type="submit" name="delete">DELETE</button><br><br>
      </form>
      <form action="updatedata.php" method="post">
      <button type="submit" name="update">UPDATE</button><br><br>
      </form>
</body>
</html>
<?php
 include("display.php");
 ?>


