<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KeluhanHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keluhanIds = DB::table('keluhan_pelanggan')->pluck('id');
        $historyData = [];

        foreach ($keluhanIds as $keluhanId) {
            $totalHistory = rand(2, 5);
            $startDate = DB::table('keluhan_pelanggan')->where('id', $keluhanId)->value('created_at');
            $startDate = Carbon::parse($startDate);

            for ($i = 1; $i <= $totalHistory; $i++) {
                $status = (string) min($i - 1, 2);
                $updatedAt = $startDate->copy()->addDays($i)->addHours(rand(1, 12));

                $historyData[] = [
                    'keluhan_id' => $keluhanId,
                    'status_keluhan' => $status,
                    'updated_at' => $updatedAt,
                ];
            }
        }

        DB::table('keluhan_status_his')->insert($historyData);
    }
}
