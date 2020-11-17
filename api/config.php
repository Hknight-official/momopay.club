<?php
	session_start();
	$apikey = '1605414830cbf077d27c487b06d995b74c2a7c51'; //API key, lấy từ website thesieutoc.net thay vào trong cặp dấu ''
	// database Mysql config
	$local_db = "localhost:3306";
	$user_db = "root";
	$pass_db = "";
	$name_db = "momopay";
	$ck = 10;
	# đừng đụng vào 
  $conn = new mysqli($local_db, $user_db, $pass_db, $name_db);
  $conn->set_charset("utf8");
  $conn->query("DELETE FROM `trans_log` WHERE `status` = 0 AND (`date` + INTERVAL 20 MINUTE) < NOW();");
    
?>
