<?php
if (isset($reg->kodeTerbesar)) {
    $kode = $reg->kodeTerbesar;
} else {
    $kode = 0;
}
$urutan = (int) substr($kode, 5, 6);
$urutan++;
$huruf  = "EXAM";
$reg    = $huruf . sprintf("%06s", $urutan);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>dir/assets/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register - Exam Online Management</title>
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

        .form-group input[type="email"],
        .form-group input[type="number"],
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 13px;
            box-sizing: border-box;
            border-radius: 3px;
            border: 1px solid #ccc;
            transition: .5s;
        }

        .form-group input[type="email"]:focus,
        .form-group input[type="number"]:focus,
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
            background: #59CE8F21;
            border: 1px solid #59CE8F;
        }

        img {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 80px;
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
            right: 10px;
            top: 10px;
            width: 50px;
            z-index: 9999;
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
    <img src="http://localhost/exam/dir/assets/img/logo.png" alt="">
    <div class="form-login">
        <h4>REGIST YOUR ACCOUNT</h4>
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url('register/save/') ?>" method="post">
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="number" autofocus required min="16" minlength="16" autocomplete="off" name="nik" id="nik" placeholder="NIK" value="<?= set_value('nik') ?>">
            </div>
            <div class="form-group">
                <label for="nama">Full Name</label>
                <input type="text" required autocomplete="off" name="nama" placeholder="full name" required value="<?= set_value('nama') ?>">
                <input type="text" autocomplete="off" name="noregist" value="<?= $reg ?>" hidden>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" autocomplete="off" name="email" placeholder="email address" required value="<?= set_value('email') ?>">
            </div>
            <div class="form-group">
                <label for="telp">Phone Number</label>
                <input type="number" required autocomplete="off" name="nomor" placeholder="phone number" required value="<?= set_value('nomor') ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required autocomplete="off" name="password" id="password" placeholder="password" required>
            </div>
            <div class="form-group">
                <label for="confirm">Confirm Password</label>
                <input type="password" required autocomplete="off" name="confirm" id="confirm" placeholder="confirm your password" required>
                <div class="message-confirm"></div>
                <div id="progressBar">
                    <div id="progress-bar"></div>
                </div>
            </div>
            <!-- <div class="form-group align">
                <div><input type="checkbox" name="agree" required> I agree with the terms and conditions that apply</div>
            </div> -->
            <button disabled>REGISTER NOW</button>
            <div style="text-align: center;font-size: 12px;margin-top: 15px;">
                Already have Account? ?<a href="<?= base_url() ?>"> <strong>Login Now</strong></a>
            </div>
        </form>
    </div>
</body>
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

</html>