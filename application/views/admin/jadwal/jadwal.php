<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Schedule Data</h4>
    </div>
    <a href="<?= base_url('admin/jadwal/tambah') ?>" class="btn btn-primary btn-sm rounded-5"><i class="far fa-layer-plus"></i> Add Schedule</a>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
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
                                    <th>Exam ID</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Participant</th>
                                    <th>Question Total (E/M/H)</th>
                                    <th>Point</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($jadwal as $j) {
                                    echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td><a href="#modal2" data-value="' . $j->id_jadwal . '" data-toggle="modal" class="all-partisipant">' . $j->kode_jadwal . '</a></td>
                                            <td><a href="' . base_url('admin/laporan/detail/' . $j->id_jadwal) . '">' . $j->nama_jadwal . '</a></td>
                                            <td>' . $j->mulai . ' - ' . $j->selesai . '</td>
                                            <td>' . $j->jumlah_peserta . '</td>
                                            <td>' . $j->soal_mudah . '/' . $j->soal_medium . '/' . $j->soal_susah . '</td>
                                            <td><h4 class="m-0">' . $j->nilai_benar . '/' . $j->nilai_salah . '</h4></td>
                                            <td>
                                                <a href="' . base_url('admin/jadwal/view/' . $j->id_jadwal) . '" class="badge badge-info rounded-5"><i class="far fa-eye"></i></a>
                                                <a href="' . base_url('admin/jadwal/edit/' . $j->id_jadwal) . '" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="' . base_url('admin/jadwal/delete/' . $j->id_jadwal) . '" class="badge badge-danger rounded-5 confirmDelete">Del</a>
                                                <a href="#modal2" data-toggle="modal" data-value="' . $j->id_jadwal . '" class="badge badge-warning rounded-5 add-partisipant"><i class="far fa-plus"></i> Participant</a>
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="alert alert-info">
                            <p class="m-0"><strong>Noted:</strong> </p>
                            <strong>E</strong>: Essay | <strong>M</strong>: Medium | <strong>H</strong>: Hard
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="<?= base_url('admin/jadwal/statuspartisipant') ?>" method="post" id="form">
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Participant</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i data-feather="x"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="viewall">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-5" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-sm rounded-5" id="btn-submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>