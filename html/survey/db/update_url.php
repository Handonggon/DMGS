<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "survey";
  $id = $_POST['id'];
  $url = $_POST['survey_url'];
  $result = query("UPDATE $table SET url='$url' WHERE id='$id'");
  if($result != 0) {
    echo "
      <script>
        location.href='/survey/survey.php';
      </script>
    ";
  }
?>
