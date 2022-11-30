<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Login History</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Login History</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Data Login History <?= $row->nama_lengkap ?></h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-hover card-task-one mb-3">
                <div class="card-header py-2 bg-primary text-white">
                    <span class="m-0">Log Login</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table stripe" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Login Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($history as $h) {
                                    if ($h->status_login == "success") {
                                        $status = '<span class="badge badge-success rounded-5">' . $h->status_login . '</span>';
                                    } elseif ($h->status_login == "failid") {
                                        $status = '<span class="badge badge-danger rounded-5">' . $h->status_login . '</span>';
                                    } elseif ($h->status_login == "disabled") {
                                        $status = '<span class="badge badge-warning rounded-5">' . $h->status_login . '</span>';
                                    } elseif ($h->status_login == "activate") {
                                        $status = '<span class="badge badge-info rounded-5">' . $h->status_login . '</span>';
                                    }
                                    echo '<tr>
                                    <td>' . $no++ . '</td>
                                    <td>' . $h->time_login . '</td>
                                    <td>' . $status . '</td>
                                </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-hover card-task-one mb-3">
                <div class="card-header py-2 bg-dark text-white">
                    <span class="m-0">Log Email</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary table-hover table-striped mg-b-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Log</th>
                                    <th>Status</th>
                                    <th>Email Send</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $log = $this->db->query("SELECT * FROM ex_log_email WHERE email_log='$row->email_peserta'")->result();
                                $no = 1;
                                foreach ($log as $l) {
                                    if ($l->status == "Success") {
                                        $status = '<span class="badge badge-success rounded-5">' . $l->status . '</span>';
                                    } else {
                                        $status = '<span class="badge badge-danger rounded-5">' . $l->status . '</span>';
                                    }
                                    echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $l->email_log . '</td>
                                            <td>' . $l->log_name . '</td>
                                            <td>' . $status . '</td>
                                            <td>' . $l->email_send . '</td>
                                            <td>' . $l->created_date . '</td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>