<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $number = $_POST['number'];
    $name = $_POST['name'];
    $date = date("y-m-d h:i:s");

    $result = query("UPDATE audience SET end_date = '$date' WHERE number = '$number' AND name = '$name';");

    if($result) {
      echo '관람자 정보가 수정되었습니다.';
    }
    else {
      echo '관람자 정보가 수정되지 않았습니다.';
    }
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
?>
