<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $id = addslashes($_POST['form-id']);
  $date = date("y-m-d H:i:s");

  $result = query("UPDATE $table SET start_date = '$date' WHERE id = '$id'");
  if($result) {
    echo "
      <script>
        window.close();
      </script>
    ";
  }
?>
