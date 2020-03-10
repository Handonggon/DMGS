<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $count = addslashes($_POST['count']);
    $result = [];
    for($i = 1; $i < 7; $i++) {
      $sql = query("SELECT * FROM exhibit WHERE number = '$i';");
      if($sql) {
        $result[$i] = [];
        while($exhibit = $sql->fetch_array()) {
          array_push($result[$i], array("name"=>$exhibit['name'], "MAC"=>$exhibit['MAC'], "space"=>$exhibit['space'], "img"=>"35.221.108.183/exhibition/uploads/".$exhibit['img']));
        }
      }
      else {
        echo '-1';
      }
      while($count < count($result[$i])) {
        $randomNum = mt_rand(0, count($result[$i]));
        unset($result[$i][$randomNum]);
        $result[$i] = array_values($result[$i]);
      }
      //print_r(count($result[$i]));
    }
    print_r(json_encode(array('result'=>$result), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE));
  }
  else {
    echo '-1';
  }
?>
