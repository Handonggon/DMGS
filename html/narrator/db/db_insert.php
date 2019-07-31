<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $date = $_POST['date'];
  $sequence = $_POST['sequence'];
  $table = "deleted_schedule";

  $result = query("INSERT INTO $table(date, sequence) values('$date', '$sequence')");
  if($result != 0) {
    echo "
      <script>
        alert('일정이 삭제되었습니다.');
        location.href = '../narrator.php';
      </script>
    ";
  }
?>
