<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\ConfidentialityPolicyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CompanyController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Registration Routes
Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);

// Password Reset Routes
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

// Email Verification Routes
Route::get('verify-email', [EmailVerificationNotificationController::class, 'create'])
    ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->name('verification.send');

Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/dash', [ProfileController::class, 'getDash'])->name('dash');
    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties/upload-images', [PropertyController::class, 'uploadImages'])->name('uploadImages');
    Route::get('/properties/favorite-listings', [PropertyController::class, 'favoriteProperties'])->name('favorite-properties');
    Route::get('/properties/my-listings', [PropertyController::class, 'myProperties'])->name('my-properties');
    Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/{id}/delete', [PropertyController::class, 'destroy'])->name('property.destroy');
    Route::post('/favorite/{property}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::delete('/favorites/{property}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Property image management routes
    Route::post('/properties/delete-image', [PropertyController::class, 'deleteImage'])->name('deleteImage');
    Route::post('/properties/set-main-image', [PropertyController::class, 'setMainImage'])->name('setMainImage');
});

Route::middleware(['auth', 'agent'])->group(function () {
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/assign', [CompanyController::class, 'assign'])->name('companies.assign');
    Route::get('/companies/join/{company}', [CompanyController::class, 'join'])->name('companies.join');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
    Route::get('/companies/{company}/members', [CompanyController::class, 'members'])->name('companies.members');
    Route::post('/companies/{company}/members/{user}/accept', [CompanyController::class, 'acceptMember'])->name('companies.members.accept');
    Route::delete('/companies/{company}/members/{member}', [CompanyController::class, 'removeMember'])
    ->name('companies.members.remove');
    Route::post('/companies/leave', [CompanyController::class, 'leaveCompany'])->name('companies.leave');
    Route::post('/companies/{company}/join-requests/{request}/approve', [CompanyController::class, 'approveJoinRequest'])->name('companies.approveJoinRequest');
    Route::post('/companies/{company}/join-requests/{request}/reject', [CompanyController::class, 'rejectJoinRequest'])->name('companies.rejectJoinRequest');
});

Route::get('/agents', [AgentController::class, 'index'])->name('agents');
Route::get('/agencies', [CompanyController::class, 'agencies_view'])->name('agencies');
Route::get('/agencies/{company}/properties', [CompanyController::class, 'agencyProperties'])->name('agency.properties');
Route::get('/user/{user}/properties', [PropertyController::class, 'userProperties'])->name('user.properties');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties');

Route::get('/get_properties', [PropertyController::class, 'get_properties']);

Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('property.show');

Route::get('/about-us', [PageController::class, 'about'])->name('about-us');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/cookie-policy', [CookiePolicyController::class, 'show'])->name('cookie.policy');
Route::get('/confidentiality-policy', action: [ConfidentialityPolicyController::class, 'show'])->name('confidentiality.policy');

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::where('email', $googleUser->email)->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => bcrypt(str()->random(16)),
            'email_verified_at' => now(),
        ]);
    }

    Auth::login($user);

    return redirect('/');
});

// Include authentication routes
require __DIR__ . '/auth.php';
