<?php

use App\Http\Controllers\EventHallController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Route;


Route::get('/mailable', function () {

    $booking = App\Models\Bookings::find(1);
    return new App\Mail\EventHallBookingCreateEmailToAdmin($booking);

});

Route::post("/create-booking", [siteController::class, 'booking'])->name('booking.create');
Route::get("/event-hall-confirm-booking/{token}", [siteController::class, 'eventHallConfirmBooking'])->name('site.event-hall-confirm-booking');
/* Route::get("/event-hall-confirm-booking-page", [siteController::class, 'eventHallConfirmBooking'])->name('site.confirm-booking-event-hall-page'); */
/* ->middleware('signed'); */
Route::get("/locations", [LocationController::class, 'index'])->name('site.bl-locations.locations');
Route::get('', [siteController::class, 'index'])->name('home');
route::get('/site-sallesfetes', [siteController::class, 'salleFete'])->name('site.sallesfetes');
route::get('/site-detail-sallesfetes-{eventHall}', [siteController::class, 'detailSallesFetes'])->name('site.detailSallesfetes');
route::get('/about', [siteController::class, 'about'])->name('site.bl-about.about');
route::get("/contact", [siteController::class, 'contact'])->name('site.bl-contact.contact');
    
    // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->middleware(['auth', 'verified'])->name('dashboard');
        
Route::get('/admin', function () {
    return view('sign-in');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware(['auth'])->group(function(){
 /*    Route:get("/admin/dashboard", AdminDashboardController::class,) */
    Route::controller(AgenceController::class)->group(function () {
        Route::get('/agences/create', 'create')->name('agences.create');
        // enregistrer un agence
        Route::post('/agences/store', 'store')->name('agences.store');
        // afficher la liste des agences
        Route::get('/agence/select','selectAgence')->name('select-agence');
    });
    

    // Accès uniquement aux propriétaires du agence
    Route::middleware(['check.hotel.owner'])->group(function(){
        //
        Route::get('/agences-{agence}-manage',[AgenceController::class, 'manageAgence'])->name('agences.manage');
        Route::get('/agences-{agence}-location-create',[LocationController::class, 'createLocation'])->name('locations.create');
        Route::get('/agences-{agence}-event_halls-create',[EventHallController::class, 'createEventHall'])->name('event_halls.create');
        Route::post('/agences-{agence}-event_halls-create',[EventHallController::class, 'storeEventhall'])->name('event_halls.store');
        // Afficher les salles de fête pour un agence donné
        Route::get('/agences-{agence}-event-halls', [EventHallController::class, 'index']) ->name('event-halls.index');
        

    });
    route::middleware(['auth'])->group(function(){
        Route::get('/agences-event-halls-{event_hall}',[EventHallController::class, 'show'])->name('event-halls.show');
        Route::get('/event-halls-{event_hall}-edit', [EventHallController::class, 'edit'])->name('event-halls.edit');
        Route::put('/event-halls-{event_hall}', [EventHallController::class, 'update'])->name('event-halls.update');
    });

});

require __DIR__.'/auth.php';
