<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use Carbon\Carbon;

class AdditionalPropertiesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        $properties = [
            [
                'title' => 'Vila moderna in cartierul Viisoara',
                'description' => 'Agentia Direkt Imobiliare propune spre vanzare vila moderna situata in cartierul Viisoara. Vila are o suprafata utila de 180 mp, dispusa pe 2 nivele. La parter regasim un living spatios cu bucatarie open space, baie, camera tehnica si garaj. La etaj sunt 3 dormitoare, 2 bai si un balcon generos. Finisaje premium, incalzire in pardoseala, sistem smart home.',
                'price' => '250000.000',
                'location' => 'Strada Viisoara, Bistrita, Bistrita-Nasaud',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'garages' => 1,
                'size' => 180.00,
                'image' => 'main.jpg',
                'featured' => 1,
                'status_id' => 1, // Vanzare
                'type_id' => 1, // Casa
                'latitude' => '47.1332450',
                'longitude' => '24.4835670',
                'user_id' => 23,
                'location_id' => null,
                'views' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Apartament de lux in Centrul Istoric',
                'description' => 'Agentia Direkt Imobiliare va prezinta un apartament exclusivist situat in inima centrului istoric. Apartamentul are o suprafata de 95 mp si dispune de 2 dormitoare, living cu bucatarie open space, 2 bai si un balcon cu vedere panoramica. Finisaje de lux, mobilat si utilat complet.',
                'price' => '175000.000',
                'location' => 'Piata Centrala, Bistrita, Bistrita-Nasaud',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'garages' => 1,
                'size' => 95.00,
                'image' => 'main.jpg',
                'featured' => 1,
                'status_id' => 1, // Vanzare
                'type_id' => 2, // Apartament
                'latitude' => '47.1305620',
                'longitude' => '24.5007890',
                'user_id' => 23,
                'location_id' => null,
                'views' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Spatiu comercial ultracentral',
                'description' => 'Agentia Direkt Imobiliare ofera spre inchiriere spatiu comercial amplasat ultracentral. Spatiul are o suprafata de 120 mp, vitrina la strada principala, grup sanitar, depozit. Pretabil pentru diverse activitati comerciale.',
                'price' => '1500.000',
                'location' => 'Strada Liviu Rebreanu, Bistrita, Bistrita-Nasaud',
                'bedrooms' => 0,
                'bathrooms' => 1,
                'garages' => 0,
                'size' => 120.00,
                'image' => 'main.jpg',
                'featured' => 0,
                'status_id' => 2, // Inchiriere
                'type_id' => 3, // Hala
                'latitude' => '47.1318900',
                'longitude' => '24.4956780',
                'user_id' => 23,
                'location_id' => null,
                'views' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Casa noua in Unirea',
                'description' => 'Agentia Direkt Imobiliare va propune spre vanzare o casa noua in cartierul Unirea. Casa are 160 mp utili si este construita pe un teren de 500 mp. Dispune de 4 dormitoare, living, bucatarie, 2 bai, terasa si garaj. Finisaje moderne, incalzire in pardoseala, panouri solare.',
                'price' => '195000.000',
                'location' => 'Cartier Unirea, Bistrita, Bistrita-Nasaud',
                'bedrooms' => 4,
                'bathrooms' => 2,
                'garages' => 1,
                'size' => 160.00,
                'image' => 'main.jpg',
                'featured' => 1,
                'status_id' => 1, // Vanzare
                'type_id' => 1, // Casa
                'latitude' => '47.1384560',
                'longitude' => '24.4789340',
                'user_id' => 23,
                'location_id' => null,
                'views' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Apartament modern in Decebal',
                'description' => 'Agentia Direkt Imobiliare va prezinta un apartament modern in zona Decebal. Apartamentul are 75 mp si este compus din 2 dormitoare, living cu bucatarie deschisa, baie si balcon. Complet renovat, mobilat si utilat modern. Loc de parcare inclus.',
                'price' => '125000.000',
                'location' => 'Bulevardul Decebal, Bistrita, Bistrita-Nasaud',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'garages' => 1,
                'size' => 75.00,
                'image' => 'main.jpg',
                'featured' => 0,
                'status_id' => 1, // Vanzare
                'type_id' => 2, // Apartament
                'latitude' => '47.1356780',
                'longitude' => '24.4923450',
                'user_id' => 23,
                'location_id' => null,
                'views' => 0,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        foreach ($properties as $propertyData) {
            $property = Property::create($propertyData);
            echo "Created property with ID: " . $property->id . " - " . $property->title . "\n";
        }
    }
} 