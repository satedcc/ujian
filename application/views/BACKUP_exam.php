<div id="contentwrapper">
    <div id="contentcolumn">
        <div class="innertube">
            <div class="sub-header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Exam</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Exam <?= $info->nama_ujian ?></li>
                    </ol>
                </div>
                <div class="date">
                    <h3 id="jam"><?= date('H:i:s') ?></h3>
                </div>
            </div>
            <div class="body">
                <?php if (!empty($soal)) : ?>
                    <div class="row">
                        <div class="col">
                            <form action="<?= base_url('soal/jawab/') ?>" method="post" id="form">
                                <input type="text" value="<?= $info->id_jadwal ?>" name="jadwal" id="jadwal" hidden>
                                <?php $x = 1;
                                foreach ($soal as $s) : $no = $x++ ?>
                                    <div class="soal" id="soal-<?= $no; ?>">
                                        <div class="card card-hover" style="margin-bottom: 10px;">
                                            <div class="card-header">
                                                <strong><span class="uppercase"><?= $info->nama_ujian ?></span> 1: QUESTION <?= $no ?> OF <?= $total ?></strong>
                                                <div>
                                                    <a href="">Instruction</a>
                                                    <strong>Exam Duration: <?= $info->durasi ?> minute</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="data-soal">
                                                    <div class="soal-body">
                                                        <?= $s->soal ?>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <?php if ($s->type_soal == "1") : ?>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_a ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,A">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_b ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,B">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_c ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,C">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_d ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,D">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_e ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,E">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    <?php elseif ($s->type_soal == "2") : ?>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_a ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,A">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label class="container-radio"><?= $s->jawab_b ?>
                                                                <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,B">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    <?php else : ?>
                                                        <label for="">Typing your answer:</label>
                                                        <textarea autofocus name="jawaban[]" id="jawaban_essay" data-value="<?= $s->id_soal ?>" cols="30" rows="10"></textarea>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <input type="text" class="time" id="time-<?= $s->id_soal ?>" hidden>
                                        <button class="btn btn-main btn-proses"><i class="fal fa-cloud-upload"></i> SUBMIT ANSWER</button>
                                        <button class="btn btn-dark next" value="<?= $no + 1; ?>" id="<?= $s->id_soal ?>">NEXT QUESTION <i class="fal fa-angle-double-right"></i></button>
                                        <!-- <input type="text" class="nomor_soal" value="<?= $no + 1; ?>"> -->
                                        <input type="text" name="ans" id="ans-<?= $s->id_soal ?>" hidden>
                                    </div>
                                <?php endforeach; ?>
                                <div class="finish-soal">
                                    <div class="card" style="margin-bottom: 10px;">
                                        <div class="card-body text-center">
                                            <img src="<?= base_url() ?>dir/assets/img/success.png" alt="" style="width: 20%;">
                                            <h1>Contratulation !</h1>
                                            <p class="m-0">Thank you for completing the Exam according to the time given</p>
                                            <p class="m-0">Please click the following button to save your answer</p>
                                            <button class="btn btn-main">Submit Answer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="alert alert-warning" style="margin-top: 30px;">
                                Mohon memperhatikan soal sebelum mengklik <strong>NEXT</strong>, soal yang telah di kerjakan tidak bisa di ubah jawabannya
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card card-hover">
                                <div class="card-header">
                                    <strong>TIMER STATUS</strong>
                                </div>
                                <div class="timer-exam">
                                    <div class="row" id="time-over"></div>
                                    <h1 class="countdown"></h1>
                                </div>
                            </div>
                            <div class="space"><span>Total Time: </span><span><?= $info->durasi ?></span></div>
                            <div class="card card-hover">
                                <div class="card-body navigasi">
                                    <strong>NAVIGASI</strong>
                                    <h3>EXAM: <?= $info->nama_ujian ?></h3>
                                    <?php
                                    $data[] = "";
                                    if (isset($_SESSION['jawaban'])) {
                                        foreach ($_SESSION['jawaban'] as $key => $value) {
                                            // $data[] = 1;
                                            $data[] = $value['nomor'];
                                            // echo $value['id_soal'] . "," . $value['jawab'] . "," . $value['time']  . $value['nomor'] . "<br>";
                                        }
                                        $last = end($data);
                                    }
                                    ?>
                                    <ul>
                                        <?php $no = 1;
                                        foreach ($soal as $s) :
                                            $x = array_search($no, $data) ?>
                                            <?php if ($x > 0) : ?>
                                                <li id="nav-<?= $no ?>" class="actives"><?= $no; ?></li>
                                            <?php else : ?>
                                                <li id="nav-<?= $no ?>"><?= $no; ?></li>
                                            <?php endif; ?>
                                        <?php $no++;
                                        endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="card card-hover" style="margin-top: 10px;">
                                <div class="card-body">
                                    <!-- <div>
                                        <video id="live" controls autoplay playsinline muted></video> <video id="playback" controls autoplay></video>
                                        <div id="controls" class="controls">
                                            <button id="rec" onclick="onBtnRecordClicked()">Record</button>
                                            <button id="pauseRes" onclick="onPauseResumeClicked()" disabled>Pause</button>
                                            <button id="stop" onclick="onBtnStopClicked()" disabled>Stop</button>
                                        </div>
                                    </div>
                                    <a id="downloadLink" href></a>
                                    <p id="data" class="m-0"></p> -->
                                    <video class="video-record" id="your-video-id" controls autoplay playsinline></video>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-md m-auto">
                            <div class="card">
                                <div class="card-body" style="text-align:center;">
                                    <img src="<?= base_url() ?>dir/assets/img/folder.png" alt="" style="width: 30%;">
                                    <h2>Soal Tidak Tersedia</h2>
                                    <p>Mohon maaf saat ini soal masih belum tersedia, mohon untuk menghubungi admin</p>
                                    <a href="<?= base_url('dashboard/') ?>" class="btn btn-main">Kembali ke beranda</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- <script src="<?= base_url() ?>dir/exam/adapter-latest.js"></script> -->
<!-- <script src="<?= base_url() ?>dir/exam/main.js"></script> -->
<script src="https://www.webrtc-experiment.com/RecordRTC.js"></script>

<script>
    $("#preloader").remove()
    // setTimeout(() => {
    //     onBtnRecordClicked()
    // }, 2000);
    // setInterval(() => {
    //     html2canvas(document.body).then(function(canvas) {
    //         var dataURL = canvas.toDataURL();
    //         $.ajax({
    //             type: "POST",
    //             url: "<?= base_url('soal/upload') ?>",
    //             data: {
    //                 image: dataURL
    //             },
    //             success: function(response) {}
    //         });
    //     });
    // }, 5000);



    function confirm() {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire('Data Jawaban Tersimpan', '', 'success');
                window.location.href = "<?= base_url('soal/jawab/') ?>";
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }
    $(document).ready(function() {
        <?php if (empty($last)) : ?>
            $(".soal:first").show()
        <?php else : ?>
            $(".soal:eq(<?= $last - 1 ?>)").show()
        <?php endif; ?>

        $("body").on("click", ".next", function(e) {
            e.preventDefault();
            let id = $(this).val();
            let soal = $(this).attr("id");
            let time = $("#time-" + soal).val();
            let x = $("#ans-" + soal).val().split(",");
            $("#soal-" + id).show();
            $("#nav-" + id).addClass("actives")
            $("#soal-" + (id - 1)).remove();
            window.soalid = id;
            $.ajax({
                method: "POST",
                url: "<?= base_url('soal/save') ?>",
                data: {
                    soal: x[0],
                    jawab: x[1],
                    time: time,
                    jadwal: $("#jadwal").val(),
                    nomor: id
                },
                success: function(response) {}
            });

            if (id == "<?= ($total + 1) ?>") {
                // confirm()
                $(".finish-soal").show()

            }
        });
        $("body").on("click", "input[name='jawaban[]']", function(e) {
            let jawab = $(this).val().split(",")
            $("#ans-" + jawab[0]).val(jawab)
        });
        $("body").on("keyup", "#jawaban_essay", function(e) {
            let soal = $(this).attr("data-value")
            let jawab = $(this).val();
            $("#ans-" + soal).val(soal + "," + jawab)
        });
        // CONFIRM BEFORE SUBMIT
        $('.btn-proses').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure to finish the exam now?',
                showCancelButton: true,
                confirmButtonText: 'Yes, I am sure',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('soal/jawab/') ?>";
                }
            })
        });
    });
    // document.addEventListener('keydown', (e) => {
    //     e = e || window.event;
    //     if (e.keyCode == 116) {
    //         e.preventDefault();
    //         alert('JANGAN MENEKAN TOMBOL REFRESH!!')
    //     }
    //     if (e.keyCode == 17) {
    //         e.preventDefault();
    //         alert('JANGAN MENEKAN TOMBOL CONTROL (CTRL)')
    //     }
    // });
    // document.addEventListener("contextmenu", function(e) {
    //     e.preventDefault();
    //     alert('PERINGATAN !! JIKA ANDA MENGKLIK KANAN LAGI ANDA AKAN DI DISKUALIFIKASI')
    // }, false);

    // -----------------++ TIMER TIME ++--------------------//
    <?php if ($info->jenis_waktu == "T") : ?>
        var timer2 = "<?= $info->timer ?>";
        var interval = setInterval(function() {


            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            $('.time').val(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
            if (timer2 == "5:00") {
                $("#time-over").html(`<div class="times-over">Waktu Anda kurang dari 1 menit</div>`);
            }
            if (timer2 == "0:00") {
                window.location.href = "<?= base_url('soal/jawab/') ?>";
            }
        }, 1000);
        // -----------------++ TIMER SECOND ++--------------------//
    <?php else : ?>
        var durasi = <?= $info->timer ?>;


        var paused = false;
        var timer = function(time, selector) {
            this.pause = function() {
                return time;
            };
            this.time = time;
            this.select = selector;

            this.x = setInterval(function() {
                $(selector).html(formatTime(time));
                if (time > 0 && !paused) {
                    time -= 1;
                }

            }, 1000);
            var pauseHolder = 0;

        };
        longTimer = new timer(durasi * 10, '.countdown');
        $('button.next').click(function() {
            if (!paused) {
                clearInterval(longTimer.x);
                longTimer = new timer(durasi * 10, '.countdown');
            } else {
                longTimer.time = durasi * 10;
            }
            window.nomor = ($(this).val())
        });


        var formatTime = function(input) {
            var seconds = Math.floor(input % 60);
            var minutes = Math.floor((input / 60) % 60);
            if (seconds < 10) {
                seconds = '0' + seconds;
            }
            return minutes + ":" + seconds;
        };

        var start = 0;
        var soalid = 2;

        function increment() {
            if (!paused) {
                clearInterval(longTimer.x);
                longTimer = new timer(durasi * 10, '.countdown');
            } else {
                longTimer.time = durasi * 10;
            }
            start += 30;
            var nextsoal = soalid++;
            $("#soal-" + nextsoal).show();
            $("#nav-" + nextsoal).addClass("actives")
            $("#soal-" + (nextsoal - 1)).remove();
        }
        setInterval(increment, (durasi * 10000) + 2000); // test
    <?php endif; ?>
</script>
<script type="text/javascript">
    // capture camera and/or microphone
    navigator.mediaDevices.getUserMedia({
        video: true,
        audio: true
    }).then(function(camera) {

        // preview camera during recording
        document.getElementById('your-video-id').muted = false;
        document.getElementById('your-video-id').srcObject = camera;

        // recording configuration/hints/parameters
        var recordingHints = {
            type: 'video'
        };

        // initiating the recorder
        var recorder = RecordRTC(camera, recordingHints);

        // starting recording here

        setInterval(() => {
            recorder.startRecording();

            // auto stop recording after 5 seconds
            var milliSeconds = 5 * 1000;
            setTimeout(function() {
                // stop recording
                recorder.stopRecording(function() {

                    // get recorded blob
                    var blob = recorder.getBlob();

                    // generating a random file name
                    var fileName = getFileName('webm');

                    // we need to upload "File" --- not "Blob"
                    var fileObject = new File([blob], fileName, {
                        type: 'video/webm'
                    });

                    var formData = new FormData();

                    // recorded data
                    formData.append('video-blob', fileObject);

                    // file name
                    formData.append('video-filename', fileObject.name);


                    var upload_url = '<?= base_url('soal/uploadVideo/') ?>';
                    // var upload_url = 'RecordRTC-to-PHP/save.php';

                    var upload_directory = upload_url;
                    // var upload_directory = 'RecordRTC-to-PHP/uploads/';

                    // upload using jQuery
                    $.ajax({
                        url: upload_url, // replace with your own server URL
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(response) {}
                    });



                });

            }, milliSeconds);
        }, 1 * 60 * 1000);
    });

    // this function is used to generate random file name
    function getFileName(fileExtension) {
        var d = new Date();
        var year = d.getUTCFullYear();
        var month = d.getUTCMonth();
        var date = d.getUTCDate();
        return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
    }

    function getRandomString() {
        if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
            var a = window.crypto.getRandomValues(new Uint32Array(3)),
                token = '';
            for (var i = 0, l = a.length; i < l; i++) {
                token += a[i].toString(36);
            }
            return token;
        } else {
            return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
        }
    }
</script>