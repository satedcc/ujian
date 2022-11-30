<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Exam Result</a></li>
                <li class="breadcrumb-item active" aria-current="page">Exam Result Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Exam Result</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table stripe table-default">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Total Schedule</th>
                                    <th>Answered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($hasil as $h) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <a href="#modal2" class="text-dark btn-hasil" data-value="<?= $h->id_regis ?>" data-toggle="modal">
                                                <h6 class="m-0"><?= $h->nama_lengkap ?></h6>
                                                <small><?= $h->no_regist ?></small>
                                            </a>
                                        </td>
                                        <td><?= $h->email_peserta ?></td>
                                        <td><?= $h->total_jadwal ?></td>
                                        <td><?= $h->benar ?>/<?= $h->total_jawab ?></td>

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
<!-- <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel2">Detail Exam Partisipant</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="x"></i></span>
                </button>
            </div>
            <div class="modal-body" id="hasil">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-5" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->