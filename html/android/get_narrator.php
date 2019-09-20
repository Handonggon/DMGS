<?php
  date_default_timezone_set('Asia/Seoul');
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $today = date("d");

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = query("SELECT * FROM schedule WHERE date = '$today'");
    if($sql) {
      $result = array();
      while($schedule = $sql->fetch_array()) {
        array_push($result, array("first_time"=>$schedule['first_time'], "second_time"=>$schedule['second_time']));
      }
      echo json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }
    else {
      echo '-1';
    }
  }
  else {
    echo '-1';
  }
 ?>
