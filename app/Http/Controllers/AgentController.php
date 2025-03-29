<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Property;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $recentProperties = Property::latest()->take(3)->get();
        $featuredProperties = Property::where('featured', true)->take(3)->get();

        // Start query builder
        $query = User::where('type', 'Agent imobiliar')
            ->withCount('properties')
            ->with('company');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('userDetail', function($q) use ($search) {
                      $q->where('phone', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting functionality
        $sortBy = $request->get('sortby', 'name');
        $sortDirection = $request->get('direction', 'asc');

        switch ($sortBy) {
            case 'company':
                $query->orderBy('company_id', $sortDirection);
                break;
            case 'properties':
                $query->orderBy('properties_count', $sortDirection);
                break;
            default:
                $query->orderBy('name', $sortDirection);
        }

        // Paginate with 5 items per page
        $agents = $query->paginate(5);

        $title = 'Agenți imobiliari';

        return view('pages.agents.index', compact('agents', 'title', 'recentProperties', 'featuredProperties'));
    }
}
