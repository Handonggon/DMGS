<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "survey";
  $result = query("SELECT * FROM $table");
  $survey = $result->fetch_array();
?>
<html>
  <head>
    <script>
      function openSurvey(id, isExist) {
        var sentence = "설문폼을 ";
        if(isExist == 1) {
          sentence += "닫으시겠습니까?";
        }
        else {
          sentence += "여시겠습니까?";
        }
        var result = confirm(sentence);
        if(result) {
          document.getElementById("hidden-id").value = id;
          document.getElementById("hidden-value").value = isExist;
          document.forms["surveyForm"].action = "./db/update_exist.php";
          document.forms["surveyForm"].submit();
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
              <form name="surveyForm" action="./db/update_url.php" method="post">
                <div class="survey-box" id="survey-box">
                  <input type="hidden" name="id" id="hidden-id" value=<?php echo $survey['id'];?>>
                  <input type="hidden" name="value" id="hidden-value">
                  설문폼 여부 :<input type="checkbox" id="survey-checkbox" <?php echo $survey['is_exist']?"checked":"unchecked"; ?>>
                  <label for="survey_checkbox" onclick='openSurvey(<?php echo $survey['id'];?>, <?php echo $survey['is_exist'];?>)'></label><br><br>
                  URL :<input  type="text" class="input-text" id="survey-text" name="survey_url" value=<?php echo $survey['url'];?>>
                  <button type="submit" class="btn-blue" id="survey-but">변경</button>
                  <script>
                    ischecked = $("#survey-checkbox").prop("checked");
                    if(ischecked == false) {
                      var url = document.getElementById("survey-text");
                      url.disabled = true;
                      url.value = '';
                      document.getElementById("survey-but").disabled = true;
                    }
                  </script>
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
