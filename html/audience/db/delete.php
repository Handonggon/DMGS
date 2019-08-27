<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $id = addslashes($_POST['form-id']);

  $result = query("DELETE FROM $table WHERE id = '$id'");
  if($result != 0) {
    echo "
      <script>
        alert('삭제되었습니다.');
        window.close();
      </script>
    ";
  }
?>
