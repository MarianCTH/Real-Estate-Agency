<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'Andrei Popescu', 'email' => 'andrei.popescu@example.com'],
            ['name' => 'Bogdan Ionescu', 'email' => 'bogdan.ionescu@example.com'],
            ['name' => 'Cristian Dumitru', 'email' => 'cristian.dumitru@example.com'],
            ['name' => 'Daniel Marin', 'email' => 'daniel.marin@example.com'],
            ['name' => 'Ion Georgescu', 'email' => 'ion.georgescu@example.com'],
            ['name' => 'Mihai Stanescu', 'email' => 'mihai.stanescu@example.com'],
            ['name' => 'Radu Alexandru', 'email' => 'radu.alexandru@example.com'],
            ['name' => 'Sorin Enescu', 'email' => 'sorin.enescu@example.com'],
            ['name' => 'Valentin Vancea', 'email' => 'valentin.vancea@example.com'],
            ['name' => 'Vlad Sava', 'email' => 'vlad.sava@example.com'],
            ['name' => 'Ana Iancu', 'email' => 'ana.iancu@example.com'],
            ['name' => 'Elena Popa', 'email' => 'elena.popa@example.com'],
            ['name' => 'Ioana Nicolae', 'email' => 'ioana.nicolae@example.com'],
            ['name' => 'Maria Costea', 'email' => 'maria.costea@example.com'],
            ['name' => 'Roxana Marinescu', 'email' => 'roxana.marinescu@example.com'],
            ['name' => 'Sofia Dragoescu', 'email' => 'sofia.dragoescu@example.com'],
            ['name' => 'Adriana Tudor', 'email' => 'adriana.tudor@example.com'],
            ['name' => 'Camelia Radu', 'email' => 'camelia.radu@example.com'],
            ['name' => 'Larisa Fanea', 'email' => 'larisa.fanea@example.com'],
            ['name' => 'Gabriela Toma', 'email' => 'gabriela.toma@example.com'],
            ['name' => 'Chiticariu Cezar-Marian', 'email' => 'cth.marian@gmail.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password123'),
                'image' => 'default.png',
            ]);
        }
    }
}
