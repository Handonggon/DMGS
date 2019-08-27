<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $date = addslashes($_POST['date']);
  $sequence = addslashes($_POST['sequence']);
  $table = "schedule";

  $result = query("SELECT * FROM $table WHERE date = '$date'");
  $narrator = $result->fetch_array();
  if($sequence == 1) {
    $value = $narrator['first_time'];
    $value = 1 - $value;
    $result = query("UPDATE $table SET first_time = '$value' WHERE date = '$date'");
  }
  elseif($sequence == 2) {
    $value = $narrator['second_time'];
    $value = 1 - $value;
    $result = query("UPDATE $table SET second_time = '$value' WHERE date = '$date'");
  }
  if($result != 0) {
    echo "
      <script>
        alert('일정이 수정되었습니다.');
        location.href = '../narrator.php';
      </script>
    ";
  }
?>
