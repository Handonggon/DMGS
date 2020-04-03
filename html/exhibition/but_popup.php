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
    <link rel="stylesheet" href="/css/popup.css?var=1">
    <body onresize="parent.resizeTo(600,580)" onload="parent.resizeTo(600,580)">
    <script>
      function autoTab(tabno, invalue) {
        if(invalue.length == tabno.maxLength) {
          var nextin = tabno.tabIndex;
          if(nextin < document.forms[0].elements.length) {
	    document.forms[0].elements[nextin].focus();
          }
        }
      }
      function onlyNumber() {
        if(!(((event.keyCode > 47) && (event.keyCode < 58)) || ((event.keyCode > 64) && (event.keyCode < 91)))) {
          event.returnValue = false;
        }
      }
      function setSubmitUrl(mode) {
        if(mode == "add") {
          document.getElementById("form-MAC").value = document.getElementById("form-MAC1").value + ":" +
                                                      document.getElementById("form-MAC2").value + ":" +
                                                      document.getElementById("form-MAC3").value + ":" +
                                                      document.getElementById("form-MAC4").value + ":" +
                                                      document.getElementById("form-MAC5").value + ":" +
                                                      document.getElementById("form-MAC6").value;
          document.forms["exhibit_form"].action = "./db/add_exhibit.php";
        }
        else if(mode == "esc") {
          window.close();
        }
      }
      function isValidSubmit() {
        return (document.getElementById("form-name").value != "" &&
                  document.getElementById("form-MAC").value != "" &&
                  document.getElementById("form-space").value != "" &&
                  document.getElementById("form-img").value != "");
      }

      $(document).ready(function(){
        var fileTarget = $('.filebox .upload-hidden');
        fileTarget.on('change', function(){
          if(window.FileReader){
            // 파일명 추출
            var filename = $(this)[0].files[0].name;
          }
          else {
            // Old IE 파일명 추출
            var filename = $(this).val().split('/').pop().split('\\').pop();
          };
          $(this).siblings('.upload-name').val(filename);
        });
        //preview image
        var imgTarget = $('.preview-image .upload-hidden');
        imgTarget.on('change', function(){
          var parent = $(this).parent();
           parent.children('.upload-display').remove();
          if(window.FileReader){
            //image 파일만
            if (!$(this)[0].files[0].type.match(/image\//)) return;
            var reader = new FileReader();
            reader.onload = function(e){
              var src = e.target.result;
              parent.append('<div class="upload-display"><div class="upload-thumb-wrap"><img src="'+src+'" class="upload-thumb"></div></div>');
            }
            reader.readAsDataURL($(this)[0].files[0]);
          }
          else {
            $(this)[0].select();
            $(this)[0].blur();
            var imgSrc = document.selection.createRange().text;
            parent.append('<div class="upload-display"><div class="upload-thumb-wrap"><img class="upload-thumb"></div></div>');

            var img = $(this).siblings('.upload-display').find('img');
            img[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\""+imgSrc+"\")";
          }
        });
      });
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
        <form name="exhibit_form" method="post" enctype="multipart/form-data" onsubmit="return isValidSubmit()">
          <div class="input-table">
            <table>
              <cpation>전시관 번호, 전시물 이름, Beacon MAC, Beanaon과의 거리, 사진</cpation>
              <colgroup>
	        <col style="width:120px;"/>
	        <col style="width:390px;"/>
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
                    <input type="text" name="form-name" id="form-name" size="28">
                  </td>
                </tr>
                <tr>
                  <th scope="row"><label for="form-MAC">MAC</label></th>
                  <td><span style="font-weight:bold;">
                    <input type="hidden" name="form-MAC" id="form-MAC">
                    <input type="text" name="form-MAC1" id="form-MAC1" size="1" maxlength="2" onKeyPress="onlyNumber()" onKeyUp="autoTab(this, this.value)" tabindex="9"> :
                    <input type="text" name="form-MAC2" id="form-MAC2" size="1" maxlength="2" onKeyPress="onlyNumber()" onKeyUp="autoTab(this, this.value)" tabindex="10"> :
                    <input type="text" name="form-MAC3" id="form-MAC3" size="1" maxlength="2" onKeyPress="onlyNumber()" onKeyUp="autoTab(this, this.value)" tabindex="11"> :
                    <input type="text" name="form-MAC4" id="form-MAC4" size="1" maxlength="2" onKeyPress="onlyNumber()" onKeyUp="autoTab(this, this.value)" tabindex="12"> :
                    <input type="text" name="form-MAC5" id="form-MAC5" size="1" maxlength="2" onKeyPress="onlyNumber()" onKeyUp="autoTab(this, this.value)" tabindex="13"> :
                    <input type="text" name="form-MAC6" id="form-MAC6" size="1" maxlength="2" onKeyPress="onlyNumber()" onKeyUp="autoTab(this, this.value)" tabindex="14">
                  </span></td>
                </tr>
                <tr>
                  <th scope="row"><label for="form-img">사진</label></th>
                  <td>
                    <div class="filebox bs3-primary preview-image">
                      <input class="upload-name" disabled="disabled" style="width: 200px;">
                      <label for="form-img">업로드</label>
                      <input type="file" name="form-img" id="form-img" class="upload-hidden">
                    </div>
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
