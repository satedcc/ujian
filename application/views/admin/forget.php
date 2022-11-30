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

    <title>Forget - Exam Management System</title>

    <!-- vendor css -->
    <link href="<?= base_url() ?>dir/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>dir/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- template css -->
    <link rel="stylesheet" href="<?= base_url() ?>dir/assets/css/cassie.css">

</head>

<body>

    <div class="signin-panel">
        <svg-to-inline path="<?= base_url() ?>dir/assets/img/forget.svg" class-Name="svg-bg"></svg-to-inline>

        <div class="signin-sidebar">
            <div class="signin-sidebar-body">
                <a href="dashboard-one.html" class="sidebar-logo mg-b-40"><span>EXAM Online</span></a>
                <h4 class="signin-title">Forget Password</h4>
                <h5 class="signin-subtitle">Enter your registered email.</h5>
                <form action="<?= base_url('admin/forget/process') ?>" method="post">
                    <div class="signin-form">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email address" value="admin@gmail.com">
                        </div>

                        <div class="form-group d-flex mg-b-0">
                            <button class="btn btn-brand-01 btn-uppercase flex-fill">Send</button>
                        </div>
                    </div>
                </form>
                <p class="mg-t-auto mg-b-0 tx-sm tx-color-03">By signing in, you agree to our <a href="">Terms of Use</a> and <a href="">Privacy Policy</a></p>
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