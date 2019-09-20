<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $number = addslashes($_POST['number']);
    $name = addslashes($_POST['name']);
    $participation = addslashes($_POST['participation']);
    $division = addslashes($_POST['division']);
    $temper = addslashes($_POST['temper']);
    $phone = addslashes($_POST['phone']);
    $destination = addslashes($_POST['destination']);

    $result = query("INSERT INTO audience (number, name, participation, division, temper, phone, destination) VALUES ('$number', '$name', '$participation', '$division', '$temper', '$phone', '$destination')");

    if($result) {
      $sql = query("SELECT * FROM audience WHERE number = '$number' AND name = '$name'");
      if(mysqli_num_rows($sql) > 0) {
        while($audience = $sql->fetch_array()) {
          echo $audience['id'];
        }
      }
      else {
        echo '-1';
      }
    }
    else {
      echo '-1';
    }
  }
  else {
    echo '-1';
  }
?>
