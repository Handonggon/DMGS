<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $parent = $_POST['form-parent'];
  $id = $_POST['form-id'];
  $table = "audience";

  $result = query("DELETE FROM $table WHERE id = '$id'");
  if($result != 0) {
    echo "
      <script>
        alert('삭제되었습니다.');
        opener.parent.location='/audience/audience_apply.php';
        window.close();
      </script>
    ";
  }
?>
