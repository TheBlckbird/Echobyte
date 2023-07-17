<?php

namespace Database\Seeders;

use App\Models\Rave;
use Illuminate\Database\Seeder;

class RaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rave::factory()
            ->count(100)
            ->create();
    }
}
