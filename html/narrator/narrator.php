<?php
include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>전시해설 관리</title>
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
          var divDate = document.createElement('div');
          var eventButton1 = document.createElement('button');
          var eventButton2 = document.createElement('button');
          divDate.classList.add('date');
          eventButton1.classList.add('event1');
          eventButton2.classList.add('event2');

          cell = row.insertCell();
          cell.appendChild(divDate);
          cell.appendChild(eventButton1);
          cell.appendChild(eventButton2);
          divDate.innerHTML = i;
          eventButton1.innerHTML = firstTime;
          eventButton2.innerHTML = secondTime;
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
  </body>
</html>
