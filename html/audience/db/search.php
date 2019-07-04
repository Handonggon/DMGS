<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $select = $_POST['search_select'];
  $value = $_POST['search_input'];

  if($value != "") {
    if($select == "군번") {
      $result = query("SELECT * FROM $table WHERE end_date IS NULL AND number = '$value'");
    }
    else if($select == "이름") {
      $result = query("SELECT * FROM $table WHERE end_date IS NULL AND name = '$value'");
    }
  }
  else {
    $result = query("SELECT * FROM $table WHERE end_date IS NULL");
  }
?>
