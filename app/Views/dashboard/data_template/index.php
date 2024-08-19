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
                            <th>Template</th>
                            <th>File Template</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($listTemplate as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['nama_template'] ?></td>
                                <td>
                                    <a href="<?= $value['file_template'] ?>" target="_blank" class="btn btn-sm btn-primary">
                                        Lihat File
                                    </a>
                                </td>
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

                            <div id="editModal-<?= $value['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Ubah <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('data-template-dokumen/update/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="nama_template">Nama Template</label>
                                                        <input class="form-control" name="nama_template" type="text" placeholder="Masukan nama template" value="<?= $value['nama_template'] ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="url_file">URL File <small>(Google Drive, atau lainnya)</small></label>
                                                        <input class="form-control" name="url_file" type="text" placeholder="https://googledrive.com/xx.x.x" value="<?= $value['file_template'] ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label class="form-label" id="ikon">Ikon <small>(dapat dilihat <a href="https://fontawesome.com/search" target="_blank">disini</a>)</small></label>
                                                        <input class="form-control" name="ikon" type="text" placeholder="user-group" value="<?= $value['ikon'] ?>">
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

                            <div id="deleteModal-<?= $value['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Hapus <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('data-template-dokumen/delete/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>Yakin ingin menghapus data <?= $value['nama_template'] ?></p>
                                                    </div>
                                                </div>
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
            <form action="<?= base_url('data-template-dokumen') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="nama_template">Nama Template</label>
                            <input class="form-control" name="nama_template" type="text" placeholder="Masukan nama template">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="url_file">URL File <small>(Google Drive, atau lainnya)</small></label>
                            <input class="form-control" name="url_file" type="text" placeholder="https://googledrive.com/xx.x.x">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" id="ikon">Ikon <small>(dapat dilihat <a href="https://fontawesome.com/search" target="_blank">disini</a>)</small></label>
                            <input class="form-control" name="ikon" type="text" placeholder="user-group">
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