<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Information</a></li>
                <li class="breadcrumb-item active" aria-current="page">Information Data</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Information Data</h4>
    </div>
    <a href="<?= base_url('admin/informasi/tambah') ?>" class="btn btn-primary btn-sm rounded-5"><i class="far fa-user-plus"></i> Add Information</a>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <?php if ($this->session->flashdata('notif')) : ?>
                        <script>
                            Swal.fire(
                                'Suksess',
                                '<?= $this->session->flashdata('notif') ?>',
                                'success'
                            )
                        </script>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table stripe" id="example1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($info as $i) {
                                    echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $i->title_info . '</td>
                                            <td>' . $i->deskripsi . '</td>
                                            <td>' . $i->status_info . '</td>
                                            <td>' . $i->created_date . '</td>
                                            <td>
                                                <a href="' . base_url('admin/informasi/edit/' . $i->id_info) . '" class="badge badge-primary rounded-5">Edit</a>
                                                <a href="' . base_url('admin/informasi/delete/' . $i->id_info) . '" class="badge badge-danger rounded-5">Del</a>
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
    </div>
</div>