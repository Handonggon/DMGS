<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibit";
  $number = addslashes($_POST['form-number']);
  $name = addslashes($_POST['form-name']);
  $MAC = addslashes($_POST['form-MAC']);
  $space = addslashes($_POST['form-space']);
  $img = addslashes($_POST['form-img']);
  echo $number, $name, $MAC, $space, $img;

  $result = query("INSERT INTO $table(number, name, MAC, space, img) values ('$number', '$name, '$MAC', '$space', '$img')");
  if($result != 0) {
    echo "
      <script>
        opener.parent.location.reload();
        window.close();
      </script>
    ";
  }
?>
