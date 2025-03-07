<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\User;  // Assuming you have a User model
use App\Models\PropertyStatus;
use App\Models\Company;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalPropertiesCount = Property::count(); // Total count of properties

        $soldStatusId = PropertyStatus::where('name', 'Vândut')->value('id');
        $soldPropertiesCount = Property::where('status_id', $soldStatusId)->count();
        $companies = Company::all()->count();
        $agentsCount = User::where('type', 'Agent imobiliar')->count();
        $languagesCount = User::where('type', 'Persoană fizică')->count();

        $lastProperties = Property::latest()->take(6)->get();
        $starredProperties = Property::where('featured', true)->latest()->take(6)->get();

        return view('welcome', compact('totalPropertiesCount', 'lastProperties', 'starredProperties',
        'soldPropertiesCount', 'companies', 'agentsCount', 'languagesCount'));
    }
}
