<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
?>
<!DOCTYPE html>
<html>
  <body>
    <nav>
      <h2>신청 관리</h2>
      <h2>관람 관리</h2>
    </nav>

    <section>
     <h3 >신청 관리</h3>
     <div class="search" id="search">
       <select class="search">
          <option value="title">군번</option>
          <option value="name">이름</option>
        </select>
        <input class="search" type="text" name="search" size="40" required="required"/>
        <button class="search">검색</button>
      </div>
      <div class="table-box-wrap">
	<div class="table-box">
          <table id="table1">
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
                $sql = query("SELECT * FROM audience WHERE end_date IS NULL");
                while($audience = $sql->fetch_array()) {
                  if($audience['participation'] == 0) {
                    $participation = "전시관람";
                  }
                  else {
                    $participation = "전시해설";
                  }

                  if($audience['start_date'] == NULL) {
                    $tem = "green";
                    $start_date = "";
                    $result="";
                  }
                  else {
                    $start_date = date("m-d/H:i", strtotime($audience['start_date']));
                    $result = (strtotime(date('Y-m-d H:i:s')) - strtotime($audience['start_date']));
                    if($result/3600 >= 2) {
                      $tem = "blue";
                    }
                    else {
                      $tem = "white";
                    }
                  }
              ?>
              <tr>
                <td class=<?php echo $tem ?>>1</td>
                <td class=<?php echo $tem ?>><?php echo $audience['number']; ?></td>
                <td class=<?php echo $tem ?>><?php echo $audience['name']; ?></td>
                <td class=<?php echo $tem ?>><?php echo $participation; ?></td>
                <td class=<?php echo $tem ?>><?php echo $audience['phone']; ?></td>
                <td class=<?php echo $tem ?>><?php echo $start_date; ?></td>
                <td class=<?php echo $tem ?>><?php echo gmdate('H:i:s', $result); ?></td>
                <td class=<?php echo $tem ?>><button>시작</button></td>
              </tr>
              <?php } ?>
	      <?php
                for($i=0; $i<=10; $i++) {
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
        $('#table1 tr').dblclick(function(){
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
