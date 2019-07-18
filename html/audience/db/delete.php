<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $parent = $_POST['form-parent'];
  $id = $_POST['form-id'];
  $table = "audience";

  $result = query("DELETE FROM $table WHERE id = '$id'");
  if($result != 0) {
      echo "
        <script>
          alert('수정되었습니다.');
          opener.parent.location='/audience/audience_apply.php';
          window.close();
        </script>
      ";
    }
    else if($parent == 2) {
      echo "
        <script>
          alert('수정되었습니다.');
          opener.parent.location='/audience/audience_manage.php';
          window.close();
        </script>
      ";
    }
  }
?>
