</div><!-- content -->

<script src="<?= base_url() ?>dir/lib/jqueryui/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>dir/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>dir/lib/feather-icons/feather.min.js"></script>
<script src="<?= base_url() ?>dir/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>dir/lib/js-cookie/js.cookie.js"></script>

<script src="<?= base_url() ?>dir/assets/js/cassie.js"></script>
<script src="<?= base_url() ?>dir/assets/js/flot.sampledata.js"></script>
<script src="<?= base_url() ?>dir/lib/select2/js/select2.min.js"></script>

<script src="<?= base_url() ?>dir/lib/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>dir/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="<?= base_url() ?>dir/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>dir/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
<script src="<?= base_url() ?>dir/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url() ?>dir/assets/js/ekko-lightbox.min.js"></script>
<script src="<?= base_url() ?>dir/assets/js/bs-custom-file-input.min.js"></script>
<script>
    base_url = window.location.origin;
    $(document).ready(function() {
        $(window).on("load", function() {
            $("#preloader").fadeOut("slow");
        });
    });
    // Adding placeholder for search input
    (function($) {
        $("body").on("click", ".typesoal", function(e) {
            let id = $(this).val();
            if (id == "1") {
                $(".ganda").prop("disabled", false);
                $(".truefalse").prop("disabled", true);
            } else if (id == "2") {
                $(".ganda").prop("disabled", true);
                $(".truefalse").prop("disabled", false);
            } else {
                $(".ganda").prop("disabled", true);
                $(".truefalse").prop("disabled", true);
            }
        });
        'use strict'

        bsCustomFileInput.init()
        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
            searchInputPlaceholder: ''
        });

        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

        var _renderSearchDropdown = SearchDropdown.prototype.render;

        SearchDropdown.prototype.render = function(decorated) {

            // invoke parent method
            var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

            this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

            return $rendered;
        };

    })(window.jQuery);


    $(function() {
        'use strict'

        // Basic with search
        $('.select2,.select3').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search options'
        });

        // Disable search
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one'
        });

        // Clearable selection
        $('.select2-clear').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one',
            allowClear: true
        });

        // Limit selection
        $('.select2-limit').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one',
            maximumSelectionLength: 2
        });
        // card-calendar-one widget
        $('#datepicker1').datepicker({
            showOtherMonths: true
        });
        $('#example1').DataTable({
            "pageLength": 25,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });
        $('.table-default').DataTable({
            "pageLength": 25,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });
        $("body").on("click", ".btn-hasil", function(e) {
            e.preventDefault();
            let id = $(this).attr("data-value");
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/test/hasil') ?>",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#hasil").html(response)
                }
            });
        });
        $("body").on("click", ".add-soal", function(e) {
            e.preventDefault();
            let id = $(this).attr("data-value");
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/ujian/soal_ujian') ?>",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#soal-ujian").html(response)
                    $("#btn-submit").removeClass("d-none");
                }
            });
        });
        $("body").on("click", ".add-partisipant", function(e) {
            e.preventDefault();
            let id = $(this).attr("data-value");
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/peserta/all') ?>",
                data: {
                    id: id
                },
                success: function(response) {
                    $("form").attr("id", "form")
                    $("#viewall").html(response)
                    $(".modal-footer .btn-primary").show()
                }
            });
        });
        $("body").on("click", ".view-question", function(e) {
            e.preventDefault();
            let id = $(this).attr("data-value");
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/ujian/view_soal') ?>",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#soal-ujian").html(response);
                    $("#btn-submit").addClass("d-none");
                }
            });
        });
        $("body").on("click", ".media", function(e) {
            $.ajax({
                url: "<?= base_url('admin/soal/icon') ?>",
                success: function(response) {
                    $("#icon-list ul").html(response)
                    $("#modal2").modal("show")
                }
            });
        });
        $("body").on("click", ".media-group", function(e) {
            $(".media-group input").prop("disabled", false)
        });
        $("body").on("click", ".list-img input", function(e) {
            let id = $(this).val()
            $(".media").val(id);
            $(".previewmedia").show();
            var file = id.split(".");
            if (file[1] == "jpg" || file[1] == "png") {
                $(".preview").html('<img src="<?= base_url() ?>dir/assets/img/' + id + '" class="w-50">')
            } else {
                $(".preview").html(`<video controls class="w-50">
                                            <source src='<?= base_url() ?>dir/assets/img/` + id + `' type='video/mp4'>
                                            Your browser does not support the video tag.
                                        </video>`)
            }
        });
        $("body").on("click", ".all-partisipant", function(e) {
            let id = $(this).attr("data-value");
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/jadwal/allpartisipant') ?>",
                data: {
                    id: id
                },
                success: function(response) {
                    $("#viewall").html(response);
                    $("form").attr("id", "form-disabled")
                }
            });
        });
        // TIMER CHOOSE
        $("select#timer").change(function() {
            var id = $(this).children("option:selected").val();
            if (id == "S") {
                $(".secontime").show();
                $(".secontime input").prop("disabled", false);
                $(".secontime input").val("00:00:01");
                $(".examtime").hide();
                $(".examtime input").prop("disabled", true);
            } else {
                $(".secontime").hide()
                $(".secontime input").prop("disabled", true);
                $(".examtime").show();
                $(".examtime input").prop("disabled", false);
            }
        });
        // SUMSOAL
        $("body").on("keyup", ".typesoal", function(e) {
            let no = $(this).val();
            let total = +$("#mudah").val() + +$("#medium").val() + +$("#susah").val()
            let type = $(this).attr("id")
            let ujian = $("#kategori").val();
            $("#totalsoal").val(total);
            $("#jmltype").val();

            if (total != $("#jmltype").val()) {
                $(".message-type").html(`<div class="alert alert-danger">The number of types of questions is not the same as the number of questions that have been determined</div>`)
            } else {
                $(".message-type").html('')
            }

            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/soal/cektype') ?>",
                data: {
                    no: no,
                    ujian: ujian,
                    type: type
                },
                success: function(response) {
                    $(".message-error").html(response)
                }
            });
        });
        $("select#kategori").change(function() {
            var id = $(this).children("option:selected").val();
            $.ajax({
                method: "POST",
                url: "<?= base_url('admin/soal/totalsoal/') ?>",
                data: {
                    id
                },
                success: function(response) {
                    let x = response.split(",");
                    $("#mudah").val(x[0])
                    $("#medium").val(x[1])
                    $("#susah").val(x[2])
                    $("#total_ganda").val(x[3])
                    $("#total_pernyataan").val(x[4])
                    $("#total_easy").val(x[5])
                    $("#totalsoal").val(+x[0] + +x[1] + +x[2])
                    $("#jmltype").val(+x[3] + +x[4] + +x[5])
                }
            });
        });
        $("body").on("click", ".confirmDelete", function(e) {
            e.preventDefault()
            var id = $(this).parents("tr").attr("id");
            Swal.fire({
                title: 'Are sure to delete this data ?',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete Now!',
                denyButtonText: `Cancel`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    document.location.href = $(this).attr("href");
                }
            })
        });
        $("body").on("click", "input[type='search']", function(e) {
            e.preventDefault()
            $("body").toggleClass("toggle-sidebar")
        });
    });

    $(function() {

        'use strict'

        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

        if (!Cookies.get('theme-skin')) {
            $('#defaultTheme').addClass('theme-selected');
        }

        $('.card-theme').on('click', function(e) {
            $('.card-theme').removeClass('theme-selected');
            $(this).addClass('theme-selected');

            var skin = $(this).attr('data-title');

            if (skin === 'default') {
                $('#themeSkin').remove();
                Cookies.remove('theme-skin');
            } else {

                if ($('#themeSkin').length === 0) {
                    $('head').append('<link id="themeSkin" rel="stylesheet" href="<?= base_url() ?>dir/assets/css/skin.' + skin + '.css">')
                } else {
                    $('#themeSkin').attr('href', '<?= base_url() ?>dir/assets/css/skin.' + skin + '.css');
                }

                Cookies.set('theme-skin', skin);
            }
        })

        var skinParam = getUrlParameter('skin');
        if (skinParam.length) {
            $('.card-theme').removeClass('theme-selected');
            $('.card-theme[data-title="' + skinParam + '"]').addClass('theme-selected');

            if (skinParam === 'default') {
                $('#themeSkin').remove();
                Cookies.remove('theme-skin');
            } else {

                if ($('#themeSkin').length === 0) {
                    $('head').append('<link id="themeSkin" rel="stylesheet" href="<?= base_url() ?>dir/assets/css/skin.' + skinParam + '.css">')
                } else {
                    $('#themeSkin').attr('href', '<?= base_url() ?>dir/assets/css/skin.' + skinParam + '.css');
                }

                Cookies.set('theme-skin', skinParam);
            }
        }
    })
    $(function() { // Dropdown toggle
        $('.menu-toggle').click(function() {
            event.preventDefault()
            $(this).next('.dropdown').fadeToggle();
        });

        $(document).click(function(e) {
            var target = e.target;
            if (!$(target).is('.menu-toggle') && !$(target).parents().is('.menu-toggle'))
            //{ $('.dropdown').hide(); }
            {
                $('.dropdown').slideUp();
            }
        });
    });
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
    $(function() {
        'use strict'

        $('[data-toggle="tooltip"]').tooltip()

        $('.component-section .btn-primary').tooltip({
            template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        })

        $('.component-section .btn-secondary').tooltip({
            template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        })

        $('.component-section .btn-success').tooltip({
            template: '<div class="tooltip tooltip-success" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        })

        $('.component-section .btn-danger').tooltip({
            template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        })


    });
</script>
<script>
    jQuery.strength = function(element, password) {
        var desc = [{
            'width': '0px'
        }, {
            'width': '20%'
        }, {
            'width': '40%'
        }, {
            'width': '60%'
        }, {
            'width': '80%'
        }, {
            'width': '100%'
        }];
        var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];
        var score = 0;

        //Jika Password Lebih Dari 6 Karakter Tambah Skor
        if (password.length > 6) {
            score++;
        }

        //Jika Password Terdapat Huruf Kecil dan Besar Tambah Skor
        if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))) {
            score++;
        }


        //Jika Password Terdiri dari Angka
        if (password.match(/\d+/)) {
            score++;
        }

        //Jika Password Terdapat Simbol
        if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
            score++;
        }

        //Jika Password Lebih dari 10 Karakter  
        if (password.length > 10) {
            score++;
        }

        element.removeClass(descClass[score - 1]).addClass(descClass[score]).css(desc[score]);
    };

    jQuery(function() {
        jQuery("#password").keyup(function() {
            jQuery.strength(jQuery("#progress-bar"), jQuery(this).val());
        });
    });
</script>
</body>

</html>