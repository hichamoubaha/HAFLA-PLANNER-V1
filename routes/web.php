<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\EventController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\BookingController;

use App\Http\Controllers\ParticipantController;

use App\Http\Controllers\ServiceProviderController;

use App\Http\Controllers\ReviewController;

Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Booking routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    // Organiser booking management
    Route::get('/events/{event}/bookings', [BookingController::class, 'eventBookings'])->name('bookings.event');
    Route::put('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    
    // Participant management
    Route::get('/participants', [ParticipantController::class, 'index'])->name('participants.index');
    Route::get('/participants/{user}', [ParticipantController::class, 'show'])->name('participants.show');

    // Service Provider Routes
    Route::get('/service-providers', [ServiceProviderController::class, 'index'])->name('service-providers.index');
    Route::get('/service-providers/create', [ServiceProviderController::class, 'create'])->name('service-providers.create');
    Route::post('/service-providers', [ServiceProviderController::class, 'store'])->name('service-providers.store');
    Route::get('/service-providers/{provider}', [ServiceProviderController::class, 'show'])->name('service-providers.show');
    Route::get('/service-providers/{provider}/edit', [ServiceProviderController::class, 'edit'])->name('service-providers.edit');
    Route::put('/service-providers/{provider}', [ServiceProviderController::class, 'update'])->name('service-providers.update');
    Route::delete('/service-providers/{provider}', [ServiceProviderController::class, 'destroy'])->name('service-providers.destroy');

    // Review Routes
    Route::post('/service-providers/{provider}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});


Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/package', function () {
    return view('package'); 
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



//routes