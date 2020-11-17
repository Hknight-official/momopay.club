<?php 
	include("./api/config.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Nạp thẻ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" href="https://cdn.rawgit.com/daneden/animate.css/v3.1.0/animate.min.css">
	<script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" />
	<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>

<body>
	<script type="text/javascript">
		new WOW().init();
	</script>
	<div class="container">
		<a href="https://momopay.club" target="_blank"><img src="https://chandat.net/testx/wp-content/uploads/2018/09/Vi-MoMo-new.jpg" width="10%" align="center" alt="" /></a>
		<span class="badge badge-danger" style="margin-left:3%;">API MOMOPAY</span>
		<div id="status"></div>
		<div class="row" style="margin-top: 30px;">
			<div class="col-md-5">
				<form method="POST" action="#" id="myform">
					<table class="table table-condensed table-bordered">
						<tbody>
							<tr bgcolor="a50064">
								<td colspan="2" align="center">
									<h3 style="color:white;">« Thanh Toán Momo »</h3>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<center>
										<p>»» Yêu cầu chuyển tiền có thời hạn là <span style="color:red;">20p</span> , số tiền bạn chuyển vào sẽ được cộng vào tài khoản với ck <b><?=$ck?>%</b> </br>
										»» Sau khi thực hiện xong thao tác chuyển tiền, vui lòng bấm nút <span style="color:red;">Hoàn Thành</span> Bên dưới!</p>
									</center>
								</td>
							</tr>
							<tr class="form_momo">
								<td colspan="2">
									<center>
										<b>Dùng Momo Quét Mã QR Bên Dưới: </br>(Đừng quên nhập lời nhắn và điền số tiền chuyển)</b>
										<img id="qrcode" src="" width="60%" />
										<label><b style="color:#ff6600">Vui lòng ghi lời nhắn như bên dưới!</b></label>
										<input type="text" id="content" style="width:50%" value="" name="content" class="form-control" required readonly/>
										<input type="hidden" id="phone_nhan" value="" name="sdtnhan"  class="form-control" required readonly/>
										<input type="hidden" id="tk_nhan" value="" name="name_nhan" class="form-control" required readonly/>
										<input type="hidden" id="key_content" value="" name="key_content" class="form-control" required readonly/>
									</center>
								</td>
							</tr>
							<tr class="">
								<td><label>Username:</label></td>
								<td><input type="text" id="username" class="form-control" name="username" required /></td>
							</tr>
							<tr class="form_momo">
								<td><label>Captcha:</label></td>
								<td>
									<center>
										<p><b>Nhập những kí tự bạn thấy vào ô bên dưới !</b></p><img width="30%" id="captcha_code" src="/ajax/captcha_code.php" onclick="refreshCaptcha();" />
										<input type="text" style="width:30%" name="captcha" id="captcha" class="demoInputBox">
									</center>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"><button type="button" id="momo_button" class="btn btn-primary btn-block" name="submit">Tạo Yêu Cầu</button></td>
							</tr>
						</tbody>
					</table>
				</form>
				<script type="text/javascript">
				$('.form_momo').hide();
					var type_form = 0;
					$("#momo_button").click(function(e) {
						if (type_form == 0){
							$.ajax({
								url: "/ajax/create_form.php",
								type: 'post',
								dataType: 'json',
								data: $("#myform").serialize(),
								success: function(data) {
									$('#username').prop("readonly", true);
									$("#tk_nhan").val(data.name);
									$("#phone_nhan").val(data.phone);
									$("#content").val(data.content);
									$("#key_content").val(data.key_content);
									$('.form_momo').show();
									$("#momo_button").removeClass('btn-primary').addClass('btn-success');
									$("#momo_button").html("Hoàn Thành");
									let momo_trans_qr = "2|99|"+data.phone+"|"+data.name+"|momopay@club.com|0|0|10|20";
									$("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl="+momo_trans_qr);
									refreshCaptcha();
									$("#load_hs").load("/ajax/history.php");
									type_form = 1;
								}
							});
						} else {
							$("#status").html("<img src='/assets/load.gif' width='30%' />");
							$.ajax({
								url: "/ajax/done.php",
								type: 'post',
								data: $("#myform").serialize(),
								success: function(data) {
									$("#status").html(data);
									refreshCaptcha();
									$("#load_hs").load("/ajax/history.php");
                                                                        $('.form_momo').hide();
                                                                        type_form = 0;
                                                                        $("#myform")[0].reset();
									$("#momo_button").removeClass('btn-success').addClass('btn-primary');
									$("#momo_button").html("Tạo Yêu Cầu");
								}
							});
						}
					});


					function refreshCaptcha() {
						$("#captcha_code").attr('src', '/ajax/captcha_code.php');
					}
				</script>
			</div>
			<div class="col-md-7">
				<h4 class="text-center"> « Tiện Ích »</h4>
				<div class="panel-body">
					<marquee><p><span style="color: #ff6600;"><strong>Build Version 1.0 </strong> </span> </p> </marquee> 
					</div> <div id="accordion">
										<div class="card">
											<div class="card-header" id="headingOne">
												<h5 class="mb-0">
													<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
														Lịch Sử Nạp
													</button>
												</h5>
											</div>

											<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
												<div id="load_hs" class="card-body table-responsive">
													<center><img src='./assets/load.gif' width='50%' /></center>
												</div>
												<script>
													$("#load_hs").load("./ajax/history.php");
													setInterval(function() {
														$("#load_hs").load("./ajax/history.php");
													}, 10000);
												</script>
											</div>
										</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>
