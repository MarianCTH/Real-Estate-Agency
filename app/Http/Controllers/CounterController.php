<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;  // Assuming you have Property model
use App\Models\PropertyStatus;
use App\Models\Company;

class CounterController extends Controller
{
    public function index()
    {
        // Fetching the counts for various statistics
        $totalPropertiesCount = Property::count(); // Total count of properties
        $dailyListingsCount = Property::whereDate('created_at', today())->count();
        $soldStatusId = PropertyStatus::where('name', 'Vândut')->value('id');
        $companies = Company::all()->count();

        return view('counter', compact('totalPropertiesCount', 'companies', 'agentsCount', 'languagesCount'));
    }

}
