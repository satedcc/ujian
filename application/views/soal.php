<div id="contentwrapper">
    <div id="contentcolumn">
        <div class="innertube">
            <div class="sub-header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Pages</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('soal/') ?>">Soal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Management Question</li>
                    </ol>
                </div>
                <div class="date">
                    <h3 id="jam"><?= date('H:i:s') ?></h3>
                </div>
            </div>
            <div class="body">
                <div class="row">
                    <?php
                    foreach ($jadwal as $j) : ?>
                        <div class="col">
                            <div class="card card-hover">
                                <div class="card-body widget-md">
                                    <i class="far fa-calculator-alt" style="color: <?= randomHex(); ?>90"></i>
                                    <div>
                                        <strong><?= $j->nama_jadwal ?></strong>
                                        <h1><?= ($j->soal_mudah + $j->soal_medium + $j->soal_susah) ?></h1>
                                        <small class="text-xs">The total number of questions to be solved</small>
                                        <div style="margin-top:10px;">
                                            <a href="<?= $j->id_jadwal ?>" data-value="<?= $j->id_ujian ?>" class="btn btn-main btn-sm remove">Exam Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card card-hover ribbon" data-label="INFORMASI">
                            <div class="card-body">
                                <h2>INFROMASI</h2>
                                <p>Sebelum memulai mengerjakan exam yang telah di sediakan oleh panitia, mohon untuk memperhatikan beberapa point berikut:</p>
                                <ol>
                                    <li>Tidak di perkanankan melakukan kegiatan selain mengerjakan soal</li>
                                    <li>Tidak di perkenankan membuka tab/window baru</li>
                                    <li>Posisi camera webcam dalam posisi aktif</li>
                                    <li>Tidak menekan tombol Escape (ESC) pada keyboard</li>
                                    <li>Tidak di perkenanankan meninggalkan laptop di saat ujian telah di mulai</li>
                                    <li>Tidak di perkanankan melakukan kegiatan selain mengerjakan soal</li>
                                    <li>Tidak di perkenankan membuka tab/window baru</li>
                                    <li>Posisi camera webcam dalam posisi aktif</li>
                                    <li>Tidak menekan tombol Escape (ESC) pada keyboard</li>
                                    <li>Tidak di perkenanankan meninggalkan laptop di saat ujian telah di mulai</li>
                                </ol>
                                <p>Bagi anda yang melanggar point yang di telah di tetapkan akan langsung di nyatakan <strong>GUGUR</strong> oleh panitia sehingga anda tidak bisa mengikuti rangkaian
                                    kegiatan berikutnya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>