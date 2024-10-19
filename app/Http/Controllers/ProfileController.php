<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserDetail;
use App\Models\Property;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($request->user()->image && Storage::exists('public/images/' . $request->user()->image)) {
                Storage::delete('public/images/' . $request->user()->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);

            // Update user with the new image name
            $request->user()->image = $imageName;
        }

        // Update other user details
        $request->user()->fill($request->except('image'));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        if ($user->image && Storage::exists('public/images/' . $user->image)) {
            Storage::delete('public/images/' . $user->image);
        }
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function changePassword(Request $request): View
    {
        $title = "Schimbă parola";
        return view('profile.change-password', compact('title'));
    }

    public function getProfile(Request $request): View
    {
        $title = "Profilul meu";
        $user = auth()->user();
        $userDetails = UserDetail::where('user_id', $user->id)->first();

        return view('profile.profile', compact('title','userDetails'));
    }

    public function getDash(Request $request): View
    {
        $title = "Panoul de utilizator";
        $user = auth()->user();
        $userDetails = UserDetail::where('user_id', $user->id)->first();
        $publishedPropertiesCount = Property::where('status', 'published')->count();
        $totalViewsCount = Property::sum('views'); // Assuming you have a 'views' column in the properties table

        return view('profile.dash', compact('title','userDetails', 'publishedPropertiesCount','totalViewsCount'));
    }

    public function updatePassword(Request $request)
    {
        // Define custom validation messages
        $messages = [
            'current_password.required' => 'Parola curentă este obligatorie.',
            'new_password.required' => 'Parola nouă este obligatorie.',
            'new_password.min' => 'Parola nouă trebuie să aibă cel puțin 8 caractere.',
            'confirm_new_password.required' => 'Confirmarea parolei noi este obligatorie.',
            'confirm_new_password.same' => 'Confirmarea parolei noi nu corespunde cu parola nouă.',
        ];

        // Validate the input fields with custom messages
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ], $messages);

        // Check if the current password is correct
        if (!Hash::check($request->input('current_password'), Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Parola curentă este incorectă.']);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));

        // Save the updated user
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Parola a fost schimbată cu succes!');
    }


}
