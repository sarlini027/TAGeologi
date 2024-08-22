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
                            <th>Keterangan</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($indikatorPenilaian as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['keterangan'] ?></td>
                                <td><?= $value['bobot'] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi <i class="mdi mdi-chevron-down"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <button class="dropdown-item d-flex align-items-center w-full" data-bs-toggle="modal" data-bs-target="#editModal-<?= $value['id'] ?>"><i class="bx bx-edit"></i> <span class="ml-3">Edit</span></button>
                                            <button class="dropdown-item d-flex align-items-center w-full" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $value['id'] ?>"><i class="bx bx-trash"></i> <span class="ml-3">Hapus</span></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <div id="editModal-<?= $value['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel-<?= $value['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-<?= $value['id'] ?>">Edit <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('indikator-penilaian/detail/update/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="bobot">Bobot</label>
                                                        <input class="form-control" name="bobot" type="number" value="<?= $value['bobot'] ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="keterangan">Keterangan</label>
                                                        <textarea class="form-control" name="keterangan"><?= $value['keterangan'] ?></textarea>
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

                            <div id="deleteModal-<?= $value['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel-<?= $value['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-<?= $value['id'] ?>">Hapus <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('indikator-penilaian/detail/delete/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body" id="deleteModalBody-<?= $value['id'] ?>">
                                                Apakah anda yakin ingin menghapus data ini?
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
            <form action="<?= base_url('indikator-penilaian/detail/' . $idIndikator) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="bobot">Bobot</label>
                            <input class="form-control" name="bobot" type="number" placeholder="Masukan bobot">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Masukan keterangan"></textarea>
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