<?php if ($this->session->userdata('level') != "superadmin") : ?>
    <?php redirect('admin/edit/' . $this->session->userdata('akun')); ?>
<?php endif ?>
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
    <a href="<?= base_url('admin/user/tambah') ?>" class="btn btn-primary btn-sm rounded-5"><i class="far fa-user-plus"></i> Add User</a>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
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
                        <table class="table stripe" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>last Login</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $u) {
                                    $status = ($u->status_user == "aktif") ? '<a href="' . base_url('admin/user/draf/' . $u->id_user) . '" class="badge badge-primary rounded-50 px-2">Publish</a>' : '<a href="' . base_url('admin/user/aktif/' . $u->id_user) . '" class="badge badge-warning rounded-50 px-2">Not Active</a>';
                                    echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $u->nama_lengkap . '</td>
                                            <td>' . $u->email . '</td>
                                            <td>' . $u->telp . '</td>
                                            <td>' . $u->level_user . '</td>
                                            <td>' . $status . '</td>
                                            <td>' . $u->last_login . '</td>
                                            <td>' . $u->created_date . '</td>
                                            <td>
                                                <a href="' . base_url('admin/user/edit/' . $u->id_user) . '" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="' . base_url('admin/user/delete/' . $u->id_user) . '" class="badge badge-danger rounded-5 confirmDelete">Del</a>
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
    </div>
</div>