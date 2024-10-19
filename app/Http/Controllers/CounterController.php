<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;  // Assuming you have Property model

class CounterController extends Controller
{
    public function index()
    {
        // Fetching the counts for various statistics
        $soldPropertiesCount = Property::where('status', 'sold')->count();
        $dailyListingsCount = Property::whereDate('created_at', today())->count();
        $languagesCount = 5; // This could be a static number or fetched from the database

        // Passing the values to the view
        return view('counter', compact('soldPropertiesCount', 'dailyListingsCount', 'agentsCount', 'languagesCount'));
    }
}
