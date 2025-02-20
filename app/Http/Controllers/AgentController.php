<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Property;

class AgentController extends Controller
{
    public function index()
    {
        $recentProperties = Property::latest()->take(3)->get();
        $featuredProperties = Property::where('featured', true)->take(3)->get();

        // Eager load the count of properties and the company for each agent
        $agents = User::where('type', 'Agent imobiliar')
            ->withCount('properties') // Count properties
            ->with('company') // Eager load company relationship
            ->paginate(10);

        $title = 'Agenți imobiliari';

        return view('pages.agents.index', compact('agents', 'title', 'recentProperties', 'featuredProperties'));
    }
}
