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
    <link rel="stylesheet" href="/css/layout.css?var=7">
    <link rel="stylesheet" href="/css/audiencec-popup.css">
    <script>
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
          document.forms["audience_form"].action = "/audience/db/modify.php";
        }
        else if(mode == "delete") {
          //alert("delete");
          if(confirm("삭제 하시겠습니까?")) {
            document.forms["audience_form"].action = "/audience/db/delete.php";
          }
        }
      }
    </script>
    <title>관람자 정보</title>
  </head>

  <body>
      <div class="popup-wrap">
        <div class="title-area">
          <h3 class="tit">관람자 정보</h3>
        </div>
        <div class="content">
          <?php
            $sql = query("SELECT * FROM $table WHERE number = '$num'");
            $audience = $sql->fetch_array();
          ?>
          <form name="audience_form" method="post" enctype="multipart/form-data">
            <div class="input-table">
              <table>
                <cpation>군번, 이름, 참여구분, 휴대폰, 부대명, 행선지, 국군구분</cpation>
								<colgroup>
									<col style="width:80px;"/>
									<col />
								</colgroup>
                <tbody>
                  <input type="hidden" name="form-id" value=<?php echo $audience['id'];?>>
                  <tr>
                    <th scope="row"><label for="form-num">군번</label></th>
                    <td>
                      <input type="text" name="form-num" id="form-num" value=<?php echo $audience['number'];?> size="8" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><label for="form-name">이름</label></th>
                    <td>
                      <input type="text" name="form-name" id="form-name" value=<?php echo $audience['name'];?> size="10">
                    </td>
                  </tr>

                  <tr>
                    <th scope="row">참여구분</th>
                    <td>
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
                    </td>
                  </tr>

                  <tr>
                    <th scope="row"><label for="form-phone">휴대폰</label></th>
                    <td>
                      <input type="text" name="form-phone" id="form-phone" value=<?php echo $audience['phone'];?> onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row"><label for="form-temper">부대명</label></th>
                    <td>
                      <input type="text" name="form-temper" id="form-temper" value=<?php echo $audience['temper'];?>>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row"><label for="row-title">행선지</label></th>
                    <td>
                      <input type="text" name="form-destination" id="form-destination" value=<?php echo $audience['destination'];?>>
                    </td>
                  </tr>

                  <tr>
                    <th scope="row">국군구분</th>
                    <td>
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
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="btn-group mt20">
                <button class="button w70px blue" type="submit" name="but_modify" onclick='setSubmitUrl("modify")'>수정</button>
                <button class="button w70px ml10" type="submit" name="but_delete" onclick='setSubmitUrl("delete")'>삭제</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </body>
</html>
