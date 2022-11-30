<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Projects &amp; Web Services</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Welcome to Dashboard</h4>
    </div>
</div>
<div class="content-body">
    <div class="card card-hover card-task-one">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <h6 class="card-title">Total Participant</h6>
                    <div class="d-flex align-items-center justify-content-between mg-b-10">
                        <h1 class="card-value"><?= $row->total_regis ?> <span class="tx-color-03">Participant</span></h1>
                    </div>
                    <p class="card-desc">Total current participants</p>
                </div><!-- col -->
                <div class="col-sm-6 col-md-3 mg-t-20 mg-sm-t-0">
                    <h6 class="card-title">Total Question</h6>
                    <div class="d-flex align-items-center justify-content-between mg-b-10">
                        <h1 class="card-value"><?= $row->total_soal ?> <span class="tx-color-03">Question</span></h1>
                    </div>
                    <p class="card-desc">Total current questions.</p>
                </div><!-- col -->
                <div class="col-sm-6 col-md-3 mg-t-20 mg-md-t-0">
                    <h6 class="card-title">Total Schedule</h6>
                    <div class="d-flex align-items-center justify-content-between mg-b-10">
                        <h1 class="card-value"><?= $row->total_jadwal ?> <span class="tx-color-03">Schedule</span></h1>
                    </div>
                    <p class="card-desc">Total Current Schedule</p>
                </div><!-- col -->
                <div class="col-sm-6 col-md-3 mg-t-20 mg-md-t-0">
                    <h6 class="card-title">Total Exam</h6>
                    <div class="d-flex align-items-center justify-content-between mg-b-10">
                        <h1 class="card-value"><?= $row->total_ujian  ?> <span class="tx-color-03">Exam Type</span></h1>
                    </div>
                    <p class="card-desc">Total current exam type.</p>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- card-body -->
    </div><!-- card -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table stripe" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Regist</th>
                                    <th>Full Name</th>
                                    <th>Birth</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Avaliable</th>
                                    <th>last Login</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($peserta as $p) :
                                    $status = ($p->status_peserta == "1") ? '<a href="' . base_url('admin/peserta/draf/' . $p->id_regis) . '" class="badge badge-primary rounded-50 px-2">Active</a>' : '<a href="' . base_url('admin/peserta/aktif/' . $p->id_regis) . '" class="badge badge-warning rounded-50 px-2">Non Active</a>';
                                    $ava = ($p->avaliable == "Y") ? '<a href="' . base_url('admin/peserta/noavaliable/' . $p->id_regis) . '" class="text-success"><i data-feather="check-circle"></i></a>' : '<a href="' . base_url('admin/peserta/avaliable/' . $p->id_regis) . '" class="text-danger"><i data-feather="x-circle"></i></a>';
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><a href="<?= base_url('admin/peserta/history/' . $p->id_regis) ?>" target="blank"><?= $p->no_regist ?></a></td>
                                        <td><?= $p->nama_lengkap ?></td>
                                        <td><?= $p->tempat_lhr ?>, <?= $p->tgl_lahir ?></td>
                                        <td><?= $p->jk ?></td>
                                        <td><?= $p->email_peserta ?></td>
                                        <td><?= $p->nomor_peserta ?></td>
                                        <td><?= $status ?></td>
                                        <td class="text-center"><?= $ava ?></td>
                                        <td><?= $p->last_login ?></td>
                                        <td><?= $p->created_date ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/peserta/edit/' . $p->id_regis) ?>" class="badge badge-primary rounded-5">Edit</a>
                                            <a href="<?= base_url('admin/peserta/delete/' . $p->id_regis) ?>" class="badge badge-danger rounded-5">Del</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>