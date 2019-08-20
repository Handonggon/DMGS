<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "schedule";
  $maxDate = date("t");  //해당 달의 최대 날짜
  $curYear = (int)date('Y'); //해당 일의 년
  $curMonth = (int)date('m'); //해당 일의 월
  $firstday= date("w", mktime(0, 0, 0, $curMonth, 1, $curYear)); //해당 달의 첫번째 요일  일(0) ~ 토(6)
  $firstMonDate = 1 + ((8 - $firstday) % 7);  //월요일 날짜 계산

  for($i = 1 ; $i <= 31 ; $i++ ) {//전부 true로 저장
    $result = query("UPDATE $table SET first_time = 1, second_time = 1 WHERE date = '$i'");
  }
  for($i = $maxDate + 1 ; $i <= 31 ; $i++ ) {//최대 날짜 이후는 false로 저장
    $result = query("UPDATE $table SET first_time = 0, second_time = 0 WHERE date = '$i'");
  }
  /*for($i = $firstMonDate ; $i <= 31 ; $i = $i + 7) {//매주 월요일은 false로 저장(휴무)
    $result = query("UPDATE $table SET first_time = 2, second_time = 2 WHERE date = '$i'");
  }*/
  if($result != 0) {
    echo "
      <script>
        alert('일정이 전부 복구되었습니다.');
        location.href = '../narrator.php';
      </script>
    ";
  }
?>
