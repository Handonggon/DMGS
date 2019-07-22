<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = query("SELECT * FROM exhibition WHERE division = 1");
    $result = array();
    while($exhibition = $sql->fetch_array()) {
      array_push($result, array("number"=>$exhibition['number'], "address"=>"http://35.221.108.183/QR/".$exhibition['value']));
    }
    echo json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
 ?>
