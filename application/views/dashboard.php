<?php if ($this->session->flashdata('notif')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: '<?= $this->session->flashdata('notif') ?>',
        })
    </script>
<?php endif; ?>
<div id="contentwrapper">
    <div id="contentcolumn">
        <div class="innertube">
            <div class="sub-header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                    <h2>WELCOME, <?= $this->session->userdata('nama') ?></h2>
                </div>
                <div class="date">
                    <h2 id="jam"><?= date('H:i:s') ?></h2>
                </div>
            </div>
            <div class="body">
                <?php if (empty($akun->tempat_lhr) || empty($akun->tgl_lahir) || empty($akun->file_photo)) : ?>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-warning">
                                Please complete your data first. <a href="<?= base_url('akun') ?>"><strong>Click here</strong></a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-primary">
                                Thank you, your profile data is complete and please take this Online Exam
                            </div>
                        </div>
                    </div>
                    <div class="row-grid">
                        <?php
                        foreach ($jadwal as $j) : ?>
                            <div class="col">
                                <div class="card card-hover m-0">
                                    <div class="card-body widget-md">
                                        <i class="far fa-calculator-alt" style="color: <?= randomHex(); ?>90"></i>
                                        <div>
                                            <strong><?= $j->nama_jadwal ?></strong>
                                            <h1><?= ($j->soal_mudah + $j->soal_medium + $j->soal_susah) ?></h1>
                                            <small class="text-xs">The total number of questions to be solved</small>
                                            <div style="margin-top:10px;">
                                                <a href="<?= $j->id_jadwal ?>" data-value="<?= $j->id_ujian ?>" class="btn btn-main btn-sm remove">Exam Now</a>
                                                <!-- <a href="" class="btn btn-dark btn-sm">Try Now</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card card-hover">
                                <div class="card-body profile">
                                    <?php
                                    $path = base_url('profile/');
                                    if (@getimagesize($path . $akun->file_photo)) : ?>
                                        <img src="<?= base_url() ?>profile/<?= $akun->file_photo ?>" alt="">
                                    <?php else : ?>
                                        <img src="<?= base_url() ?>profile/user.png" alt="">
                                    <?php endif; ?>
                                    <div class="profile-info">
                                        <div>
                                            <h2><?= $akun->nama_lengkap ?></h2>
                                            <div class="info">
                                                <ul>
                                                    <li><i class="far fa-id-card"></i> <?= $akun->no_regist ?></li>
                                                    <li><i class="far fa-user"></i> <?= $akun->email_peserta ?></li>
                                                    <li><i class="fab fa-whatsapp"></i> <?= $akun->nomor_peserta ?></li>
                                                </ul>
                                                <span></span>
                                            </div>
                                            <div class="task">
                                                <ul>
                                                    <li>NIK: <?= $akun->nik ?></li>
                                                    <li><i class="far fa-info"></i> <?= $akun->tempat_lhr ?>, <?= $akun->tgl_lahir ?></li>
                                                    <li><i class="far fa-home"></i> <?= $akun->alamat_peserta ?></li>
                                                </ul>
                                                <a href="<?= base_url('akun') ?>" class="btn btn-main" style="margin-top: 10px;">Update Data</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col">
                        <?php foreach ($info as $i) : ?>
                            <div class="card ribbon" data-label="INFORMATION">
                                <div class="card-body">
                                    <h2><?= $i->title_info ?></h2>
                                    <?= $i->deskripsi ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>