<?php
  date_default_timezone_set('Asia/Seoul');
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = addslashes($_POST['id']);
    $date = date("y-m-d h:i:s");

    $result = query("UPDATE audience SET end_date = '$date' WHERE id = '$id';");

    if($result) {
      echo "1";
    }
    else {
      echo "0";
    }
  }
  else {
    echo 'PSOT Request';
  }
?>
