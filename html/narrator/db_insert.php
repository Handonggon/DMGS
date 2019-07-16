<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $id = $_POST['id'];
  $table = "narrator";

  $result = query("INSERT INTO $table values($id)");
  if($result != 0) {
    echo "
      <script>
        alert('일정이 삭제되었습니다.');
        location.href = './narrator.php';
      </script>
    ";
  }
?>
