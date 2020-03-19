<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibit";
  $id = addslashes($_POST['number']);

  $sql = query("SELECT * FROM $table WHERE id = '$id';");
  $exhibit = $sql->fetch_array();
  if(unlink("../uploads/".$exhibit['hash'])) {
    $result = query("DELETE FROM $table WHERE id = '$id'");
    if($result != 0) {
      echo "
        <script>
          alert('삭제되었습니다.');
          opener.parent.location.reload();
          window.close();
        </script>
      ";
    }
    else {
      echo "DB 삭제 실패";
    }
  }
  else {
    echo "사진 삭제 실패";
  }
?>
