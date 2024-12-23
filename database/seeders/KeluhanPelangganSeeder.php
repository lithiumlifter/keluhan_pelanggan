<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KeluhanPelangganSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 50; $i++) {
            $createdAt = Carbon::now()->subDays(rand(1, 30));
            $updatedAt = $createdAt->copy()->addHours(rand(1, 72));

            $data[] = [
                'nama' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'nomor_hp' => '081234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'keluhan' => 'Ini adalah contoh keluhan dari User ' . $i,
                'status_keluhan' => rand(0, 2),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ];
        }
        DB::table('keluhan_pelanggan')->insert($data);
    }
}