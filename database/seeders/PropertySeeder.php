<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Assuming type_id should correspond to some existing types in your `property_types` table
        // Example type IDs: 1 = Residential, 2 = Commercial, etc.

        Property::create([
            'title' => 'Vila de lux în centrul Bistriței',
            'description' => 'Vila de lux situată în centrul orașului Bistrița, cu o arhitectură modernă și finisaje de înaltă calitate. Proprietatea dispune de 8 camere spațioase, 5 băi, garaj pentru două mașini și o grădină frumos amenajată.',
            'price' => 350,
            'location' => 'Strada Libertății, Bistrița, Bistrița-Năsăud, România',
            'bedrooms' => 8,
            'bathrooms' => 5,
            'garages' => 0,
            'size' => 450,
            'image' => 'luxury-villa.jpg',
            'featured' => true,
            'status' => 'Vânzare',
            'user_id' => 21,
            'type_id' => 1, // Example type ID for residential
            'latitude' => 47.13382457277001, // Example latitude
            'longitude' => 24.4988373612849, // Example longitude
        ]);

        Property::create([
            'title' => 'Apartament cu două camere în cartierul Andrei Mureșanu',
            'description' => 'Apartament modern cu două camere situat în cartierul Andrei Mureșanu din Bistrița. Imobilul are o suprafață utilă de 65 mp și include living, bucătărie open space, dormitor, baie și balcon. Este complet mobilat și utilat.',
            'price' => 75,
            'location' => 'Strada Mihai Eminescu, Andrei Mureșanu, Bistrița, Bistrița-Năsăud, România',
            'bedrooms' => 2,
            'bathrooms' => 1,
            'garages' => 0,
            'size' => 65,
            'image' => 'apartment-andrei-muresanu.jpg',
            'featured' => false,
            'status' => 'Vânzare',
            'user_id' => 21,
            'type_id' => 1, // Example type ID for residential
            'latitude' => 47.13931657778199, // Example latitude
            'longitude' => 24.48904271993267, // Example longitude
        ]);

        Property::create([
            'title' => 'Casă de familie în zona rezidențială Speranța',
            'description' => 'Casă spațioasă de familie situată în zona rezidențială Speranța din Bistrița. Proprietatea oferă 5 dormitoare, 3 băi, bucătărie complet utilată și o curte generoasă cu loc de joacă pentru copii și grădină frumos amenajată.',
            'price' => 250,
            'location' => 'Strada Speranța, Bistrița, Bistrița-Năsăud, România',
            'bedrooms' => 5,
            'bathrooms' => 3,
            'garages' => 0,
            'size' => 300,
            'image' => 'family-house-speranta.jpg',
            'featured' => true,
            'status' => 'Vânzare',
            'user_id' => 21,
            'type_id' => 1, // Example type ID for residential
            'latitude' => 47.14933747267141, // Example latitude
            'longitude' => 24.480082582691075, // Example longitude
        ]);

        Property::create([
            'title' => 'Apartament cu trei camere renovat în centrul vechi',
            'description' => 'Apartament recent renovat cu trei camere situat în inima centrului vechi al orașului Bistrița. Imobilul are o suprafață de 90 mp, include living, două dormitoare, două băi și balcon cu vedere la centrul istoric.',
            'price' => 110,
            'location' => 'Strada Piața Centrală, Bistrița, Bistrița-Năsăud, România',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'garages' => 0,
            'size' => 90,
            'image' => 'renovated-apartment.jpg',
            'featured' => true,
            'status' => 'Închiriere',
            'user_id' => 21,
            'type_id' => 1, // Example type ID for residential
            'latitude' => 47.13177830185579, // Example latitude
            'longitude' => 24.498711556576268, // Example longitude
        ]);

        // You can add more properties here as needed
    }
}
