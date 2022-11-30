<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Log Exam</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Log Exam</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Data Log Exam</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Log Capture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Log Record</a>
                        </li>
                    </ul>
                    <div class="tab-content bd bg-white bd-t-0 pd-20" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <ul class="log">
                                <?php
                                foreach ($log as $f) {
                                    $name = explode("-", $f->name_log);
                                    if ($name[1] == $jadwal->kode_jadwal) {
                                        echo "<li>
                                        <a href='" . base_url() . "dir/exam-picture/$id-$jadwal->kode_jadwal-$name[2]' data-toggle='lightbox' data-gallery='gallery'>
                                            <img loading='lazy' src='" . base_url() . "dir/exam-picture/$id-$jadwal->kode_jadwal-$name[2]'>
                                            <p><small>$f->created_date</small></p>
                                        </a>

                                    </li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <ul class="log">
                                <?php
                                foreach ($vid as $v) {
                                    $name = explode("-", $v->name_log);
                                    if ($name[1] == $jadwal->kode_jadwal) {
                                        echo "<li>
                                                <video controls>
                                                    <source src='" . base_url() . "dir/record/$id-$jadwal->kode_jadwal-$name[2]-$name[3]-$name[4]' type='video/webm'>
                                                    <source src='" . base_url() . "dir/record/$id-$jadwal->kode_jadwal-$name[2]-$name[3]-$name[4]' type='video/mp4'>
                                                    Your browser does not support the video tag.
                                                </video>
                                                <p><small>$v->created_date</small></p>
                                            </li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>