<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - Exam Online Management</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		a {
			color: #3D56B2;
			text-decoration: none;
		}

		body {
			background: #f2f2f2;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Poppins', sans-serif;
			height: 100vh;
		}

		.form-login {
			position: relative;
			z-index: 9999;
			background: #FFF;
			padding: 30px;
			border-radius: 4px;
			width: 25%;
			box-shadow: 0 4px 30px rgba(0, 0, 0, 0.09);
			z-index: 999;
			transition: .5s;
		}

		.form-group {
			position: relative;
			margin-bottom: 10px;
		}

		.form-group input[type="text"],
		.form-group input[type="password"] {
			width: 100%;
			padding: 13px;
			box-sizing: border-box;
			border-radius: 3px;
			border: 1px solid #ccc;
			transition: .5s;
		}

		.form-group input[type="password"]:focus,
		.form-group input[type="text"]:focus {
			outline: none;
			border-color: #3D56B285;
			background-color: #fff;
			box-shadow: 0 0 0 4px #3D56B251;
		}

		.form-group label {
			color: #444;
			font-weight: 600;
			margin: 4px 0;
			display: block;
			font-size: 14px;
		}

		body::before {
			content: '';
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			width: 50%;
			height: 100%;
			background: #3D56B2;
		}

		body::after {
			content: '';
			position: absolute;
			left: -80px;
			top: -50px;
			width: 300px;
			height: 300px;
			border-radius: 50%;
			background: rgba(255, 255, 255, 0.09);
		}

		.form-login::after {
			content: '';
			position: fixed;
			right: -80px;
			bottom: -50px;
			width: 300px;
			height: 300px;
			border-radius: 50%;
			background: rgba(0, 0, 0, 0.05);
			z-index: -1;
		}

		h4 {
			margin-bottom: 10px;
			text-align: center;
		}

		button {
			background: #3D56B2;
			display: block;
			width: 100%;
			padding: 13px;
			border-radius: 3px;
			border: none;
			color: white;
			font-weight: 600;
			letter-spacing: 3px;
			transition: .5s;
		}

		button:hover {
			background: #032e1a;
		}

		button:active {
			background: #01120a;
			transform: translateY(3px);
		}

		.form-group>div {
			display: flex;
			align-items: center;
		}

		.form-group>div input {
			margin-right: 5px;
		}

		.align {
			display: flex;
			align-items: center;
			justify-content: space-between;
			font-size: 12px;
			margin: 20px 0;
		}

		.bg-fixed {
			position: fixed;
			left: 0;
			top: 0;
			right: 0;
			bottom: 0;
			width: 100%;
			background: rgba(0, 0, 0, 0.537);
			z-index: 9999;
			display: none;
		}

		.bg-fixed>span {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
		}

		.loader {
			width: 64px;
			height: 44px;
			position: relative;
			border: 5px solid #fff;
			border-radius: 8px;
		}

		.loader::before {
			content: '';
			position: absolute;
			border: 5px solid #fff;
			width: 32px;
			height: 28px;
			border-radius: 50% 50% 0 0;
			left: 50%;
			top: 0;
			transform: translate(-50%, -100%)
		}

		.loader::after {
			content: '';
			position: absolute;
			transform: translate(-50%, -50%);
			left: 50%;
			top: 50%;
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background-color: #fff;
			box-shadow: 16px 0 #fff, -16px 0 #fff;
			animation: flash 0.5s ease-out infinite alternate;
		}

		@keyframes flash {
			0% {
				background-color: rgba(255, 255, 255, 0.25);
				box-shadow: 16px 0 rgba(255, 255, 255, 0.25), -16px 0 rgba(255, 255, 255, 1);
			}

			50% {
				background-color: rgba(255, 255, 255, 1);
				box-shadow: 16px 0 rgba(255, 255, 255, 0.25), -16px 0 rgba(255, 255, 255, 0.25);
			}

			100% {
				background-color: rgba(255, 255, 255, 0.25);
				box-shadow: 16px 0 rgba(255, 255, 255, 1), -16px 0 rgba(255, 255, 255, 0.25);
			}
		}

		.alert {
			padding: 10px;
			border-radius: 2px;
			font-weight: 600;
			font-size: 14px;
			margin: 10px 0;
			width: 100%;
			box-sizing: border-box;
		}

		.alert-danger {
			background: #FF1E0021;
			border: 1px solid #FF1E00;
		}

		.alert-success {
			background: #3CCF4E21;
			border: 1px solid #3CCF4E;
		}

		@media screen and (max-width: 768px) {
			.form-login {
				width: 80%;
			}

			.form-login::after {
				right: -80px;
				bottom: -50px;
				width: 200px;
				height: 200px;
			}

			body::after {
				left: -80px;
				top: -50px;
				width: 150px;
				height: 150px;
			}
		}

		img {
			position: absolute;
			right: 20px;
			top: 20px;
			width: 80px;
		}

		button:disabled,
		button[disabled] {
			border: 1px solid #8D8DAA;
			background-color: #DFDFDE;
			color: #666666;
		}

		/* PASS */


		#progressBar {
			height: 5px;
			width: 100%;
			margin-top: 0.6em;
			border-radius: 1px;
		}

		#progress-bar {
			width: 0%;
			height: 100%;
			transition: width 500ms linear;
			border-radius: 50px;
		}

		.progress-bar-danger {
			background: #d00;
		}

		.progress-bar-warning {
			background: #f50;
		}

		.progress-bar-success {
			background: #080;
		}


		#pwd_strength_wrap {
			border: 1px solid #D5CEC8;
			display: none;
			float: left;
			padding: 10px;
			position: relative;
			width: 320px;
		}

		#pwd_strength_wrap:before,
		#pwd_strength_wrap:after {
			content: ' ';
			height: 0;
			position: absolute;
			width: 0;
			border: 10px solid transparent;
			/* arrow size */
		}

		#pwd_strength_wrap:before {
			border-bottom: 7px solid rgba(0, 0, 0, 0);
			border-right: 7px solid rgba(0, 0, 0, 0.1);
			border-top: 7px solid rgba(0, 0, 0, 0);
			content: "";
			display: inline-block;
			left: -18px;
			position: absolute;
			top: 10px;
		}

		#pwd_strength_wrap:after {
			border-bottom: 6px solid rgba(0, 0, 0, 0);
			border-right: 6px solid #fff;
			border-top: 6px solid rgba(0, 0, 0, 0);
			content: "";
			display: inline-block;
			left: -16px;
			position: absolute;
			top: 11px;
		}

		#pswd_info ul {
			list-style-type: none;
			margin: 5px 0 0;
			padding: 0;
		}

		#pswd_info ul li {
			background: url(icon_pwd_strength.png) no-repeat left 2px;
			padding: 0 0 0 20px;
		}

		#pswd_info ul li.valid {
			background-position: left -42px;
			color: green;
		}

		#passwordStrength {
			display: block;
			height: 5px;
			margin-bottom: 10px;
			transition: all 0.4s ease;
		}

		.strength0 {
			background: none;
			/* too short */
			width: 0px;
		}

		.strength1 {
			background: none repeat scroll 0 0 #FF4545;
			/* weak */
			width: 25px;
		}

		.strength2 {
			background: none repeat scroll 0 0 #FFC824;
			/* good */
			width: 75px;
		}

		.strength3 {
			background: none repeat scroll 0 0 #6699CC;
			/* strong */
			width: 100px;
		}

		.strength4 {
			background: none repeat scroll 0 0 #008000;
			/* best */
			width: 150px;
		}
	</style>

</head>

<body>
	<img src="<?= base_url() ?>dir/assets/img/logo.png" alt="">
	<div class="form-login">
		<h4>New Password</h4>
		<?= $this->session->flashdata('message'); ?>
		<form action="<?= base_url('forget/resetpassword') ?>" method="post">
			<div class="form-group">
				<label for="username">New Password</label>
				<input type="password" autofocus required autocomplete="off" name="password" id="password" placeholder="new password">
				<input type="text" name="otp" value="<?php if (isset($otp)) echo $otp ?>" hidden>
				<input type="text" name="email" value="<?php if (isset($email)) echo $email ?>" hidden>
			</div>
			<div class="form-group">
				<label for="username">Confirm New Password</label>
				<input type="password" required autocomplete="off" name="newpassword" id="confirm" placeholder="confirm password">
				<div class="message-confirm"></div>
				<div id="progressBar">
					<div id="progress-bar"></div>
				</div>
			</div>
			<button disabled>RESET NOW</button>
			<div style="text-align: center;font-size: 12px;margin-top: 15px;">
				Have account ?<a href="<?= base_url('/') ?>"> <strong>Register Now</strong></a>
			</div>
		</form>
	</div>
	<div class="bg-fixed"><span class="loader"></span></div>
	<script src="<?= base_url() ?>dir/lib/jquery/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("body").on("keyup", "#confirm", function(e) {
				var password = $("#password").val();
				if (password != $(this).val()) {
					$(".message-confirm").html(`<div class="alert alert-danger mt-2">Password is not same</div>`)
				} else {
					$(".message-confirm").html(`<div class="alert alert-success mt-2">the password is correct</div>`)
					$("button").prop("disabled", false)
				}
			});
			$("body").on("keyup", "#nik", function(e) {
				var nik = $(this).val();
				if (nik.length > 16) {
					$(this).val($(this).val().substr(0, 16));
				}

			});

		});
	</script>
	<script>
		jQuery.strength = function(element, password) {
			var desc = [{
				'width': '0px'
			}, {
				'width': '20%'
			}, {
				'width': '40%'
			}, {
				'width': '60%'
			}, {
				'width': '80%'
			}, {
				'width': '100%'
			}];
			var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];
			var score = 0;

			//Jika Password Lebih Dari 6 Karakter Tambah Skor
			if (password.length > 6) {
				score++;
			}

			//Jika Password Terdapat Huruf Kecil dan Besar Tambah Skor
			if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))) {
				score++;
			}


			//Jika Password Terdiri dari Angka
			if (password.match(/\d+/)) {
				score++;
			}

			//Jika Password Terdapat Simbol
			if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
				score++;
			}

			//Jika Password Lebih dari 10 Karakter  
			if (password.length > 10) {
				score++;
			}

			element.removeClass(descClass[score - 1]).addClass(descClass[score]).css(desc[score]);
		};

		jQuery(function() {
			jQuery("#password").keyup(function() {
				jQuery.strength(jQuery("#progress-bar"), jQuery(this).val());
			});
		});
	</script>
</body>

</html>