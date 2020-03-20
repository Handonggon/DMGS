<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = [];
    $sql = query("SELECT hash FROM exhibit;");
    if($sql) {
      while($exhibit = $sql->fetch_array()) {
        array_push($result, "35.221.108.183/exhibition/uploads/".$exhibit['hash']);
      }
    }
    else {
      echo '-1';
    }
    print_r(json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE));
  }
  else {
    echo '-1';
  }
?>
