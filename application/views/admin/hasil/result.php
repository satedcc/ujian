<?php if (isset($jawaban)) : ?>
    <div class="detail-profile">
        <div class="profile">
            <div class="avatar avatar-xl"><img src="http://localhost/exam/profile/20220822030336-img_avatar.png" class="rounded-circle" alt=""></div>
            <div>
                <h4 class="m-0"><?= $row->nama_lengkap ?></h4>
                <div><small><strong><i class="far fa-user" style="width: 15px;"></i> <?= $row->no_regist ?></strong></small></div>
                <div><small><strong><i class="far fa-phone" style="width: 15px;"></i> <?= $row->nomor_peserta ?></strong></small></div>
            </div>
        </div>
        <ul>
            <li class="bg-primary">
                <p class="m-0">Answered</p>
                <h2 class="m-0"><?= $nilai->jml ?></h2>
            </li>
            <li class="bg-info">
                <p class="m-0">True</p>
                <h2 class="m-0"><?= ($nilai->benar + $nilai->benar_essay) ?></h2>
            </li>
            <li class="bg-danger">
                <p class="m-0">False</p>
                <h2 class="m-0"><?= ($nilai->salah + $nilai->salah_essay) ?></h2>
            </li>
            <li class="bg-success">
                <p class="m-0">Point</p>
                <h2 class="m-0">
                    <?php
                    $benar = ($nilai->benar * 4);
                    $salah = ($nilai->salah);
                    echo $benar - $salah;
                    ?>
                </h2>
            </li>
        </ul>
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
            $no = 1;
            foreach ($jawaban as $j) {
                $benar = ($j->jawaban == $j->soal_jawaban) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>';
                $essay = ($j->type_soal == "3") ? '<a href="' . base_url('admin/jadwal/true/' . $j->id_jawab) . '" class="badge badge-primary">True</a> <a href="' . base_url('admin/jadwal/false/' . $j->id_jawab) . '" class="badge badge-warning">false</a>' : $benar;
                // $status = ($j->status_jawaban == "true") ? $benar : $essay;

                if ($j->type_soal == "3") {
                    if ($j->status_jawaban == "") {
                        $status = '<a href="' . base_url('admin/jadwal/true/' . $j->id_jawab) . '" class="badge badge-primary">True</a> <a href="' . base_url('admin/jadwal/false/' . $j->id_jawab) . '" class="badge badge-warning">false</a>';
                    } else {
                        if ($j->status_jawaban == "true") {
                            $status = '<span class="badge badge-success">True</span>';
                        } else {
                            $status = '<span class="badge badge-danger">False</span>';
                        }
                    }
                } else {
                    if ($j->jawaban == $j->soal_jawaban) {
                        $status = '<span class="badge badge-success">True</span>';
                    } else {
                        $status = '<span class="badge badge-danger">False</span>';
                    }
                }

                echo '<tr>
                                        <td>' . $no++ . '</td>
                                        <td class="w-50">' . $j->soal . '</td>
                                        <td>' . $j->jawaban . '</td>
                                        <td>' . $j->soal_jawaban . '</td>
                                        <td>' . $status . '</td>
                                    </tr>';
            }
            ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="alert alert-warning text-center">
        <h4>Data Tidak di temukan</h4>
        <span>Data partisipant tidak di temukan</span>
    </div>
<?php endif; ?>