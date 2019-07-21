<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $number = $_POST['number'];
    $name = $_POST['name'];
    $date = date("y-m-d h:i:s");

    $result = query("UPDATE audience SET end_date = '$date' WHERE number = '$number' AND name = '$name';");

    if($result) {
      echo "1";
    }
    else {
      echo "0";
    }
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
?>
