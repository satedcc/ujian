<div id="footer">
    <a href="<?= base_url() ?>">Copyright &copy; 2022. Asuransi Astra - Asuransi Umum Terbaik</a>
</div>
</div>
<div id="loading">
    <div id="loading-body">
        <i class="fal fa-hourglass-half fa-3x" style="margin-bottom: 10px;"></i>
        <h3>Loading...</h3><span>Mohon menunggu, data anda sedang di proses</span>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("body").on("click", ".remove", function(e) {
            e.preventDefault()
            let id = $(this).parents("tr").attr("id");
            let ujian = $(this).attr("href");
            let soal = $(this).attr("data-value");
            Swal.fire({
                title: 'Are you sure to start the exam, you will not be allowed to repeat the exam again?',
                showCancelButton: true,
                confirmButtonText: 'Yes, Im ready',
                denyButtonText: `Cancel`,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: "POST",
                        url: "<?= base_url('soal/cekuser') ?>",
                        data: {
                            id: ujian,
                            soal: soal,
                        },
                        beforeSend: function() {
                            $("#loading").fadeIn("slow").html(`<div id="loading-body">
                                                                <span class="loader"></span>
                                                                <h3>Loading...</h3><span>Please wait, your data is being processed</span>
                                                            </div>`);
                        },
                        success: function(response) {
                            $("#loading div").html(response)
                        }
                    });
                }
            })

        });
        $(".fa-bars").click(function(e) {
            e.preventDefault();
            $(".cssmenu").toggleClass("show")
        });
        $("body").on("click", ".fa-times", function(e) {
            e.preventDefault();
            $("#loading").fadeOut()
        });
    });
    var myVar = setInterval(function() {
        myTimer()
    }, 1000);

    function myTimer() {
        var d = new Date();
        var t = d.toLocaleTimeString();
        document.getElementById("jam").innerHTML = t;
    }
    $(window).on("load", function() {
        $('#preloader').fadeOut(300, function() {
            /* toastr.options = {
                timeOut: 2000,
                progressBar: true,
                showMethod: "slideDown",
                hideMethod: "slideUp",
                showDuration: 200,
                hideDuration: 200
            }; */
            // toastr.success('Welcome!');
        });
    });

    function cekKoneksi() {
        setInterval(() => {
            var status = document.getElementById("status");
            $.ajax({
                url: "<?= base_url('json/get') ?>",
                context: document.body,
                error: function(jqXHR, exception) {
                    status.innerHTML = "Conection: Offline";
                    status.classList.add("offline");
                    status.classList.remove("online");
                    $(".btn-proses,.next").prop('disabled', true);
                    $(".btn-proses").text('Connection....');
                    $(".next").text('Connection....');
                    clearInterval(counter);
                },
                success: function() {
                    status.innerHTML = "Conection: Online";
                    status.classList.add("online");
                    status.classList.remove("offline");
                    $(".btn-proses,.next").prop('disabled', false);
                    $(".btn-proses").text('SUBMIT TEST');
                    $(".next").text('NEXT QUESTION');
                }
            })
        }, 1000);
    }

    function convertH2M(timeInHour) {
        var timeParts = timeInHour.split(":");
        return Number(timeParts[0]) * 60 + Number(timeParts[1]);
    }

    function sec2human(seconds) {
        sec = seconds % 60;
        min = parseInt(seconds / 60);
        if (sec.toString().length == 1) { // padding
            sec = "0" + sec;
        }
        return min + ":" + sec;
    }

    // clearInter = setInterval(function() {
    //     timerCal();
    // }, 1000);


    function timerCal() {
        //count++;
        //console.log(count);
        tempW = tempW + width;

        $('.bar').css({
            'width': tempW + '%'
        });

        if (s > 0) {
            s = s - 1;
            if (s < 10) {
                $('.second').html("0" + s);
            } else {
                $('.second').html(s);
            }


        }

        if (s == 0) {
            s = 60;
            var ss = s;

            if (xx == 0) {
                s = 59;
                ss = s;
                xx = 1;
            }
            $('.second').html(s);
            if (minute != 0) {
                minute = minute - 1;
                if (minute < 10) {
                    $('.minute').html("0" + minute);
                } else {
                    $('.minute').html(minute);
                }
            } else {
                if (h != 0) {
                    h = h - 1;
                    minute = 59;
                    $('.minute').html(minute);

                    $('.hour').html(h);
                } else {
                    //alert('sdfs')
                    $('.second').html('00');
                    window.location.href = "<?= base_url('soal/jawab/') ?>";
                    clearInterval(clearInter);
                }
            }
        }
    }
</script>

<?php if (isset($info->jenis_waktu)) : ?>
    <?php if ($info->jenis_waktu == "T") : ?>
        <script>
            $(".countdown").html('<span class="hour">00</span>:<span class="minute">00</span>:<span class="second">00</span>');
            var m = convertH2M("<?php echo $info->timer ?>"); //define your minute
            var s = 0;
            var h;
            var xx = 0;
            var width = 100 / (m * 60);
            //var count=0;
            var clearInter;
            var tempW = 0;

            //s=$('.second').html();
            // m=$('.minute').html();
            minute = m % 60;
            h = Math.floor(m / 60);


            $('.hour').html(h);
            $('.minute').html(minute);
            $(document).ready(function() {

                setInterval(() => {
                    var status = document.getElementById("status");

                    $.ajax({
                        url: "<?= base_url('json/get') ?>",
                        context: document.body,
                        error: function(jqXHR, exception) {
                            status.innerHTML = "Connection: Offline";
                            status.classList.add("offline");
                            status.classList.remove("online");
                            $(".btn-proses,.next").prop('disabled', true);
                            $(".btn-proses").text('Connection....');
                            $(".next").text('Connection....');
                            clearInterval(clearInter);
                        },
                        success: function() {
                            status.innerHTML = "Connection: Online";
                            status.classList.add("online");
                            status.classList.remove("offline");
                            $(".btn-proses,.next").prop('disabled', false);
                            $(".btn-proses").text('SUBMIT TEST');
                            $(".next").text('NEXT QUESTION');
                            timerCal()
                        }
                    })
                }, 1000);
            });
        </script>
    <?php else : ?>
        <script>
            cekKoneksi();
        </script>
    <?php endif; ?>
<?php else : ?>
    <script>
        cekKoneksi();
    </script>
<?php endif; ?>


</body>

</html>