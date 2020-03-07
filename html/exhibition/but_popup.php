<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $number = addslashes($_GET['number']);
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
      function setSubmitUrl(mode) {
        if(mode == "add") {
          document.forms["exhibit_form"].action = "./db/add_exhibit.php";
        }
        else if(mode == "esc") {
          window.close();
        }
      }
    </script>
    <link rel="shortcut icon" href="/images/logo.png" />
    <title>전시물 정보</title>
  </head>

  <body>
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
                <tr>
                  <th scope="row">전시관 번호</th>
                  <td>
                  <?php
                    for($i = 1; $i < 7; $i++) {
                  ?>
                      <input type="radio" name="form-number" id="form-number" value=<?php echo $i?>
                        <?php
                          if($number == $i){
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
                    <input type="text" name="form-name" id="form-name" size="20">
                  </td>
                </tr>
                <tr>
                  <th scope="row"><label for="form-MAC">MAC</label></th>
                  <td>
                    <input type="text" name="form-MAC" id="form-MAC" size="20">
                  </td>
                </tr>
                <tr>
                  <th scope="row"><label for="form-space">거리</label></th>
                  <td>
                    <input type="text" name="form-space" id="form-space" size="5"> M
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
              <button class="btn-blue w70px" type="submit" name="but_add" onclick='setSubmitUrl("add")'>저장</button>
              <button class="btn-white w70px" type="submit" name="but_esc" onclick='setSubmitUrl("esc")'>닫기</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
