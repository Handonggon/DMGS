<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "audience";
  $key = addslashes($_GET['skey']);
  $val = addslashes($_GET['sval']);
?>
<script>
  function search_click(mod, id) {
    switch(mod) {
      case "init" :   document.getElementById("select-search").value = "number";
                      document.getElementById("write-search").value = "";
                      break;
    }
      document.forms["searchForm"].action = window.location.href;
  }
  function tr_click(id) {
    window.open("popup.php?id=" + id, "tr_click_popup", "width=550,  height=650, scrollbars=no, location=no, toolbar=no, status=no");
  }
  function tr_btn_click(mod, id) {
    switch(mod) {
      case "blue" :  var url = "./db/start_date.php";
                     break;
      case "white" : var url = "./db/init_date.php";
                     break;
      case "red" :   var url ="./db/end_date.php";
                     break;
    }
    var frmPop = document.tableForm;
    window.open("","tr_btn_click_popup");
    document.getElementById("form-id").value = id;
    frmPop.action = url;
    frmPop.target = "tr_btn_click_popup"
    frmPop.submit();

    $("#table_div").load(window.location + ' #table_div');
    $("#information-box").load(window.location + ' #information-box');
  }
  setInterval(function(){$("#information-box").load(window.location + ' #information-box');}, 1000);
  setInterval(function(){$("#table_div").load(window.location + ' #table_div');}, 1000);
</script>
<html>
  <header>
    <iframe width=0 height=0 name="tr_btn_click_popup" style="display:none;"></iframe>
  </header>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">관람자 관리</h2>
            <ul class="left-menu">
              <li><a href="/audience/audience_view.php">일반관람자 관리</a></li>
              <li><a href="/audience/audience_commentary.php" class="on">해설관람자 관리</a></li>
              <li><a href="/audience/audience_manage.php">관람자 확인</a></li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
              <h3 class="tit">해설관람자 관리</h3>
              <div class="right">
                <ul class="location">
                  <li class="home"><span>home</span></li>
                  <li>관람자 관리</li>
                  <li class="now">해설관람자 관리</li>
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
		  <button type="submit" class="btn-search" onclick='search_click("search")'>검색</button>
                  <button type="submit" class="btn-init" onclick='search_click("init")'>초기화</button>
                </form>
              </div>
              <div class="information-box" id="information-box">
                <?php
                  $sql1 = mysqli_num_rows(query("SELECT * FROM $table WHERE end_date IS NULL AND participation = 1;"));
                  $sql2 = mysqli_num_rows(query("SELECT * FROM $table WHERE start_date IS NULL AND participation = 1;"));
                ?>
                <h3>관람자 현황 <신청자 : <?php echo($sql2) ?>, 관람자 : <?php echo($sql1-$sql2) ?>></h3>
              </div>
              <div class="table-list">
                <form name="tableForm" method="post"  enctype="multipart/form-data">
                  <input type="hidden" name="form-id" id="form-id">
                  <table summary="관람자 정보 목록" id="table_div">
                    <colgroup>
                      <col width="14%" />
                      <col width="18%" />
                      <col width="18%" />
                      <col width="18%" />
                      <col width="18%" />
                      <col width="14%" />
                    </colgroup>
  	            <thead>
                      <tr>
                        <th>No.</th>
                        <th>군번</th>
                        <th>이름</th>
                        <th>휴대폰</th>
                        <th>진행시간</th>
                        <th>비고</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if($val != "") {
                          if($key == "number") {
                            $result = query("SELECT * FROM $table WHERE end_date IS NULL AND participation = 1 AND number LIKE '%$val%' ORDER BY start_date");
                          }
                          else if($key == "name") {
                            $result = query("SELECT * FROM $table WHERE end_date IS NULL AND participation = 1 AND name LIKE '%$val%' ORDER BY start_date");
                          }
                        }
                        else {
                          $result = query("SELECT * FROM $table WHERE end_date IS NULL AND participation = 1 ORDER BY start_date");
                        }
                        for($i = 1; $audience = $result->fetch_array(); $i++) {
                          if($audience['start_date'] == NULL) {
                            $tem = "blue";
                          }
                          else {
                            $progress_date = (strtotime(date('Y-m-d H:i:s')) - strtotime($audience['start_date']));
                            if($progress_date/3600 >= ($audience['participation']?1:2)) {
                              $tem = "red";
                            }
                            else {
                              $tem = "white";
                            }
                          }
                      ?>
                      <tr name="table_tr" onclick='<?php echo("tr_click(".$audience['id'].");") ?>'>
                        <td class=<?php echo $tem ?>><?php echo $i; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $audience['number']; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $audience['name']; ?></td>
                        <td class=<?php echo $tem ?>><?php echo $audience['phone']; ?></td>
                        <td class=<?php echo $tem ?>><?php echo gmdate('H:i:s', $progress_date); ?></td>
                        <td class=<?php echo $tem ?> onclick="event.cancelBubble=true;">
                        <?php
                          switch($tem) {
                            case "blue": ?>
                                         <button type="submit" id="btn-blue" class="btn-blue" onclick='tr_btn_click("blue", <?php echo $audience['id']; ?>)'>시작</button>
                                         <?php break;
                            case "white": ?>
                                         <button type="submit" id="btn-white" class="btn-blue" onclick='tr_btn_click("white", <?php echo $audience['id']; ?>)'>초기화</button>
                                         <?php break;
                            case "red":  ?>
                                         <button type="submit" id="btn-red" class="btn-blue" onclick='tr_btn_click("red", <?php echo $audience['id']; ?>)'>종료</button>
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
