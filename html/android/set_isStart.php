<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = addslashes($_POST['id']);

    $sql = query("SELECT * FROM audience WHERE id = '$id';");
    if(mysqli_num_rows($sql) > 0) {
      $result = array();
      while($audience = $sql->fetch_array()) {
        if($audience['end_date'] != NULL) {
          echo '0';
        }
        else {
          $result = query("UPDATE audience SET start_date = null WHERE id = '$id';");
          if($result) {
            echo '1';
          }
          else {
            echo '0';
          }
        }
      }
    }
    else {
      echo '-1';
    }
  }
  else {
    echo '-1';
  }
?>
