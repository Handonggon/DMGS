<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = addslashes($_POST['id']);

    $sql = query("SELECT * FROM audience WHERE id = '$id'");

    if(mysqli_num_rows($sql) > 0) {
      $result = array();
      while($audience = $sql->fetch_array()) {
        array_push($result, array("number"=>$audience['number'], "name"=>$audience['name'], "participation"=>$audience['participation'], "division"=>$audience['division'], "temper"=>$audience['temper'], "phone"=>$audience['phone'], "destination"=>$audience['destination']));
      }
      echo json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }
    else {
      echo '0';
    }
  }
  else {
    echo 'PSOT Request';
  }
?>
