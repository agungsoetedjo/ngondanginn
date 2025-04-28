<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQ::create([
            'pertanyaan' => 'Pertanyaan 1 ?',
            'jawaban' => 'Jawaban 1'
        ]);

        FAQ::create([
            'pertanyaan' => 'Pertanyaan 2 ?',
            'jawaban' => 'Jawaban 2'
        ]);

        FAQ::create([
            'pertanyaan' => 'Pertanyaan 3 ?',
            'jawaban' => 'Jawaban 3'
        ]);
    }
}
