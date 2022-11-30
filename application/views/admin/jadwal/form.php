<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Schedule</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Schedule</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Form Schedule</h4>
    </div>

</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <?php if ($this->session->flashdata('notif')) : ?>
                <script>
                    Swal.fire(
                        'Gagal',
                        '<?= $this->session->flashdata('notif') ?>',
                        'error'
                    )
                </script>
            <?php endif; ?>
            <div class="card card-hover card-task-one">
                <div class="card-header py-2 bg-primary text-white">
                    Form Schedule
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/jadwal/save/') ?>" method="post">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label font-weight-bold">Schedule Title</label>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control" id="title" name="title" placeholder="schedule title" value="<?php if (isset($row)) echo $row->nama_jadwal ?>">
                                <input type="text" id="id" name="id" value="<?php if (isset($row)) echo $row->id_jadwal ?>" hidden>
                                <?php if (isset($row)) : ?>
                                    <input type="text" hidden id="schedule_id" name="schedule_id" value="<?= $row->kode_jadwal ?>">
                                <?php else : ?>
                                    <input type="text" hidden id="schedule_id" name="schedule_id" value="<?= $kodeBarang ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-3 col-form-label font-weight-bold">Exam Type</label>
                            <div class="col-sm-9">
                                <select name="kategori" id="kategori" class="form-control select2">
                                    <option value="0">Exam Type</option>
                                    <?php foreach ($ujian as $j) : ?>
                                        <?php if (isset($row)) : ?>
                                            <?php if ($row->id_kategori == $j->id_ujian) : ?>
                                                <option value="<?= $j->id_ujian ?>" selected><?= $j->nama_ujian ?></option>
                                            <?php else : ?>
                                                <option value="<?= $j->id_ujian ?>"><?= $j->nama_ujian ?></option>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <option value="<?= $j->id_ujian ?>"><?= $j->nama_ujian ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mulai" class="col-sm-3 col-form-label font-weight-bold">Start/End Date</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md mb-2">
                                        <input required type="text" class="form-control" id="mulai" name="mulai" placeholder="start date" value="<?= (isset($row)) ? $row->mulai : date("Y-m-d H:i:s"); ?>">
                                    </div>
                                    <div class="col-md mb-2">
                                        <input required type="text" class="form-control" id="selesai" name="selesai" placeholder="end date" value="<?= (isset($row)) ? $row->selesai : date("Y-m-d H:i:s"); ?>">
                                    </div>
                                </div>
                                <div id="message-date"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Total Participant</label>
                            <div class="col-sm-9">
                                <input type="number" required class="form-control" id="jumlah" name="jumlah" placeholder="total of participant" value="<?php if (isset($row)) echo $row->jumlah_peserta ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Point True</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" required name="nilai_benar" class="form-control" placeholder="poin of true" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->nilai_benar ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-3 col-form-label font-weight-bold">Point False</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" required name="nilai_salah" class="form-control" placeholder="point of false" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->nilai_salah ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                            <div class="col-sm-9">
                                <select required name="status_jadwal" id="status_jadwal" class="form-control">
                                    <?php if (isset($row)) : ?>
                                        <?php if ($row->status_jadwal == "actived") : ?>
                                            <option value="actived" selected>Actived</option>
                                            <option value="disabled">Disabled</option>
                                        <?php else : ?>
                                            <option value="actived">Actived</option>
                                            <option value="disabled" selected>Disabled</option>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="actived">Actived</option>
                                        <option value="disabled">Disabled</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mudah" class="col-sm-3 col-form-label font-weight-bold">Category Question</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md mb-2">
                                        <input required type="number" class="form-control typesoal" min="0" id="mudah" name="mudah" placeholder="total of easy question" value="<?php if (isset($row)) echo $row->soal_mudah ?>">
                                    </div>
                                    <div class="col-md mb-2">
                                        <input required type="number" class="form-control typesoal" min="0" id="medium" name="medium" placeholder="total of medium question" value="<?php if (isset($row)) echo $row->soal_medium ?>">
                                    </div>
                                    <div class="col-md mb-2">
                                        <input required type="number" class="form-control typesoal" min="0" id="susah" name="susah" placeholder="total of hard question" value="<?php if (isset($row)) echo $row->soal_susah ?>">
                                    </div>
                                </div>
                                <div class="message-error"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Minimum Score</label>
                            <div class="col-sm-9">
                                <input type="number" required min="0" minlength="1" class="form-control" id="score" name="score" placeholder="minimum score" value="<?php if (isset($row)) echo $row->score ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-sm-3 col-form-label font-weight-bold">Timer Type</label>
                            <div class="col-sm-9">
                                <select required name="timer" id="timer" class="form-control">
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
                        <?php if (isset($row)) :
                            $show = ($row->jenis_waktu != "T") ? ' style="display:none;"' : false;
                        ?>
                            <div class="form-group row examtime" <?= $show ?>>
                                <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Timer Format</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputTime2" name="format_timer" placeholder="ex: 01:45, 02:00, 03:30" value="<?php if (isset($row)) echo $row->timer ?>">
                                    <small>Please set format for timer (hh:mm), example: <strong>01:00,02:30,03:15 (Hour for Timer of exam)</strong></small>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="form-group row examtime">
                                <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Timer Format</label>
                                <div class="col-sm-9">
                                    <input type="text" required class="form-control" id="inputTime2" name="format_timer" placeholder="ex: 01:45, 02:00, 03:30">
                                    <small>Please set format for timer (hh:mm), example: <strong>01:00,02:30,03:15 (Hour for Timer of exam)</strong></small>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($row)) : ?>
                            <?php if ($row->jenis_waktu == "S") : ?>
                                <div class="secontime" style="display: block;">
                                    <div class="form-group row">
                                        <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Set Timer</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" required name="set_ganda" value="<?php if (isset($row)) echo gmdate("H:i:s", $row->set_ganda); ?>" id="set_ganda" class="form-control" placeholder="timer for eassy question 00:00:00">
                                                </div>
                                                <div class="col">
                                                    <input type="text" required name="set_benar" value="<?php if (isset($row)) echo gmdate("H:i:s", $row->set_benar); ?>" id="set_pernyataan" class="form-control" placeholder="timer for medium question 00:00:00">
                                                </div>
                                                <div class="col">
                                                    <input type="text" required name="set_esay" value="<?php if (isset($row)) echo gmdate("H:i:s", $row->set_esay); ?>" id="set_esay" class="form-control" placeholder="timer for hard question 00:00:00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="secontime">
                                    <div class=" form-group row">
                                        <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Set Timer</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" name="set_ganda" value="" id="set_ganda" class="form-control" placeholder="timer for eassy question 00:00:00">
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="set_benar" value="" id="set_pernyataan" class="form-control" placeholder="timer for medium question 00:00:00">
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="set_esay" value="" id="set_esay" class="form-control" placeholder="timer for hard question 00:00:00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="secontime">
                                <div class="form-group row">
                                    <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Set Timer</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="set_ganda" value="" id="set_ganda" value="00:00:01" class="form-control" placeholder="timer for eassy question 00:00:00">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="set_benar" value="" id="set_pernyataan" value="00:00:01" class="form-control" placeholder="timer for medium question 00:00:00">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="set_esay" value="" id="set_esay" value="00:00:01" class="form-control" placeholder="timer for hard question 00:00:00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group row">
                            <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Record Video</label>
                            <div class="col-sm-9 row align-items-center px-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="record" name="record" value="aktif" checked>
                                    <label class="custom-control-label" for="record">Actived</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Set Interval Uploads</label>
                            <div class="col-sm-9">
                                <input type="number" required name="interval" min="5" minlength="5" value="<?php if (isset($row)) echo $row->interval_img ?>" id="interval" class="form-control" placeholder="set interval upload capture">
                                <small>Interval set in format second (5 second, 10 second etc)</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="susah" class="col-sm-3 col-form-label font-weight-bold">Duration Record</label>
                            <div class="col-sm-9">
                                <input type="number" required name="durasi" min="5" minlength="5" value="<?php if (isset($row)) echo $row->durasi ?>" id="durasi" class="form-control" placeholder="set duration record">
                                <small>Duration in format second (5 second, 10 second etc)</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold"></label>
                            <div class="col-sm-9">
                                <a href="#modal2" class="btn btn-primary rounded-5" data-toggle="modal">Confirm</a>
                                <button type="button" onclick="history.back()" class="btn btn-dark rounded-5">Cancel</button>
                            </div>
                        </div>
                        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel2">Confirm</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i data-feather="x"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mg-b-0">Are you sure save this data ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        <button class="btn btn-dark btn-sm" id="btn-jadwal" <?php if (!isset($row)) echo 'disabled'; ?>>Yes, Save Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>dir/lib/cleave.js/cleave.min.js"></script>
<script src="<?= base_url() ?>dir/lib/cleave.js/addons/cleave-phone.us.js"></script>
<script>
    var cleaveE = new Cleave('#set_ganda', {
        time: true,
        timePattern: ['h', 'm', 's']
    });
    var cleaveE = new Cleave('#set_pernyataan', {
        time: true,
        timePattern: ['h', 'm', 's']
    });
    var cleaveE = new Cleave('#set_esay', {
        time: true,
        timePattern: ['h', 'm', 's']
    });
    var cleaveF = new Cleave('#inputTime2', {
        time: true,
        timePattern: ['h', 'm']
    });
</script>
<script>
    $(function() {
        'use strict'
        $('#mulai').datepicker({
            dateFormat: "dd/mm/yy",
        });
        $('#selesai').datepicker({
            dateFormat: "dd/mm/yy",
        });

        $("body").on('change', '#selesai', function(e) {
            e.preventDefault();
            var mulai = $("#mulai").val();
            var selesai = $(this).val();
            if (mulai > selesai) {
                $("#message-date").html(`<div class="alert alert-danger">Start date is greater than end date</div>`)
            } else {
                $("#message-date").hide()
                $("#btn-jadwal").prop("disabled", false);
            }
        });
    });
</script>