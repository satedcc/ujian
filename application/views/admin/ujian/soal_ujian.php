<div class="table-responsive">
    <table class="table stripe table-default" id="example">
        <thead>
            <tr>
                <th>Question</th>
                <th>Category</th>
                <th>Type</th>
                <th>Status</th>
                <th>Hastag</th>
                <th class="text-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="cek_all" class="custom-control-input" id="cek_all">
                        <label class="custom-control-label" for="cek_all"></label>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($soal as $s) {
                $status = ($s->status_soal == "aktif") ? '<a href="" class="badge badge-primary rounded-50 px-2">Publish</a>' : '<a href="" class="badge badge-warning rounded-50 px-2">Draf</a>';
                // $jenis = 0;
                if (isset($s->jenis_soal)) {
                    $jenis = "";
                    if ($s->jenis_soal == "E") {
                        $jenis = '<span class="badge rounded-5 badge-primary">Easy</span>';
                    } elseif ($s->jenis_soal == "M") {
                        $jenis = '<span class="badge rounded-5 badge-info">Medium</span>';
                    } elseif ($s->jenis_soal == "H") {
                        $jenis = '<span class="badge rounded-5 badge-warning">Hard</span>';
                    }
                }

                // $type = 0;
                if (isset($s->type_soal)) {
                    if ($s->type_soal == "1") {
                        $type = '<span class="badge rounded-5 badge-primary-light">Multiple Thoice</span>';
                    } elseif ($s->type_soal == "2") {
                        $type = '<span class="badge rounded-5 badge-danger-light">True False</span>';
                    } elseif ($s->type_soal == "3") {
                        $type = '<span class="badge rounded-5 badge-warning-light">Essay</span>';
                    }
                }
                echo '<tr>
                            <td class="w-50">' . $s->soal . '</td>
                            <td>' . $jenis . '</td>
                            <td>' . $type . '</td>
                            <td>' . $status . '</td>
                            <td>' . $s->hastag . '</td>
                            <td class="text-center">
                                <input type="text" name="idsoal[]" value="' . $id . '" hidden>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="cek_soal[]" class="custom-control-input" id="customCheck-' . $s->id_soal . '" value="' . $s->id_soal . '">
                                    <label class="custom-control-label" for="customCheck-' . $s->id_soal . '"></label>
                                </div>
                            </td>
                        </tr>';
                // }
            }
            ?>
        </tbody>
        <tfoot>
            <th>Question</th>
            <th>Category</th>
            <th>Type</th>
            <th>Status</th>
            <th>Hastag</th>
            <th></th>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function() {
        // var table = $('.table-default').DataTable({
        //     "pageLength": 50,
        //     "columnDefs": [{
        //             "orderable": false,
        //             "targets": [-1, 0]
        //         },
        //         {
        //             "searchable": false,
        //             "targets": [-1, 0]
        //         }
        //     ]
        // });

        // Setup - add a text input to each footer cell
        $('#example tfoot th:eq(1),#example tfoot th:eq(2),#example tfoot th:eq(3),#example tfoot th:eq(4)').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        // DataTable
        var table = $('#example').DataTable({
            "pageLength": 50,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [-1, 0]
                },
                {
                    "searchable": false,
                    "targets": [-1, 0]
                }
            ],
            initComplete: function() {
                // Apply the search
                this.api()
                    .columns()
                    .every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
            },
        });

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });
        $('body').on('submit', '#form', function(e) {
            e.preventDefault();
            var data = table.$('input').serialize();
            $.ajax({
                method: 'POST',
                url: '<?= base_url('admin/ujian/soal/') ?>',
                data: data,
                success: function(data) {
                    Swal.fire(
                        'Success',
                        'Question successfully added',
                        'success'
                    ).then(function() {
                        window.location = "<?= base_url('admin/ujian') ?>";
                    });
                }
            });

        });
        $('body').on('click', '#cek_all', function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
</script>