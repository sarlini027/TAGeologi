<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailIndikatorPenilaian extends Model
{
    protected $table            = 'detail_indikator_penilaian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_indikator', 'bobot', 'keterangan'
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

    // Relationships
    public function getDetailIndikatorPenilaian($id_indikator)
    {
        return $this->where('id_indikator', $id_indikator)->findAll();
    }

    public function getMaksBobot($tipe) {
        $indikatorPenilaianModel = new IndikatorPenilaian();
        $listIndikatorPenilaian = $indikatorPenilaianModel->where('tipe', $tipe)->findAll();

        $dataMaksBobot = [];

        foreach ($listIndikatorPenilaian as $row) {
            $detailIndikatorPenilaian = $this->where('id_indikator', $row['id'])->findAll();

            $bobot = [];
            foreach ($detailIndikatorPenilaian as $rowDetail) {
                array_push($bobot, $rowDetail['bobot']);
            }

            $dataMaksBobot[] = max($bobot);
        }

        // return $dataMaksBobot;
        return array_sum($dataMaksBobot);
    }
}
