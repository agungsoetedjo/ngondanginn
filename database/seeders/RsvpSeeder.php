<?php

namespace Database\Seeders;

use App\Models\RSVP;
use App\Models\Wedding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RsvpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weddings = Wedding::all();

        foreach ($weddings as $wedding) {
            RSVP::factory()->count(5)->create([
                'wedding_id' => $wedding->id,
            ]);
        }
    }
}
