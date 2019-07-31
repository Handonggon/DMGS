<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "deleted_schedule";

  $result = query("DELETE FROM $table;");
  if($result != 0) {
    echo "
      <script>
        alert('일정이 전부 복구되었습니다.');
        location.href = '../narrator.php';
      </script>
    ";
  }
?>
