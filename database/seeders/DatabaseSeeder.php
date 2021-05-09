<?php

namespace Database\Seeders;

use App\Models\Professions;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DetailSeeder::class,
            ProfessionSeeder::class
        ]);
    }
}
