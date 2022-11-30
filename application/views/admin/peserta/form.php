<?php
$urutan = (int) substr($reg->kodeTerbesar, 5, 6);
$urutan++;
$huruf  = "EXAM";
$reg    = $huruf . sprintf("%06s", $urutan);
?>
<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">Participant Form</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Add Participant</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php if ($this->session->flashdata('notif')) : ?>
                <script>
                    Swal.fire(
                        'Error',
                        '<?= $this->session->flashdata('notif') ?>',
                        'error'
                    )
                </script>
            <?php endif; ?>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url('admin/peserta/save/') ?>" method="post" enctype="multipart/form-data">
                        <input type="text" hidden id="noregist" name="noregist" readonly value="<?= $reg ?>">
                        <input type="text" hidden id="id" name="id" value="<?php if (isset($row)) echo $row->id_regis ?>">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Qualified</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="qualified" name="qualified">
                                    <?php foreach ($qua as $q) : ?>
                                        <?php if (isset($row)) : ?>
                                            <?php if ($row->id_qua == $q->id_qua) : ?>
                                                <option selected value="<?= $q->id_qua ?>"><?= $q->nama_qualified ?></option>
                                            <?php else : ?>
                                                <option value="<?= $q->id_qua ?>"><?= $q->nama_qualified ?></option>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <option value="<?= $q->id_qua ?>"><?= $q->nama_qualified ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="nama" name="nama" placeholder="full name" value="<?php if (isset($row)) echo $row->nama_lengkap ?><?= set_value('nama') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">NIK</label>
                            <div class="col-sm-10">
                                <input type="number" required class="form-control" id="nik" name="nik" placeholder="nik" value="<?php if (isset($row)) echo $row->nik ?><?= set_value('nik') ?>">
                                <input type="text" name="validasi_nik" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Place</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="tempat" name="tempat" placeholder="place of birth" value="<?php if (isset($row)) echo $row->tempat_lhr ?><?= set_value('tempat') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Birth</label>
                            <div class="col-sm-10">
                                <input type="date" required class="form-control" id="tanggal" name="tanggal" placeholder="tanggal lahir" value="<?php if (isset($row)) echo $row->tgl_lahir ?><?= set_value('tanggal') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Email</label>
                            <div class="col-sm-10">
                                <input type="email" required class="form-control" id="email" name="email" placeholder="email address" value="<?php if (isset($row)) echo $row->email_peserta ?><?= set_value('email') ?>">
                                <input type="text" name="validasi_email" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="number" required class="form-control" id="nomor" name="nomor" placeholder="phone number ex 0811234500" value="<?php if (isset($row)) echo $row->nomor_peserta ?><?= set_value('nomor') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Gender</label>
                            <div class="col-sm-10">
                                <div class="d-flex">
                                    <div>
                                        <div class="custom-control custom-radio">
                                            <?php if (isset($row)) : ?>
                                                <input type="radio" <?php if ($row->jk == "L") echo "checked"; ?> required id="laki" name="jk" value="L" class="custom-control-input">
                                            <?php else : ?>
                                                <input type="radio" required id="laki" name="jk" value="L" class="custom-control-input">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="laki">Man</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <?php if (isset($row)) : ?>
                                                <input type="radio" <?php if ($row->jk == "P") echo "checked"; ?> required id="per" name="jk" value="P" class="custom-control-input">
                                            <?php else : ?>
                                                <input type="radio" required id="per" name="jk" value="P" class="custom-control-input">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="per">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Address</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="alamat" name="alamat" placeholder="address" value="<?php if (isset($row)) echo $row->alamat_peserta ?><?= set_value('alamat') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirm" name="confirm" placeholder="confirm password">
                                <div class="message-error"></div>
                                <div id="progressBar">
                                    <div id="progress-bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">File Photo</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <?php if (isset($row)) : ?>
                                    <img src="<?= base_url('profile') ?>/<?= $row->file_photo ?>" alt="" class="w-25 mt-3 rounded-10">
                                <?php endif; ?>
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
                                        <h6 class="modal-title" id="exampleModalLabel2">Confirm of Data</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i data-feather="x"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mg-b-0">Are sure to save this ?</p>
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
        $("body").on("keyup", "#nik", function(e) {
            $("input[name='validasi_nik']").val("Y")
        });
        $("body").on("keyup", "#email", function(e) {
            $("input[name='validasi_email']").val("Y")
        });

    });
</script>