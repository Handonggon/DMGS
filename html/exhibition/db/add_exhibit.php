<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibit";
  $number = addslashes($_POST['form-number']);
  $name = addslashes($_POST['form-name']);
  $MAC = addslashes($_POST['form-MAC']);
  $space = addslashes($_POST['form-space']);
  $img = html_entity_decode(htmlentities($_FILES['form-img']['name'], ENT_QUOTES, 'UTF-8'));
  echo $id, $number, $name, $MAC, $space, $img;
  //print_r($_FILES);

  if(isset($_FILES['form-img']) && !$_FILES['form-img']['error']) {
    //허용할 이미지 종류를 배열로 저장
    $imageKind = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');
    //imageKind 배열내에 $_FILES['upload']['type']에 해당되는 타입(문자열) 있는지 체크
    if(in_array(strtolower($_FILES['form-img']['type']), $imageKind)) {
      if(move_uploaded_file($_FILES['form-img']['tmp_name'], "../uploads/".$img)) {
        $result = query("INSERT INTO $table(id, number, name, MAC, space, img) values(null, $number, '$name', '$MAC', $space, '$img');");
        if($result != 0) {
          echo "
            <script>
              opener.parent.parent.location.reload();
              window.close();
            </script>
          ";
        }
        else {
          echo "전시물 정보가 중복되었습니다.";
        }
      }
      else {
          echo "저장 실패";
      }
    }
    else {
      echo "이미지 타입 에러";
    }
  }
  else {
    echo "업로드 실패";
  }
?>
