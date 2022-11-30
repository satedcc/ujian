<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Question</a></li>
                <li class="breadcrumb-item active" aria-current="page">Question Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Question Data</h4>
    </div>
    <div>
        <a href="<?= base_url('admin/soal/tambah') ?>" class="btn btn-primary btn-sm rounded-5"><i class="fal fa-layer-plus"></i> Add Question</a>
        <a href="<?= base_url('admin/soal/import') ?>" class="btn btn-success btn-sm rounded-5"><i class="fal fa-upload"></i> Import</a>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($this->session->flashdata('message'))) : ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('message'); ?></div>
            <?php endif; ?>
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <?php if ($this->session->flashdata('notif')) : ?>
                        <script>
                            Swal.fire(
                                'Success',
                                '<?= $this->session->flashdata('notif') ?>',
                                'success'
                            )
                        </script>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/soal/checkcustom/') ?>" method="post">
                        <div class="form-group row">
                            <div class="col-2 d-flex">
                                <select name="status" id="status" class="form-control form-control-sm select2">
                                    <option value="delete">Delete</option>
                                </select>
                                <button class="ml-2 btn btn-primary btn-sm rounded-5">Update</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table stripe" id="example1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="cek_all" class="custom-control-input" id="cek_all">
                                                <label class="custom-control-label" for="cek_all"></label>
                                            </div>
                                        </th>
                                        <th>NO</th>
                                        <th>Question</th>
                                        <th>Status</th>
                                        <th>Hastag</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($soal as $s) {
                                        $status = ($s->status_soal == "aktif") ? '<a href="' . base_url('admin/soal/draf/' . $s->id_soal) . '" class="badge badge-primary rounded-50 px-2">Publish</a>' : '<a href="' . base_url('admin/soal/aktif/' . $s->id_soal) . '" class="badge badge-warning rounded-50 px-2">Draf</a>';
                                        // $jenis = 0;
                                        if ($s->jenis_soal == "E") {
                                            $jenis = '<span class="badge rounded-5 badge-primary">Easy</span>';
                                        } elseif ($s->jenis_soal == "M") {
                                            $jenis = '<span class="badge rounded-5 badge-info">Medium</span>';
                                        } elseif ($s->jenis_soal == "H") {
                                            $jenis = '<span class="badge rounded-5 badge-warning">Hard</span>';
                                        }

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
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="cek_soal[]" class="custom-control-input" id="customCheck-' . $s->id_soal . '" value="' . $s->id_soal . '">
                                                    <label class="custom-control-label" for="customCheck-' . $s->id_soal . '"></label>
                                                </div>
                                            </td>
                                            <td>' . $no++ . '</td>
                                            <td class="w-50">' . $s->soal . '</td>
                                            <td>' . $status . '</td>
                                            <td>' . $s->hastag . '</td>
                                            <td>' . $jenis . '</td>
                                            <td>' . $type . '</td>
                                            <td>' . $s->created_date . '</td>
                                            <td>
                                                <a href="' . base_url('admin/soal/edit/' . $s->id_soal) . '" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="' . base_url('admin/soal/delete/' . $s->id_soal) . '" class="badge badge-danger rounded-5 confirmDelete">Del</a>
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
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