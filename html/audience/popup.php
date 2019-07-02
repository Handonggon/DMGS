<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $num = $_GET['number'];
  $table = "audience";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/css/audiencec.css" type="text/css">
    <script>
      var number = location.href.split('=')[1];
      //document.writeln(number);
      function onlyNumber(event){
  			event = event || window.event;
  			var keyID = (event.which) ? event.which : event.keyCode;
  			if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
  				return;
  			else
  				return false;
  		}
  		function removeChar(event) {
  			event = event || window.event;
  			var keyID = (event.which) ? event.which : event.keyCode;
  			if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
  				return;
  			else
  				event.target.value = event.target.value.replace(/[^0-9]/g, "");
  		}
      function setSubmitUrl(mode) {
        if(mode == "modify") {
          document.forms["audience_form"].action = "./modify.php";
        }
        else if(mode == "delete") {
          //alert("delete");
          document.forms["audience_form"].action = "./delete.php";
        }
        else if(mode == "cancel") {
          document.forms["audience_form"].action = "./cancel.php";
        }
      }
    </script>
    <title>관람자 정보</title>
  </head>

  <body>
    <?php
      #number = echo "<script>document.write(number);</script>";
      $sql = query("SELECT * FROM $table WHERE number = '$num'");
      $audience = $sql->fetch_array();
    ?>
    <h1>관람자 정보</h1>
    <form name="audience_form" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>관람자 정보</legend>
        <input type="hidden" name="form-id" value=<?php echo $audience['id'];?>>
        <div id="form-table">
          <div class="form-table" id="form-row1">
            <label for="form-num">군번</label>
            <input type="text" name="form-num" id="form-num" value=<?php echo $audience['number'];?> size="8" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>
            <label for="form-name">이름</label>
            <input type="text" name="form-name" id="form-name" value=<?php echo $audience['name'];?> size="10">
          </div>

          <div class="form-table" id="form-row2">
            <label for="form-phone">휴대폰</label>
            <input type="text" name="form-phone" id="form-phone" value=<?php echo $audience['phone'];?> onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>
          </div>

          <div class="form-table" id="form-row3">
            <label for="form-temper">부대명</label>
            <input type="text" name="form-temper" id="form-temper" value=<?php echo $audience['temper'];?>>
          </div>

          <div class="form-table" id="form-row4">
            <label for="row-title">행선지</label>
            <input type="text" name="form-destination" id="form-destination" value=<?php echo $audience['destination'];?>>
          </div>

          <div class="form-table" id="form-row5">
            <span class="row-title">참여구분</span>
            <input type="radio" name="form-participation" id="form-participation0" value="0"
            <?php
              if($audience['participation'] == 0){
                echo "checked";
              }
            ?>>
            <label for="form-participation0">전시관람</label>
            <input type="radio" name="form-participation" id="form-participation1" value="1"
            <?php
              if($audience['participation'] == 1){
                echo "checked";
              }
            ?>>
            <label for="form-participation1">전시해설</label>
          </div>

          <div class="form-table" id="form-row6">
            <span class="row-title">국군구분</span>
            <input type="radio" name="form-division" id="form-division0" value="0"
            <?php
              if($audience['division'] == 0){
                echo "checked";
              }
            ?>>
            <label for="form-division0">육군</label>
            <input type="radio" name="form-division" id="form-division1" value="1"
            <?php
              if($audience['division'] == 1){
                echo "checked";
              }
            ?>>
            <label for="form-division1">해군</label>
            <input type="radio" name="form-division" id="form-division2" value="2"
            <?php
              if($audience['division'] == 2){
                echo "checked";
              }
            ?>>
            <label for="form-division2">공군</label>
            <input type="radio" name="form-division" id="form-division3" value="3"
            <?php
              if($audience['division'] == 3){
                echo "checked";
              }
            ?>>
            <label for="form-division3">해병대</label>
          </div>
        </div>
      </fieldset>
      <div id="button">
        <button class="submit" type="submit" name="but_modify" onclick='setSubmitUrl("modify")'>수정</button>
        <button class="submit" type="submit" name="but_delete" onclick='setSubmitUrl("delete")'>삭제</button>
        <button class="submit" type="submit" name="but_cancel" onclick='setSubmitUrl("cancel")'>취소</button>
      </div>
    </form>
  </body>
</html>
