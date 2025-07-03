<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
        helper('form');
    }

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses hanya untuk admin');
        }

        $data['diskon'] = $this->diskonModel->findAll();
        return view('v_diskon', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses hanya untuk admin');
        }

        return view('diskon/create');
    }

    public function store()
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/')->with('error', 'Akses hanya untuk admin');
    }

    // Ambil input tanggal dalam format dd/mm/yyyy dari form
    $tanggalInput = $this->request->getVar('tanggal');
    $nominal = $this->request->getVar('nominal');

    // Ubah tanggal ke format Y-m-d (format SQL)
    $tanggalObj = \DateTime::createFromFormat('d/m/Y', $tanggalInput);
    if (!$tanggalObj) {
        return redirect()->back()->withInput()->with('errors', ['Format tanggal tidak valid']);
    }
    $tanggal = $tanggalObj->format('Y-m-d');

    // Validasi manual karena tanggal diproses dulu sebelum disimpan
    $rules = [
        'nominal' => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Cek apakah tanggal sudah ada
    if ($this->diskonModel->where('tanggal', $tanggal)->countAllResults() > 0) {
        return redirect()->back()->withInput()->with('errors', ['Tanggal diskon sudah ada.']);
    }

    // Simpan ke database
    $this->diskonModel->save([
        'tanggal' => $tanggal,
        'nominal' => $nominal,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan');
}

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses hanya untuk admin');
        }

        $data['diskon'] = $this->diskonModel->find($id);
        return view('diskon/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses hanya untuk admin');
        }

        $rules = [
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->diskonModel->update($id, [
            'nominal' => $this->request->getVar('nominal'),
            'updated_at' => date('dd/mm/yyyy H:i:s'),
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diupdate');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses hanya untuk admin');
        }

        $this->diskonModel->delete($id);
        return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus');
    }
}
