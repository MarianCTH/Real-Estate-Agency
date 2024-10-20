<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        // Get all users with the type 'Persoană fizică'
        $agents = User::where('type', 'Persoană fizică')->paginate(10);
        $title = 'Agenți imobiliari';

        // Return a view with the agents
        return view('pages.agents.index', compact('agents', 'title'));
    }
}
