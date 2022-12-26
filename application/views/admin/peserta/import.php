<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/peserta/') ?>">Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import Participant</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Import Participant</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="message-error"></div>
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/peserta/upload/') ?>" method="post" enctype="multipart/form-data">
                        <div class="Gambar">
                            <h5>Import Participant</h5>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <small>The file format for importing question data is in <strong>.xlxs</strong> or <strong>.csv</strong> format</small>. <a href="<?= base_url('format_partisipant.xlsx') ?>" class="badge badge-primary rounded-5">Download Format</a>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded-5">Import Now</button>
                        <button type="reset" class="btn btn-dark rounded-5">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("body").on("submit", "form", function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('admin/peserta/upload/') ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(".btn-primary").prop("disabled", true);
                    $(".btn-primary").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>`)
                },
                success: function(data) {
                    $(".btn-primary").prop("disabled", false);
                    $(".btn-primary").html(`Import Now`);
                    // if (data) {
                    //     $(".message-error").html(`<div class="alert alert-danger">` + data + `</div>`)
                    // } else {
                    //     window.location.href = '<?= base_url('admin/peserta/') ?>';
                    // }

                    var x = data.split(",");
                    if (x[1] == "0") {
                        $(".message-error").html(x[0])
                    }
                    if (x[1] == "1") {
                        $(".message-error").html(x[0])
                    }
                },
            });
        });
    });
</script>