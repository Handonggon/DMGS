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
    <link rel="stylesheet" href="/css/layout.css?var=10">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
	      <li><a href="/audience/audience_apply.php">관람자 관리</a></li>
	      <li><a href="/exhibition/exhibition.php">전시관람 관리</a></li>
	      <li><a href="/narrator/narrator.php">전시해설 관리</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
  </body>
</html>
