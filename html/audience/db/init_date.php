<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $id = addslashes($_POST['form-id']);

  $result = query("UPDATE $table SET start_date = NULL WHERE id = '$id'");
  if($result != 0) {
    echo "
      <script>
        window.close();
      </script>
    ";
  }
?>
