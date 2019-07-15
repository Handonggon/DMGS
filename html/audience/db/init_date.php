<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $number = $_GET['number'];
  $table = "audience";

  $result = query("UPDATE $table SET start_date = NULL WHERE number = '$number'");
  if($result != 0) {
    echo "
      <script>
        location.href='/audience/audience_apply.php';
      </script>
    ";
  }
?>
