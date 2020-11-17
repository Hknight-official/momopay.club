<?php
include(__DIR__ ."/../api/config.php");

if($_POST["captcha"] != $_SESSION["captcha_code"]){
	exit('<script type="text/javascript">toastr.error("Xác nhận captcha không đúng !");</script>');
}

$username = $conn->real_escape_string(strip_tags(addslashes($_POST['username']))); 
$sdtnhan = $conn->real_escape_string(strip_tags(addslashes($_POST['sdtnhan']))); 
$name_nhan = $conn->real_escape_string(strip_tags(addslashes($_POST['name_nhan']))); 
$key_content = $conn->real_escape_string(strip_tags(addslashes($_POST['key_content']))); 
$content = $conn->real_escape_string(strip_tags(addslashes($_POST['content']))); 

$query = $conn->query("SELECT * FROM `trans_log` WHERE `username` = '{$username}' AND `sdtnhan` = '{$sdtnhan}' AND `status` = 1 AND `name_nhan` = '{$name_nhan}' AND `ghichu` = '{$key_content}' AND `trans_id` = '{$content}'");
if (!$query->num_rows > 0){
    exit('<script type="text/javascript">toastr.error("Bạn chưa thanh toán !");</script>');
}
$row = $query->fetch_assoc();
exit('<script type="text/javascript">swal("Thành Công", "Thanh Toán Thành Công '.number_format($row['amount']).'đ ", "success");</script>');