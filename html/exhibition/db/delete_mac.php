<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibition";
  $id = addslashes($_GET['number']);
  if($id > 12) {
    $result = query("DELETE FROM $table WHERE id = '$id'");
    if($result != 0) {
      echo "
        <script>
          location.href='/exhibition/exhibition.php';
        </script>
      ";
    }
  }
?>
