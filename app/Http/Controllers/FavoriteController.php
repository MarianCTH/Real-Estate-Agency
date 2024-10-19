<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Property $property)
    {
        $user = auth()->user();
        if ($user->favorites()->where('property_id', $property->id)->exists()) {
            // Remove from favorites
            $user->favorites()->detach($property->id);
        } else {
            // Add to favorites
            $user->favorites()->attach($property->id);
        }

        return back();
    }

    public function destroy($propertyId)
    {
        $user = Auth::user();

        // Assuming you have a pivot table for favorites
        $user->favorites()->detach($propertyId);

        return redirect()->back()->with('success', 'Property removed from favorites.');
    }
}
