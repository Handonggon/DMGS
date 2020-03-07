<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibit";
  $id = addslashes($_POST['number']);

  $result = query("DELETE FROM $table WHERE id = '$id'");
  if($result != 0) {
    echo "
      <script>
        alert('삭제되었습니다.');
        opener.parent.location.reload();
        window.close();
      </script>
    ";
  }
?>
