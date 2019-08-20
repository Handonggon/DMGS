<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "survey";
  $id = $_POST['id'];
  $is_exist = 1- $_POST['value'];
  $result = query("UPDATE $table SET is_exist='$is_exist' WHERE id='$id'");
  if($result != 0) {
    echo "
      <script>
        location.href='/survey/survey.php';
      </script>
    ";
  }
?>
