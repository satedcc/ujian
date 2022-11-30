<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Report</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Report</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Data Report</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <?php if (!empty($peserta)) : ?>
            <?php foreach ($peserta as $p) :
                $jmlsoal = $this->db->query("SELECT id_regis,id_jawab,id_jadwal FROM ex_jawaban WHERE id_regis='$p->id_regis' AND id_jadwal='$id'")->num_rows();
                $persen = ceil(($jmlsoal / ($jadwal->soal_mudah + $jadwal->soal_medium + $jadwal->soal_susah)) * 100);
                $nilai  = $this->db->query("SELECT 
                                        COUNT(CASE WHEN a.jawaban = b.soal_jawaban THEN 1 END ) AS benar,
                                        COUNT(CASE WHEN a.status_jawaban = 'true' THEN 1 END ) AS benar_essay,
                                        COUNT(CASE WHEN a.status_jawaban = 'false' THEN 1 END ) AS salah_essay,
                                        COUNT(*) as jml,
                                        (COUNT(*) - COUNT(CASE WHEN a.jawaban = b.soal_jawaban THEN 1 END )) as salah
                                        FROM ex_jawaban AS a LEFT JOIN ex_soal AS b ON b.id_soal = a.id_soal WHERE a.id_regis='$p->id_regis' AND a.id_jadwal='$id'")->row();
                $benar = ($nilai->benar + $nilai->benar_essay) * $jadwal->nilai_benar;
                $salah = ($nilai->jml - ($nilai->benar + $nilai->benar_essay)) * $jadwal->nilai_salah;
            ?>
                <div class="col-md-3 mb-3">
                    <div class="card card-hover card-task-one">
                        <?php if ($nilai->jml > 0) : ?>
                            <?php if (($benar - $salah) > $jadwal->score) : ?>
                                <div class="marker marker-ribbon marker-success marker-top-right pos-absolute t-10 r-0">SUCCESSFULY</div>
                            <?php else : ?>
                                <div class="marker marker-ribbon marker-danger marker-top-right pos-absolute t-10 r-0">FAIL</div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="marker marker-ribbon marker-warning marker-top-right pos-absolute t-10 r-0">NOT STARTED</div>
                        <?php endif; ?>
                        <div class="card-body list-user">
                            <div class="text-center">
                                <?php
                                $path = base_url('profile/');
                                if (@getimagesize($path . $p->file_photo)) : ?>
                                    <img src="<?= base_url() ?>profile/<?= $p->file_photo ?>" alt="" class="mb-3">
                                <?php else : ?>
                                    <img src="<?= base_url() ?>profile/user.png" class="rounded-circle" alt="user.png">
                                <?php endif; ?>
                                <h6 class="m-0"><?= $p->nama_lengkap ?></h6>
                                <small><?= $p->no_regist ?> - <?= $p->email_peserta ?></small>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <strong>Score: <span class="text-muted"><?= ($benar - $salah) ?></span>/<?= $jadwal->score ?></strong>
                                <strong>Question: <span class="text-muted"><?= $jmlsoal ?>/<?= ($jadwal->soal_mudah + $jadwal->soal_medium + $jadwal->soal_susah) ?></span></strong>
                            </div>
                            <div class="d-flex align-items-center justify-content-end mt-3">
                                <strong class="text-muted"><?= $persen ?>% complete</strong>
                            </div>
                            <div class="progress rounded-5" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: <?= $persen ?>%;" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <a href="<?= base_url('admin/jadwal/detailexam/' . $p->id_regis . "/" . $id) ?>" class="btn btn-sm btn-primary mt-3 d-block w-100 rounded-5">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-xl-12 mg-t-15 mg-sm-t-20">
                <div class="card card-project-three card-project-pink">
                    <div class="card-body">
                        <div class="marker marker-ribbon marker-danger marker-top-right pos-absolute t-10 r-0">Participant Null</div>
                        <label class="content-label tx-600 tx-success mg-b-5">Detail Report</label>
                        <h2>Participants are not registered yet</h2>
                        <p>Please add participants to this schedule first</p>
                        <button class="btn btn-danger rounded" onclick="history.back()">Back to schedule</button>
                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
        <?php endif; ?>
    </div>
</div>