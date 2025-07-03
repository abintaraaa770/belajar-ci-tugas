<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $nominal = 100000;

        for ($i = 0; $i < 10; $i++) {
            $tanggal = Time::today()->addDays($i); // langsung bikin objek baru

            $data[] = [
                'tanggal'    => $tanggal->toDateString(),
                'nominal'    => $nominal + ($i * 10000),
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
        }

        $this->db->table('diskon')->insertBatch($data);
    }
}
