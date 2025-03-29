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
use App\Models\PropertyStatus;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::all();
        $propertyTypes = PropertyType::all();
        $propertyOptions = PropertyOption::all();
        $propertyStatuses = PropertyStatus::all(); // Fetch statuses from the database

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
            $query->where('type_id', $request->input('property_type'));
        }
        if ($request->filled('status')) {
            $query->where('status_id', $request->input('status')); // Adjust for the new structure
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->input('bedrooms'));
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->input('bathrooms'));
        }
        if ($request->filled('area_min') && $request->filled('area_max')) {
            $query->whereBetween('size', [$request->input('area_min'), $request->input('area_max')]);
        }
        if ($request->filled('price_min') && $request->filled('price_max')) {
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
            return view('pages.properties.index', compact('properties', 'locations', 'propertyTypes', 'propertyOptions', 'propertyStatuses'))->render();
        }

        return view('pages.properties.index', compact('properties', 'locations', 'propertyTypes', 'propertyOptions', 'propertyStatuses'));
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
    public function userProperties(User $user, Request $request)
    {
        // Default sorting (normal)
        $sortBy = $request->input('sortby', 'normal');

        // Query properties based on the user ID
        $propertiesQuery = Property::where('user_id', $user->id);

        // Apply sorting logic based on the selected option
        switch ($sortBy) {
            case '1': // Most viewed
                $propertiesQuery->orderBy('views', 'desc');
                break;
            case '2': // Price ascending
                $propertiesQuery->orderBy('price', 'asc');
                break;
            case '3': // Price descending
                $propertiesQuery->orderBy('price', 'desc');
                break;
            default:
                // No sorting applied, or normal sorting
                $propertiesQuery->latest();
                break;
        }

        // Paginate the results
        $properties = $propertiesQuery->paginate(10);

        // Return the view with sorted properties
        $title = 'Proprietăți listate';
        return view('pages.properties.user-properties', compact('title', 'properties', 'user', 'sortBy'));
    }


    public function create()
    {
        $title = 'Adaugă anunț';

        $user = auth()->user();
        $propertyTypes = PropertyType::all();
        $propertyStatuses = PropertyStatus::all();
        $userDetails = UserDetail::where('user_id', $user->id)->first();

        return view('pages.properties.create', compact('user', 'userDetails', 'propertyTypes', 'title', 'propertyStatuses'));
    }


    public function get_properties(Request $request)
    {
        $user = auth()->user();
    
        // Start with a query builder
        $query = Property::with('user.userDetail', 'type', 'status');
    
        // Apply filters based on request parameters
        if ($request->filled('property-status')) {
            $query->whereHas('status', function ($q) use ($request) {
                $q->where('name', $request->input('property-status'));
            });
        }
    
        if ($request->filled('property-type')) {
            $query->whereHas('type', function ($q) use ($request) {
                $q->where('name', $request->input('property-type'));
            });
        }
    
        if ($request->filled('location')) {
            $query->whereHas('location', function ($q) use ($request) {
                $q->where('name', $request->input('location'));
            });
        }
    
        if ($request->filled('beds')) {
            $query->where('bedrooms', $request->input('beds'));
        }
    
        if ($request->filled('baths')) {
            $query->where('bathrooms', $request->input('baths'));
        }
    
        if ($request->filled('areaMin')) {
            $query->where('size', '>=', $request->input('areaMin'));
        }
    
        if ($request->filled('areaMax')) {
            $query->where('size', '<=', $request->input('areaMax'));
        }
    
        if ($request->filled('priceMin')) {
            $query->where('price', '>=', (float) $request->input('priceMin'));
        }
        
        if ($request->filled('priceMax')) {
            $query->where('price', '<=', (float) $request->input('priceMax'));
        }
        
        // Fetch filtered properties
        $properties = $query->get();
    
        // Get the current comparison list from session
        $compareList = session('compare_list', []);
    
        // Add 'is_favorited' and 'is_in_compare' fields for each property
        $properties->transform(function ($property) use ($user, $compareList) {
            $property->is_favorited = $user ? $user->favorites->contains($property->id) : false;
            $property->is_in_compare = in_array($property->id, $compareList);
            return $property;
        });
    
        return response()->json($properties);
    }
    

    public function store(Request $request)
    {
        try {
            $messages = [
                'title.required' => 'Titlul proprietății este obligatoriu.',
                'description.required' => 'Descrierea proprietății este obligatorie.',
                'status_id.required' => 'Statusul proprietății este obligatoriu.',
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
                'latitude.numeric' => 'Latitudinea trebuie să fie un număr.',
                'longitude.numeric' => 'Longitudinea trebuie să fie un număr.',
                'con-name.required' => 'Numele de contact este obligatoriu.',
                'con-name.max' => 'Numele de contact nu poate depăși 255 de caractere.',
                'con-email.required' => 'Adresa de email este obligatorie.',
                'con-email.email' => 'Adresa de email trebuie să fie validă.',
                'con-email.max' => 'Adresa de email nu poate depăși 255 de caractere.',
                'con-phn.required' => 'Numărul de telefon este obligatoriu.',
                'con-phn.max' => 'Numărul de telefon nu poate depăși 15 caractere.',
            ];

            $validated = $request->validate([
                'title' => 'required|string|max:100',
                'description' => 'required|string',
                'status_id' => 'required|numeric',
                'type_id' => 'required|integer|exists:property_types,id',
                'bedrooms' => 'nullable|integer',
                'price' => 'required|numeric|min:0|max:9223372036854775807',
                'size' => 'required|numeric',
                'location' => 'required|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'bathrooms' => 'nullable|integer',
                'garages' => 'nullable|integer',
                'con-name' => 'required|string|max:255',
                'con-email' => 'required|email|max:255',
                'con-phn' => 'required|string|max:15',
            ], $messages);

            // Set default values for nullable fields
            $validated['bathrooms'] = $validated['bathrooms'] ?? 0;
            $validated['garages'] = $validated['garages'] ?? 0;
            $validated['bedrooms'] = $validated['bedrooms'] ?? 0;
            $validated['user_id'] = auth()->id();

            // Create the property
            $property = new Property();
            $property->fill($validated);

            // Handle main image if provided
            if ($request->filled('main_image')) {
                $property->image = $request->input('main_image');
            }

            // Save the property
            $property->save();

            return response()->json([
                'property_id' => $property->id,
                'message' => 'Anunțul a fost postat cu success!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Property creation error: ' . $e->getMessage());
            return response()->json([
                'message' => 'A apărut o eroare la salvarea proprietății.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function uploadImages(Request $request)
    {
        try {
            // First validate the request with custom messages
            $messages = [
                'file.required' => 'Vă rugăm să selectați o imagine.',
                'file.image' => 'Fișierul trebuie să fie o imagine.',
                'file.mimes' => 'Formatul imaginii trebuie să fie: jpg, jpeg sau png.',
                'file.max' => 'Dimensiunea imaginii nu poate depăși 2MB.',
                'property_id.required' => 'ID-ul proprietății este obligatoriu.',
                'property_id.integer' => 'ID-ul proprietății trebuie să fie un număr întreg.'
            ];

            $request->validate([
                'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'property_id' => 'required|integer',
            ], $messages);

            $propertyId = $request->input('property_id');
            
            // Create the base properties directory
            $basePropertiesDir = public_path('img/properties');
            if (!File::exists($basePropertiesDir)) {
                if (!File::makeDirectory($basePropertiesDir, 0755, true)) {
                    \Log::error('Failed to create base directory: ' . $basePropertiesDir);
                    return response()->json([
                        'success' => false,
                        'message' => 'Nu s-a putut crea directorul pentru imagini'
                    ], 500);
                }
            }

            // Create the property-specific directory
            $propertyDir = $basePropertiesDir . '/' . $propertyId;
            if (!File::exists($propertyDir)) {
                if (!File::makeDirectory($propertyDir, 0755, true)) {
                    \Log::error('Failed to create property directory: ' . $propertyDir);
                    return response()->json([
                        'success' => false,
                        'message' => 'Nu s-a putut crea directorul pentru proprietate'
                    ], 500);
                }
            }

            // Handle the file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                
                // Generate a unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $propertyDir . '/' . $filename;

                // Move the file
                if ($file->move($propertyDir, $filename)) {
                    \Log::info('File uploaded successfully: ' . $filename);
                    return response()->json([
                        'success' => true,
                        'filename' => $filename,
                        'message' => 'Imaginea a fost încărcată cu succes'
                    ]);
                } else {
                    \Log::error('Failed to move file to: ' . $filePath);
                    return response()->json([
                        'success' => false,
                        'message' => 'Nu s-a putut încărca imaginea'
                    ], 500);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Nu a fost selectată nicio imagine'
            ], 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Eroare de validare',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Eroare la încărcarea imaginii: ' . $e->getMessage()
            ], 500);
        }
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
        $property = Property::with(['type', 'status'])->findOrFail($id);
        $title = 'Editare proprietate';
        $propertyTypes = PropertyType::all();
        $propertyStatuses = PropertyStatus::all();
        $user = auth()->user();
        $userDetails = UserDetail::where('user_id', $user->id)->first();

        // Get existing images
        $propertyImages = glob(public_path('img/properties/' . $property->id . '/*.*'));
        $images = array_map(function($file) {
            return [
                'name' => basename($file),
                'size' => filesize($file),
                'path' => str_replace(public_path(), '', $file)
            ];
        }, $propertyImages ?: []);

        return view('pages.properties.edit', compact(
            'property', 
            'title', 
            'propertyTypes', 
            'propertyStatuses', 
            'user', 
            'userDetails',
            'images'
        ));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        // Handle deleted files first
        if ($request->has('deleted_files')) {
            $deletedFiles = json_decode($request->deleted_files, true);
            if (is_array($deletedFiles)) {
                foreach ($deletedFiles as $filename) {
                    $filePath = public_path('img/properties/' . $id . '/' . $filename);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                        
                        // If the deleted file was the main image, clear it
                        if ($property->image === $filename) {
                            $property->image = null;
                        }
                    }
                }
            }
        }

        // Update property fields that exist in the table
        $property->title = $request->title;
        $property->description = $request->description;
        $property->status_id = $request->status_id;
        $property->type_id = $request->type_id;
        $property->bedrooms = $request->bedrooms;
        $property->price = $request->price;
        $property->size = $request->size;
        $property->garages = $request->garages ?? $property->garages;
        $property->bathrooms = $request->bathrooms ?? $property->bathrooms;

        // Update main image if changed
        if ($request->has('main_image') && $request->main_image) {
            $property->image = $request->main_image;
        }

        $property->save();

        return redirect()->route('my-properties')->with('success', 'Proprietatea a fost actualizată cu succes!');
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Delete the property
        $property->delete();

        return redirect()->route('my-properties')->with('success', 'Property deleted successfully!');
    }

    // Property comparison methods
    public function addToCompare(Request $request, $id)
    {
        $compareList = session('compare_list', []);
        
        if (in_array($id, $compareList)) {
            return response()->json([
                'success' => false,
                'message' => 'Această proprietate este deja în lista de comparație.'
            ]);
        }

        if (count($compareList) >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Puteți compara maxim 3 proprietăți.'
            ]);
        }

        $compareList[] = $id;
        session(['compare_list' => $compareList]);

        return response()->json([
            'success' => true,
            'message' => 'Proprietatea a fost adăugată la comparație.',
            'count' => count($compareList)
        ]);
    }

    public function removeFromCompare(Request $request, $id)
    {
        try {
            $compareList = session('compare_list', []);
            $compareList = array_values(array_diff($compareList, [$id]));
            session(['compare_list' => $compareList]);

            return response()->json([
                'success' => true,
                'message' => 'Proprietatea a fost eliminată din comparație.',
                'count' => count($compareList)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'A apărut o eroare la eliminarea proprietății din comparație.'
            ], 500);
        }
    }

    public function compare()
    {
        $compareList = session('compare_list', []);
        $properties = Property::whereIn('id', $compareList)->get();
        
        return view('pages.properties.compare', compact('properties'));
    }

    public function clearCompare(Request $request)
    {
        try {
            session()->forget('compare_list');
            
            return response()->json([
                'success' => true,
                'message' => 'Lista de comparație a fost ștearsă.',
                'count' => 0
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'A apărut o eroare la ștergerea listei de comparație.'
            ], 500);
        }
    }
}
