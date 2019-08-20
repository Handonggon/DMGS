<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "survey";
  $sql = query("SELECT * FROM $table");
  $servey = $sql->fetch_array()
?>
<html>
  <head>
    <script type="text/javascript">
      function openSubmit(id, isExist) {
        var sentence = "설문폼을 ";
        if(isExist == 1) {
          sentence += "을 닫으시겠습니까?";
        }
        else {
          sentence += "을 여시겠습니까?";
        }
        var result = confirm(sentence);
        if(result) {
          document.getElementById("hidden-id").value = id;
          document.getElementById("hidden-value").value = isExist;
          document.forms["serveyForm"].action = "./update_exist.php";
          document.forms["serveyForm"].submit();
        }
        else {
          window.location.reload(true);
        }
      }
    </script>
  </head>
  <body>
    <div id="container">
      <div class="inner-wrap">
        <div class="sub-contain">
          <div id="snb">
            <h2 class="tit">설문 관리</h2>
            <ul class="left-menu">
              <li><a href="/survey/survey.php" class="on">설문지 관리</a></li>
            </ul>
          </div>
          <div class="content-wrap" id="main-container">
            <div class="title-area">
              <h3 class="tit">설문지 관리</h3>
              <div class="right">
                <ul class="location">
                  <li class="home"><span>home</span></li>
                  <li>설문 관리</li>
                  <li class="now">설문지 관리</li>
                </ul>
              </div>
            </div>
            <div class="content">
              <form name="serveyForm" action="update_url.php" method="post">
                <div class="bd-box" id="bd-box">
                  <input type="hidden" name="id" id="hidden-id">
                  <input type="hidden" name="value" id="hidden-value">
                  설문폼 여부 :<input type="checkbox" id="servey_checkbox" value=<?php echo $servey['is_exist']?"checked":""; ?>>
                  <label for="servey_checkbox" onclick='openServey(<?php echo $servey['id'];?>, <?php echo $servey['is_exist'];?>)'></label><br><br>
                  URL :<input  type="text" class="input-text" id="servey_url" value=<?php echo $servey['url'];?>>
                  <button type="submit" class="btn-blue">변경</button>
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
