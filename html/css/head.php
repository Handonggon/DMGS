<?php date_default_timezone_set('Asia/Seoul'); ?>
<html>
  <head>
    <meta charset="UTF-8">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/css/button.css?var=4" type="text/css">
    <link rel="stylesheet" href="/css/table.css?var=4" type="text/css">
    <link rel="stylesheet" href="/css/search.css?var=3" type="text/css">
    <style type="text/css">
      body {
        margin: 0;
        padding: 0;
      }
      header1 {
        height: 7%;
        width: 100%;
	float: left;
      }
      header2 {
	background-color: #585858;
        height: 7%;
        width: 100%;
        border-top: #D8D8D8 solid 2px;
        border-bottom: #D8D8D8 solid 2px;
        float: left;
      }
      nav {
  	margin-left: 0%;
        border-left: #D8D8D8 solid 2px;
        border-right: #D8D8D8 solid 2px;
        border-bottom: #D8D8D8 solid 2px;
        width: 15.9%;
        height: 81%;
        float: left;
      }
      section {
        margin: 10px;
        width: 80%;
        height: 81%;
        float:left;
	<!-- overflow: auto; -->
      }
    </style>
  </head>

  <body>
    <header1 onclick = "location.href = '../title.php'">
      <h2> 국군 관람 안내 시스템 </h2>
    </header1>
    <header2>
      <div class="back" onclick = "location.href = '/audience/audience.php'">
        <div class="button_audience">관람자 관리</div>
      </div>
      <div class="back" onclick = "location.href = '../exhibition.php'">
        <div class="button_exhibition">전시관 관리</div>
      </div>
      <div class="back" onclick = "location.href = '../narrator.php'">
        <div class="button_narrator">전시해설 관리</div>
      </div>
    </header2>
  </body>
</html>
