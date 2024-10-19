<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'EMAIL' => 'required|email',
        ]);

        // Check if the email is already subscribed
        $existingSubscription = Subscription::where('email', $request->input('EMAIL'))->first();

        if ($existingSubscription) {
            // Return a JSON response indicating that the email is already subscribed
            return response()->json(['error' => 'Acest email este deja abonat.'], 400);
        }

        // Create a new subscription record
        Subscription::create([
            'email' => $request->input('EMAIL'),
        ]);

        // Return a JSON response for AJAX requests
        return response()->json(['success' => 'Abonarea a fost făcută cu success!']);
    }
}
