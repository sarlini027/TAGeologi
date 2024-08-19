<?= $this->extend('dashboard/layouts/master') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="datatable table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>File Proposal</th>
                            <th>Lembar Pendaftaran</th>
                            <th>Status Validasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($seminarKemajuan as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['nama_lengkap'] ?></td>
                                <td><?= $value['username'] ?></td>
                                <td>
                                    <a href="<?= $value['draft_proposal'] ?>" class="btn btn-sm btn-primary" target="_blank">Download</a>
                                </td>
                                <td>
                                    <a href="<?= $value['lembar_pendaftaran'] ?>" class="btn btn-sm btn-primary" target="_blank">Download</a>
                                </td>
                                <td>
                                    <span class="badge bg-success">Sudah Diverifikasi</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<?= $this->endSection() ?>