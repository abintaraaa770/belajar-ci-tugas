<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'nama' => 'ASUS TUF A15 FA506NF',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'Asus Vivobook 14 A1404ZA',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'nama' => 'Lenovo IdeaPad Slim 3-14IAU7',
                'created_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('product_category')->insert($item);
        }
    }
}
