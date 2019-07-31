<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];

    $sql = query("SELECT * FROM audience WHERE id = '$id';");

    if(mysqli_num_rows($sql) > 0) {
      $result = array();
      while($audience = $sql->fetch_array()) {
//        array_push($result, array("id"=>$audience['id'], "number"=>$audience['number'], "name"=>$audience['name'], "participation"=>$audience['participation'], "division"=>$audience['division'], "temper"=>$audience['temper'], "phone"=>$audience['phone'], "destination"=>$audience['destination'], "input_date"=>$audience['input_date'], "start_date"=>$audience['start_date'], "end_date"=>$audience['end_date']));
          if($audience['start_date'] != NULL) {
            echo $audience['start_date'];
          }
          else {
            echo '0';
          }
      }
      //echo json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
    }

    else {
      echo '0';
    }
  }
  else {
    echo '0';
  }
?>
