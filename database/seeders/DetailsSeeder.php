<?php

namespace Database\Seeders;

use App\Models\Details;
use Illuminate\Database\Seeder;

class DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Details::factory(15)->create();
    }
}
