<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibition";
  $number = addslashes($_GET['number']);
  $value = addslashes($_GET['value']);
  $result = query("INSERT INTO $table(number, division, value) values ('$number', '2', '$value')");
  if($result != 0) {
    echo "
      <script>
        location.href='/exhibition/exhibition.php';
      </script>
    ";
  }


?>
