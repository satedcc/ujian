<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>dir/assets/img/favicon.png">
    <title>Exam Online - Management System</title>
    <link rel="stylesheet" href="<?= base_url() ?>dir/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>dir/assets/font/font.css">
    <link rel="stylesheet" href="<?= base_url() ?>dir/jquery-ui/jquery-ui.min.css">
    <script src="<?= base_url() ?>dir/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>dir/assets/js/sweetalert2.js"></script>
    <script src="<?= base_url() ?>dir/assets/js/html2canvas.min.js"></script>
    <script src="<?= base_url() ?>dir/lib/jqueryui/jquery-ui.min.js"></script>
    <link href="<?= base_url() ?>dir/style.css" rel="stylesheet">
</head>

<body>
    <div id="preloader"><span class="loader"></span></div>
    <div id="maincontainer">

        <div id="topsection">
            <div class="innertube">
                <div class="logo">
                    <img src="<?= base_url() ?>dir/assets/img/logo.png" width="65"></a>
                </div>
                <div class="text">
                    <h1>Exam Online Pratest </h1>
                    <span>Asuransi Astra - Asuransi Umum Terbaik</span>
                </div>
            </div>
            <i class="far fa-bars"></i>
            <div>
                <div id="status">Connection: Online</div>
            </div>
        </div>
        <div class="cssmenu">
            <div class="logos">
                <img src="<?= base_url() ?>dir/assets/img/logo.png" alt="">
            </div>
            <ul>
                <li class="has-sub"><a href="<?= base_url('dashboard/') ?>">Dashboard</a></li>
                <li class="has-sub"><a href="<?= base_url('soal/') ?>">Exam</a></li>
                <li class="has-sub"><a href="<?= base_url('logout/') ?>">Logout</a></li>
            </ul>
            <ul class="sosmed-menu">
                <li><a href=""><i class="fab fa-facebook"></i></a></li>
                <li><a href=""><i class="fab fa-instagram"></i></a></li>
                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                <li><a href=""><i class="fas fa-rss"></i></a></li>
                <li><a href=""><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>