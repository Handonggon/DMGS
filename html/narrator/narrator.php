<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "schedule";
  $result = query("SELECT * FROM $table order by date");
  $count = $result->num_rows;
  $schedule = NULL;
  if($count == 0) { //query의 반환값이 없을 때 처리
    $schedule = array();
    $schedule['date'] = '-1';
    $schedule['first_time'] = '-1';
    $schedule['second_time'] = '-1';
  }
  else {
    $num = 0;
    $dateArr = "";
    $time1Arr = "";
    $time2Arr = "";
    while($schedule = $result->fetch_array()) {
      if ($diff++ != 0) {
        $dateArr .= ",";
        $time1Arr .= ",";
        $time2Arr .= ",";
      }
      $dateArr .= "'".$schedule['date']."'";
      $time1Arr .= "'".$schedule['first_time']."'";
      $time2Arr .= "'".$schedule['second_time']."'";
    }
  }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="../css/narratorc.css">
    <script language="javascript" type="text/javascript">
      function buildCalendar() {// 현재 달
        const firstTime = "11:00";
        const secondTime = "13:00";
        var today = new Date(); // 오늘 날짜//지신의 컴퓨터를 기준으로
        var firstDate = new Date(today.getFullYear(), today.getMonth(), 1);  // 이번 달의 첫째 날
        var nowDay = firstDate.getDay();                                   //첫번째 날의 요일 구함
        var lastDate = new Date(today.getFullYear(), today.getMonth()+1, 0); // 이번 달의 마지막 날
        var tableCalendar = document.getElementById("tbodyCal");     // 테이블 달력을 만들 테이블의 tbody
        var tableCalendarYM = document.getElementById("year-month");    // yyyy년 m월 출력할 곳
        tableCalendarYM.innerHTML = today.getFullYear() + "년 " + (today.getMonth() + 1) + "월";  // yyyy년 m월 출력
        var dateArr = new Array(<?php echo $dateArr ?>);
        var seqArr1 = new Array(<?php echo $time1Arr ?>);
        var seqArr2 = new Array(<?php echo $time2Arr ?>);
        // 기존 테이블에 뿌려진 줄, 칸 삭제

        /*while (tableCalendar.rows.length > 2) {
          tableCalendar.deleteRow(tblCalendar.rows.length - 1);
        }*/


        var row = null;
        row = tableCalendar.insertRow(tableCalendar.rows.length);
        var cnt = 0;
        // 1일이 시작되는 칸을 맞추어 줌
        for (i=0; i<firstDate.getDay(); i++) {
          var divBox = document.createElement('div');
          divBox.classList.add('box');
          cell = row.insertCell();
          cell.classList.add('other');
          cell.appendChild(divBox);
          cnt = cnt + 1;
        }

        for (i=1; i<=lastDate.getDate(); i++) {
          var divBox = document.createElement('div');
          var spanDay = document.createElement('span');
          var divButton = document.createElement('div');
          var eventButton1 = document.createElement('button');
          var eventButton2 = document.createElement('button');
          divBox.classList.add('box');
          spanDay.classList.add('day');
          divButton.classList.add('scheduleButton');
          eventButton1.classList.add('event1');
          eventButton2.classList.add('event2');
          eventButton1.id = i * 2 - 1;
          eventButton2.id = i * 2;
          eventButton1.onclick = function(event) {
            var thisButton = event.currentTarget;
            if(confirm("일정을 수정 하시겠습니까?")) {
              document.getElementById("hidden-date").value = (Number(thisButton.getAttribute('id')) + 1) / 2;
              document.getElementById("hidden-sequence").value = '1';
              document.forms["send-value"].action = "./db/update.php";
              document.forms["send-value"].submit();
            }
            //console.log(thisButton.getAttribute('id') + " " + (Number(thisButton.getAttribute('id')) + 1) / 2);
          }
          eventButton2.onclick = function(event) {
            var thisButton = event.currentTarget;
            if(confirm("일정을 수정 하시겠습니까?")) {
              document.getElementById("hidden-date").value = Number(thisButton.getAttribute('id')) / 2;
              document.getElementById("hidden-sequence").value = '2';
              document.forms["send-value"].action = "./db/update.php";
              document.forms["send-value"].submit();
            }
          }
          eventButton1.innerHTML = firstTime;
          eventButton2.innerHTML = secondTime;
          divBox.appendChild(spanDay);
          divBox.appendChild(divButton);
          divButton.appendChild(eventButton1);
          divButton.appendChild(eventButton2);

          cell = row.insertCell();    //해당 행에 새로운 셀 생성
          if(today.getDate() == i) {
            cell.classList.add('today');
          }
          else if(cnt % 7 == 0) {  //일요일이면
            cell.classList.add('sun');
          }
          else if(cnt % 7 == 6) { //토요일이면
            cell.classList.add('sat');
          }
          cell.appendChild(divBox);  //날짜 영역 추가
          /*
          if(nowDay == 6 || nowDay == 0 || nowDay == 1) { //토, 일, 월인 경우 달력에 버튼 deleted로
            eventButton1.classList.remove('event1');
            eventButton1.classList.add('deleted-button1');
            eventButton2.classList.remove('event2');
            eventButton2.classList.add('deleted-button2');
          }*/
          if(seqArr1[i - 1] == 0) { //일정이 없는 경우에 대한 처리
            eventButton1.classList.remove('event1');
            eventButton1.classList.add('deleted-button1');
          }
          if(seqArr2[i - 1] == 0) {
            eventButton2.classList.remove('event2');
            eventButton2.classList.add('deleted-button2');
          }
          spanDay.innerHTML = i;    //날짜 추가

          nowDay = (nowDay + 1) % 7;
          cnt = cnt + 1;
          if (cnt%7 == 0)// 1주일이 7일 이므로
            row = tableCalendar.insertRow();// 줄 추가
        }

        for(i=lastDate.getDay() % 7 + 1 ; i < 7 ; i++) {
          var divBox = document.createElement('div');
          divBox.classList.add('box');
          cell = row.insertCell();
          cell.classList.add('other');
          cell.appendChild(divBox);
          cnt = cnt + 1;
        }
      }
    </script>
  </head>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">전시해설 관리</h2>
            <ul class="left-menu">
              <li><a href="./narrator.php" class="on">해설사 관리</a></li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
              <h3 class="tit">해설사 관리</h3>
              <div class="right">
                <ul class="location">
                  <li class="home"><span>home</span></li>
                  <li class="now">전시해설 관리</li>
                  <li class="now">해설사 관리</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <form class="send-value" name="send-value" action="./db/update.php" method="post">
                <input type="hidden" name="date" id="hidden-date">
                <input type="hidden" name="sequence" id="hidden-sequence">
              </form>
              <div class="calendar-control">
                <div class="arr-area">
                  <span class="year-month" id="year-month">yyyy년 m월</span>
                </div>
              </div>
              <div class="calendar-form">
                <table id="table1">
                  <caption>오늘의 해설사 일정 목록</caption>
                  <colgroup>
            				<col />
            				<col />
            				<col />
            				<col />
            				<col />
            				<col />
            				<col />
            			</colgroup>
                  <thead>
                    <tr>
                      <th>일</td>
                      <th>월</td>
                      <th>화</td>
                      <th>수</td>
                      <th>목</td>
                      <th>금</td>
                      <th>토</td>
                    </tr>
                  </thead>
                  <tbody id = "tbodyCal">
                  </tbody>
                </table>
                <div class="ico-area">
			             <button type="button" name="reset" class="btn-blue" onclick="location.href='./db/rollback.php'">초기화</button>
		            </div>
                <script language="javascript" type="text/javascript">
                  buildCalendar();
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer id="footer">
      <div class="top">
        </div>
          <div class="bottom">
        </div>
    </footer>
  </body>
</html>
