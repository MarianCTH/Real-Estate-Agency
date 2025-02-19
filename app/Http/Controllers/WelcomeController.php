<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\User;  // Assuming you have a User model

class WelcomeController extends Controller
{
    public function index()
    {
        $soldPropertiesCount = Property::where('status', 'sold')->count();
        $dailyListingsCount = Property::whereDate('created_at', today())->count();
        $agentsCount = User::where('type', 'Agent imobiliar')->count();
        $languagesCount = User::where('type', 'Persoană fizică')->count();

        $lastProperties = Property::latest()->take(6)->get();
        $starredProperties = Property::where('featured', true)->latest()->take(6)->get();

        return view('welcome', compact('lastProperties', 'starredProperties',
        'soldPropertiesCount', 'dailyListingsCount', 'agentsCount', 'languagesCount'));
    }
}
