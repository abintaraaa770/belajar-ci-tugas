<?php

namespace App\Controllers;

use App\Models\ProdukKategoriModel;

class ProdukKategoriController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProdukKategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->model->findAll();
        return view('v_produkkategori', $data);
    }

    public function save()
    {
        $this->model->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('produkkategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $this->model->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('produkkategori')->with('success', 'Kategori berhasil diubah');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('produkkategori')->with('success', 'Kategori berhasil dihapus');
    }
}
