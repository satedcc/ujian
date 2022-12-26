<div class="content-header justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Question</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Question</li>
            </ol>
        </nav>
        <h4 class="content-title content-title-xs">Add Question</h4>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card card-hover card-task-one">
                <div class="card-body">
                    <form action="<?= base_url('admin/soal/save/') ?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Question Category</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <?php if (isset($row)) : ?>
                                    <option value="1" <?php if ($row->jenis_soal == "E") echo " selected" ?>>Easy</option>
                                    <option value="2" <?php if ($row->jenis_soal == "M") echo " selected" ?>>Medium</option>
                                    <option value="3" <?php if ($row->jenis_soal == "H") echo " selected" ?>>Hard</option>
                                <?php else : ?>
                                    <option value="1">Easy</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Hard</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hastag</label>
                            <input type="text" required class="form-control" value="<?php if (isset($row)) echo $row->hastag ?>" name="hastag" data-role="tagsinput" placeholder="hastag">
                            <input type="text" value="<?php if (isset($row)) echo $row->id_soal ?>" name="id" hidden>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Question Type</label>
                            <div class="d-flex">
                                <?php if (isset($row)) : ?>
                                    <div class="mr-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" <?php if ($row->type_soal == "1") echo " checked" ?> id="pilihan" name="type" value="1" class="custom-control-input typesoal" checked>
                                            <label class="custom-control-label" for="pilihan">Multiple Choice</label>
                                        </div>
                                    </div>
                                    <div class="mr-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" <?php if ($row->type_soal == "2") echo " checked" ?> id="truefalse" name="type" value="2" class="custom-control-input typesoal">
                                            <label class="custom-control-label" for="truefalse">True False</label>
                                        </div>
                                    </div>
                                    <div class="mr-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" <?php if ($row->type_soal == "3") echo " checked" ?> id="easy" name="type" value="3" class="custom-control-input typesoal">
                                            <label class="custom-control-label" for="easy">Essay</label>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="mr-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pilihan" name="type" value="1" class="custom-control-input typesoal" checked>
                                            <label class="custom-control-label" for="pilihan">Multiple Choice</label>
                                        </div>
                                    </div>
                                    <div class="mr-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="truefalse" name="type" value="2" class="custom-control-input typesoal">
                                            <label class="custom-control-label" for="truefalse">True False</label>
                                        </div>
                                    </div>
                                    <div class="mr-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="easy" name="type" value="3" class="custom-control-input typesoal">
                                            <label class="custom-control-label" for="easy">Essay</label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="text">
                            <h5>Question Description</h5>
                            <div class="form-group">
                                <textarea required name="soal" id="soal" cols="30" rows="10"><?php if (isset($row)) echo $row->soal ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h5>Input Image/Video</h5>
                            <div class="form-group media-group mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Media</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <input type="text" name="media" class="form-control media" placeholder="input image/video" aria-describedby="basic-addon1" value="<?= $row->media_file ?>">
                                    <?php else : ?>
                                        <input type="text" disabled name="media" class="form-control media" placeholder="input image/video" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                                <small>Please double click to actived media input</small>
                                <div class="previewmedia" <?php if (isset($row)) echo ' style="display:block;"'; ?>>
                                    <div class="preview">
                                        <?php if (isset($row)) : ?>
                                            <?php if ($row->jenis_media == "mp4" || $row->jenis_media == "mpeg" || $row->jenis_media == "mkv" || $row->jenis_media == "MP4" || $row->jenis_media == "MPEG" || $row->jenis_media == "MKV") : ?>
                                                <video controls class="w-50">
                                                    <source src='<?= base_url() ?>dir/assets/img/<?= $row->media_file ?>' type='video/mp4'>
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php elseif ($row->jenis_media == "JPG" || $row->jenis_media == "jpg" || $row->jenis_media == "PNG" || $row->jenis_media == "png" || $row->jenis_media == "JPEG" || $row->jenis_media == "jpeg") : ?>
                                                <img src='<?= base_url() ?>dir/assets/img/<?= $row->media_file ?>' class="w-50">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="form-row">
                                                <?php if (isset($row)) :
                                                    $size = explode(",", $row->size_media);
                                                ?>
                                                    <div class="col">
                                                        <label for="">Height</label>
                                                        <input type="number" class="form-control" name="height" placeholder="height media" value="<?php if (isset($size[0])) echo $size[0]; ?>">
                                                    </div>
                                                    <div class="col">
                                                        <label for="">Width</label>
                                                        <input type="number" class="form-control" name="width" placeholder="width media" value="<?php if (isset($size[0])) echo $size[0]; ?>">
                                                    </div>
                                                <?php else : ?>
                                                    <div class="col">
                                                        <label for="">Height</label>
                                                        <input type="number" class="form-control" name="height" placeholder="height media">
                                                    </div>
                                                    <div class="col">
                                                        <label for="">Width</label>
                                                        <input type="number" class="form-control" name="width" placeholder="width media">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="pilihan">
                            <h5>Multiple Choice</h5>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">A</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <?php if ($row->type_soal == "1") : ?>
                                            <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_a" class="form-control ganda" placeholder="answer A" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->jawab_a ?>">
                                        <?php else : ?>
                                            <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_a" class="form-control ganda" placeholder="answer A" aria-describedby="basic-addon1">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <input type="text" name="jawab_a" class="form-control ganda" placeholder="answer A" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">B</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <?php if ($row->type_soal == "1") : ?>
                                            <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_b" class="form-control ganda" placeholder="answer B" aria-describedby="basic-addon1" value="<?php echo $row->jawab_b ?>">
                                        <?php else : ?>
                                            <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_b" class="form-control ganda" placeholder="answer B" aria-describedby="basic-addon1">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <input type="text" name="jawab_b" class="form-control ganda" placeholder="answer B" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">C</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_c" class="form-control ganda" placeholder="answer C" aria-describedby="basic-addon1" value="<?php echo $row->jawab_c ?>">
                                    <?php else : ?>
                                        <input type="text" name="jawab_c" class="form-control ganda" placeholder="answer C" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">D</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_d" class="form-control ganda" placeholder="answer D" aria-describedby="basic-addon1" value="<?php echo $row->jawab_d ?>">
                                    <?php else : ?>
                                        <input type="text" name="jawab_d" class="form-control ganda" placeholder="answer D" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">E</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <input type="text" <?php if ($row->type_soal != "1") echo "disabled" ?> name="jawab_e" class="form-control ganda" placeholder="answer E" aria-describedby="basic-addon1" value="<?php echo $row->jawab_e ?>">
                                    <?php else : ?>
                                        <input type="text" name="jawab_e" class="form-control ganda" placeholder="answer E" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="pilihan">
                            <h5>True False</h5>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">A</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <?php if ($row->type_soal == "2") : ?>
                                            <input type="text" required <?php if ($row->type_soal != "2") echo "disabled" ?> name="jawab_a" class="form-control truefalse" placeholder="Statement A" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->jawab_a ?>">
                                        <?php else : ?>
                                            <input type="text" required <?php if ($row->type_soal != "2") echo "disabled" ?> name="jawab_a" class="form-control truefalse" placeholder="Statement A" aria-describedby="basic-addon1">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <input type="text" disabled name="jawab_a" class="form-control truefalse" placeholder="Statement A" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">B</span>
                                    </div>
                                    <?php if (isset($row)) : ?>
                                        <?php if ($row->type_soal == "2") : ?>
                                            <input type="text" required <?php if ($row->type_soal != "2") echo "disabled" ?> name="jawab_b" class="form-control truefalse" placeholder="Statement B" aria-describedby="basic-addon1" value="<?php if (isset($row)) echo $row->jawab_b ?>">
                                        <?php else : ?>
                                            <input type="text" required <?php if ($row->type_soal != "2") echo "disabled" ?> name="jawab_b" class="form-control truefalse" placeholder="Statement B" aria-describedby="basic-addon1">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <input type="text" disabled name="jawab_b" class="form-control truefalse" placeholder="Statement B" aria-describedby="basic-addon1">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="kunci">
                            <h5>Right Answer</h5>
                            <div class="form-group">
                                <textarea required name="kunci" id="kunci" cols="30" rows="10" placeholder="right answer" class="form-control"><?php if (isset($row)) echo $row->soal_jawaban ?></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded-5">Save Question</button>
                        <button type="button" onclick="history.back()" class="btn btn-dark rounded-5">Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" style="z-index: 99999999;">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel2">Pilih Gambar</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="x"></i></span>
                </button>
            </div>
            <div class="modal-body" id="icon-list">
                <ul class="list-img"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('soal');
</script>