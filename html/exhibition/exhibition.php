<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "exhibition";
  $sql = query("SELECT * FROM $table");
  $isOpen = [];//["0","0","0","0","0","0","0"];
  $qr = [];//["","","","","","",""];
  while($exhibition = $sql->fetch_array()) {
    if($exhibition['division'] == 0) {
      $isOpen[$exhibition['number']] = $exhibition['value'];
    }
    else if($exhibition['division'] == 1) {
      $qr[$exhibition['number']] = $exhibition['value'];

    }
  }
?>
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
      var frmPop = document.inputForm;
      window.open("","openSubmit_popup");
      document.getElementById("number").value = exhibitionNum;
      document.getElementById("value").value = isOpen;
      frmPop.action = "./db/open.php";
      frmPop.target = "openSubmit_popup";
      frmPop.submit();
    }
    else {
      window.location.reload();
    }
  }

  function setSubmitUrl(mod, number) {
    var frmPop = document.inputForm;
    window.open("","setSubmitUrl_popup");
    frmPop.target = "setSubmitUrl_popup";
    if(mod == "enter") {
      document.getElementById("number").value = number;
      document.getElementById("value").value = $('#qrInput' + number).val();
      frmPop.action = "./db/update_qr.php";
      frmPop.submit();
    }
    else if(mod == "add") {
      window.open("but_popup.php?number=" + number, "but_click_popup", "width=600,  height=580, scrollbars=no, location=no, toolbar=no, status=no");
    }
    else if(mod == "modify") {
      window.open("tr_popup.php?id=" + number, "tr_click_popup", "width=600,  height=580, scrollbars=no, location=no, toolbar=no, status=no");
    }
    else if(mod == "delete") {
      var result = confirm("전시물을 삭제하시겠습니까?");
      if(result) {
        document.getElementById("number").value = number;
        frmPop.action = "./db/delete_exhibit.php";
        frmPop.submit();
      }
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
  function class_init(){
    $("#li1 a").attr('class', 'off');
    $("#li2 a").attr('class', 'off');
    $("#li3 a").attr('class', 'off');
    $("#li4 a").attr('class', 'off');
    $("#li5 a").attr('class', 'off');
    $("#li6 a").attr('class', 'off');
  }
</script>
<html>
  <header>
    <iframe width=0 height=0 name="openSubmit_popup" style="display:none;"></iframe>
    <iframe width=0 height=0 name="setSubmitUrl_popup" style="display:none;"></iframe>
  </header>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">일반관람 관리</h2>
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
                  <li class="now">일반관람 관리</li>
                  <li class="now">전시관 관리</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <form name="inputForm" method="post" enctype="multipart/form-data">
                <input id="number" name="number" class="hidden">
                <input id="value" name="value" class="hidden">

                <?php
                  for($i = 1; $i < 7; $i++) {
                ?>
                  <div class="bd-box" id=<?php echo "bd-box".$i; ?>>
                    <h5 class="tit"><strong>제<?php echo $i; ?>전시관</strong></h5>
                    <div class="exhibition-box">
                      개설 여부 :<input type="checkbox" id=<?php echo "checbox".$i; ?> <?php echo $isOpen[$i]?"checked":""; ?>>
                      <label for=<?php echo "checbox".$i; ?> onclick='openSubmit(<?php echo "$i, ".$isOpen[$i]; ?>)'></label><br><br>
                      QR 코드 :<input  type="text" class="input-text" id=<?php echo "qrInput".$i; ?> value=<?php echo $qr[$i];?>>
                      <button type="submit" class="btn-blue" onclick='setSubmitUrl("enter", <?php echo $i; ?>)'>변경</button>
                    </div>
                    <div class="table-list">
                      <table summary="제<?php echo $i; ?>전시관 테이블" id="table_div">
                        <colgroup>
                          <col width="20%" />
                          <col width="60%" />
                          <col width="20%" />
                        </colgroup>
                        <thead>
                          <tr>
                            <th>NO.</th>
                            <th>전시물 이름</th>
                            <th>비고</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = query("SELECT * FROM exhibit WHERE number = ".$i);
                            $mac = [];
                            $j = 0;
                            while($exhibit = $sql->fetch_array()) {
                              $j++;
                          ?>
                            <tr name="table_tr" onclick='<?php echo("setSubmitUrl(\"modify\", ".$exhibit['id'].")") ?>'>
                              <td><?php echo $j; ?></td>
                              <td><?php echo $exhibit['name'] ?></td>
                              <td onclick="event.cancelBubble=true;">
                                <button type="submit" class="btn-blue" onclick='setSubmitUrl("delete", <?php echo $exhibit['id']; ?>)'>삭제</button>
                              </td>
                            </tr>
                          <?php } ?>
                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                              <button type="submit" class="btn-blue" onclick='setSubmitUrl("add", <?php echo $i; ?>)'>추가</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php } ?>
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
