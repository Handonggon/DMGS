<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = query("SELECT * FROM survey ORDER BY id;");
    if($sql) {
      $result = array();
      while($survey = $sql->fetch_array()) {
        array_push($result, array("is_exist"=>$survey['is_exist'], "url"=>$survey['url']));
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
