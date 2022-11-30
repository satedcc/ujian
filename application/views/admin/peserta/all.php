<div class="table-responsive">
    <table class="table stripe table-default hover">
        <thead>
            <tr>
                <th>NO</th>
                <th>Regis ID</th>
                <th>Name</th>
                <th>Qualified</th>
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
            foreach ($peserta as $p) {
                echo '<tr>
                        <td>' . $no++ . '</td>
                        <td>' . $p->no_regist . '</td>
                        <td>' . $p->nama_lengkap . '</td>
                        <td>' . $p->nama_qualified . '</td>
                        <td class="text-center">
                            <input type="text" name="idjadwal[]" value="' . $id . '" hidden>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="cek_regis[]" class="custom-control-input" id="customCheck-' . $p->id_regis . '" value="' . $p->id_regis . '">
                                <label class="custom-control-label" for="customCheck-' . $p->id_regis . '"></label>
                            </div>
                        </td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        var table = $('.table-default').DataTable({
            "pageLength": 150,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [-1, 0]
                },
                {
                    "searchable": false,
                    "targets": [-1, 0]
                }
            ]
        });

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });
        $('body').on('submit', '#form', function(e) {
            e.preventDefault();
            var data = table.$('input').serialize();
            $.ajax({
                method: 'POST',
                url: '<?= base_url('admin/jadwal/addpartisipant/') ?>',
                data: data,
                success: function(data) {
                    Swal.fire(
                        'Success',
                        'Add Partisipant Success',
                        'success'
                    ).then(function() {
                        window.location = "../jadwal/";
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