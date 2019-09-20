<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $id = addslashes($_POST['form-id']);
  $date = date("y-m-d H:i:s");

  $result = query("UPDATE $table SET end_date = '$date'  WHERE id = '$id'");
  if($result) {
    echo "
      <script>
        opener.parent.location.reload();
        window.close();
      </script>
    ";
  }
?>
