<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibition";
  $number = addslashes($_POST['number']);
  $value = addslashes($_POST['value']);

  $result = query("INSERT INTO $table(number, division, value) values ('$number', '2', '$value')");
  if($result != 0) {
    echo "
      <script>
        opener.parent.location.reload();
        window.close();
      </script>
    ";
  }
?>
