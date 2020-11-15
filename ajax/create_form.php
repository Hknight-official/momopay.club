<?php
session_start();
include(__DIR__ ."/../api/config.php");

if (!isset($_POST['username'])){
	exit('<script type="text/javascript">toastr.error("Vui Lòng Nhập Đầy Đủ Thông Tin !");</script>');
}

$content = md5(time() . rand(0, 999999));
$username = $conn->real_escape_string(strip_tags(addslashes($_POST['username']))); // string

        $url = file_get_contents("https://momopay.club/API/get_phone.php?apikey={$apikey}&type=momo&ghichu=".$username);
        exit($url); 


?>
