<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $title = 'Societate imobiliară';

        // Get the logged-in user's company, if they have one
        $user = auth()->user();
        $company = $user->company;  // Assuming the 'company' relation is set up correctly in the User model

        return view('pages.company.assigned-company', compact('title', 'company'));
    }

}
