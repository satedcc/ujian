<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function randomHex()
{
    $chars = 'ABCDEF0123456789';
    $color = '#';
    for ($i = 0; $i < 6; $i++) {
        $color .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $color;
}
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('../login');
    }
}
function is_logged_user()
{
    $ci = get_instance();
    if (!$ci->session->userdata('akun')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mohon untuk login terlebih dahulu</div>');
        redirect('../');
    }
}
function angka($length)
{
    $str        = "";
    $characters = '123456789';
    $max        = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}
function timesecond($waktu)
{
    $time = $waktu;
    $timeInSeconds = strtotime($time) - strtotime('TODAY');

    return $timeInSeconds;
}
function email($otp, $email, $nama)
{
    $ci = get_instance();
    $c = $ci->db->query("SELECT * FROM ex_setting WHERE id_setting='1'")->row();
    $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => $c->set_smtp_host,
        'smtp_user' => $c->set_smtp_username,  // Email gmail
        'smtp_pass'   => custom_decrypt($c->set_smtp_password),  // Password gmail
        'smtp_crypto' => 'ssl',
        'smtp_port'   => $c->set_smtp_port,
        'crlf'    => "\r\n",
        'newline' => "\r\n"
    ];

    // Load library email dan konfigurasinya
    $ci->load->library('email', $config);

    // Email dan nama pengirim
    $ci->email->from($c->webmail, 'Admin');

    // Email penerima
    $ci->email->to($email); // Ganti dengan email tujuan


    // Subject email
    $ci->email->subject('Registration successful');

    // Isi email
    $pesan = '
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email Template</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="https://www.asuransiastra.com/" title="logo" target="_blank">
                            <img width="60" src="https://ibfgi.com/wp-content/uploads/2017/12/LOGO-BARU-ASURANSI-ASTRA-300x210.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Your registration has been accepted</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Thank you ' . $nama . ' Registration has been received since you received this email. Please enter the OTP code to verify your email.
                                        </p>
                                        <h2>' . $otp . '</h2>
                                        <a href="https://www.asuransiastra.com/"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Back to home</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.asuransiastra.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
    $ci->email->message($pesan);

    // Tampilkan pesan sukses atau error
    if ($ci->email->send()) {
        echo 'Sukses! email berhasil dikirim.';
    } else {
        echo 'Error! email tidak dapat dikirim.';
    }
}

function email_forget($otp, $email, $nama)
{
    $ci = get_instance();
    $c = $ci->db->query("SELECT * FROM ex_setting WHERE id_setting='1'")->row();
    $config = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => $c->set_smtp_host,
        'smtp_user' => $c->set_smtp_username,  // Email gmail
        'smtp_pass'   => custom_decrypt($c->set_smtp_password),  // Password gmail
        'smtp_crypto' => 'ssl',
        'smtp_port'   => $c->set_smtp_port,
        'crlf'    => "\r\n",
        'newline' => "\r\n"
    ];

    // Load library email dan konfigurasinya
    $ci->load->library('email', $config);

    // Email dan nama pengirim
    $ci->email->from($c->webmail, 'Admin');

    // Email penerima
    $ci->email->to($email); // Ganti dengan email tujuan


    // Subject email
    $ci->email->subject('Forget Password');

    // Isi email
    $pesan = '
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Forget Password</title>
    <meta name="description" content="Forget Passwrod.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="https://www.asuransiastra.com/" title="logo" target="_blank">
                            <img width="60" src="https://ibfgi.com/wp-content/uploads/2017/12/LOGO-BARU-ASURANSI-ASTRA-300x210.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Forget your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Hi ' . $nama . ' Please enter the OTP code to verify your email.
                                        </p>
                                        <h2>' . $otp . '</h2>
                                        <a href="https://www.asuransiastra.com/"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Back to home</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.asuransiastra.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
    $ci->email->message($pesan);

    // Tampilkan pesan sukses atau error
    if ($ci->email->send()) {
        echo 'Sukses! email berhasil dikirim.';
    } else {
        echo 'Error! email tidak dapat dikirim.';
    }
}

function phonize($phoneNumber, $country)
{

    $countryCodes = array(
        'idn' => '+62',
    );

    return preg_replace(
        '/[^0-9+]/',
        '',
        preg_replace('/^0/', $countryCodes[$country], $phoneNumber)
    );
}

function strongPassword($password)
{
    // Validasi kekuatan password
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $status = "weak";
    } else {
        $status =  "strong";
    }

    return $status;
}
function email_log($email, $log, $status, $sending)
{
    $ci = get_instance();
    $now = date("Y-m-d H:i:s");
    $ci->db->query("INSERT INTO ex_log_email VALUES(NULL,'$email','$log','$status','$sending','$now')");
}

function custom_encript($simple_string)
{
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "satedcc";

    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt(
        $simple_string,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    return $encryption;
}
function custom_decrypt($encryption)
{
    $ciphering = "AES-128-CTR";
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
    $options = 0;
    // Store the decryption key
    $decryption_key = "satedcc";

    // Use openssl_decrypt() function to decrypt the data
    $decryption = openssl_decrypt(
        $encryption,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    return $decryption;
}


function email_test($otp, $email, $nama)
{

    $ci = get_instance();
    $c = $ci->db->query("SELECT * FROM ex_setting WHERE id_setting='1'")->row();
    // PHPMailer object
    $response = false;
    $mail = new PHPMailer();


    // SMTP configuration
    $mail->isSMTP();
    $mail->Host     = $c->set_smtp_host; //sesuaikan sesuai nama domain hosting/server yang digunakan
    $mail->SMTPAuth = true;
    $mail->Username = $c->set_smtp_username; // user email
    $mail->Password = custom_decrypt($c->set_smtp_password); // password email
    $mail->SMTPSecure = 'tls';
    $mail->Port     = 587;
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
    $mail->setFrom($c->webmail, 'Admin'); // user email
    $mail->addReplyTo($c->webmail, 'Admin'); //user email

    // Add a recipient
    $mail->addAddress($email); //email tujuan pengiriman email

    // Email subject
    $mail->Subject = 'Registration successful'; //subject email

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = '
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password Email Template</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="https://www.asuransiastra.com/" title="logo" target="_blank">
                            <img width="60" src="https://ibfgi.com/wp-content/uploads/2017/12/LOGO-BARU-ASURANSI-ASTRA-300x210.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Your registration has been accepted</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Thank you ' . $nama . ' Registration has been received since you received this email. Please enter the OTP code to verify your email.
                                        </p>
                                        <h2>' . $otp . '</h2>
                                        <a href="https://www.asuransiastra.com/"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Back to home</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.asuransiastra.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
    $mail->Body = $mailContent;

    // Send email
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

function email_cek($otp, $email, $nama)
{
    $ci = get_instance();
    $c = $ci->db->query("SELECT * FROM ex_setting WHERE id_setting='1'")->row();
    // PHPMailer object
    $response = false;
    $mail = new PHPMailer();


    // SMTP configuration
    $mail->isSMTP();
    $mail->Host     = $c->set_smtp_host; //sesuaikan sesuai nama domain hosting/server yang digunakan
    $mail->SMTPAuth = true;
    $mail->Username = $c->set_smtp_username; // user email
    $mail->Password = custom_decrypt($c->set_smtp_password); // password email
    $mail->SMTPSecure = 'tls';
    $mail->Port     = 587;
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
    $mail->setFrom($c->webmail, 'Admin'); // user email
    $mail->addReplyTo($c->webmail, 'Admin'); //user email

    // Add a recipient
    $mail->addAddress($email); //email tujuan pengiriman email

    // Email subject
    $mail->Subject = 'Forget Password'; //subject email

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = '
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Forget Password</title>
    <meta name="description" content="Forget Passwrod.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="https://www.asuransiastra.com/" title="logo" target="_blank">
                            <img width="60" src="https://ibfgi.com/wp-content/uploads/2017/12/LOGO-BARU-ASURANSI-ASTRA-300x210.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Kode OTP</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Hi ' . $nama . ' Please enter the OTP code to verify your email.
                                        </p>
                                        <h2>' . $otp . '</h2>
                                        <a href="http://klikngabar.com/"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Back to home</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>http://klikngabar.com/</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>';
    $mail->Body = $mailContent;

    // Send email
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
