<!DOCTYPE html>
<?php
  date_default_timezone_set('Asia/Seoul');
  include $_SERVER['DOCUMENT_ROOT']."/css/dbconn.php";
?>
<html>
  <head>
    <title>국군 관람 안내 시스템</title>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="shortcut icon" href="/images/logo.png" />
    <link rel="stylesheet" href="/css/layout.css?var=5">
  </head>
  <body>
    <header id="header">
      <div class="top">
        <div class="inner-wrap">
          <div class="left">
            <h1 class="logo"><a href="/main.php" class="go-main">독립기념관</a></h1>
          </div>
          <div class="right">
          </div>
        </div>
      </div>
      <div class="bottom">
        <div class="inner-wrap">
          <nav id="gnb">
	    <ul>
	      <li><a href="/audience/audience_apply.php">관람 관리</a></li>
	      <li><a href="/exhibition/exhibition.php">전시관 관리</a></li>
	      <li><a href="/narrator/narrator.php">전시해설 관리</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
  </body>
</html>
