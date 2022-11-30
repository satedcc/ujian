<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard and Admin Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>dir/assets/img/favicon.png">

    <title>Login - Exam Management System Online</title>

    <!-- vendor css -->
    <link href="<?= base_url() ?>dir/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>dir/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- template css -->
    <link rel="stylesheet" href="<?= base_url() ?>dir/assets/css/cassie.css">

</head>

<body>

    <div class="signin-panel">
        <svg-to-inline path="<?= base_url() ?>dir/assets/img/login.svg" class-Name="svg-bg"></svg-to-inline>

        <div class="signin-sidebar">
            <div class="signin-sidebar-body">
                <a href="<?= base_url() ?>" class="sidebar-logo mg-b-40"><span>EXAM Online</span></a>
                <h4 class="signin-title">Welcome Back</h4>
                <h5 class="signin-subtitle">Please login first for update fitur.</h5>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="signin-form">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" autofocus name="username" class="form-control" placeholder="Enter your email address">
                        </div>

                        <div class="form-group">
                            <label class="d-flex justify-content-between">
                                <span>Password</span>
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password">
                        </div>

                        <div class="form-group d-flex mg-b-0">
                            <button class="btn btn-brand-01 btn-uppercase flex-fill">Sign In</button>
                        </div>

                        <div class="divider-text mg-y-30">Or</div>

                        <a href="https://wa.me/<?= phonize($user->telp, "idn") ?>" target="blank" class="btn btn-facebook btn-uppercase btn-block">PLEASE CONTACT YOUR ADMIN</a>
                    </div>
                </form>
            </div><!-- signin-sidebar-body -->
        </div><!-- signin-sidebar -->
    </div><!-- signin-panel -->

    <script src="<?= base_url() ?>dir/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>dir/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>dir/lib/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>dir/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script>
        $(function() {

            'use strict'

            feather.replace();

            new PerfectScrollbar('.signin-sidebar', {
                suppressScrollX: true
            });

        })
    </script>
    <script src="<?= base_url() ?>dir/assets/js/svg-inline.js"></script>
</body>

</html>