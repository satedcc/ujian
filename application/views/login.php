<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>dir/assets/img/favicon.png">
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
			padding: 15px;
			border-radius: 2px;
			font-weight: 600;
			font-size: 14px;
			margin: 10px 0;
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
	</style>

</head>

<body>
	<img src="<?= base_url() ?>dir/assets/img/logo.png" alt="">
	<div class="form-login">
		<h4>LOGIN FOR EXAM ONLINE</h4>
		<?= $this->session->flashdata('message'); ?>
		<form action="<?= base_url('auth') ?>" method="post">
			<div class="form-group">
				<label for="username">Email</label>
				<input type="text" autofocus required autocomplete="off" name="username" placeholder="username@gmail.com">
			</div>
			<div class="form-group">
				<label for="username">Password</label>
				<input type="password" required autocomplete="off" name="password" placeholder="password">
			</div>
			<div class="form-group align">
				<a href="<?= base_url('forget/') ?>"><strong>Forget password ?</strong></a>
			</div>
			<button>LOGIN NOW</button>
			<div style="text-align: center;font-size: 12px;margin-top: 15px;">
				Dont have account ?<a href="<?= base_url('register/') ?>"> <strong>Register Now</strong></a>
			</div>
		</form>
	</div>
	<div class="bg-fixed"><span class="loader"></span></div>
</body>

</html>