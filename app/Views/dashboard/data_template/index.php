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
                            <th>Template</th>
                            <th>Ikon</th>
                            <th>Validasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($listTemplate as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['nama_template'] ?></td>
                                <td>
                                    <a href="<?= $value['file_template'] ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                        <i class="bx bx-file" /> Lihat File
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success">Validasi</a>
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