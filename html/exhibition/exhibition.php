<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "exhibition";
?>
<!DOCTYPE html>
<html>
  <head>
    <script>
      function confirmSubmit(exhibitionNum, isOpen) {
        var sentence = "제" + exhibitionNum + "전시관";
        if(isOpen == 1) {
          sentence += "을 닫으시겠습니까?";
        }
        else {
          sentence += "을 여시겠습니까?";
        }
        var result = confirm(sentence);
        if(result) {
          document.getElementsByName('exhibition-num')[0].value = exhibitionNum;
          document.getElementsByName('exhibition-value')[0].value = isOpen;
          document.getElementById('exhibition').submit();
        }
        else {
          document.getElementsByName('exhibition_checkbox')[exhibitionNum - 1].value = isOpen;
          window.location.reload(true);
        }
      }
      function getid(form) {
        form.checkId.checked = ((form.loginId.value = getCookie("saveid")) != "");
        $(document.frmLogin.checkId).checkboxradio("refresh");
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
              <div class="bd-box" id="bd-box1">
                <h5 class="tit"><strong>제1전시관</strong></h5>
                <div class="exhibition-box">
                  <form name="exhibitionForm1" method="get">
                    <label for="checbox1">개설 여부 :</label>
                    <input type="checkbox" id="checbox1" name="isOpen">
                    <label for="checbox1"></label>
                    <input  type="text" id="input-qr1" name="location-in1" class="input-text" placeholder="" value="">
                    <button type="submit" id="btn-qr1" name="location-btn1" class="btn-blue">입력</button>
                  </form>
                </div>
                <div class="table-list">
                  <form name="tableForm1" method="get">
                    <table summary="제1전시관 테이블" id="table_div1">
                      <colgroup>
                        <col width="20%" />
                        <col width="60%" />
                        <col width="20%" />
                      </colgroup>
  	              <thead>
                          <th>NO.</th>
                          <th>Beacon RSSI</th>
                          <th>비고</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>2</td>
                          <td>
                            <button type="submit" id="btn-delete" name="name"  class="btn-blue" onclick=''>삭제</button>
                          <td>
                        </tr>
                        </tr>
                        <tr>
                          <td></td>
                          <td><input></input></td>
                          <td>
                            <button type="submit" id="btn-insert " name="name" class="btn-blue" onclick=''>추가</button>
                          <td>
                        </tr>
                      </thead>
                    </form>
                  </table>
                </div>
              </div>

              <div class="bd-box" id="bd-box2">
                <h5 class="tit"><strong>제2전시관</strong></h5>
                <div class="table-list">
                  <form name="tableForm2" method="get">
                    <table summary="제2전시관 테이블" id="table_div2">
                    </table>
                  </form>
                </div>
              </div>
              <div class="bd-box" id="bd-box3">
                <h5 class="tit"><strong>제3전시관</strong></h5>
                <div class="table-list">
                  <form name="tableForm1" method="get">
                    <table summary="제3전시관 테이블" id="table_div3">
                    </table>
                  </form>
                </div>
              </div>
              <div class="bd-box" id="bd-box4">
                <h5 class="tit"><strong>제4전시관</strong></h5>
                <div class="table-list">
                  <form name="tableForm4" method="get">
                    <table summary="제4전시관 테이블" id="table_div4">
                    </table>
                  </form>
                </div>
              </div>
              <div class="bd-box" id="bd-box5">
                <h5 class="tit"><strong>제5전시관</strong></h5>
                <div class="table-list">
                  <form name="tableForm5" method="get">
                    <table summary="제5전시관 테이블" id="table_div5">
                    </table>
                  </form>
                </div>
              </div>
              <div class="bd-box" id="bd-box6">
                <h5 class="tit"><strong>제6전시관</strong></h5>
                <div class="table-list">
                  <form name="tableForm6" method="get">
                    <table summary="제6전시관 테이블" id="table_div6">
                    </table>
                  </form>
                </div>
              </div>

      <form id="exhibition" action="/exhibition/db/update.php" method="post">
        <input type="hidden" name="exhibition-num">
        <?php
          $result = query("SELECT * FROM $table");
          while($exhibition = $result->fetch_array()) {
        ?>
          <div class="row">
            <input type="checkbox" name="exhibition_checkbox" onclick='confirmSubmit(<?php echo $exhibition['number'].", ".$exhibition['is_open'];?>)' <?php
              if($exhibition['is_open'] == 1){
                echo "checked";
              }
            ?>>
            <span class="ex_text"><?php echo "제", $exhibition['number'], "전시관";?></span>
          </div>
        <?php
          }
        ?>
        <input type="hidden" name="exhibition-value">
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
