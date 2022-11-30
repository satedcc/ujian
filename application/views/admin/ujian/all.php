<div class="table-responsive">
    <table class="table stripe table-default">
        <thead>
            <tr>
                <th>NO</th>
                <th>Question</th>
                <th>Status</th>
                <th>Category</th>
                <th>Type</th>
                <th>Hastag</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($soal as $s) {
                $status = ($s->status_soal == "aktif") ? '<span class="badge badge-primary rounded-50 px-2">Publish</span>' : '<span class="badge badge-warning rounded-50 px-2">Draf</span>';
                // $jenis = 0;
                if (isset($s->jenis_soal)) {
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
                            <td>' . $no++ . '</td>
                            <td class="w-50">' . $s->soal . '</td>
                            <td>' . $status . '</td>
                            <td>' . $jenis . '</td>
                            <td>' . $type . '</td>
                            <td>' . $s->hastag . '</td>
                            <td>' . $s->created_date . '</td>
                            <td>
                                <a href="' . base_url('admin/ujian/deletedetail/' . $s->id_detail) . '" class="badge badge-danger rounded-5">Del</a>
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
            "pageLength": 25,
        });

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });
    });
</script>