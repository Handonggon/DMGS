<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = query("SELECT * FROM schedule ORDER BY date);
    $result = array();
    while($schedule = $sql->fetch_array()) {
      array_push($result, array("date"=>$schedule['date'], "first_time"=>$schedule['first_time'], "second_time"=>$schedule['second_time']));
    }
    echo json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
 ?>
