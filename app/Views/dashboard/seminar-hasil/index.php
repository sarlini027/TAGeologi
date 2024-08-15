<?= $this->extend('dashboard/layouts/master') ?>
<?= $this->section('content') ?>
<?php
$validation = service('validation');
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Pendaftaran <?= $title ?></h4>
                <p class="card-title-desc">
                    Form untuk pendaftaran <?= $title ?>
                </p>

                <form action="<?= base_url('seminar-hasil') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3 row  align-items-center">
                        <label for="nama_lengkap" class="col-md-2 col-form-label">Nama Lengkap</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="<?= session()->user['nama_lengkap'] ?>" readonly
                                id="nama_lengkap" name="nama_lengkap">
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="nim" class="col-md-2 col-form-label">NIM</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="<?= session()->user['username'] ?>" readonly
                                id="nim" name="nim">
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="bukti_kehadiran" class="col-md-2 col-form-label">Bukti Kehadiran <span style="color: red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('bukti_kehadiran') ? 'is-invalid' : '' ?>" type="file"
                                id="bukti_kehadiran" name="bukti_kehadiran">
                            <?php if ($validation->hasError('bukti_kehadiran')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('bukti_kehadiran') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="kendali_bimbingan_semhas" class="col-md-2 col-form-label">Kendali Bimbingan Seminar Hasil <span style="color: red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('kendali_bimbingan_semhas') ? 'is-invalid' : '' ?>" type="file"
                                id="kendali_bimbingan_semhas" name="kendali_bimbingan_semhas">
                            <?php if ($validation->hasError('kendali_bimbingan_semhas')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kendali_bimbingan_semhas') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="form_pendaftaran_dosbing" class="col-md-2 col-form-label">Form Pendaftaran Dosbing <span style="color: red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('form_pendaftaran_dosbing') ? 'is-invalid' : '' ?>" type="file"
                                id="form_pendaftaran_dosbing" name="form_pendaftaran_dosbing">
                            <?php if ($validation->hasError('form_pendaftaran_dosbing')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('form_pendaftaran_dosbing') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
<?= $this->endSection() ?>