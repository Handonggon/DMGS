<?php
        date_default_timezone_set('Asia/Seoul');
//	echo "MySql 연결<br>";
	session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩
	$db = mysqli_connect("localhost", "root", "root", "DMGS");
/*	if($db) {
	    echo "connect : 성공<br>";
	}
	else{
    	    echo "disconnect : 실패<br>";
	}*/
	$db->set_charset("utf8");

	function query($sql)
	{
		global $db;
		return $db->query($sql);
	}
?>
