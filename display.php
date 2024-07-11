<?php
$dbcon = mysqli_connect("localhost", "root", "", "kadeeja")or die("Error");
$sql = "SELECT * FROM book";
$data = mysqli_query($dbcon, $sql);
 if (mysqli_num_rows($data) > 0) {
 echo "<table  border=1>";
 echo "<tr>";
 echo "<th>BOOK ID</th>";
 echo "<th>TITLE</th>";
 echo "<th>AUTHOR</th>";
 echo "<th>PUBLISHER</th>";
 echo "<th>YEAR</th>";
 echo "</tr>";
 while ($row = mysqli_fetch_array($data)) {
 echo "<tr>";
 echo "<td>".$row['BOOK_ID']."</td>";
 echo "<td>".$row['TITLE']."</td>";
 echo "<td>".$row['AUTHOR']."</td>";
 echo "<td>".$row['PUBLISHER']."</td>";
 echo "<td>".$row['YEAR']."</td>";
 echo "</tr>";
 }
 echo "</table>";
}
 else {
 echo "No matching records are found.";
 }
?>
