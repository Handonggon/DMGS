<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "audience";
  $key = addslashes($_GET['skey']);
  $val = addslashes($_GET['sval']);
  $fromdate = addslashes($_GET['fromdate']?$_GET['fromdate']:date("Y-m-d", strtotime("-3 month", time())));
  $todate = addslashes($_GET['todate']?$_GET['todate']:date("Y-m-d"));
?>
<script>
  function tr_click(id) {
    var openWin =  window.open("popup.php?id=" + id, "tr_click_popup", "width=500, height=600, scrollbars=no, location=no, toolbar=no, status=no");
    var g_oInterval = window.setInterval(function() {
      try {
        if(openWin == null || openWin.closed ) {
          window.clearInterval(g_oInterval);
          openWin = null;
          $("#table_div").load(window.location + ' #table_div');
        }
      } catch (e) { }
    }, 500);
  }
  function setSubmitUrl(mode, number) {
    if(mode == "search") {
      document.forms["searchForm"].action = "/audience/audience_manage.php";
    }
    else if(mode == "init") {
      document.getElementById("select-search").value = "number";
      document.getElementById("write-search").value = "";
      document.getElementById("datepicker1").value = "";
      document.getElementById("datepicker2").value = "";
      document.forms["searchForm"].action = "/audience/audience_manage.php";
    }
  }
  $.datepicker.regional['ko'] = {
    prevText: '이전달',
    nextText: '다음달',
    currentText: '오늘',
    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
    monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
    dayNames: ['일','월','화','수','목','금','토'],
    dayNamesShort: ['일','월','화','수','목','금','토'],
    dayNamesMin: ['일','월','화','수','목','금','토'],
    weekHeader: 'Wk',
    dateFormat: 'yy-mm-dd',
    firstDay: 0,
    isRTL: false,
    duration:200,
    showAnim:'show',
    showMonthAfterYear: true,
    yearSuffix:'년'
  };
  $.datepicker.setDefaults($.datepicker.regional['ko']);
  $(function(){
    $("#datepicker1").datepicker({
      changeMonth: false,
      changeYear: false,
      defaultDate: new Date()
    });
  });
  $(function(){
    $("#datepicker2").datepicker({
      changeMonth: false,
      changeYear: false,
      defaultDate: new Date()
    });
  });
</script>
<html>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">관람자 관리</h2>
            <ul class="left-menu">
              <li><a href="/audience/audience_view.php">일반관람 관리</a></li>
              <li><a href="/audience/audience_commentary.php">해설관람 관리</a></li>
              <li><a href="/audience/audience_manage.php" class="on">관람 확인</a></li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
	      <h3 class="tit">관람 확인</h3>
	      <div class="right">
                <ul class="location">
	          <li class="home"><span>home</span></li>
	          <li >관람자 관리</li>
	          <li class="now">관람 확인</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <div class="search-box">
                <form name="searchForm" method="get">
                  <label for="date-search" class="hidden">날짜 검색</label>
                  <input type="text" id="datepicker1" name="fromdate"class="input-date" value=<?php echo $fromdate; ?>>
                  <img src="/images/tilde.png"  width="30px" height="10px">
                  <input type="text" id="datepicker2" name="todate" class="input-date" value=<?php echo $todate; ?>>
                  <label for="select-search" class="hidden">검색어 분류</label>
                  <select id="select-search" name="skey">
                    <option value="number" <?php echo($key=='number'?'selected':''); ?>>군번</option>
                    <option value="name" <?php echo($key=='name'?'selected':''); ?>>이름</option>
		  </select>
                  <label for="write-search" class="hidden">검색어</label>
	  	  <input type="text" id="write-search" name="sval" class="input-text" placeholder="검색어를 입력하세요" value=<?php echo $val; ?>>
		  <button type="submit" class="btn-search" onclick='setSubmitUrl("search")'>검색</button>
                  <button type="submit" class="btn-init" onclick='setSubmitUrl("init")'>초기화</button>
                </form>
              </div>
              <div class="table-list">
                <form name="tableForm" method="get">
                  <table summary="관람자 정보 목록" id="table_div">
                    <colgroup>
                      <col width="15%" />
                      <col width="17%" />
                      <col width="17%" />
                      <col width="17%" />
                      <col width="17%" />
                      <col width="17%" />
                    </colgroup>
  	            <thead>
                      <tr>
                        <th>No.</th>
                        <th>군번</th>
                        <th>이름</th>
                        <th>관람구분</th>
                        <th>휴대폰</th>
                        <th>종료일자</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $fromdate = date("Y-m-d H:i:s", strtotime($fromdate)+"000000");
                        $todate = date("Y-m-d H:i:s", strtotime($todate)+"86399");
                        if($val != "") {
                          if($key == "number") {
                            $result = query("SELECT * FROM $table WHERE end_date IS NOT NULL AND number LIKE '%$val%' AND end_date BETWEEN '$fromdate' AND '$todate'");
                          }
                          else if($key == "name") {
                            $result = query("SELECT * FROM $table WHERE end_date IS NOT NULL AND name LIKE '%$val%' AND end_date BETWEEN '$fromdate' AND '$todate'");
                          }
                        }
                        else {
                          $result = query("SELECT * FROM $table WHERE end_date IS NOT NULL AND end_date BETWEEN '$fromdate' AND '$todate'");
                        }
                        for($i = 1; $audience = $result->fetch_array(); $i++) {
                          $participation = ($audience['participation']?"전시해설":"전시관람");
                      ?>
                      <tr name="table_tr" onclick=<?php echo("tr_click(".$audience['id'].");") ?>>
                        <td class="white"><?php echo $i; ?></td>
                        <td class="white"><?php echo $audience['number']; ?></td>
                        <td class="white"><?php echo $audience['name']; ?></td>
                        <td class="white"><?php echo $participation; ?></td>
                        <td class="white"><?php echo $audience['phone']; ?></td>
                        <td class="white"><?php echo date("Y-m-d", strtotime($audience['end_date'])); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </from>
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
