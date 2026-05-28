<?php

namespace Database\Seeders;

use App\Models\HealthTask;
use Illuminate\Database\Seeder;

class HealthTaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Jalan pagi 30 menit',
                'category' => 'Latihan',
                'description' => 'Berjalan santai selama 30 menit untuk menjaga kebugaran jantung.',
                'points' => 80,
                'target' => '30 menit',
            ],
            [
                'title' => 'Minum 8 gelas air',
                'category' => 'Hidrasi',
                'description' => 'Menjaga tubuh tetap terhidrasi agar metabolisme lancar.',
                'points' => 60,
                'target' => '8 gelas',
            ],
            [
                'title' => 'Sarapan sehat',
                'category' => 'Nutrisi',
                'description' => 'Pilih sarapan bergizi dengan protein, serat, dan lemak sehat.',
                'points' => 70,
                'target' => 'Sarapan bergizi',
            ],
            [
                'title' => 'Tidur 7 jam atau lebih',
                'category' => 'Istirahat',
                'description' => 'Pastikan tidur cukup untuk pemulihan tubuh dan pikiran.',
                'points' => 70,
                'target' => '7 jam',
            ],
            [
                'title' => 'Meditasi atau peregangan',
                'category' => 'Kesehatan Mental',
                'description' => 'Kerjakan meditasi ringan atau stretching untuk mengurangi stres.',
                'points' => 50,
                'target' => '10 menit',
            ],
        ];

        foreach ($tasks as $task) {
            HealthTask::updateOrCreate(['title' => $task['title']], $task);
        }
    }
}
