<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibition";
  $id = addslashes($_POST['number']);
  $value = addslashes(1 - $_POST['value']);

  $result = query("UPDATE $table SET value='$value' WHERE id='$id'");
  if($result != 0) {
    echo "
      <script>
        opener.parent.location.reload();
        window.close();
      </script>
    ";
  }
?>
