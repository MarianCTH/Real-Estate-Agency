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
        $properties = $user->properties;
        $userDetails = UserDetail::where('user_id', $user->id)->first();
        $publishedPropertiesCount = $user->properties()->count();
        $totalViewsCount = auth()->user()->properties()->sum('views');
        $user = Auth::user();
        $favoriteCount = $user->favoriteCount()->get()->sum('favorited_by_count');

        return view('profile.dash', compact('title','userDetails', 'publishedPropertiesCount','totalViewsCount', 'favoriteCount', 'properties'));
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

    public function updateProfile(Request $request)
    {
        $messages = [
            'name.required' => 'Numele este obligatoriu.',
            'name.string' => 'Numele trebuie să fie text.',
            'name.max' => 'Numele nu poate depăși 255 de caractere.',
            'email.required' => 'Adresa de email este obligatorie.',
            'email.email' => 'Adresa de email trebuie să fie validă.',
            'email.unique' => 'Această adresă de email este deja folosită.',
            'phone.max' => 'Numărul de telefon nu poate depăși 255 de caractere.',
            'address.max' => 'Adresa nu poate depăși 255 de caractere.',
        ];

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . auth()->id(),
                'phone' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
            ], $messages);

            // Update user
            $user = auth()->user();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }
            
            $user->save();

            // Update or create user details
            $userDetails = UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                ]
            );

            return redirect()->back()->with('success', 'Profilul a fost actualizat cu succes!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'A apărut o eroare la actualizarea profilului. Vă rugăm să încercați din nou.');
        }
    }

}
