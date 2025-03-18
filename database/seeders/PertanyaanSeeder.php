<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;
use App\Models\Asesmen;
use Illuminate\Support\Str;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {


        // Soal Pilihan Ganda
        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "49c2dd04-a861-412f-aeee-2dab0a596388",
            'pertanyaan' => 'Apa fungsi dari mesin cuci?',
            'jenis' => 'multiple_choice',
            'durasi' => 60, // 1 menit
            'bobot' => 10,
        ]);

        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "954aa52a-043c-4abf-943b-123ba572378e",
            'pertanyaan' => 'Berikut ini adalah fitur dari mesin pengering pakaian, kecuali...',
            'jenis' => 'multiple_choice',
            'durasi' => 60, // 1 menit
            'bobot' => 10,
        ]);

        // Soal Essay
        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' =>"e8dfc3b5-2bc4-476c-8d00-9e9a3c9e8d93",
            'pertanyaan' => 'Jelaskan cara merawat dan memelihara mesin cuci agar tetap berfungsi dengan baik.',
            'jenis' => 'essay',
            'durasi' => 120, // 2 menit
            'bobot' => 20,
        ]);

        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "954aa52a-043c-4abf-943b-123ba572378e",
            'pertanyaan' => 'Sebutkan manfaat dari penggunaan mesin pengering pakaian modern.',
            'jenis' => 'essay',
            'durasi' => 120, // 2 menit
            'bobot' => 20,
        ]);
    }
}
