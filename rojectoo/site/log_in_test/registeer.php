<?php
  include "php/database/data.php";

  $con = mysqli_connect($servername,$uid,$pwd,$database);
  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }

  $vertificatie = $_GET['vertificatie'];
  $boolean = "true";

  $sql = "UPDATE account SET active=$boolean WHERE vertificatie=$vertificatie";

  $con->query($sql);

  echo "Account is geactiveerd";

?>
