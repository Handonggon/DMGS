<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibition";
  $number = $_POST['exhibition-num'];
  $is_open = 1 - $_POST['exhibition-value'];

  $result = query("UPDATE $table SET is_open='$is_open' WHERE number='$number'");
  if($result != 0) {
    echo "
      <script>
        alert('적용되었습니다.');
        location.href = './exhibition.php';
      </script>
    ";
  }
?>
