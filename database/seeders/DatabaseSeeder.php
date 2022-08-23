<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     * @return void
     */
    public function run()
    {
        $this->call(type__bloodsTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(religionsTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);

    }
}
