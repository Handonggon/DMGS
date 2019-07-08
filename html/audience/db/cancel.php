<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $id = $_POST['form-id'];
  $table = "audience";
  echo $id;

  $result = query("UPDATE $table SET start_date = NULL WHERE id = '$id'");
  if($result != 0) {
    echo "
      <script>
        alert('취소되었습니다.');
        opener.parent.location='/audience/audience_apply.php';
        window.close();
      </script>
    ";
  }
?>
