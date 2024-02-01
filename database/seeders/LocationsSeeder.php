<?php

namespace Redninjaturtle\RedLaravelLocation\Database;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name' => 'Brazil',
            'slug' => 'pt-br',
        ]);
    }
}
