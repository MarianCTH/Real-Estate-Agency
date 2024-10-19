<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyOption;

class PropertyOptionsSeeder extends Seeder
{
    public function run()
    {
        $optiuni = [
            'Aer condiționat', 'Piscină', 'Încălzire centrală', 'Cameră de spălătorie', 'Sală de sport',
            'Alarmă', 'Acoperire pentru ferestre', 'WiFi', 'Cablu TV', 'Uscător', 'Cuptor cu microunde',
            'Mașină de spălat', 'Frigider', 'Duș exterior'
        ];

        foreach ($optiuni as $optiune) {
            PropertyOption::create(['name' => $optiune]);
        }
    }
}
