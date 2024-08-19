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
                            <th>Indikator</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($listIndikatorPenilaian as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['indikator'] ?></td>
                                <td>
                                    <?php
                                    $tipe;
                                    $bgTipe;
                                    if ($value['tipe'] == 'seminar_kemajuan') {
                                        $tipe = 'Seminar Kemajuan';
                                        $bgTipe = 'bg-primary';
                                    } else if ($value['tipe'] == 'seminar_hasil') {
                                        $tipe = 'Seminar Hasil';
                                        $bgTipe = 'bg-warning';
                                    } else if ($value['tipe'] == 'sidang_akhir') {
                                        $tipe = 'Sidang Akhir';
                                        $bgTipe = 'bg-success';
                                    } else {
                                        $tipe = '-';
                                        $bgTipe = 'bg-secondary';
                                    }
                                    ?>
                                    <span class="badge <?= $bgTipe ?>">
                                        <?= $tipe ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('/indikator-penilaian/detail/' . $value['id']) ?>" class="btn btn-sm btn-dark">Detail</a>
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