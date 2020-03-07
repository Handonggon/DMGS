<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $id = addslashes($_GET['id']);
  $table = "exhibit";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/css/popup.css?var=2">
    <body onresize="parent.resizeTo(550,700)" onload="parent.resizeTo(550,700)">
    <script>
      function onlyNumber(event){
        event = event || window.event;
  	var keyID = (event.which) ? event.which : event.keyCode;
  	if ((keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ) return;
  	else return false;
      }
      function removeChar(event) {
  	event = event || window.event;
  	var keyID = (event.which) ? event.which : event.keyCode;
  	if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ) return;
  	else event.target.value = event.target.value.replace(/[^0-9]/g, "");
      }
      function setSubmitUrl(mode) {
        if(mode == "modify") {
          document.forms["exhibit_form"].action = "/exhibition/db/modify.php";
        }
        else if(mode == "delete") {
          if(confirm("삭제 하시겠습니까?")) {
            document.forms["exhibit_form"].action = "/exhibition/db/delete.php";
          }
        }
      }
    </script>
    <link rel="shortcut icon" href="/images/logo.png" />
    <title>전시물 정보</title>
  </head>

  <body>
      <?php
        $sql = query("SELECT * FROM $table WHERE id = '$id'");
        $exhibit = $sql->fetch_array();
      ?>
      <div class="popup-wrap">
        <div class="title-area">
          <h3 class="tit">전시물 정보</h3>
        </div>
        <div class="content">
          <form name="exhibit_form" method="post" enctype="multipart/form-data">
            <div class="input-table">
              <table>
                <cpation>전시관 번호, 전시물 이름, Beacon MAC, Beanaon과의 거리, 사진</cpation>
								<colgroup>
									<col style="width:110px;"/>
									<col style="width:340px;"/>
								</colgroup>
                <tbody>
                  <input type="hidden" name="form-id" value=<?php echo $exhibit['id'];?>>
                  <tr>
                    <th scope="row">전시관 번호</th>
                    <td>
                      <?php
                        for($i = 1; $i < 7; $i++) {
                      ?>
                          <input type="radio" name="form-number" id="form-number" value=<?php echo $i?>
                          <?php
                            if($exhibit['number'] == $i){
                              echo "checked";
                            }
                          ?>>
                          <label for="form-division"><?php echo $i?></label>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><label for="form-name">이름</label></th>
                    <td>
                      <input type="text" name="form-name" id="form-name" value=<?php echo $exhibit['name'];?> size="8" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><label for="form-MAC">MAC</label></th>
                    <td>
                      <input type="text" name="form-MAC" id="form-MAC" value=<?php echo $exhibit['MAC'];?> size="10">
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><label for="form-space">거리</label></th>
                    <td>
                      <input type="text" name="form-space" id="form-space" value=<?php echo $exhibit['space'];?> onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' style='ime-mode:disabled;'>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row"><label for="form-img">사진</label></th>
                    <td>
                      <input type="file" name="form-img" id="form-img"><br>
                      <?php echo $exhibit["img"]?>
                    </td>
                  </tr>

                </tbody>
              </table>
              <div class="btn-div">
                <button class="btn-blue w70px" type="submit" name="but_modify" onclick='setSubmitUrl("modify")'>수정</button>
                <button class="btn-white w70px" type="submit" name="but_delete" onclick='setSubmitUrl("delete")'>삭제</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </body>
</html>
