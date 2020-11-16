<?php
include(__DIR__ ."/../api/config.php");

if (!isset($_POST['username'])){
	exit('<script type="text/javascript">toastr.error("Vui Lòng Nhập Đầy Đủ Thông Tin !");</script>');
}

$content = md5(time() . rand(0, 999999));
$username = $conn->real_escape_string(strip_tags(addslashes($_POST['username']))); // string

        $url = file_get_contents("https://momopay.club/API/get_phone.php?apikey={$apikey}&type=momo&ghichu=".$content);
        $obj = json_decode($url, true);
        $obj['key_content'] = hash("sha256", $content);
        $conn->query("INSERT INTO `trans_log`(`username`, `amount`, `sdtnhan`, `sdtgui`, `name_nhan`, `status`, `trans_id`, `ghichu`)
         VALUES ('{$username}', 0, '{$obj['phone']}', NULL, '{$obj['name']}', 0, '{$obj['content']}', '{$content}')");
        exit(json_encode($obj)); 


?>
