<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $number = $_POST['number'];
  $table = "audience";
  $date = date("y-m-d H:i:s");

  $result = query("UPDATE $table SET start_date = '$date'  WHERE number = '$number'");
  if($result) {
    echo "
      <script>
        location.href='/audience/audience_apply.php';
      </script>
    ";
  }
?>
