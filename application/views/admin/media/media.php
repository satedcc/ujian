<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Question</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload Media/Image</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Upload Media/Image</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/soal/imageUploadPost') ?>" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <ul class="list-media">
                        <?php
                        $files = directory_map('./dir/assets/img/', FALSE, TRUE);
                        foreach ($files as $f) {
                            $x =  explode(".", $f);
                            if ($x[1] == "mp4" || $x[1] == "mpeg" || $x[1] == "mkv" || $x[1] == "MP4" || $x[1] == "MPEG" || $x[1] == "MKV") {
                                echo "<li>
                                        <video controls>
                                            <source src='" . base_url() . "dir/assets/img/$f' type='video/mp4'>
                                            Your browser does not support the video tag.
                                        </video>
                                    </li>";
                            } else {
                                echo "<li>
                                <a href='" . base_url() . "dir/assets/img/$f' data-toggle='lightbox' data-gallery='gallery'>
                                    <img loading='lazy' src='" . base_url() . "dir/assets/img/$f'>
                                </a>
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
<script>
    Dropzone.options.imageUpload = {
        maxFilesize: 100,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4,.mpeg,.mkv"
    };
</script>