<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyStatus;

class PropertyStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['vanzare', 'inchiriere', 'vandut'];

        foreach ($statuses as $status) {
            PropertyStatus::firstOrCreate(['name' => $status]);
        }
    }
}
