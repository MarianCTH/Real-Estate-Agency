<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class UpdatePropertyImagesSeeder extends Seeder
{
    public function run()
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            $folderPath = public_path("img/properties/{$property->id}");
            
            if (is_dir($folderPath)) {
                // Get all jpg files in the directory
                $images = glob($folderPath . "/*.jpg");
                
                if (!empty($images)) {
                    // Get just the filename from the first image path
                    $firstImage = basename($images[0]);
                    
                    // Update the property with the actual image name
                    $property->update(['image' => $firstImage]);
                    echo "Updated property {$property->id} with image: {$firstImage}\n";
                } else {
                    echo "No images found for property {$property->id}\n";
                }
            } else {
                echo "Directory not found for property {$property->id}\n";
            }
        }
    }
} 