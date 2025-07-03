<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukKategoriModel extends Model
{
    protected $table = 'produk_kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];
    protected $useTimestamps = true; //untuk mengisi created_at dan updated_at otomatis
}
