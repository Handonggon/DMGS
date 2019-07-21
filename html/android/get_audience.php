<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $number = $_POST['number'];
    $name = $_POST['name'];

    $sql = query("SELECT * FROM audience WHERE number = '$number' AND name = '$name'");

    if(mysqli_num_rows($sql) > 0) {
      $result = array();
      while($audience = $sql->fetch_array()) {
        array_push($result, array("id"=>$audience['id'], "number"=>$audience['number'], "name"=>$audience['name'], "participation"=>$audience['participation'], "division"=>$audience['division'], "temper"=>$audience['temper'], "phone"=>$audience['phone'], "destination"=>$audience['destination'], "input_date"=>$audience['input_date'], "start_date"=>$audience['start_date'], "end_date"=>$audience['end_date']));
      }
      echo json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }
    else {
      echo '0';
    }
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
?>
