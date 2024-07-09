<?php
$dbcon = mysqli_connect("localhost", "root", "", "kadeeja")or die("Error");


$sql = "SELECT * FROM student";
$data = mysqli_query($dbcon, $sql);
 if (mysqli_num_rows($data) > 0) {
 echo "<table>";
 echo "<tr>";
 echo "<th>Student Id</th>";
 echo "<th>Student Name</th>";
 echo "<th>Mark</th>";
 echo "</tr>";
 while ($row = mysqli_fetch_array($data)) {
 echo "<tr><form action=UpdateQuery.php method=post>";
 echo "<td><input type=text name=rollno value=".$row['studid']."></td>";
 echo "<td><input type=text name=stname value=".$row['StName']."></td>";
 echo "<td><input type=text name=stmark value=".$row['Marks']."></td>";
 echo "<td><input type=submit name=submit value=update></td>";
echo "</form></tr>";
 }
 echo "</table>";
 }
 else {
 echo "No matching records are found.";
 }
?>
