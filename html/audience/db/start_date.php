<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  $number = location.href.split('=')[1];
  document.writeln(number);
  $date = date("y-m-d h:i:s");

  query("UPDATE audience SET strat_date = '$date'  WHERE number = '$number';");
?>
