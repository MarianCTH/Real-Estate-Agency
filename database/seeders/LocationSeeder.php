<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = ['Big', 'Centru', 'Decebal', 'Mall', 'Ștefan'];

        foreach ($locations as $location) {
            Location::create(['name' => $location]);
        }
    }
}
