<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Information</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Information</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Form Information</h4>
    </div>

</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/informasi/save/') ?>" method="post">
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2 col-form-label font-weight-bold">Title</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="judul" name="judul" placeholder="information title" value="<?php if (isset($row)) echo $row->title_info ?>">
                                <input type="text" id="id" name="id" value="<?php if (isset($row)) echo $row->id_info ?>" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2 col-form-label font-weight-bold">Description</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" required id="deskripsi" cols="30" rows="10"><?php if (isset($row)) echo $row->deskripsi ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold"></label>
                            <div class="col-sm-10">
                                <a href="#modal2" class="btn btn-primary rounded-5" data-toggle="modal">Confirm</a>
                                <button type="button" onclick="history.back()" class="btn btn-dark rounded-5">Back</button>
                            </div>
                        </div>
                        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel2">Confrim</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i data-feather="x"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mg-b-0">Do you want save this data ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        <button class="btn btn-dark btn-sm">Yes, Save Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('deskripsi');
</script>