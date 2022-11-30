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
</div>
<div class="content-body">
    <div class="row row-sm mg-t-15 mg-sm-t-20">
        <div class="col-sm-12 col-xl-6 mx-auto">
            <div class="card card-hover card-profile-three">
                <div class="card-body">
                    <div class="avatar avatar-online avatar-xxl mg-b-20">
                        <?php
                        $path = base_url('profile/');
                        if (@getimagesize($path . $row->file_photo)) : ?>
                            <img src="<?= base_url() ?>profile/<?= $row->file_photo ?>" class="rounded-circle" alt="<?= $row->file_photo ?>">
                        <?php else : ?>
                            <img src="<?= base_url() ?>profile/user.png" class="rounded-circle" alt="user.png">
                        <?php endif; ?>
                    </div>
                    <h5 class="profile-name"><a href=""><?= $row->nama_lengkap ?></a></h5>
                    <p class="profile-position"><?= $row->no_regist ?></p>
                    <nav class="nav mg-b-15">
                        <a href="" class="badge badge-primary-light"><?= $row->nik ?></a>
                        <a href="" class="badge badge-success-light"><?= $row->nomor_peserta ?></a>
                        <a href="" class="badge badge-warning-light"><?= $row->email_peserta ?></a>
                        <a href="" class="badge badge-danger-light"><?= $row->tempat_lhr ?>, <?= $row->tgl_lahir ?></a>
                    </nav>
                    <p class="profile-bio"><?= $row->alamat_peserta ?></p>
                </div><!-- card-body -->
                <div class="card-footer row no-gutters">
                    <div class="col">
                        <div class="p-2">
                            <i class="far fa-lock"></i> Last Login: <?= $row->last_login ?>
                        </div>
                    </div>
                    <div class="col bd-l">
                        <div class="p-2">
                            <i class="far fa-lock"></i> Join Date: <?= $row->last_login ?>
                        </div>
                    </div>
                </div><!-- card-footer -->
            </div><!-- card -->
        </div><!-- col -->
        <div class="col-md-12 mt-3">
            <div class="card card-hover">
                <div class="card-body">
                    <h5 id="section1" class="tx-semibold">List Schedule</h5>
                    <p class="mg-b-25">List of schedules followed by satria adipradana.</p>
                    <div class="table-responsive mg-t-20">
                        <table class="table table-dark table-hover table-striped mg-b-0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Schedule</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Question</th>
                                    <th>True/False</th>
                                    <th>Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jadwal = $this->db->query("SELECT * FROM ex_detail_jadwal AS a LEFT JOIN ex_jadwal AS b ON a.id_jadwal=b.id_jadwal WHERE a.id_regis='$row->id_regis'")->result()
                                ?>
                                <?php $no = 1;
                                foreach ($jadwal as $a) :
                                    $nilai  = $this->db->query("SELECT 
                                                                COUNT(CASE WHEN a.jawaban = b.soal_jawaban THEN 1 END ) AS benar,
                                                                COUNT(CASE WHEN a.status_jawaban = 'true' THEN 1 END ) AS benar_essay,
                                                                COUNT(CASE WHEN a.status_jawaban = 'false' THEN 1 END ) AS salah_essay,
                                                                COUNT(*) as jml,
                                                                (COUNT(*) - COUNT(CASE WHEN a.jawaban = b.soal_jawaban THEN 1 END )) as salah
                                                                FROM ex_jawaban AS a LEFT JOIN ex_soal AS b ON b.id_soal = a.id_soal WHERE a.id_regis='$row->id_regis' AND a.id_jadwal='$a->id_jadwal'")->row();
                                    $benar = ($nilai->benar + $nilai->benar_essay) * $a->nilai_benar;
                                    $salah = ($nilai->jml - ($nilai->benar + $nilai->benar_essay)) * $a->nilai_salah;
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <p class="m-0"><?= $a->nama_jadwal ?></p>
                                            <small class="font-weight-bold"><?= $a->kode_jadwal ?></small>
                                        </td>
                                        <td><?= $a->mulai ?> - <?= $a->selesai ?></td>
                                        <td>
                                            <?php
                                            if ($nilai->jml > 0) {
                                                if ($benar - $salah > $a->score) {
                                                    echo '<span class="badge badge-success rounded-5">Successfully</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger rounded-5">Fail</span>';
                                                }
                                            } else {
                                                echo '<span class="badge badge-secondary rounded-5">Not Started</span>';
                                            }
                                            ?>

                                        </td>
                                        <td><?= $nilai->jml ?>/<?= ($a->soal_mudah + $a->soal_medium + $a->soal_susah) ?></td>
                                        <td><?= $nilai->benar + $nilai->benar_essay ?>/<?= $nilai->jml - ($nilai->benar + $nilai->benar_essay) ?></td>
                                        <td><?= $benar - $salah ?>/<?= $a->score ?></td>
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