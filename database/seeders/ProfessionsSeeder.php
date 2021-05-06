<?php

namespace Database\Seeders;

use App\Models\Professions;
use Illuminate\Database\Seeder;

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Professions::factory(15)->create();
    }
}
