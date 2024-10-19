<?php

// database/seeders/UserDetailSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserDetail;

class UserDetailSeeder extends Seeder
{
    public function run()
    {
        UserDetail::create([
            'user_id' => 21,
            'address' => 'Aleea Soimilor nr.1',
            'phone' => '+40 755 560 779',
        ]);

    }
}
