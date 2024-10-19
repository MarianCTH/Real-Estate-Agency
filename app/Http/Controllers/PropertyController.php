<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\File;
use App\Models\Location;
use App\Models\PropertyType;
use App\Models\PropertyOption;
use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::all();
        $propertyTypes = PropertyType::all();
        $propertyOptions = PropertyOption::all();

        // Start building the query
        $query = Property::query();

        // Apply filters based on request parameters
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('location')) {
            $query->where('location_id', $request->input('location'));
        }

        if ($request->filled('property_type')) {
            $query->where('property_type_id', $request->input('property_type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }
        if ($request->has('area_min') && $request->has('area_max')) {
            $query->whereBetween('size', [$request->input('area_min'), $request->input('area_max')]);
        }
        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->input('price_min'), $request->input('price_max')]);
        }
        if ($request->has('sortby')) {
            switch ($request->input('sortby')) {
                case '1':
                    $query->orderBy('views', 'desc');
                    break;
                case '2':
                    $query->orderBy('price', 'asc');
                    break;
                case '3':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }


        // Use pagination instead of getting all records
        $properties = $query->paginate(10); // Change 10 to the number of items per page you want
        if ($request->ajax()) {
            return view('pages.properties.index', compact('properties', 'locations', 'propertyTypes', 'propertyOptions'))->render();
        }

        return view('pages.properties.index', compact('properties', 'locations', 'propertyTypes', 'propertyOptions'));
    }

    public function show($id)
    {

        $property = Property::with('user.userDetail', 'type')->findOrFail($id);
        $property->increment('views');

        // Define the path to the directory containing the images
        $directoryPath = public_path('img/properties/' . $id);

        // Retrieve all image files from the directory
        $imageFiles = File::files($directoryPath);

        // Map each file to its full URL
        $images = array_map(function ($file) use ($id) {
            return asset('img/properties/' . $id . '/' . $file->getFilename());
        }, $imageFiles);
        $properties = Property::where('featured', true)
            ->orderBy('created_at', 'desc') // Or any other criteria
            ->limit(3)
            ->get();

        $otherProperties = Property::where('user_id', $property->user_id)
            ->where('id', '!=', $property->id)
            ->take(5) // Limit the number of properties displayed
            ->get();

        return view('pages.properties.show', compact('properties', 'property', 'images', 'otherProperties'));
    }
    public function userProperties(User $user)
    {
        // Get all properties listed by this user
        $properties = Property::where('user_id', $user->id)->paginate(10);
        $title = 'Proprietăți listate';

        // Return a view with the user's properties
        return view('pages.properties.user-properties', compact('title', 'properties', 'user'));
    }

    public function create()
    {
        $title = 'Adaugă anunț';

        $user = auth()->user();
        $propertyTypes = PropertyType::all();
        $userDetails = UserDetail::where('user_id', $user->id)->first();

        return view('pages.properties.create', compact('user', 'userDetails', 'propertyTypes', 'title'));
    }


    public function get_properties(Request $request)
    {
        $query = Property::with('user.userDetail', 'type');
        /*
                if ($request->has('property-status') && $request->input('property-status') !== '') {
                    $query->where('status', $request->input('property-status'));
                }

                if ($request->has('property-type') && $request->input('property-type') !== '') {
                    $query->where('type_id', $request->input('property-type'));
                }

                if ($request->has('location') && $request->input('location') !== '') {
                    $query->where('location', $request->input('location'));
                }

                if ($request->has('beds') && $request->input('beds') !== '') {
                    $query->where('bedrooms', $request->input('beds'));
                }

                if ($request->has('baths') && $request->input('baths') !== '') {
                    $query->where('bathrooms', $request->input('baths'));
                }
        */
        $properties = $query->get();
        return response()->json($properties);
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Titlul proprietății este obligatoriu.',
            'description.required' => 'Descrierea proprietății este obligatorie.',
            'status.required' => 'Statusul proprietății este obligatoriu.',
            'type_id.required' => 'Tipul proprietății este obligatoriu.',
            'type_id.exists' => 'Tipul selectat nu este valid.',
            'bedrooms.required' => 'Numărul de camere este obligatoriu.',
            'bedrooms.integer' => 'Numărul de camere trebuie să fie un număr întreg.',
            'price.required' => 'Prețul proprietății este obligatoriu.',
            'price.numeric' => 'Prețul trebuie să fie un număr.',
            'size.required' => 'Suprafața proprietății este obligatorie.',
            'size.numeric' => 'Suprafața trebuie să fie un număr.',
            'location.required' => 'Adresa proprietății este obligatorie.',
            'location.max' => 'Adresa nu poate depăși 255 de caractere.',
            'city.required' => 'Orașul este obligatoriu.',
            'city.max' => 'Numele orașului nu poate depăși 255 de caractere.',
            'latitude.numeric' => 'Latitudinea trebuie să fie un număr.',
            'longitude.numeric' => 'Longitudinea trebuie să fie un număr.',
            'con-name.required' => 'Numele de contact este obligatoriu.',
            'con-name.max' => 'Numele de contact nu poate depăși 255 de caractere.',
            'con-email.required' => 'Adresa de email este obligatorie.',
            'con-email.email' => 'Adresa de email trebuie să fie validă.',
            'con-email.max' => 'Adresa de email nu poate depăși 255 de caractere.',
            'con-phn.required' => 'Numărul de telefon este obligatoriu.',
            'con-phn.max' => 'Numărul de telefon nu poate depăși 15 caractere.',
            'file.mimes' => 'Fișierul trebuie să fie de tipul jpg, jpeg sau png.',
            'file.max' => 'Fișierul nu poate fi mai mare de 2048KB.',
        ];

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'status' => 'required|string',
            'type_id' => 'required|integer|exists:property_types,id',
            'bedrooms' => 'required|integer',
            'price' => 'required|numeric',
            'size' => 'required|numeric',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'age' => 'nullable|string',
            'bathrooms' => 'nullable|integer',
            'garages' => 'nullable|integer',
            'con-name' => 'required|string|max:255',
            'con-email' => 'required|email|max:255',
            'con-phn' => 'required|string|max:15',
        ], $messages);

        $validated['age'] = $validated['age'] ?? '0';
        $validated['bathrooms'] = $validated['bathrooms'] ?? 0;
        $validated['garages'] = $validated['garages'] ?? 0;

        $property = new Property();
        $property->fill($validated);
        $property->user_id = auth()->id();
        $mainImage = $request->input('main_image');
        if ($mainImage) {
            $property->image = $mainImage;
        }
        $property->save();
        return response()->json([
            'property_id' => $property->id,
            'message' => 'Anunțul a fost postat cu success !'
        ]);
    }

    public function uploadImages(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'property_id' => 'required|integer',
        ]);

        $propertyId = $request->input('property_id');
        $finalDirectory = 'img/properties/' . $propertyId;
        $finalDirectoryPath = public_path($finalDirectory);

        // Create final directory if it doesn't exist
        if (!File::exists($finalDirectoryPath)) {
            File::makeDirectory($finalDirectoryPath, 0755, true);
        }

        if ($file = $request->file('file')) {
            $filename = $file->getClientOriginalName();
            $filePath = $finalDirectoryPath . '/' . $filename;

            // Save the file to the final directory
            if ($file->move($finalDirectoryPath, $filename)) {
                return response()->json(['success' => 'File uploaded successfully']);
            } else {
                return response()->json(['error' => 'Failed to upload file'], 500);
            }
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function favoriteProperties()
    {
        $title = 'Proprietăți favorite';

        $favorites = Auth::user()->favorites()->paginate(10);
        return view('pages.properties.favortite-properties', compact('favorites', 'title'));
    }

    public function myProperties()
    {
        $title = 'Proprietățile mele';

        $properties = Property::with('user.userDetail', 'type')->where('user_id', Auth::id())->paginate(10);

        return view('pages.properties.my-properties', compact('properties', 'title'));
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);  // Find the property by ID or fail
        return view('pages.properties.edit', compact('property'));  // Return the edit form view
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        // Validate and update the property
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
        ]);

        $property->title = $request->input('title');
        $property->location = $request->input('location');
        $property->price = $request->input('price');

        // Save the property
        $property->save();

        return redirect()->route('my-properties')->with('success', 'Property updated successfully!');
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Delete the property
        $property->delete();

        return redirect()->route('my-properties')->with('success', 'Property deleted successfully!');
    }
}
