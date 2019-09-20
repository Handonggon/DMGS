<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = addslashes($_POST['id']);
    $date = date("Y-m-d H:i:s");

    $sql = query("SELECT * FROM audience WHERE id = '$id';");
    if(mysqli_num_rows($sql) > 0) {
      while($audience = $sql->fetch_array()) {
        if($audience['start_date'] == null) {
          echo '-1';
          break;
        }
        if($audience['end_date'] != null) {
          echo '-1';
          break;
        }
        $progress_date = strtotime($date) - strtotime($audience['start_date']);
        if($progress_date/3600 >= ($audience['participation']?1:2)) {
          $result = query("UPDATE audience SET end_date = '$date' WHERE id = '$id';");
          if($result) {
            echo '1';
          }
          else {
            echo '0';
          }
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
?>
