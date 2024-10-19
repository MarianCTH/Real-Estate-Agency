<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you are using User model for agents

class AgentController extends Controller
{
    public function show($id)
    {
        $agent = User::findOrFail($id);
        return view('pages.agents.show', compact('agent'));
    }
}
