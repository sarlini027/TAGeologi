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

                <form action="<?= base_url('seminar-kemajuan') ?>" method="post" enctype="multipart/form-data">
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
                        <label for="draft_proposal" class="col-md-2 col-form-label">Draft Proposal <span style="color: red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('draft_proposal') ? 'is-invalid' : '' ?>" type="file"
                                id="draft_proposal" name="draft_proposal">
                            <?php if ($validation->hasError('draft_proposal')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('draft_proposal') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3 row align-items-center">
                        <label for="lembar_seminar" class="col-md-2 col-form-label">Lembar Pendaftaran Seminar <span style="color: red">*</span></label>
                        <div class="col-md-10">
                            <input class="form-control <?= $validation->hasError('lembar_seminar') ? 'is-invalid' : '' ?>" type="file"
                                id="lembar_seminar" name="lembar_seminar">
                            <?php if ($validation->hasError('lembar_seminar')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('lembar_seminar') ?>
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