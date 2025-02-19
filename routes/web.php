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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties/upload-images', [PropertyController::class, 'uploadImages'])->name('uploadImages');
    Route::get('/properties/favorite-listings', [PropertyController::class, 'favoriteProperties'])->name('favorite-properties');
    Route::get('/properties/my-listings', [PropertyController::class, 'myProperties'])->name('my-properties');
    Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::post('/property/{id}/update', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/{id}/delete', [PropertyController::class, 'destroy'])->name('property.destroy');
    Route::post('/favorite/{property}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::delete('/favorites/{property}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

});
Route::get('/agents', [AgentController::class, 'index'])->name('agents');

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
Route::get('/assigned-company', action: [CompanyController::class, 'index'])->name('assigned.company.index');

// Include authentication routes
require __DIR__ . '/auth.php';
