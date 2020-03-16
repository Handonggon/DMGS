<?php
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
  $table = "exhibit";
  $id = addslashes($_POST['form-id']);
  $number = addslashes($_POST['form-number']);
  $name = addslashes($_POST['form-name']);
  $MAC = addslashes($_POST['form-MAC']);
  $space = addslashes($_POST['form-space']);
  $img_name = addslashes($_POST['form-img_name']);
  $img = html_entity_decode(htmlentities($_FILES['form-img']['name'], ENT_QUOTES, 'UTF-8'));
  //echo $id, $number, $name, $MAC, $space, $img_name;
  //print_r($_FILES);
  //허용할 이미지 종류 배열
  $imageKind = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');

  $sql = query("SELECT * FROM $table WHERE id = '$id';");
  $exhibit = $sql->fetch_array();
  if($exhibit['img'] != $img_name) {  //이미지명이 변경 했을 경우
    if(isset($_FILES['form-img']) && !$_FILES['form-img']['error']) {
      if(in_array(strtolower($_FILES['form-img']['type']), $imageKind)) {
        $result = query("UPDATE $table SET number=$number, name='$name', MAC='$MAC',space=$space, img='$img' WHERE id = '$id';");
        if($result != 0) {
          if(unlink("../uploads/".$exhibit['img'])) {
            if(move_uploaded_file($_FILES['form-img']['tmp_name'], "../uploads/".$img)) {
              echo "
                <script>
                  alert('수정되었습니다.');
                  opener.parent.parent.location.reload();
                  window.close();
                </script>
              ";
            }
            else {
              echo "사진 저장 에러";
            }
          }
          else {
            echo "원본이미지 삭제 에러";
          }
        }
        else {
          echo "DB 수정 에러";
        }
      }
      else {
        echo "이미지 타입 에러";
      }
    }
    else {
      echo "이미지 업로드 에러";
    }
  }
  else {
    $result = query("UPDATE $table SET number=$number, name='$name', MAC='$MAC', space=$space WHERE id = '$id';");
    if($result != 0) {
      if(isset($_FILES['form-img']) && !$_FILES['form-img']['error']) {
        if(in_array(strtolower($_FILES['form-img']['type']), $imageKind)) {
          unlink("../uploads/".$exhibit['img']);
          move_uploaded_file($_FILES['form-img']['tmp_name'], "../uploads/".$img);
        }
      }
      echo "
        <script>
          alert('수정되었습니다.');
          opener.parent.parent.location.reload();
          window.close();
        </script>
      ";
    }
    else {
      echo "DB 수정 실패";
    }
  }
?>
