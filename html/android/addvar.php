<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $number = $_POST['number'];
    $name = $_POST['name'];
    $participation = $_POST['participation'];
    $division = $_POST['division'];
    $temper = $_POST['temper'];
    $phone = $_POST['phone'];
    $destination = $_POST['destination'];

    $result = query("INSERT INTO audience (number, name, participation, division, temper, phone, destination) VALUES ('$number', '$name', '$participation', '$division', '$temper', '$phone', '$destination')");

    if($result) {
      echo '관람자 정보가 입력되었습니다.';
    }
    else {
      echo '관람자 정보가 입력되지 않았습니다.';
    }
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
?>
