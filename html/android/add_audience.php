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
      $sql = query("SELECT * FROM audience WHERE number = '$number' AND name = '$name'");
      if(mysqli_num_rows($sql) > 0) {
        while($audience = $sql->fetch_array()) {
          echo $audience['id'];
        }
      }
    }
    else {
      echo "0";
    }
  }
  else {
    echo 'PSOT Request가 아닙니다.';
  }
?>
