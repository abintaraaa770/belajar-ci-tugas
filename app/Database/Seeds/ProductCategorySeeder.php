<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Elektronik', 'description' => 'Produk elektronik rumah tangga', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Fashion', 'description' => 'Pakaian dan aksesoris', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Makanan', 'description' => 'Makanan dan minuman ringan', 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('product_category')->insertBatch($data);
    }
}
