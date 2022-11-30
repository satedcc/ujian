<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Result</a></li>
                <li class="breadcrumb-item active" aria-current="page">Result Data Exam</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Result Data Exam</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <?php if (isset($jawaban)) : ?>
                        <div class="detail-profile">
                            <div class="profile">
                                <div class="avatar avatar-xl">
                                    <?php
                                    $path = base_url('profile/');
                                    if (@getimagesize($path . $row->file_photo)) : ?>
                                        <img src="<?= base_url() ?>profile/<?= $row->file_photo ?>" class="rounded-circle" alt="<?= $row->file_photo ?>">
                                    <?php else : ?>
                                        <img src="<?= base_url() ?>profile/user.png" class="rounded-circle" alt="user.png">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h4 class="m-0"><?= $row->nama_lengkap ?></h4>
                                    <div><small><strong><i class="far fa-user" style="width: 15px;"></i> <?= $row->no_regist ?></strong></small></div>
                                    <div><small><strong><i class="far fa-phone" style="width: 15px;"></i> <?= $row->nomor_peserta ?></strong></small></div>
                                </div>
                            </div>
                            <div class="result-exam">
                                <ul>
                                    <li class="bg-warning">
                                        <p class="m-0">Min Score</p>
                                        <h2 class="m-0"><?= $jadwal->score ?></h2>
                                    </li>
                                    <li class="bg-primary">
                                        <p class="m-0">Answered</p>
                                        <h2 class="m-0"><?= $nilai->jml - $nilai->pass ?></h2>
                                    </li>
                                    <li class="bg-info">
                                        <p class="m-0">True</p>
                                        <h2 class="m-0"><?= ($nilai->benar + $nilai->benar_essay) ?></h2>
                                    </li>
                                    <li class="bg-danger">
                                        <p class="m-0">False</p>
                                        <h2 class="m-0"><?= ($nilai->jml - $nilai->pass) - ($nilai->benar + $nilai->benar_essay) ?></h2>
                                    </li>
                                    <li class="bg-success">
                                        <p class="m-0">Point</p>
                                        <h2 class="m-0">
                                            <?php
                                            $benar = ($nilai->benar + $nilai->benar_essay) * $jadwal->nilai_benar;
                                            $salah = (($nilai->jml - $nilai->pass) - ($nilai->benar + $nilai->benar_essay)) * $jadwal->nilai_salah;
                                            echo $benar - $salah;
                                            ?>
                                        </h2>
                                    </li>
                                </ul>
                                <?php if (($nilai->jml - $nilai->pass) > 0) : ?>
                                    <?php if (($benar - $salah) > $jadwal->score) : ?>
                                        <div class="bg-success rounded-5 mt-2 text-center p-2">
                                            <h5 class="text-white m-0">SUCCESFULLY</h5>
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-danger rounded-5 mt-2 text-center p-2">
                                            <h5 class="text-white m-0">FAIL</h5>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div class="bg-warning rounded-5 mt-2 text-center p-2">
                                        <h5 class="text-white m-0">NOT STARTED</h5>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <table class="table stripe" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Final Answer</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $participan = $this->db->query("SELECT * FROM ex_jawaban WHERE id_regis=' $row->id_regis' AND id_jadwal='$jadwal->id_jadwal'")->num_rows();
                                if ($participan > 0) {
                                    $no = 1;
                                    $soal = $this->db->query("SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE a.id_ujian='$jadwal->id_kategori'")->result();
                                    foreach ($soal as $j) {
                                        $jawab = $this->db->query("SELECT * FROM ex_jawaban WHERE id_soal='$j->id_soal' AND id_regis='$row->id_regis' AND id_jadwal='$jadwal->id_jadwal'")->row();
                                        if (isset($jawab)) {
                                            $ans = $jawab->jawaban;
                                        } else {
                                            $ans = "0";
                                        }

                                        // $benar = ($jawab->jawaban == $j->soal_jawaban) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>';
                                        // $essay = ($j->type_soal == "3") ? '<a href="' . base_url('admin/jadwal/true/' . $jawab->id_jawab) . '" class="badge badge-primary">True</a> <a href="' . base_url('admin/jadwal/false/' . $jawab->id_jawab) . '" class="badge badge-warning">false</a>' : $benar;
                                        // $status = ($jawab->status_jawaban == "true") ? $benar : $essay;

                                        if ($j->type_soal == "3") {
                                            if (empty($jawab->status_jawaban)) {
                                                if ($ans == '0') {
                                                    $status = '<span class="badge badge-info">SKIP</span>';
                                                } else {
                                                    $status = '<a href="' . base_url('admin/jadwal/true/' . $jawab->id_jawab) . '" class="badge badge-primary">True</a> <a href="' . base_url('admin/jadwal/false/' . $jawab->id_jawab) . '" class="badge badge-warning">false</a>';
                                                }
                                            } else {
                                                if ($jawab->status_jawaban == "true") {
                                                    $status = '<span class="badge badge-success">True</span>';
                                                } else {
                                                    $status = '<span class="badge badge-danger">False</span>';
                                                }
                                            }
                                        } else {
                                            if ($ans == "0") {
                                                $status = '<span class="badge badge-info">SKIP</span>';
                                            } else {
                                                if ($j->soal_jawaban == $jawab->jawaban) {
                                                    $status = '<span class="badge badge-success">True</span>';
                                                } else {
                                                    $status = '<span class="badge badge-danger">False</span>';
                                                }
                                            }
                                        }




                                        if (!empty(($j->jenis_media))) {
                                            if ($j->jenis_media == "MP4" || $j->jenis_media == "mp4" || $j->jenis_media == "MPEG" || $j->jenis_media == "MKV" || $j->jenis_media == "mkv") {
                                                $media =  "<video controls style='width:300px;'>
                                                    <source src='" . base_url() . "dir/assets/img/$j->media_file' type='video/mp4'>
                                                    Your browser does not support the video tag.
                                                </video>";
                                            } elseif ($j->jenis_media == "JPG" || $j->jenis_media == "jpg" || $j->jenis_media == "PNG" || $j->jenis_media == "png" || $j->jenis_media == "JPEG") {
                                                $media = "<img style='width:300px;' src='" . base_url() . "dir/assets/img/$j->media_file'>";
                                            }
                                        } else {
                                            $media = false;
                                        }
                                        echo '<tr>
                                            <td>' . $no++ . '</td>
                                                <td class="w-50">
                                                ' . $j->soal . '
                                                ' . $media . '
                                            </td>
                                            <td>' . $j->soal_jawaban . '</td>
                                            <td>' . nl2br($ans) . '</td>
                                            <td>' . $status . '</td>
                                        </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="alert alert-warning text-center">
                            <h4>Data Tidak di temukan</h4>
                            <span>Data participant tidak di temukan</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#example1').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    });
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity
    });
</script>