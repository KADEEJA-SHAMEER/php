<html>
<body>
  <h1>Sum of Array Elements</h1>
  <form action="" method="post">
    <input type="number" name="num_elements" placeholder="Enter number of elements">
    <button type="submit" name="submit1">Next</button>
  </form>
  <?php
    if(isset($_POST['submit1'])){
      $num_elements = $_POST['num_elements'];
      ?>
      <form action="" method="post">
        <?php
        for($i=0; $i<$num_elements; $i++){
          ?>
          <input type="number" name="array[]" placeholder="Enter element <?=$i+1?>">
          <br>
          <?php
        }
        ?>
        <button type="submit" name="submit2">Calculate Sum</button>
      </form>
      <?php
    }
    if(isset($_POST['submit2'])){
      $array = $_POST['array'];
      $sum = array_sum($array);
      echo "Sum: $sum";
    }
  ?>
</body>
</html>