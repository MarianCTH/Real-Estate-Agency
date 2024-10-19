<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookiePolicyController extends Controller
{
    public function show()
    {
        return view('pages.others.cookie-policy');
    }
}
