<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "audience";
  $key = $_GET['skey'];
  $val = $_GET['sval'];
?>
<script>
  function table_click(number) {
    var openWin =  window.open("popup.php?number=" + number , "name", "width=500, height=600, scrollbars=no");
  }
  function setSubmitUrl(mode, number) {
    if(mode == "search") {
      document.forms["search-box"].action = "/audience/audience_apply.php";
    }
    else if(mode == "init") {
      document.getElementById("select-search").value = "number";
      document.getElementById("write-search").value = "";
      document.forms["search-box"].action = "/audience/audience_apply.php";
    }
    else if(mode == "blue") {
      document.getElementById("btn-blue").value = number;
      document.forms["tableForm"].action = "/audience/db/start_date.php";
    }
    else if(mode == "white") {
      if(confirm("초기화 하시겠습니까?")) {
        document.getElementById("btn-white").value = number;
        document.forms["tableForm"].action = "/audience/db/init_date.php";
      }
    }
    else if(mode == "red") {
      document.getElementById("btn-red").value = number;
      document.forms["tableForm"].action = "/audience/db/end_date.php";
    }
  }
  setInterval(function(){$("#table_div").load(window.location + ' #table_div');}, 1000);
</script>
<html>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">관람자 관리</h2>
            <ul class="left-menu">
              <li><a href="/audience/audience_apply.php" class="on">관람 관리</a></li>
              <li><a href="/audience/audience_manage.php">관람 확인</a></li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
              <h3 class="tit">관람 관리</h3>
              <div class="right">
                <ul class="location">
                  <li class="home"><span>home</span></li>
                  <li >관람자 관리</li>
                  <li class="now">관람 관리</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <div class="search-box">
                <form name="searchForm" method="get">
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
                      <col width="10%" />
                      <col width="16%" />
                      <col width="16%" />
                      <col width="16%" />
                      <col width="16%" />
                      <col width="16%" />
                      <col width="10%" />
                    </colgroup>
  	            <thead>
                      <tr>
                        <th>No.</th>
                        <th>군번</th>
                        <th>이름</th>
                        <th>참여구분</th>
                        <th>휴대폰</th>
                        <th>진행시간</th>
                        <th>비고</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($val != "") {
                          if($key == "number") {
                            $result = query("SELECT * FROM $table WHERE end_date IS NULL AND number LIKE '%$val%'");
                          }
                          else if($key == "name") {
                            $result = query("SELECT * FROM $table WHERE end_date IS NULL AND name LIKE '%$val%'");
                          }
                        }
                        else {
                          $result = query("SELECT * FROM $table WHERE end_date IS NULL");
                        }
                        for($i = 1; $audience = $result->fetch_array(); $i++) {
                          $participation = ($audience['participation']?"전시해설":"전시관람");
                          if($audience['start_date'] == NULL) {
                            $tem = "blue";
                          }
                          else {
                            $progress_date = (strtotime(date('Y-m-d H:i:s')) - strtotime($audience['start_date']));
                            if($progress_date/3600 >= 2) {
                              $tem = "red";
                            }
                            else {
                              $tem = "white";
                            }
                          }
                      ?>
                      <tr name="table_tr" onclick=<?php echo("table_click(".$audience['number'].");") ?>>
                        <td class=<?php echo $tem ?>><?php echo $i; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $audience['number']; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $audience['name']; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $participation; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $audience['phone']; ?></td>
                        <td class=<?php echo $tem ?>><?php echo gmdate('H:i:s', $progress_date); ?></td>
                        <td class=<?php echo $tem ?> onclick="event.cancelBubble=true;">
                        <?php
                          switch($tem) {
                            case "blue": ?>
                                         <button type="submit" id="btn-blue" name="number" class="btn-blue" onclick='setSubmitUrl("blue", <?php echo $audience['number']; ?>)'>시작</button>
                                         <?php break;
                            case "white": ?>
                                         <button type="submit" id="btn-white" name="number" class="btn-blue" onclick='setSubmitUrl("white", <?php echo $audience['number']; ?>)'>초기화</button>
                                         <?php break;
                            case "red":  ?>
                                         <button type="submit" id="btn-red" name="number" class="btn-blue" onclick='setSubmitUrl("red", <?php echo $audience['number']; ?>)'>종료</button>
                                         <?php break;
                          }
                        ?>
                        </td>
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
