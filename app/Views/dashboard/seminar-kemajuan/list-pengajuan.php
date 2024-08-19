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
                            <th>Validasi</th>
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
                                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addModal">Validasi</button>
                                </td>
                            </tr>

                            <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Validasi <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('seminar-kemajuan/validasi/' . $value['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label" id="id_dosen_pembimbing_1">Dosen Pembimbing 1</label>
                                                        <select class="form-select" name="id_dosen_pembimbing_1">
                                                            <option value="">Silahkan Pilih</option>
                                                            <?php foreach ($listDosen as $key => $value): ?>
                                                                <option value="<?= $value['id'] ?>"><?= $value['nama_lengkap'] ?> - <?= $value['username'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label" id="id_dosen_pembimbing_2">Dosen Pembimbing 2</label>
                                                        <select class="form-select" name="id_dosen_pembimbing_2">
                                                            <option value="">Silahkan Pilih</option>
                                                            <?php foreach ($listDosen as $key => $value): ?>
                                                                <option value="<?= $value['id'] ?>"><?= $value['nama_lengkap'] ?> - <?= $value['username'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label" id="id_dosen_penguji_1">Dosen Penguji 1</label>
                                                        <select class="form-select" name="id_dosen_penguji_1">
                                                            <option value="">Silahkan Pilih</option>
                                                            <?php foreach ($listDosen as $key => $value): ?>
                                                                <option value="<?= $value['id'] ?>"><?= $value['nama_lengkap'] ?> - <?= $value['username'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label class="form-label" id="id_dosen_penguji_2">Dosen Penguji 2</label>
                                                        <select class="form-select" name="id_dosen_penguji_2">
                                                            <option value="">Silahkan Pilih</option>
                                                            <?php foreach ($listDosen as $key => $value): ?>
                                                                <option value="<?= $value['id'] ?>"><?= $value['nama_lengkap'] ?> - <?= $value['username'] ?></option>
                                                            <?php endforeach; ?>
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
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<?= $this->endSection() ?>