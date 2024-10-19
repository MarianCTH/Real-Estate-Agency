<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        // Fetch the user with related user details
        $user = User::with('userDetail')->findOrFail($id);

        // Pass the user data to the view
        return view('users.show', compact('user'));
    }
}
