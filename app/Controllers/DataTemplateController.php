<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemplateDokumen;
use CodeIgniter\HTTP\ResponseInterface;

class DataTemplateController extends BaseController
{
    public function index()
    {
        $dokumenModel = new TemplateDokumen();
        $data['title'] = 'Data Template';
        $data['listTemplate'] = $dokumenModel->findAll();

        return view('dashboard/data_template/index', $data);
    }

    public function store() {
        // validation rules template name and url file
        $rules = [
            'nama_template' => 'required',
            'url_file'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $dokumenModel = new TemplateDokumen();
        $simpanDokumen = $dokumenModel->insert([
            'nama_template' => $this->request->getPost('nama_template'),
            'file_template' => $this->request->getPost('url_file'),
            'ikon' => $this->request->getPost('ikon') ?? 'file'
        ]);

        if ($simpanDokumen) {
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function update($id) {
        // validation rules template name and url file
        $rules = [
            'nama_template' => 'required',
            'url_file'  => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $dokumenModel = new TemplateDokumen();
        $updateDokumen = $dokumenModel->update($id, [
            'nama_template' => $this->request->getPost('nama_template'),
            'file_template' => $this->request->getPost('url_file'),
            'ikon' => $this->request->getPost('ikon') ?? 'file'
        ]);

        if ($updateDokumen) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }

    public function delete($id) {
        $dokumenModel = new TemplateDokumen();
        $deleteDokumen = $dokumenModel->delete($id);

        if ($deleteDokumen) {
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
