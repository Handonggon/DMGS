<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "exhibition";
  $sql = query("SELECT * FROM $table");
  $isOpen = [];//["0","0","0","0","0","0","0"];
  $qr = [];//["","","","","","",""];
  $rssid = [array(), array(), array(), array(), array(), array(), array()];
  while($exhibition = $sql->fetch_array()) {
    if($exhibition['division'] == 0) {
      $isOpen[$exhibition['number']] = $exhibition['value'];
    }
    else if($exhibition['division'] == 1) {
      $qr[$exhibition['number']] = $exhibition['value'];

    }
    else if($exhibition['division'] == 2) {
      array_push($rssid[$exhibition['number']], array($exhibition['id'], $exhibition['value']));
    }
  }
?>
<html>
  <head>
    <script>
      function openSubmit(exhibitionNum, isOpen) {
        var sentence = "제" + exhibitionNum + "전시관";
        if(isOpen == 1) {
          sentence += "을 닫으시겠습니까?";
        }
        else {
          sentence += "을 여시겠습니까?";
        }
        var result = confirm(sentence);
        if(result) {
          document.getElementById("number").value = exhibitionNum;
          document.getElementById("value").value = isOpen;
          document.forms["inputForm"].action = "/exhibition/db/open.php";
          document.forms["inputForm"].submit();
        }
        else {
          window.location.reload(true);
        }
      }
      function setSubmitUrl(mode, number) {
        if(mode == "enter") {
          document.getElementById("number").value = number;
          document.getElementById("value").value = $('#qrInput' + number).val();
          document.forms["inputForm"].action = "/exhibition/db/qr_update.php";
        }
        else if(mode == "add") {
          document.getElementById("number").value = number;
          document.getElementById("value").value = $('#rssidInput' + number).val();
          document.forms["inputForm"].action = "/exhibition/db/rssid_add.php";
        }
        else if(mode == "delete") {
          document.getElementById("number").value = number;
          document.forms["inputForm"].action = "/exhibition/db/rssid_delete.php";
        }
      }
      $(document).ready(function(){
        var div1Y = $("#bd-box1").offset().top;
        var div2Y = $("#bd-box2").offset().top;
        var div3Y = $("#bd-box3").offset().top;
        var div4Y = $("#bd-box4").offset().top;
        var div5Y = $("#bd-box5").offset().top;
        var div6Y = $("#bd-box6").offset().top;
        $(document).scroll(function(){
          var scrollPosition = $(this).scrollTop() + window.innerHeight / 2;
            if(scrollPosition >= div6Y) {
             class_init();
             $("#li6 a").attr('class', 'on');
            }
            else if(scrollPosition >= div5Y) {
              class_init();
              $("#li5 a").attr('class', 'on');
            }
            else if(scrollPosition >= div4Y) {
              class_init();
              $("#li4 a").attr('class', 'on');
            }
            else if(scrollPosition >= div3Y) {
              class_init();
              $("#li3 a").attr('class', 'on');
            }
            else if(scrollPosition >= div2Y) {
              class_init();
              $("#li2 a").attr('class', 'on');
            }
            else if(scrollPosition >= div1Y) {
              class_init();
              $("#li1 a").attr('class', 'on');
            }
            else if(scrollPosition >= 0) {
              class_init();
            }
          });
        $("#li1").click(function(){
           $('html').animate({scrollTop : div1Y-window.innerHeight/2+100}, 400);
        });
        $("#li2").click(function(){
           $('html, body').animate({scrollTop : div2Y-window.innerHeight/2+100}, 400);
        });
        $("#li3").click(function(){
           $('html, body').animate({scrollTop : div3Y-window.innerHeight/2+100}, 400);
        });
        $("#li4").click(function(){
           $('html, body').animate({scrollTop : div4Y-window.innerHeight/2+100}, 400);
        });
        $("#li5").click(function(){
           $('html, body').animate({scrollTop : div5Y-window.innerHeight/2+100}, 400);
        });
        $("#li6").click(function(){
           $('html, body').animate({scrollTop : div6Y-window.innerHeight/2+100}, 400);
        });
      });
      function class_init() {
        $("#li1 a").attr('class', 'off');
        $("#li2 a").attr('class', 'off');
        $("#li3 a").attr('class', 'off');
        $("#li4 a").attr('class', 'off');
        $("#li5 a").attr('class', 'off');
        $("#li6 a").attr('class', 'off');
      }
    </script>
  </head>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">전시관람 관리</h2>
            <ul class="left-menu">
              <li><a href="/exhibition/exhibition.php" class="depth2 on">전시관 관리</a>
                <ul class="depth3">
                  <li id="li1"><a>제1전시관</a></li>
                  <li id="li2"><a>제2전시관</a></li>
                  <li id="li3"><a>제3전시관</a></li>
                  <li id="li4"><a>제4전시관</a></li>
                  <li id="li5"><a>제5전시관</a></li>
                  <li id="li6"><a>제6전시관</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
              <h3 class="tit">전시관 관리</h3>
              <div class="right">
                <ul class="location">
                  <li class="home"><span>home</span></li>
                  <li class="now">전시관람 관리</li>
                  <li class="now">전시관 관리</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <form name="inputForm" method="get">
                <input id="number" name="number" class="hidden">
                <input id="value" name="value" class="hidden">

                <div class="bd-box" id="bd-box1">
                  <h5 class="tit"><strong>제1전시관</strong></h5>
                  <div class="exhibition-box">
                    개설 여부 :<input type="checkbox" id="checbox1" <?php echo $isOpen[1]?"checked":""; ?>>
                    <label for="checbox1" onclick='openSubmit(1, <?php echo $isOpen[1];?>)'></label><br><br>
                    QR 코드 :<input  type="text" class="input-text" id="qrInput1" value=<?php echo $qr[1];?>>
                    <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", 1)'>변경</button>
                  </div>
                  <div class="table-list">
                    <table summary="제1전시관 테이블" id="table_div">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
  	              <thead>
                        <tr>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          for($i = 1; $row =  each($rssid[1]); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row[1][1] ?></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $row[1][0]; ?>)'>삭제</button>
                            </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><input id="rssidInput1"></input></td>
                          <td>
                            <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", 1)'>추가</button>
                          </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <div class="bd-box" id="bd-box2">
                  <h5 class="tit"><strong>제2전시관</strong></h5>
                  <div class="exhibition-box">
                    개설 여부 :<input type="checkbox" id="checbox2" <?php echo $isOpen[2]?"checked":""; ?>>
                    <label for="checbox2" onclick='openSubmit(2, <?php echo $isOpen[2];?>)'></label><br><br>
                    QR 코드 :<input  type="text" class="input-text" id="qrInput2" value=<?php echo $qr[2];?>>
                    <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", 2)'>변경</button>
                  </div>
                  <div class="table-list">
                    <table summary="제2전시관 테이블" id="table_div">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          for($i = 1; $row =  each($rssid[2]); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row[1][1] ?></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $row[1][0]; ?>)'>삭제</but$
                            </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><input id="rssidInput2"></input></td>
                          <td>
                            <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", 2)'>추가</button>
                          </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <div class="bd-box" id="bd-box3">
                  <h5 class="tit"><strong>제3전시관</strong></h5>
                  <div class="exhibition-box">
                    개설 여부 :<input type="checkbox" id="checbox3" <?php echo $isOpen[3]?"checked":""; ?>>
                    <label for="checbox3" onclick='openSubmit(3, <?php echo $isOpen[3];?>)'></label><br><br>
                    QR 코드 :<input  type="text" class="input-text" id="qrInput3" value=<?php echo $qr[3];?>>
                    <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", 3)'>변경</button>
                  </div>
                  <div class="table-list">
                    <table summary="제3전시관 테이블" id="table_div">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          for($i = 1; $row =  each($rssid[3]); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row[1][1] ?></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $row[1][0]; ?>)'>삭제</but$
                            </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><input id="rssidInput3"></input></td>
                          <td>
                            <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", 3)'>추가</button>
                          </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <div class="bd-box" id="bd-box4">
                  <h5 class="tit"><strong>제4전시관</strong></h5>
                  <div class="exhibition-box">
                    개설 여부 :<input type="checkbox" id="checbox4" <?php echo $isOpen[4]?"checked":""; ?>>
                    <label for="checbox4" onclick='openSubmit(4, <?php echo $isOpen[4];?>)'></label><br><br>
                    QR 코드 :<input  type="text" class="input-text" id="qrInput4" value=<?php echo $qr[4];?>>
                    <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", 4)'>변경</button>
                  </div>
                  <div class="table-list">
                    <table summary="제4전시관 테이블" id="table_div">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          for($i = 1; $row =  each($rssid[4]); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row[1][1] ?></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $row[1][0]; ?>)'>삭제</but$
                            </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><input id="rssidInput4"></input></td>
                          <td>
                            <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", 4)'>추가</button>
                          </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <div class="bd-box" id="bd-box5">
                  <h5 class="tit"><strong>제5전시관</strong></h5>
                  <div class="exhibition-box">
                    개설 여부 :<input type="checkbox" id="checbox5" <?php echo $isOpen[5]?"checked":""; ?>>
                    <label for="checbox5" onclick='openSubmit(5, <?php echo $isOpen[5];?>)'></label><br><br>
                    QR 코드 :<input  type="text" class="input-text" id="qrInput5" value=<?php echo $qr[5];?>>
                    <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", 5)'>변경</button>
                  </div>
                  <div class="table-list">
                    <table summary="제5전시관 테이블" id="table_div">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          for($i = 1; $row =  each($rssid[5]); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row[1][1] ?></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $row[1][0]; ?>)'>삭제</but$
                            </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><input id="rssidInput5"></input></td>
                          <td>
                            <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", 5)'>추가</button>
                          </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
                <div class="bd-box" id="bd-box6">
                  <h5 class="tit"><strong>제6전시관</strong></h5>
                  <div class="exhibition-box">
                    개설 여부 :<input type="checkbox" id="checbox6" <?php echo $isOpen[6]?"checked":""; ?>>
                    <label for="checbox6" onclick='openSubmit(6, <?php echo $isOpen[6];?>)'></label><br><br>
                    QR 코드 :<input  type="text" class="input-text" id="qrInput6" value=<?php echo $qr[6];?>>
                    <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", 6)'>변경</button>
                  </div>
                  <div class="table-list">
                    <table summary="제6전시관 테이블" id="table_div">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          for($i = 1; $row =  each($rssid[6]); $i++) {
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row[1][1] ?></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $row[1][0]; ?>)'>삭제</but$
                            </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <td></td>
                          <td><input id="rssidInput6"></input></td>
                          <td>
                            <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", 6)'>추가</button>
                          </td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </form>
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
