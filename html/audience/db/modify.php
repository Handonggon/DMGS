<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $id = addslashes($_POST['form-id']);
  $num = addslashes($_POST['form-num']);
  $name = addslashes($_POST['form-name']);
  $temper = addslashes($_POST['form-temper']);
  $phone = addslashes($_POST['form-phone']);
  $destination = addslashes($_POST['form-destination']);
  $participation = addslashes($_POST['form-participation']);
  $division = addslashes($_POST['form-division']);
  //echo $num, $name, $temper, $phone, $destination, $participation, $division;

  $result = query("UPDATE $table SET number='$num', name='$name', participation='$participation', division='$division', temper='$temper', phone='$phone', destination='$destination' WHERE id='$id'");
  if($result != 0) {
    echo "
      <script>
        alert('수정되었습니다.');
        window.close();
      </script>
    ";
  }
  else {
    echo "군번이 중복되었습니다.";
  }
?>
