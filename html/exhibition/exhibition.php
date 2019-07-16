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

    </script>
  </head>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">전시관람 관리</h2>
            <ul class="left-menu">
              <li><a href="/exhibition/exhibition.php" class="on">전시관 관리</a></li>
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
              <form id="exhibition" action="/exhibition/db/update.php" method="post">
                <input type="hidden" name="exhibition-num">
                <?php
                  $result = query("SELECT * FROM $table");
                  while($exhibition = $result->fetch_array()) {
                ?>
                  <div class="row">
                    <label for=<?php echo "check", $exhibition['number']?> class="checkbox-label">
                      <span id="exhibition_checkbox" class="ui-icon" onclick="confirmSubmit(<?php echo $exhibition['number']; ?>, <?php echo $exhibition['is_open'] ?>)"></span>
                      <?php echo "제", $exhibition['number'], "전시관";?>
                    </label>
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
