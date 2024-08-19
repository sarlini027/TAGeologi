<?= $this->extend('dashboard/layouts/master') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-4">
                    <button type="button" class="btn btn-sm btn-dark waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addModal">Tambah <?= $title ?></button>
                </div>
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
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi <i class="mdi mdi-chevron-down"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item d-flex align-items-center w-full" href="<?= base_url('/indikator-penilaian/detail/' . $value['id']) ?>"><i class="bx bx-info-circle"></i> <span class="ml-3">Detail</span></a>
                                            <button class="dropdown-item d-flex align-items-center w-full" data-bs-toggle="modal" data-bs-target="#editModal-<?= $value['id'] ?>"><i class="bx bx-edit"></i> <span class="ml-3">Edit</span></button>
                                            <button class="dropdown-item d-flex align-items-center w-full" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $value['id'] ?>"><i class="bx bx-trash"></i> <span class="ml-3">Hapus</span></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <div id="editModal-<?= $value['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Ubah <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('indikator-penilaian/update/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="nama_indikator">Nama Indikator</label>
                                                        <input class="form-control" name="nama_indikator" type="text" placeholder="Masukan nama indikator" value="<?= $value['indikator'] ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="tipe">Pilih Kategori</label>
                                                        <select class="form-select" name="tipe">
                                                            <option value="seminar_kemajuan" <?= $value['tipe'] == 'seminar_kemajuan' ? 'selected' : '' ?>>Seminar Kemajuan</option>
                                                            <option value="seminar_hasil" <?= $value['tipe'] == 'seminar_hasil' ? 'selected' : '' ?>>Seminar Hasil</option>
                                                            <option value="sidang_akhir" <?= $value['tipe'] == 'sidang_akhir' ? 'selected' : '' ?>>Sidang Akhir</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-dark waves-effect waves-light">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>

                            <div id="deleteModal-<?= $value['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Hapus <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('indikator-penilaian/delete/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <p>Yakin ingin menghapus data <?= $value['indikator'] ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-dark waves-effect waves-light">Hapus</button>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('indikator-penilaian') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="nama_indikator">Nama Indikator</label>
                            <input class="form-control" name="nama_indikator" type="text" placeholder="Masukan nama indikator">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="tipe">Pilih Kategori</label>
                            <select class="form-select" name="tipe">
                                <option value="seminar_kemajuan">Seminar Kemajuan</option>
                                <option value="seminar_hasil">Seminar Hasil</option>
                                <option value="sidang_akhir">Sidang Akhir</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>
<?= $this->endSection() ?>