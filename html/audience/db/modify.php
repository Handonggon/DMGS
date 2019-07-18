<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $parent = $_POST['form-parent'];
  $id = $_POST['form-id'];
  $num = $_POST['form-num'];
  $name = $_POST['form-name'];
  $temper = $_POST['form-temper'];
  $phone = $_POST['form-phone'];
  $destination = $_POST['form-destination'];
  $participation = $_POST['form-participation'];
  $division = $_POST['form-division'];
  //echo $num, $name, $temper, $phone, $destination, $participation, $division;

  $result = query("UPDATE $table SET number='$num', name='$name', participation='$participation', division='$division', temper='$temper', phone='$phone', destination='$destination' WHERE id='$id'");
  if($result != 0) {
    if($parent == 1) {
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
