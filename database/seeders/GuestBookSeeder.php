<?php

namespace Database\Seeders;

use App\Models\GuestBook;
use App\Models\Wedding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wedding = Wedding::first(); // atau Wedding::inRandomOrder()->first();

        if (!$wedding) {
            $this->command->warn("Tidak ada data wedding ditemukan. Seeder GuestBook dilewati.");
            return;
        }

        GuestBook::factory()->count(5)->create([
            'wedding_id' => $wedding->id,
        ]);
    }
}
