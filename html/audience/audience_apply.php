<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
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
  window.onbeforeunload = function() {}  //새로고침 이벤트
  function blue_click(id) {
    alert(id);
  }
  function green_click(id) {
    alert(id);
  }
  function white_click(id) {
    alert(id);
  }
</script>
<!DOCTYPE html>
<html>
  <body>
    <nav>
      <h2 onclick = "location.href = 'audience_apply.php'">신청 관리</h2>
      <h2 onclick = "location.href = 'audience_manage.php'">관람 관리</h2>
    </nav>
    <section id>
     <h3 >신청 관리</h3>
     <div class="search-parent">
      <div id="search">
       <select class="search" id="search_select">
          <option value=<?php echo $_COOKIE["select"] ?> selected disabled hidden>
            <?php
              if($_COOKIE["select"] == "number") {
                $val1 = "군번";
              }
              else if($_COOKIE["select"] == "name") {
                $val1 = "이름";
              }
              echo $val1;
            ?>
          </option>
          <option value="number">군번</option>
          <option value="name">이름</option>
        </select>
        <input class="search" id="search_input" type="text" name="search" size="40" required="required" value=<?php echo $_COOKIE["value"] ?>>
        <button class="search" id="search_button" onclick="search_click();">검색</button>
        <button class="reset" id="reset_button" onclick="reset_click();">초기화</button>
       </div>
      </div>
      <div class="table-box-wrap">
	<div class="table-box">
          <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>군번</th>
                <th>이름</th>
                <th>참여구분</th>
                <th>휴대폰</th>
                <th>시작일시</th>
                <th>진행시간</th>
                <th>비고</th>
              </tr>
            </thead>
            <tbody>
              <?php
 	        $table = "audience";
                $select = $_COOKIE["select"];
                $value = $_COOKIE["value"];
                if($value != "") {
                  if($select == "number") {
                    $result = query("SELECT * FROM $table WHERE end_date IS NULL AND number LIKE '%$value%'");
                  }
                  else if($select == "name") {
                    $result = query("SELECT * FROM $table WHERE end_date IS NULL AND name LIKE '%$value%'");
                  }
                }
                else {
                  $result = query("SELECT * FROM $table WHERE end_date IS NULL");
  	        }
                $i = 0;
                while($audience = $result->fetch_array()) {
                  $i++;
                  if($audience['participation'] == 0) {
                    $participation = "전시관람";
                  }
                  else {
                    $participation = "전시해설";
                  }

                  if($audience['start_date'] == NULL) {
                    $tem = "green";
                    $start_date = "";
                    $progress_date="";
                  }
                  else {
                    $start_date = date("m.d/H:i", strtotime($audience['start_date']));
                    $progress_date = (strtotime(date('Y-m-d H:i:s')) - strtotime($audience['start_date']));
                    if($progress_date/3600 >= 2) {
                      $tem = "blue";
                    }
                    else {
                      $tem = "white";
                    }
                  }
              ?>
              <tr name = table_tr>
                <td class=<?php echo $tem ?>><?php echo $i ?></td>
                <td class=<?php echo $tem ?>><?php echo $audience['number']; ?></td>
                <td class=<?php echo $tem ?>><?php echo $audience['name']; ?></td>
                <td class=<?php echo $tem ?>><?php echo $participation; ?></td>
                <td class=<?php echo $tem ?>><?php echo $audience['phone']; ?></td>
                <td class=<?php echo $tem ?>><?php echo $start_date; ?></td>
                <td class=<?php echo $tem ?>><?php echo gmdate('H:i:s', $progress_date); ?></td>
		<td class=<?php echo $tem ?>>
                  <button onclick = <?php echo($tem."_click(".$audience['id'].");") ?>>
                    <?php
                      if($tem == "white") {
                        $val2 = "초기화";
                      }
                      else if($tem == "blue") {
                        $val2 = "종료";
                      }
                      else if($tem == "green") {
                        $val2 = "시작";
                      }
                      echo $val2;
                    ?>
                  </button>
                </td>
              </tr>
              <?php } ?>
	      <?php
                for(; $i<=10; $i++) {
              ?>
    	      <tr>
                <td class="white"> </td>
                <td class="white"> </td>
                <td class="white"> </td>
                <td class="white"> </td>
                <td class="white"> </td>
                <td class="white"> </td>
                <td class="white"> </td>
                <td class="white"> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <script>
        //setInterval('', 1000);
        $(document.getElementsByName("table_tr")).dblclick(function(){
          var str = ""
          var tdArr = new Array();
          var tr = $(this);
          var td = tr.children();
          var openWin =  window.open("popup.php?number=" + td.eq(1).text() , "name", "width=500, height=600, scrollbar=no");
        });
      </script>
    </section>
  </body>
</html>
