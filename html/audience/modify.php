<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "audience";
  $id = $_POST['form_id'];
  $num = $_POST['form_num'];
  $name = $_POST['form_name'];
  $temper = $_POST['form_temper'];
  $phone = $_POST['form_phone'];
  $destination = $_POST['form_destination'];
  $participation = $_POST['form_participation'];
  $division = $_POST['form_division'];
  //echo $num, $name, $temper, $phone, $destination, $participation, $division;

  $result = query("UPDATE $table SET number='$num', name='$name', participation='$participation', division='$division', temper='$temper', phone='$phone', destination='$destination' WHERE id='$id'");
  if($result != 0) {
    echo "
      <script>
        alert('수정되었습니다.');
        opener.parent.location='audience.php';
        window.close();
      </script>
    ";
  }
?>
