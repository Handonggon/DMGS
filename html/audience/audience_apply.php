
<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
?>

<script>
  function search_click() {
    document.cookie = "select=" + document.getElementById("search_select").value;
    document.cookie = "value=" + document.getElementById("search_input").value;
    window.location.reload(true);
  }
  function reset_click() {
    document.cookie = "select=" + "number";
    document.cookie = "value=" + "";
    window.location.reload(true);
  }
  function blue_click(number) {
    alert(number);
  }
  function green_click(number) {
    alert(number);
  }
  function white_click(number) {
    alert(number);
  }
  function table_click(number) {
    var openWin =  window.open("popup.php?number=" + number , "name", "width=500, height=600, scrollbar=no");
  }
</script>

<html>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">관람 관리</h2>
            <ul class="left-menu">
              <li><a href="/audience/audience_apply.php" class="on">관람자 관리</a></li>
              <li><a href="/audience/audience_manage.php">관람자 확인</a></li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
              <h3 class="tit">관람자 관리</h3>
              <div class="right">
                <ul class="location">
                  <li class="home"><span>home</span></li>
                  <li >관람 관리</li>
                  <li class="now">관람자 관리</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <div class="search-box">
                <form name="searchForm" method="get" action="/audience/audience_apply.php">
                  <label for="select00" class="hidden">검색어 분류</label>
                  <select name="skey" id="select00">
                    <option value="number">군번</option>
                    <option value="name">이름</option>
		  </select>
                  <label for="write-search" class="hidden">검색어</label>
	  	  <input type="text" id="write-search" name="sval" class="input-text" placeholder="검색어를 입력하세요" value="">
		  <button type="submit" id="btn-search" class="btn-search">검색</button>
                </form>
              </div>
              <div class="table-list">
              <form name="tableForm" method="get" action="/audience/audience_apply.php">
                <table summary="관람자 정보 목록">
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
 	            $table = "audience";
                    $result = query("SELECT * FROM $table WHERE end_date IS NULL");
                    for($i = 0; $audience = $result->fetch_array(); $i++) {
                      $participation = ($audience['participation']?"전시해설":"전시관람");

                      if($audience['start_date'] == NULL) {
                        $tem = "green";
                      }
                      else {
                        $progress_date = (strtotime(date('Y-m-d H:i:s')) - strtotime($audience['start_date']));
                        if($progress_date/3600 >= 2) {
                          $tem = "blue";
                        }
                        else {
                          $tem = "white";
                        }
                      }
                  ?>
                  <tr name="table_tr" /*dbl*/onclick=<?php echo("table_click(".$audience['number'].");") ?>>
                    <td class=<?php echo $tem ?>><?php echo $i; ?></td>
                    <td class=<?php echo $tem ?>><?php echo $audience['number']; ?></td>
                    <td class=<?php echo $tem ?>><?php echo $audience['name']; ?></td>
                    <td class=<?php echo $tem ?>><?php echo $participation; ?></td>
                    <td class=<?php echo $tem ?>><?php echo $audience['phone']; ?></td>
                    <td class=<?php echo $tem ?>><?php echo gmdate('H:i:s', $progress_date); ?></td>
                    <td class=<?php echo $tem ?> onclick="event.cancelBubble=true;">
                      <button onclick = <?php echo($tem."_click(".$audience['number'].");") ?>>
                        <?php
                          switch($tem) {
                            case "green": echo "시작"; break;
                            case "white": echo "초기화"; break;
                            case "blue": echo "종료"; break;
                          }
                        ?>
                      </button>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </from>
            </div>
          </div>
          <script>
            setInterval(function() {$("#table-box").load(window.location + ' #table-box')}, 1000);
          </script>
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

