<?= $this->extend('dashboard/layouts/master') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="card blog-stats-wid">
                    <div class="card-body">

                        <div class="d-flex flex-wrap">
                            <div class="me-3">
                                <p class="text-muted mb-2">Jumlah Seminar Kemajuan</p>
                                <h5 class="mb-0 text-muted">Belum divalidasi: <?= $jmlSeminarKemajuanPending ?></h5>
                                <h5 class="mb-0 text-muted">Sudah divalidasi: <?= $jmlSeminarKemajuanAcc ?></h5>
                            </div>

                            <div class="avatar-sm ms-auto">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="bx bxs-note"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card blog-stats-wid">
                    <div class="card-body">

                        <div class="d-flex flex-wrap">
                            <div class="me-3">
                                <p class="text-muted mb-2">Jumlah Seminar Hasil</p>
                                <h5 class="mb-0 text-muted">Belum divalidasi: <?= $jmlSeminarHasilPending ?></h5>
                                <h5 class="mb-0 text-muted">Sudah divalidasi: <?= $jmlSeminarHasilAcc ?></h5>
                            </div>

                            <div class="avatar-sm ms-auto">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="bx bxs-note"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card blog-stats-wid">
                    <div class="card-body">

                        <div class="d-flex flex-wrap">
                            <div class="me-3">
                                <p class="text-muted mb-2">Jumlah Sidang Akhir</p>
                                <h5 class="mb-0 text-muted">Belum divalidasi: <?= $jmlSidangAkhirPending ?></h5>
                                <h5 class="mb-0 text-muted">Sudah divalidasi: <?= $jmlSidangAkhirAcc ?></h5>
                            </div>

                            <div class="avatar-sm ms-auto">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="bx bxs-note"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end row -->
<?= $this->endSection() ?>