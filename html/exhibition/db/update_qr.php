<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibition";
  $id = addslashes($_GET['number']+6);
  $value = addslashes($_GET['value']);
  $result = query("UPDATE $table SET value='$value' WHERE id='$id'");
  if($result != 0) {
    echo "
      <script>
        location.href='/exhibition/exhibition.php';
      </script>
    ";
  }
?>
