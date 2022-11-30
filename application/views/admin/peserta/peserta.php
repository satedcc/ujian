<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">Participant Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Participant Data</h4>
    </div>
    <div>
        <a href="<?= base_url('admin/peserta/tambah') ?>" class="btn btn-primary btn-sm rounded-5"><i class="fal fa-user-plus"></i> Add Participant</a>
        <a href="<?= base_url('admin/peserta/import') ?>" class="btn btn-success btn-sm rounded-5"><i class="fal fa-upload"></i> Import</a>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <script>
                            Swal.fire(
                                'Error',
                                '<?= $this->session->flashdata('error') ?>',
                                'error'
                            )
                        </script>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('notif')) : ?>
                        <script>
                            Swal.fire(
                                'Success',
                                '<?= $this->session->flashdata('notif') ?>',
                                'success'
                            )
                        </script>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/peserta/checkcustom/') ?>" method="post" id="form">
                        <div class="form-group row">
                            <div class="col-2">
                                <select name="action" id="action" class="form-control select2">
                                    <option value="0">Action</option>
                                    <option value="delete">Delete</option>
                                    <option value="aktif">Active</option>
                                    <option value="disabled">Not Active</option>
                                    <!-- <option value="available">Available</option> -->
                                    <!-- <option value="notavailable">Not Available</option> -->
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary rounded-5">Update</button>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table stripe table-peserta hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="cek_all" class="custom-control-input" id="cek_all">
                                                <label class="custom-control-label" for="cek_all"></label>
                                            </div>
                                        </th>
                                        <th>NO</th>
                                        <th>Regist</th>
                                        <th>Full Name</th>
                                        <th>Qualified</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <!-- <th>Avaliable</th> -->
                                        <th>Last Login</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($peserta as $p) :
                                        $status = ($p->status_peserta == "1") ? '<a href="' . base_url('admin/peserta/draf/' . $p->id_regis) . '" class="badge badge-primary rounded-50 px-2">Active</a>' : '<a href="' . base_url('admin/peserta/aktif/' . $p->id_regis) . '" class="badge badge-warning rounded-50 px-2">Non Active</a>';
                                        // $ava = ($p->avaliable == "Y") ? '<a href="' . base_url('admin/peserta/noavaliable/' . $p->id_regis) . '" class="text-success"><i data-feather="check-circle"></i></a>' : '<a href="' . base_url('admin/peserta/avaliable/' . $p->id_regis) . '" class="text-danger"><i data-feather="x-circle"></i></a>';
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="text" name="status[]" class="status" hidden>
                                                    <input type="checkbox" name="cek_user[]" class="custom-control-input" id="customCheck-<?= $p->id_regis ?>" value="<?= $p->id_regis ?>">
                                                    <label class="custom-control-label" for="customCheck-<?= $p->id_regis ?>"></label>
                                                </div>
                                            </td>
                                            <td><?= $no++ ?></td>
                                            <td><a href="<?= base_url('admin/peserta/history/' . $p->id_regis) ?>" target="blank"><?= $p->no_regist ?></a></td>
                                            <td><a href="<?= base_url('admin/peserta/detail/' . $p->id_regis) ?>"><?= $p->nama_lengkap ?></a></td>
                                            <td><?= $p->nama_qualified ?></td>
                                            <td><?= $p->jk ?></td>
                                            <td><?= $p->email_peserta ?></td>
                                            <td><?= $p->nomor_peserta ?></td>
                                            <td><?= $status ?></td>
                                            <!-- <td class="text-center"><?= $ava ?></td> -->
                                            <td><?= $p->last_login ?></td>
                                            <td><?= $p->created_date ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/peserta/edit/' . $p->id_regis) ?>" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="<?= base_url('admin/peserta/delete/' . $p->id_regis) ?>" class="badge badge-danger rounded-5 confirmDelete">Del</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('.table-peserta').DataTable({
            "pageLength": 25,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [-1, 0]
                },
                {
                    "searchable": false,
                    "targets": [-1, 0]
                }
            ]
        });


        $('body').on('submit', '#form', function(e) {
            e.preventDefault();
            var data = table.$('input').serialize();
            $.ajax({
                method: 'POST',
                url: '<?= base_url('admin/peserta/checkcustom/') ?>',
                data: data,
                success: function(data) {
                    window.location = "<?= base_url('admin/peserta/') ?>";
                }
            });
        });
        $('body').on('click', '#cek_all', function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
        $("select#action").change(function() {
            var aksi = $(this).children("option:selected").val();
            $(".status").val(aksi)
        });
    });
</script>