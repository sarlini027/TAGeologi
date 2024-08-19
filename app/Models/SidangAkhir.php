<?php

namespace App\Models;

use CodeIgniter\Model;

class SidangAkhir extends Model
{
    protected $table            = 'sidang_akhir';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'kendali_bimbingan',
        'form_pendaftaran',
        'form_bimbingan',
        'kehadiran_seminar',
        'nilai_kompre',
        'transkrip_nilai',
        'status_validasi',
        'id_dosen_penguji_1',
        'id_dosen_penguji_2',
        'id_dosen_pembimbing_1',
        'id_dosen_pembimbing_2',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Relationships Table Users
    public function getSidangAkhirWithUsers()
    {
        return $this->select('users.*, sidang_akhir.*')
            ->join('users', 'users.id = sidang_akhir.user_id')
            ->where('sidang_akhir.status_validasi', 0)
            ->findAll();
    }

    public function getRiwayatPengajuan()
    {
        $riwayatPengajuan = $this->select('users.*, sidang_akhir.*')
            ->join('users', 'users.id = sidang_akhir.user_id')
            ->where('sidang_akhir.status_validasi', 1)
            ->findAll();

        // looping data riwayat pengajuan untuk mendapatkan data dosen
        foreach ($riwayatPengajuan as $key => $value) {
            $riwayatPengajuan[$key]['dosen_pembimbing_1'] = (new User())->find($value['id_dosen_pembimbing_1']);
            $riwayatPengajuan[$key]['dosen_pembimbing_2'] = (new User())->find($value['id_dosen_pembimbing_2']);
            $riwayatPengajuan[$key]['dosen_penguji_1'] = (new User())->find($value['id_dosen_penguji_1']);
            $riwayatPengajuan[$key]['dosen_penguji_2'] = (new User())->find($value['id_dosen_penguji_2']);
        }

        return $riwayatPengajuan;
    }
}
