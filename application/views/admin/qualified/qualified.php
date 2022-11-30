<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Qualified</a></li>
                <li class="breadcrumb-item active" aria-current="page">Qualified Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Qualified Data</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-8">
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
                    <div class="table-responsive">
                        <table class="table stripe hover" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Qualified Code </th>
                                    <th>Qualified Name</th>
                                    <th>Quota</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($qualified as $a) {
                                    $status = ($a->status_qualified == "Y") ? '<a href="' . base_url('admin/required/draf/' . $a->id_qua) . '" class="badge badge-primary rounded-50 px-2">Publish</a>' : '<a href="' . base_url('admin/required/aktif/' . $a->id_qua) . '" class="badge badge-warning rounded-50 px-2">Not Active</a>';
                                    echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $a->code_qualified . '</td>
                                            <td>' . $a->nama_qualified . '</td>
                                            <td>' . $a->kuota . '</td>
                                            <td>' . $status . '</td>
                                            <td>
                                                <a href="' . base_url('admin/required/edit/' . $a->id_qua) . '" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="' . base_url('admin/required/delete/' . $a->id_qua) . '" class="badge badge-danger rounded-5 confirmDelete">Del</a>
                                            </td>
                                        </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-hover card-task-one">
                <div class="card-header py-2 bg-primary text-white">
                    Qualified Form
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/required/save/') ?>" method="post">
                        <div class="form-group row mb-2">
                            <label for="qualified" class="col-sm-12 font-weight-bold">Qualified Code</label>
                            <div class="col-12">
                                <input type="text" required class="form-control" id="code" name="code" placeholder="qualified code" value="<?php if (isset($row)) echo $row->code_qualified ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="qualified" class="col-sm-12 font-weight-bold">Qualified Name</label>
                            <div class="col-12">
                                <input type="text" required class="form-control" id="qualified" name="qualified" placeholder="qualified" value="<?php if (isset($row)) echo $row->nama_qualified ?>">
                                <input type="text" hidden id="id" name="id" value="<?php if (isset($row)) echo $row->id_qua ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kuota" class="col-sm-12 font-weight-bold">Quota</label>
                            <div class="col-12">
                                <input type="number" required class="form-control" min="1" id="quota" name="kuota" placeholder="kuota" value="<?php if (isset($row)) echo $row->kuota ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="status" class="col-sm-12 font-weight-bold">Exam Status</label>
                            <div class="col-12">
                                <select name="status" id="status" class="form-control select2">
                                    <?php if (isset($row)) : ?>
                                        <option <?php if ($row->status_qualified == 'Y') echo 'selected'; ?> value="Y">Active</option>
                                        <option <?php if ($row->status_qualified == 'N') echo 'selected'; ?> value="N">Disabled</option>
                                    <?php else : ?>
                                        <option value="Y">Active</option>
                                        <option value="N">Disabled</option>
                                    <?php endif; ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <div class="col-12">
                                <button class="btn btn-sm btn-primary rounded-5">Save</button>
                                <button type="reset" class="btn btn-sm btn-dark rounded-5">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>