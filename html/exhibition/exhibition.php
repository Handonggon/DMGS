<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/head.php";
  $table = "exhibition";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>전시관 관리</title>
    <script type="text/javascript">
      function confirmSubmit(exhibitionNum) {
        var sentence = "제" + exhibitionNum + "전시관";
        var isOpen = document.getElementsByName('exhibition_checkbox')[exhibitionNum - 1].value;  //기존 값이 넘어옴
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
    </script>
  </head>
  <body>
    <div id="exhibition-div">
      <form id="exhibition" action="update.php" method="post">
        <input type="hidden" name="exhibition-num">
        <?php
          $result = query("SELECT * FROM $table");
          while($exhibition = $result->fetch_array()) {
        ?>
          <div class="row">
            <input type="checkbox" name="exhibition_checkbox" value=<?php echo $exhibition['is_open'];?>  onclick='confirmSubmit("<?php echo $exhibition['number'];?>")' <?php
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
  </body>
</html>
