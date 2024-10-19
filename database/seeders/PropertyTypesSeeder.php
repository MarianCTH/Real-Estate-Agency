<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypesSeeder extends Seeder
{
    public function run()
    {
        PropertyType::create(['name' => 'Casă']);
        PropertyType::create(['name' => 'Apartament']);
        PropertyType::create(['name' => 'Condo']);
    }
}
