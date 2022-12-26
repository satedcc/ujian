<div id="contentwrapper">
    <div id="contentcolumn">
        <div class="innertube">
            <div class="sub-header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Exam</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Exam <?= $info->nama_jadwal ?></li>
                    </ol>
                </div>
                <div class="date">
                    <h3 id="jam"><?= date('H:i:s') ?></h3>
                </div>
            </div>
            <div class="body">
                <form action="<?= base_url('soal/jawab') ?>" method="post" id="form">
                    <?php if (!empty($soal)) : ?>
                        <div class="row">
                            <div class="col">
                                <input type="text" value="<?= $info->id_jadwal ?>" name="jadwal" id="jadwal" hidden>
                                <input type="text" value="<?= $info->id_kategori ?>" name="ujian" id="ujian" hidden>
                                <?php $x = 1;
                                foreach ($soal as $s) : $no = $x++ ?>
                                    <div class="soal" id="soal-<?= $no; ?>" data-value="<?= $s->id_soal ?>">
                                        <div class="card card-hover" style="margin-bottom: 10px;">
                                            <div class="card-header">
                                                <div class="head-question">
                                                    <span class="uppercase"><?= $info->nama_jadwal ?> :</span>
                                                    <span>QUESTION <?= $no ?> OF <?= $total ?></span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="data-soal">
                                                    <div class="soal-body">
                                                        <?= $s->soal ?>
                                                        <?php
                                                        if (!empty($s->media_file)) {
                                                            $size = explode(",", $s->size_media);
                                                            if ($s->jenis_media == "PNG" or $s->jenis_media == "JPG" or $s->jenis_media == "JPEG" or $s->jenis_media == "png" or $s->jenis_media == "jpg" or $s->jenis_media == "jpeg") {
                                                                echo '<img src="' . base_url() . '/dir/assets/img/' . $s->media_file . '" style="width:' . $size[0] . ';height:' . $size[1] . ';">';
                                                            } else {
                                                                echo "<video controls style='width:" . $size[0] . ";height:" . $size[1] . ";'>
                                                                        <source src='" . base_url() . '/dir/assets/img/' . $s->media_file . "' type='video/mp4'>
                                                                        Your browser does not support the video tag.
                                                                    </video>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <?php if ($s->type_soal == "1") : ?>
                                                        <?php if (isset($s->jawab_a)) : ?>
                                                            <li>
                                                                <label class="container-radio"><?= $s->jawab_a ?>
                                                                    <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,A">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (isset($s->jawab_b)) : ?>
                                                            <li>
                                                                <label class="container-radio"><?= $s->jawab_b ?>
                                                                    <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,B">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (isset($s->jawab_c)) : ?>
                                                            <li>
                                                                <label class="container-radio"><?= $s->jawab_c ?>
                                                                    <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,C">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (isset($s->jawab_d)) : ?>
                                                            <li>
                                                                <label class="container-radio"><?= $s->jawab_d ?>
                                                                    <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,D">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        <?php endif; ?>
                                                        <?php if (isset($s->jawab_e)) : ?>
                                                            <li>
                                                                <label class="container-radio"><?= $s->jawab_e ?>
                                                                    <input type="radio" name="jawaban[]" value="<?= $s->id_soal ?>,E">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </li>
                                                        <?php endif; ?>
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
                                        <button class="btn btn-dark next" value="<?= $no + 1; ?>" id="<?= $s->id_soal ?>">NEXT QUESTION <i class="fal fa-angle-double-right"></i></button>
                                        <textarea name="ans" id="ans-<?= $s->id_soal ?>" hidden><?= $s->id_soal ?>,0</textarea>
                                        <?php
                                        if ($jadwal->jenis_waktu == "S") {
                                            if ($s->jenis_soal == "E") {
                                                echo ' <input type="hidden" name="sec" id="sec_' . ($no + 1) . '" value="' . $jadwal->set_ganda . '">';
                                            } elseif ($s->jenis_soal == "M") {
                                                echo ' <input type="hidden" name="sec" id="sec_' . ($no + 1) . '" value="' . $jadwal->set_benar . '">';
                                            } elseif ($s->jenis_soal == "H") {
                                                echo ' <input type="hidden" name="sec" id="sec_' . ($no + 1) . '" value="' . $jadwal->set_esay . '">';
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                                <div class="finish-soal">
                                    <div class="card" style="margin-bottom: 10px;">
                                        <div class="card-body text-center">
                                            <img src="<?= base_url() ?>dir/assets/img/success.png" alt="" style="width: 20%;">
                                            <h1>Congratulation !</h1>
                                            <p class="m-0">Thank you for completing the Exam according to the time given</p>
                                            <p class="m-0">Please click the following button to save your answer</p>
                                            <button class="btn btn-main btn-proses">Submit Answer</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning" style="margin-top: 30px;">
                                    Mohon memperhatikan soal sebelum mengklik <strong>NEXT</strong>, soal yang telah di kerjakan tidak bisa di ubah jawabannya
                                </div>
                </form>
            </div>
            <div class="col-sm">
                <div class="card card-hover">
                    <div class="card-header">
                        <strong>TIMER STATUS</strong>
                    </div>
                    <div class="timer-exam">
                        <div class="row" id="time-over"></div>
                        <h1 class="countdown">
                            <p class="timer"> <span class="min"></span>:<span class="sec"></span></p>
                        </h1>
                        <button class="btn btn-main btn-proses" style="width: 100%;"><i class="fal fa-cloud-upload"></i> SUBMIT TEST</button>
                    </div>
                </div>
                <div class="space">
                </div>
                <div class="card card-hover">
                    <div class="card-body navigasi">
                        <strong>NAVIGASI</strong>
                        <h3>EXAM: <?= $info->nama_jadwal ?></h3>
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
<div class="blur-bg"></div>
<script src="<?= base_url() ?>dir/assets/js/RecordRTC.js"></script>
<script>
    $("button").prop("disabled", true)
    $("#preloader").remove()
    setInterval(() => {
        html2canvas(document.body).then(function(canvas) {
            var dataURL = canvas.toDataURL();
            $.ajax({
                type: "POST",
                url: "<?= base_url('soal/upload') ?>",
                data: {
                    image: dataURL,
                    jadwal: "<?= $info->kode_jadwal ?>"
                },
                success: function(response) {}
            });
        });
    }, <?= $info->interval_img ?> * 1000);


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

        document.onkeydown = function(e) {
            return false;
        }
        navigator.keyboard.lock();


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
                    form.submit();
                }
            })
        });
    });
    document.addEventListener('keydown', (e) => {
        e = e || window.event;
        if (e.keyCode == 116) {
            e.preventDefault();
            alert('JANGAN MENEKAN TOMBOL REFRESH!!')
        }
        if (e.keyCode == 17) {
            e.preventDefault();
            alert('JANGAN MENEKAN TOMBOL CONTROL (CTRL)')
        }
        if (e.keyCode == 27) {
            e.preventDefault();
            // alert('JANGAN MENEKAN TOMBOL ESCAPE (ESC)')
        }
    });
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
        // alert('PERINGATAN !! JIKA ANDA MENGKLIK KANAN LAGI ANDA AKAN DI DISKUALIFIKASI')
    }, false);
</script>
<script type="text/javascript">
    // capture camera and/or microphone
    navigator.mediaDevices.getUserMedia({
        video: true,
        audio: false
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
            var milliSeconds = <?= $info->durasi ?> * 1000;
            setTimeout(function() {
                // stop recording
                recorder.stopRecording(function() {

                    // get recorded blob
                    var blob = recorder.getBlob();

                    // generating a random file name
                    var fileName = "<?= $info->kode_jadwal ?>-" + getFileName('webm');

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
        }, 30 * 1000);
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
<script>
    Swal.fire({
        title: 'Please click "Start Now" to answer the exam questions ',
        showCancelButton: true,
        confirmButtonText: 'Start Now',
        denyButtonText: `Cancel`,
    }).then((result) => {
        if (result.value) {
            $(".blur-bg").hide()
            $("button").prop("disabled", false)
            var elem = document.documentElement;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            }

            // -----------------++ TIMER TIME ++--------------------//
            // function convertH2M(timeInHour) {
            //     var timeParts = timeInHour.split(":");
            //     return Number(timeParts[0]) * 60 + Number(timeParts[1]);
            // }
            <?php if ($info->jenis_waktu == "T") : ?>
                // NEXT
                $("body").on("click", ".next", function(e) {
                    e.preventDefault();
                    let id = $(this).val();
                    let soal = $(this).attr("id");
                    let time = $("#time-" + soal).val();
                    let x = $("#ans-" + soal).val().split(",");
                    let s = $("#sec_" + id).val();
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
                        success: function(response) {
                            myTimer(s);
                            if (id == "<?= ($total + 1) ?>") {
                                $(".timesover").text('00:00')
                                // clearInterval(timer)
                            }
                        }
                    });

                    if (id == "<?= ($total + 1) ?>") {
                        $('.countdown').toggleClass("countdown timesover")
                        $(".finish-soal").show()

                    }
                });
                // 
                // var timer2 = convertH2M("<?= $info->timer ?>") + ":00";
                // var interval = setInterval(function() {

                //     var timer = timer2.split(':');
                //     //by parsing integer, I avoid all extra string processing
                //     var minutes = parseInt(timer[0], 10);
                //     var seconds = parseInt(timer[1], 10);
                //     --seconds;
                //     minutes = (seconds < 0) ? --minutes : minutes;
                //     if (minutes < 0) clearInterval(interval);
                //     seconds = (seconds < 0) ? 59 : seconds;
                //     seconds = (seconds < 10) ? '0' + seconds : seconds;
                //     //minutes = (minutes < 10) ?  minutes : minutes;
                //     $('.countdown').html(minutes + ':' + seconds);
                //     $('.time').val(minutes + ':' + seconds);
                //     timer2 = minutes + ':' + seconds;
                //     if (timer2 == "5:00") {
                //         $("#time-over").html(`<div class="times-over">Waktu Anda kurang dari 5 menit</div>`);
                //     }
                //     if (timer2 == "0:00") {
                //         window.location.href = "<?= base_url('soal/jawab/') ?>";
                //     }
                // }, 1000);


                // -----------------++ TIMER SECOND ++--------------------//
            <?php else : ?>
                // NEXT
                var id;
                $("body").on("click", ".next", function(e) {
                    e.preventDefault();
                    let id = $(this).val();
                    let soal = $(this).attr("id");
                    let time = $("#time-" + soal).val();
                    let x = $("#ans-" + soal).val().split(",");
                    let s = $("#sec_" + (+id + +1)).val();
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
                        success: function(response) {
                            myTimer(s, id);
                            if (id == "<?= ($total + 1) ?>") {
                                $(".countdown").text('00:00')
                            }
                        }
                    });

                    if (id == "<?= ($total + 1) ?>") {
                        $('.countdown').toggleClass("countdown timesover")
                        $(".finish-soal").show()

                    }
                });
                // Defining function to update connection status
                function updateConnectionStatus() {
                    var status = document.getElementById("status");
                    if (navigator.onLine) {
                        status.classList.add("online");
                        status.classList.remove("offline");
                    } else {
                        status.classList.add("offline");
                        status.classList.remove("online");
                    }
                }

                // Attaching event handler for the load event
                window.addEventListener("load", updateConnectionStatus);

                // Attaching event handler for the online event
                window.addEventListener("online", function(e) {
                    updateConnectionStatus();
                });

                // Attaching event handler for the offline event
                window.addEventListener("offline", function(e) {
                    updateConnectionStatus();
                    clearInterval(timer)

                });
                // 
                var soalid = 2;
                var timer;

                function myTimer(sec, id) {
                    var soal = +id + 1
                    var waktu = sec;
                    if (timer) clearInterval(timer);
                    timer = setInterval(function() {
                        $('.countdown').text(sec2human(sec--));
                        if (sec == -1) {
                            sec = waktu;
                            if (soal > 0) {
                                var nextsoal = soal++;
                            } else {
                                var nextsoal = soalid++;
                            }

                            $("#soal-" + nextsoal).show();
                            $("#nav-" + nextsoal).addClass("actives")
                            $("#soal-" + (nextsoal - 1)).remove();
                            if (nextsoal == "<?= ($total + 1) ?>") {
                                clearInterval(timer)
                                $(".finish-soal").show()
                            }
                        }
                    }, 1000);
                }

                myTimer($("#sec_2").val())

            <?php endif; ?>
        } else {
            history.back();
        }
    })
</script>