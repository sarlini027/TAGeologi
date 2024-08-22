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
                            <th>Nilai</th>
                            <th>Input Nilai</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($listAccSeminarKemajuan as $key => $value): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['nama_lengkap'] ?></td>
                                <td><?= $value['username'] ?></td>
                                <td>
                                    <?php if(count($value['nilai']) > 0): ?>
                                        <?= $value['jumlah_nilai'] ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (count($value['nilai']) > 0): ?>
                                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" disabled>Edit</button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-sm btn-success waves-effect waves-light" onclick="onOpenModalInputNilai('<?= $value['user_id'] ?>')">Input</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
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
                <h5 class="modal-title" id="addModalLabel">Input <?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('nilai-seminar-kemajuan') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <strong>Perhatian!</strong> Pastikan pilihan sesuai, data yang telah di simpan tidak dapat di edit!
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" />
                        <?php foreach ($formattedDataIndikatorPenilaian as $row): ?>
                            <div class="col-md-12 mb-2">
                                <input type="hidden" name="id_indikator[]" value="<?= $row['id'] ?>">
                                <label class="form-label" id="nama_lengkap"><?= $row['indikator'] ?></label>
                                <select name="id_detail_indikator[]" id="" class="form-select">
                                    <option>Silahkan Pilih</option>
                                    <?php foreach ($row['detail_indikator'] as $rowDetail): ?>
                                        <option value="<?= $rowDetail['id'] ?>"><?= $rowDetail['keterangan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endforeach; ?>
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
<?= $this->section('js') ?>
<script>
    function onOpenModalInputNilai(id) {
        $('#id_mahasiswa').val(id);
        const myModalAlternative = new bootstrap.Modal('#addModal', options)
        myModalAlternative.show()
    }
</script>
<?= $this->endSection() ?>