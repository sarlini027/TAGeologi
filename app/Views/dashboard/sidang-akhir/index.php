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

                <form action="<?= base_url('sidang-akhir') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3 row align-items-center">
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
                        <label for="kendali_bimbingan" class="col-md-2 col-form-label">Kendali Bimbingan <span style="color: red">* <small>(PDF, maks: 1mb)</small></span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('kendali_bimbingan') ? 'is-invalid' : '' ?>" type="file"
                                id="kendali_bimbingan" name="kendali_bimbingan">
                            <?php if ($validation->hasError('kendali_bimbingan')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kendali_bimbingan') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="form_pendaftaran_sidang" class="col-md-2 col-form-label">Form Pendaftaran Sidang <span style="color: red">* <small>(PDF, maks: 1mb)</small></span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('form_pendaftaran_sidang') ? 'is-invalid' : '' ?>" type="file"
                                id="form_pendaftaran_sidang" name="form_pendaftaran_sidang">
                            <?php if ($validation->hasError('form_pendaftaran_sidang')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('form_pendaftaran_sidang') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="form_bimbingan" class="col-md-2 col-form-label">Form Bimbingan <span style="color: red">* <small>(PDF, maks: 1mb)</small></span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('form_bimbingan') ? 'is-invalid' : '' ?>" type="file"
                                id="form_bimbingan" name="form_bimbingan">
                            <?php if ($validation->hasError('form_bimbingan')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('form_bimbingan') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="kehadiran_seminar" class="col-md-2 col-form-label">Kehadiran Seminar <span style="color: red">* <small>(PDF, maks: 1mb)</small></span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('kehadiran_seminar') ? 'is-invalid' : '' ?>" type="file"
                                id="kehadiran_seminar" name="kehadiran_seminar">
                            <?php if ($validation->hasError('kehadiran_seminar')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kehadiran_seminar') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="nilai_kompre" class="col-md-2 col-form-label">Nilai Kompre <span style="color: red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('nilai_kompre') ? 'is-invalid' : '' ?>" type="text" id="nilai_kompre" name="nilai_kompre">
                            <?php if ($validation->hasError('nilai_kompre')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nilai_kompre') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="transkrip_nilai" class="col-md-2 col-form-label">Transkrip Nilai <span style="color: red">* <small>(PDF, maks: 1mb)</small></span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('transkrip_nilai') ? 'is-invalid' : '' ?>" type="file"
                                id="transkrip_nilai" name="transkrip_nilai">
                            <?php if ($validation->hasError('transkrip_nilai')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('transkrip_nilai') ?>
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