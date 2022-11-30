<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">SMTP Setting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form SMTP Setting</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">SMTP Setting</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php if ($this->session->flashdata('notif')) : ?>
                <script>
                    Swal.fire(
                        'Success',
                        '<?= $this->session->flashdata('notif') ?>',
                        'success'
                    )
                </script>
            <?php endif; ?>
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/smtp/save') ?>" method="post">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" placeholder="email address" value="<?= $smtp->webmail ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Port</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="port" name="port" placeholder="port webmail" value="<?= $smtp->set_smtp_port ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Username SMTP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" placeholder="username for smtp" value="<?= $smtp->set_smtp_username ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Password SMTP</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" placeholder="username for smtp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Host SMTP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="host" name="host" placeholder="host for smtp" value="<?= $smtp->set_smtp_host ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold"></label>
                            <div class="col-sm-9">
                                <a href="#modal2" class="btn btn-primary rounded-5" data-toggle="modal">Confirm</a>
                                <button type="button" class="btn btn-dark rounded-5" onclick="history.back()">Back</button>
                                <a href="#modal3" data-toggle="modal" class="btn btn-info rounded-5">Testing Email</a>
                            </div>
                        </div>
                        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel2">Confirm</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i data-feather="x"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mg-b-0">Are sure to save this data?</p>
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
<form action="<?= base_url('admin/smtp/send/') ?>" method="post" id="form-email">
    <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel2">Testing Email</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i data-feather="x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-sm-12">
                            <input type="email" required name="email" class="form-control" placeholder="receive email">
                        </div>
                        <div class="col-sm-12 mg-t-10">
                            <textarea required name="message" class="form-control" rows="2" placeholder="message"></textarea>
                            <div class="message-error"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button class="btn btn-dark btn-sm" id="sending">Sending</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("body").on("submit", "#form-email", function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#sending").text('Loading...');
                },
                success: function(data) {
                    $("#sending").text('Sending');
                    $(".message-error").html(`<div class="mt-4 alert alert-info">` + data + `</div>`);
                },
            });
        });
    });
</script>