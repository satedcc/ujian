<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Exam</a></li>
                <li class="breadcrumb-item active" aria-current="page">Exam Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Exam Data</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <?php if ($this->session->flashdata('notif')) : ?>
                        <script>
                            Swal.fire(
                                'Success',
                                '<?= $this->session->flashdata('notif') ?>',
                                'success'
                            )
                        </script>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table stripe hover" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Exam</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($ujian as $a) {
                                    echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td><a href="#modal2" class="view-question" data-toggle="modal" data-value="' . $a->id_ujian . '">' . $a->nama_ujian . '</a></td>
                                            <td>' . $a->total_soal . '</td>
                                            <td>' . $a->status_ujian . '</td>
                                            <td>
                                                <a href="' . base_url('admin/ujian/edit/' . $a->id_ujian) . '" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="' . base_url('admin/ujian/delete/' . $a->id_ujian) . '" class="badge badge-danger rounded-5 confirmDelete">Del</a>
                                                <a href="#modal2" class="badge badge-warning rounded-5 add-soal" data-value="' . $a->id_ujian . '" data-toggle="modal" data-placement="top" title="add questions to the exam type">Add Soal</a>
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-hover card-task-one">
                <div class="card-header py-2 bg-primary text-white">
                    Exam Form
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/ujian/save/') ?>" method="post">
                        <div class="form-group row mb-2">
                            <label for="kategori" class="col-sm-12 font-weight-bold">Exam Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="name exam type" value="<?php if (isset($row)) echo $row->nama_ujian ?>">
                                <input type="text" hidden id="id" name="id" value="<?php if (isset($row)) echo $row->id_ujian ?>">
                            </div>
                        </div>
                        <?php if ($this->session->userdata('level') == "superadmin") : ?>
                            <div class="form-group row mb-2">
                                <label for="kategori" class="col-sm-12 font-weight-bold">User</label>
                                <div class="col-12">
                                    <div class="select-user">
                                        <?php foreach ($user as $u) : ?>
                                            <?php
                                            if (isset($row)) {
                                                $patpel = $this->db->query("SELECT * FROM ex_patpel WHERE id_user='$u->id_user' AND id_ujian='$row->id_ujian'")->num_rows();
                                                if ($patpel > 0) {
                                                    echo '<div class="custom-control custom-checkbox">
                                                        <input type="checkbox" checked name="user_create[]" class="custom-control-input checkuser" id="customCheck-' . $u->id_user . '" value="' . $u->id_user . ',' . $row->id_ujian . '">
                                                        <label class="custom-control-label" for="customCheck-' . $u->id_user . '">' . $u->nama_lengkap . '</label>
                                                    </div>';
                                                } else {
                                                    echo '<div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="user_create[]" class="custom-control-input" id="customCheck-' . $u->id_user . '" value="' . $u->id_user . '">
                                                        <label class="custom-control-label" for="customCheck-' . $u->id_user . '">' . $u->nama_lengkap . '</label>
                                                    </div>';
                                                }
                                            } else {
                                                echo '<div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="user_create[]" class="custom-control-input" id="customCheck-' . $u->id_user . '" value="' . $u->id_user . '">
                                                <label class="custom-control-label" for="customCheck-' . $u->id_user . '">' . $u->nama_lengkap . '</label>
                                            </div>';
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="button" class="btn-tooltip" data-toggle="tooltip" data-placement="top" title="Please select the user who will set the exam category">
                                        <i class="far fa-info-circle"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group row mb-2">
                            <label for="status" class="col-sm-12 font-weight-bold">Exam Status</label>
                            <div class="col-12">
                                <select name="status" id="status" class="form-control select2">
                                    <?php if (isset($row)) : ?>
                                        <option <?php if ($row->status_ujian == 'Actived') echo 'selected'; ?> value="Actived">Active</option>
                                        <option <?php if ($row->status_ujian == 'disabled') echo 'selected'; ?> value="disabled">Disabled</option>
                                    <?php else : ?>
                                        <option value="Actived">Active</option>
                                        <option value="disabled">Disabled</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-12">
                                <button class="btn btn-sm btn-primary rounded-5">Save</button>
                                <button type="reset" class="btn btn-sm btn-dark rounded-5">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="<?= base_url('admin/ujian/soal') ?>" method="post" id="form">
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width:1500px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Question</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i data-feather="x"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="soal-ujian">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button class="btn btn-dark btn-sm" id="btn-submit">Save Now</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".checkuser").click(function(e) {
            var id = $(this).val();
            if ($(this).prop('checked')) {
                false
            } else {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('admin/ujian/deletepatpel/') ?>",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $(this).removeClass("checkuser")
                    }
                });
            }
        });
    });
</script>