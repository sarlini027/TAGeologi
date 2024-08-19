<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailIndikatorPenilaian;
use App\Models\IndikatorPenilaian;
use CodeIgniter\HTTP\ResponseInterface;

class DataIndikatorPenilaianController extends BaseController
{
    public function index()
    {
        $indikatorPenilaianModel = new IndikatorPenilaian();
        $data['title'] = 'Indikator Penilaian';
        $data['listIndikatorPenilaian'] = $indikatorPenilaianModel->findAll();

        return view('dashboard/data_indikator_penilaian/index', $data);
    }

    public function detail($id)
    {
        $detailIndikatorPenilaianModel = new DetailIndikatorPenilaian();
        $data['title'] = 'Detail Indikator Penilaian';
        $data['idIndikator'] = $id;
        $data['indikatorPenilaian'] = $detailIndikatorPenilaianModel->getDetailIndikatorPenilaian($id);

        return view('dashboard/data_indikator_penilaian/detail', $data);
    }

    public function store() {
        // rules required nama_indikator, tipe
        $rules = [
            'nama_indikator' => 'required',
            'tipe'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $indikatorPenilaianModel = new IndikatorPenilaian();
        $simpanIndikatorPenilaian = $indikatorPenilaianModel->insert([
            'indikator' => $this->request->getPost('nama_indikator'),
            'tipe' => $this->request->getPost('tipe'),
        ]);

        if ($simpanIndikatorPenilaian) {
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function update($id) {
        // rules required nama_indikator, tipe
        $rules = [
            'nama_indikator' => 'required',
            'tipe'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $indikatorPenilaianModel = new IndikatorPenilaian();
        $updateIndikatorPenilaian = $indikatorPenilaianModel->update($id, [
            'indikator' => $this->request->getPost('nama_indikator'),
            'tipe' => $this->request->getPost('tipe'),
        ]);

        if ($updateIndikatorPenilaian) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }

    public function delete($id) {
        $indikatorPenilaianModel = new IndikatorPenilaian();
        $deleteIndikatorPenilaian = $indikatorPenilaianModel->delete($id);

        if ($deleteIndikatorPenilaian) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }

    public function storeDetail($id) {
        // rules id, bobot, keterangan
        $rules = [
            'bobot' => 'required',
            'keterangan'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $detailIndikatorPenilaianModel = new DetailIndikatorPenilaian();
        $simpanDetailIndikatorPenilaian = $detailIndikatorPenilaianModel->insert([
            'id_indikator' => $id,
            'bobot' => $this->request->getPost('bobot'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        if ($simpanDetailIndikatorPenilaian) {
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function updateDetail($id) {
        // rules id, bobot, keterangan
        $rules = [
            'bobot' => 'required',
            'keterangan'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $detailIndikatorPenilaianModel = new DetailIndikatorPenilaian();
        $updateDetailIndikatorPenilaian = $detailIndikatorPenilaianModel->update($id, [
            'bobot' => $this->request->getPost('bobot'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        if ($updateDetailIndikatorPenilaian) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }

    public function deleteDetail($id) {
        $detailIndikatorPenilaianModel = new DetailIndikatorPenilaian();
        $deleteDetailIndikatorPenilaian = $detailIndikatorPenilaianModel->delete($id);

        if ($deleteDetailIndikatorPenilaian) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
