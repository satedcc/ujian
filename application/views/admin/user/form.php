<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Form</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">User Form</h4>
    </div>

</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?= $this->session->flashdata('message'); ?>
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/user/save/') ?>" method="post">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Full Name</label>
                            <div class="col-sm-10">
                                <?php if (isset($row)) : ?>
                                    <input type="text" required class="form-control" id="nama" name="nama" placeholder="full name" value="<?= $row->nama_lengkap ?>">
                                <?php else : ?>
                                    <input type="text" required class="form-control" id="nama" name="nama" placeholder="full name" value="<?= set_value('nama') ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Email</label>
                            <div class="col-sm-10">
                                <?php if (isset($row)) : ?>
                                    <input type="email" required class="form-control" id="email" name="email" placeholder="email user" value="<?= $row->email ?>">
                                <?php else : ?>
                                    <input type="email" required class="form-control" id="email" name="email" placeholder="email user" value="<?= set_value('email') ?>">
                                <?php endif; ?>
                                <input type="text" id="id" name="id" value="<?php if (isset($row)) echo $row->id_user ?>" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Phone Number</label>
                            <div class="col-sm-10">
                                <?php if (isset($row)) : ?>
                                    <input type="number" required class="form-control" id="nomor" name="nomor" placeholder="phone number" value="<?= $row->telp ?>">
                                <?php else : ?>
                                    <input type="number" required class="form-control" id="nomor" name="nomor" placeholder="phone number" value="<?= set_value('nomor') ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-sm-2 col-form-label font-weight-bold">User Level</label>
                            <div class="col-sm-10">
                                <select name="level" id="level" class="form-control" required>
                                    <?php if (isset($row)) : ?>
                                        <?php if ($row->level_user == "superadmin") : ?>
                                            <option value="superadmin" selected>Admin</option>
                                            <option value="user">User</option>
                                        <?php else : ?>
                                            <option value="superadmin">Admin</option>
                                            <option value="user" selected>User</option>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="superadmin">Admin</option>
                                        <option value="user">User</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Password</label>
                            <div class="col-sm-10">
                                <?php if (isset($row)) : ?>
                                    <input type="password" required class="form-control" id="password" name="password" placeholder="password">
                                <?php else : ?>
                                    <input type="password" required class="form-control" id="password" name="password" placeholder="password" value="User@2022!!">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Confirm Password</label>
                            <div class="col-sm-10">
                                <?php if (isset($row)) : ?>
                                    <input type="password" required class="form-control" id="confirm" name="confirm" placeholder="confirm">
                                <?php else : ?>
                                    <input type="password" required class="form-control" id="confirm" name="confirm" placeholder="confirm" value="User@2022!!">
                                <?php endif; ?>
                                <div class="message-error"></div>
                                <div id="progressBar">
                                    <div id="progress-bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold"></label>
                            <div class="col-sm-10">
                                <a href="#modal2" class="btn btn-primary rounded-5" data-toggle="modal">Confirm</a>
                                <button type="button" onclick="history.back()" class="btn btn-dark rounded-5">Back</button>
                            </div>
                        </div>
                        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel2">Confrim</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i data-feather="x"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mg-b-0">Are sure to save data ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        <button class="btn btn-dark btn-sm">Ya, Save Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("body").on("keyup", "#confirm", function(e) {
            var password = $("#password").val();
            if (password != $(this).val()) {
                $(".message-error").html(`<div class="alert alert-danger mt-2">Password is not same</div>`)
            } else {
                $(".message-error").html(`<div class="alert alert-success mt-2">the password is correct</div>`)
            }
        });

    });
</script>