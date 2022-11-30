<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Schedule <?= $row->nama_jadwal ?></h4>
    </div>

</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card card-hover card-task-one">
                <div class="card-header py-2 bg-primary text-white">
                    <?= $row->nama_jadwal ?>
                </div>
                <div class="card-body-item">
                    <div class="form-group row border-dashed">
                        <label for="mulai" class="col-sm-3 col-form-label font-weight-bold">Schedule ID</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="schedule_id" name="schedule_id" placeholder="schelude id" value="<?= $row->kode_jadwal ?>">
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="title" class="col-sm-3 col-form-label font-weight-bold">Schedule Title</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control" id="title" name="title" placeholder="schedule title" value="<?php if (isset($row)) echo $row->nama_jadwal ?>">
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="kategori" class="col-sm-3 col-form-label font-weight-bold">Exam Type</label>
                        <div class="col-sm-9">
                            <select disabled name="kategori" id="kategori" class="form-control">
                                <option value="0">Exam Type</option>
                                <?php foreach ($ujian as $j) : ?>
                                    <?php if ($row->id_kategori == $j->id_ujian) : ?>
                                        <option value="<?= $j->id_ujian ?>" selected><?= $j->nama_ujian ?></option>
                                    <?php else : ?>
                                        <option value="<?= $j->id_ujian ?>"><?= $j->nama_ujian ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="mulai" class="col-sm-3 col-form-label font-weight-bold">Start/End Date</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md mb-2">
                                    <input disabled type="datetime-local" class="form-control" id="mulai" name="mulai" placeholder="start date" value="<?php if (isset($row)) echo $row->mulai ?>">
                                </div>
                                <div class="col-md mb-2">
                                    <input disabled type="datetime-local" class="form-control" id="selesai" name="selesai" placeholder="end date" value="<?php if (isset($row)) echo $row->selesai ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Total Participant</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control" id="jumlah" name="jumlah" placeholder="total of participant" value="<?php if (isset($row)) echo $row->jumlah_peserta ?>">
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Point True</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" disabled name="nilai_benar" class="form-control" placeholder="poin of true" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->nilai_benar ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Point False</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" disabled name="nilai_salah" class="form-control" placeholder="point of false" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->nilai_salah ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="level" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                        <div class="col-sm-9">
                            <select disabled name="status_jadwal" id="status_jadwal" class="form-control">
                                <?php if ($row->status_jadwal == "actived") : ?>
                                    <option value="actived" selected>Actived</option>
                                    <option value="disabled">Disabled</option>
                                <?php else : ?>
                                    <option value="actived">Actived</option>
                                    <option value="disabled" selected>Disabled</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="mudah" class="col-sm-3 col-form-label font-weight-bold">Question</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md mb-2">
                                    <input disabled type="number" class="form-control typesoal" min="0" id="mudah" name="mudah" placeholder="total of easy question" value="<?php if (isset($row)) echo $row->soal_mudah ?>">
                                </div>
                                <div class="col-md mb-2">
                                    <input disabled type="number" class="form-control typesoal" min="0" id="medium" name="medium" placeholder="total of medium question" value="<?php if (isset($row)) echo $row->soal_medium ?>">
                                </div>
                                <div class="col-md mb-2">
                                    <input disabled type="number" class="form-control typesoal" min="0" id="susah" name="susah" placeholder="total of hard question" value="<?php if (isset($row)) echo $row->soal_susah ?>">
                                </div>
                            </div>
                            <div class="message-type"></div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Minimum Score</label>
                        <div class="col-sm-9">
                            <input type="number" disabled class="form-control" id="score" name="score" placeholder="minimum score" value="<?php if (isset($row)) echo $row->score ?>">
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="level" class="col-sm-3 col-form-label font-weight-bold">Timer Type</label>
                        <div class="col-sm-9">
                            <select disabled name="timer" id="timer" class="form-control">
                                <?php if (isset($row)) : ?>
                                    <?php if ($row->jenis_waktu == "T") : ?>
                                        <option value="S">Timer/Question</option>
                                        <option value="T" selected>Timer/Exam</option>
                                    <?php else : ?>
                                        <option value="T">Timer/Exam</option>
                                        <option value="S" selected>Timer/Question</option>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <option value="T">Timer/Exam</option>
                                    <option value="S">Timer/Question</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <?php if ($row->jenis_waktu == "T") : ?>
                        <div class="form-group row border-dashed examtime">
                            <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Timer Format</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control" id="inputTime2" name="format_timer" placeholder="ex: 10,20,30" value="<?php if (isset($row)) echo $row->timer ?>">
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="form-group row border-dashed">
                            <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Set Second</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" disabled name="set_ganda" value="<?php if (isset($row)) echo gmdate("H:i:s", $row->set_ganda); ?>" id="set_ganda" class="form-control" placeholder="timer for eassy question">
                                    </div>
                                    <div class="col">
                                        <input type="text" disabled name="set_benar" value="<?php if (isset($row)) echo gmdate("H:i:s", $row->set_benar); ?>" id="set_pernyataan" class="form-control" placeholder="timer for medium question">
                                    </div>
                                    <div class="col">
                                        <input type="text" disabled name="set_esay" value="<?php if (isset($row)) echo gmdate("H:i:s", $row->set_esay); ?>" id="set_esay" class="form-control" placeholder="timer for hard question">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group row border-dashed">
                        <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Record Webcam</label>
                        <div class="col-sm-9">
                            <div class="custom-control custom-switch">
                                <?php
                                if ($row->record == "aktif") {
                                    echo '<input type="checkbox" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="record">Actived</label>';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input">
                                            <label class="custom-control-label" for="record">No Actived</label>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Interval Upload</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control" value="<?php if (isset($row)) echo $row->interval_img ?> second">
                        </div>
                    </div>
                    <div class="form-group row border-dashed">
                        <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Duration Record</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control" value="<?php if (isset($row)) echo $row->durasi ?> second">
                        </div>
                    </div>
                    <div class="form-group row border-none">
                        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold"></label>
                        <div class="col-sm-9">
                            <button type="reset" class="btn btn-dark rounded-5" onclick="history.back()">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>