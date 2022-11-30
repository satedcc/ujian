<div class="sidebar">
    <div class="sidebar-header">
        <div>
            <a href="#" class="sidebar-logo"><span>EXANON</span></a>
            <small class="sidebar-logo-headline">Management Exam Online 1.1</small>
        </div>
    </div><!-- sidebar-header -->
    <div id="dpSidebarBody" class="sidebar-body">
        <?php if ($this->session->userdata('level') == "superadmin") : ?>
            <ul class="nav nav-sidebar">
                <li class="nav-label"><label class="content-label">ACCOUNT</label></li>
                <li class="account">
                    <img src="<?= base_url() ?>dir/assets/img/user.png" alt="">
                    <div class="text-muted">
                        <h6 class="m-0"><a href="<?= base_url('admin/user/edit/' . $this->session->userdata('akun')) ?>" class="text-white"><?= $this->session->userdata('nama') ?></a></h6>
                        <small class="text-white"><?= $this->session->userdata('level') ?></small>
                    </div>
                </li>
                <li class="nav-label"><label class="content-label">MAIN MENU</label></li>
                <!-- <li class="nav-item show">
                    <a href="<?= base_url('admin/home/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'home') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="box"></i> Dashboard</a>
                </li> -->
                <li class="nav-item">
                    <a href="<?= base_url('admin/ujian/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'ujian') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="clipboard"></i> Exam Type</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/test/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'test') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="award"></i> Test Result</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/required/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'required') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="zap"></i> Qualified</a>
                </li>
                <li class="nav-label"><label class="content-label">FITUR</label></li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/soal/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'soal') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="database"></i> Bank Question</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/media/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'media') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="camera"></i> Media</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/jadwal/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'jadwal') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="archive"></i> Schedule</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/informasi/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'informasi') {
                                                                                        echo ' active';
                                                                                    } ?>"><i data-feather="info"></i> Information</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/peserta/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'peserta') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="star"></i> Participant</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/smtp/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'smtp') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="inbox"></i> SMTP</a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?= base_url('admin/setting/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'setting') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="settings"></i> Setting</a>
                </li> -->
            </ul>

            <hr class="mg-t-30 mg-b-25">

            <ul class="nav nav-sidebar">
                <!-- <li class="nav-item"><a href="<?= base_url('theme') ?>" class="nav-link"><i data-feather="aperture"></i> Themes</a></li> -->
                <li class="nav-item"><a href="<?= base_url('admin/user/') ?>" class="nav-link"><i data-feather="users"></i> User</a></li>
                <li class="nav-item"><a href="<?= base_url('admin/logout/') ?>" class="nav-link"><i data-feather="log-out"></i> Logout</a></li>
            </ul>
        <?php else : ?>
            <ul class="nav nav-sidebar">
                <li class="nav-label"><label class="content-label">ACCOUNT</label></li>
                <li class="account">
                    <img src="<?= base_url() ?>dir/assets/img/user.png" alt="">
                    <div class="text-muted">
                        <h6 class="m-0"><a href="<?= base_url('admin/user/edit/' . $this->session->userdata('akun')) ?>" class="text-white"><?= $this->session->userdata('nama') ?></a></h6>
                        <small class="text-white"><?= $this->session->userdata('level') ?></small>
                    </div>
                </li>
                <li class="nav-label"><label class="content-label">MAIN MENU</label></li>
                <!-- <li class="nav-item show">
                    <a href="<?= base_url('admin/home/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'home') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="box"></i> Dashboard</a>
                </li> -->
                <li class="nav-item">
                    <a href="<?= base_url('admin/ujian/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'ujian') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="clipboard"></i> Exam Type</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/test/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'test') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="award"></i> Test Result</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/required/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'required') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="zap"></i> Qualified</a>
                </li>
                <li class="nav-label"><label class="content-label">FITUR</label></li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/soal/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'soal') {
                                                                                echo ' active';
                                                                            } ?>"><i data-feather="database"></i> Bank Question</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/jadwal/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'jadwal') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="archive"></i> Schedule</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/peserta/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'peserta') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="star"></i> Participant</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/informasi/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'informasi') {
                                                                                        echo ' active';
                                                                                    } ?>"><i data-feather="info"></i> Information</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/setting/') ?>" class="nav-link<?php if ($this->uri->segment('2') == 'setting') {
                                                                                    echo ' active';
                                                                                } ?>"><i data-feather="settings"></i> Setting</a>
                </li>
            </ul>

            <hr class="mg-t-30 mg-b-25">

            <ul class="nav nav-sidebar">
                <li class="nav-item"><a href="<?= base_url('admin/logout/') ?>" class="nav-link"><i data-feather="log-out"></i> Logout</a></li>
            </ul>
        <?php endif; ?>
    </div><!-- sidebar-body -->
</div><!-- sidebar -->