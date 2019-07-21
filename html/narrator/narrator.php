<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "narrator";
  $result = query("SELECT * FROM $table order by id");
  $narrator = $result->fetch_array();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/css/narratorc.css" type="text/css">
    <script language="javascript" type="text/javascript">
      var today = new Date(); // 오늘 날짜//지신의 컴퓨터를 기준으로
      function buildCalendar() {// 현재 달
        const firstTime = "11:00";
        const secondTime = "13:00";
        var firstDate = new Date(today.getFullYear(), today.getMonth(), 1);  // 이번 달의 첫째 날
        var lastDate = new Date(today.getFullYear(), today.getMonth()+1, 0); // 이번 달의 마지막 날
        var tableCalendar = document.getElementById("calendar");     // 테이블 달력을 만들 테이블
        var tableCalendarYM = document.getElementById("calendarYM");    // yyyy년 m월 출력할 곳
        tableCalendarYM.innerHTML = today.getFullYear() + "년 " + (today.getMonth() + 1) + "월";  // yyyy년 m월 출력
        // 기존 테이블에 뿌려진 줄, 칸 삭제

        /*while (tableCalendar.rows.length > 2) {
          tableCalendar.deleteRow(tblCalendar.rows.length - 1);
        }*/


        var row = null;
        row = tableCalendar.insertRow();
        var cnt = 0;
        // 1일이 시작되는 칸을 맞추어 줌
        for (i=0; i<firstDate.getDay(); i++) {
          cell = row.insertCell();
          cell.classList.add('blank');
          cnt = cnt + 1;
        }
        for (i=1; i<=lastDate.getDate(); i++) {
          var divDate = document.createElement('div');  //Html 태그들 생성
          var eventButton1 = document.createElement('button');
          var eventButton2 = document.createElement('button');
          divDate.classList.add('date');
          eventButton1.classList.add('event1');
          eventButton2.classList.add('event2');
          eventButton1.id = i * 2 - 1;
          eventButton2.id = i * 2;
          eventButton1.innerHTML = firstTime;
          eventButton2.innerHTML = secondTime;

          cell = row.insertCell();    //해당 행에 새로운 셀 생성
          cell.appendChild(divDate);  //날짜 영역 추가
          if(<?php echo $narrator;?> == 0) {    //db에 삭제할 일정이 없으면 일정들 달력에 추가
            cell.appendChild(eventButton1);
            cell.appendChild(eventButton2);
          }
          else {
            if(<?php echo $narrator['id'];?> != eventButton1.id) {
              cell.appendChild(eventButton1);
            }
            else {
              <?php $narrator = $result->fetch_array();?>;
            }
            if(<?php echo $narrator;?> == 0) {
              cell.appendChild(eventButton2);
            }
            else {
              if (<?php echo $narrator['id'];?> != eventButton2.id) {
                cell.appendChild(eventButton1);
              }
              else {
                <?php $narrator = $result->fetch_array();?>;
              }
            }
          }
          divDate.innerHTML = i;    //날짜 추가

          cnt = cnt + 1;
          if (cnt%7 == 0)// 1주일이 7일 이므로
          row = calendar.insertRow();// 줄 추가
          row.classList.add('days');
        }
        for(i=lastDate.getDate() % 7 + 1 ; i < 7 ; i++) {
          cell = row.insertCell();
          cell.classList.add('blank');
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
              <li><a href="./exhibition.php" class="on">해설사 관리</a></li>
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
              <div id="calendar-wrap">
                <header>
                  <h1 id="calendarYM">yyyy년 m월</h1>
                </header>
                <table id="calendar" boarder="3" align="center">
                  <tr id="weekdays">
                    <td align="center">일</td>
                    <td align="center">월</td>
                    <td align="center">화</td>
                    <td align="center">수</td>
                    <td align="center">목</td>
                    <td align="center">금</td>
                    <td align="center">토</td>
                  </tr>
                </table>
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
