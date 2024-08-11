<?= $this->extend('auth/layouts') ?>
<?= $this->section('page_title') ?>
Daftar
<?= $this->endSection('page_title') ?>
<?= $this->section('content') ?>
<?php
$validation = service('validation');
?>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary-subtle">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Selamat Datang!</h5>
                                    <p>
                                        Silahkan buat akun untuk melanjutkan.
                                    </p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="<?= base_url('dashboard_assets/images/profile-img.png') ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <a href="<?= base_url() ?>" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="<?= base_url('dashboard_assets/images/logo-light.svg') ?>" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>

                            <a href="<?= base_url() ?>" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="<?= base_url('dashboard_assets/images/logo.svg') ?>" alt="" class="rounded-circle" height="34">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" action="<?= base_url('auth/register') ?>" method="POST">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= $validation->hasError('nama_lengkap') ? 'is-invalid' : '' ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama_lengkap') ?>">
                                    <?php if ($validation->hasError('nama_lengkap')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_lengkap') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM (Nomor Induk Mahasiswa)</label>
                                    <input type="text" class="form-control <?= $validation->hasError('nim') ? 'is-invalid' : '' ?>" id="nim" name="nim" placeholder="Masukan NIM" value="<?= set_value('nim') ?>">
                                    <?php if ($validation->hasError('nim')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nim') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kata Sandi</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" placeholder="Masukan kata sandi" name="password" aria-label="Password" aria-describedby="password-addon" value="<?= set_value('password') ?>">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        <?php if ($validation->hasError('password')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('password') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Daftar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <div>
                        <p>Sudah memiliki akun? <a href="<?= base_url('auth/login') ?>" class="fw-medium text-primary"> Masuk </a> </p>
                        <!-- <p>© <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->
<?= $this->endSection() ?>