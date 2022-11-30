<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Question</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import Question</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Import Question</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="message-error"></div>
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/soal/upload/') ?>" method="post" id="form-upload" enctype="multipart/form-data">
                        <div class="Gambar">
                            <h5>Import Question</h5>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" required name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <small>The file format for importing question data is in <strong>.xlxs</strong> or <strong>.csv</strong> format</small>. <a href="<?= base_url('format_soal.csv') ?>" class="badge badge-primary rounded-5">Download Format</a>
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
        $("body").on("submit", "#form-uploadX", function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(".btn-primary").text('Loading...');
                    $(".btn-primary").prop('disabled', true);
                },
                success: function(data) {
                    alert(data)
                    $(".btn-primary").text('Question Import Successfully');
                },
            });
        });
    });
</script>