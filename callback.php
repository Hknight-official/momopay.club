<?php
include(__DIR__ ."/api/config.php");

$validate = ValidateCallback($_POST);
if($validate != false) { 
	$apikey = $validate['apikey']; 
	$magiaodich = $validate['magiaodich']; 
	$sdtnhan = $validate['sdtnhan']; 
	$sdtgui = $validate['sdtgui']; 
	$amount = $validate['sotien'];
	$noidung = $validate['noidung']; 
	$ghichu = $validate['ghichu']; 
	
	if($apikey == $apikey) {		
		$result = $conn->query("SELECT * FROM `trans_log` WHERE `status` = 0 AND `trans_id` = '{$ghichu}' AND `content` = '{$noidung}' AND`sdtnhan` = '{$sdtnhan}'");
	
		if ($result->num_rows > 0){
			$result = $result->fetch_array(MYSQLI_ASSOC);
			print_r($result);
			$conn->query("UPDATE trans_log SET `status` = 1, `amount` = {$amount}, `sdtgui` = '{$sdtgui}' WHERE id = {$result['id']}");
			
			#[!] Lưu log Nạp Thẻ 
			$file = "momo.log";
			$fh = fopen($file,'a') or die("cant open file");
			fwrite($fh,"Tai khoan: ".$result['username'].", data: ".json_encode($_POST));
			fwrite($fh,"\r\n");
			fclose($fh);
		}
	}
}

function ValidateCallback($out) { //Hàm kiểm tra callback từ sever
		if(isset(
			$out['apikey'],
			$out['magiaodich'],
			$out['sdtnhan'],
			$out['sdtgui'],
			$out['sotien'],
			$out['noidung'],
			$out['ghichu']
			)) {
			return $out; //xác thực thành công, return mảng dữ liệu từ sever trả về.
			
		} else {
			return false; //Xác thực callback thất bại.
		}
	}
