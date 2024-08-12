<?php
function calculateMean($numbers) {
  $sum = array_sum($numbers);
  $count = count($numbers);
  $mean = $sum / $count;
  return $mean;
}

if(isset($_POST['numbers'])) {
  $numbers = explode(',', $_POST['numbers']);
  $numbers = array_map('intval', $numbers);
  $mean = calculateMean($numbers);
  echo "Mean: $mean";
}
?>
<html>
    <head>
        <body>

<form action="calculatemean.php" method="post">
  Enter numbers (comma-separated): <input type="text" name="numbers" />
  <input type="submit" value="Calculate Mean" />
</form>
</body>
</head>
</html>

