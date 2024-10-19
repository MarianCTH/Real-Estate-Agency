<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        // Assuming the property ID is passed via the request, adjust this if needed
        $propertyId = $request->input('property_id'); // This needs to be handled correctly

        // Directory path for storing images
        $directoryPath = public_path('img/properties/' . $propertyId);

        // Create directory if it doesn't exist
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        // Handle the upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($directoryPath, $fileName);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
