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
// Creer une réservation de salle
Route::post("/site-detail-sallesfetes-{eventHall}/create-event-hall-booking", [siteController::class, 'storeEventHallBooking'])->name('event-hall-booking.store');
// Confirmer la réservation d'une salle par mail
Route::get("/book-event-hall-booking/{token}", [siteController::class, 'bookEventHallBooking'])->name('site.event-hall-booking.book')->middleware('signed');
// Annuler la réservation d'une salle par mail
Route::get("/cancel-event-hall-booking/{token}", [siteController::class, 'cancelEventHallBooking'])->name('site.event-hall-booking.cancel')->middleware('signed');
// Confirmer la réservation d'une location par mail
Route::get("/book-location-booking/{token}", [siteController::class, 'bookLocationBooking'])->name('site.location-booking.book')->middleware('signed');
// Annuler la réservation d'une location par mail
Route::get("/cancel-location-hall-booking/{token}", [siteController::class, 'cancelLocationBooking'])->name('site.location-booking.cancel')->middleware('signed');

Route::get("/locations", [LocationController::class, 'index'])->name('site.locations');
// Page d'accueil
Route::get('', [siteController::class, 'index'])->name('home');
// Page des salles de fêtes
route::get('/site-sallesfetes', [siteController::class, 'salleFete'])->name('site.sallesfetes');
// Page des détails d'une salle de fête
route::get('/site-detail-sallesfetes-{eventHall}', [siteController::class, 'detailSallesFetes'])->name('site.detailSallesfetes');
// Page about
route::get('/about', [siteController::class, 'about'])->name('site.about');
// Page contact
route::get("/contact", [siteController::class, 'contact'])->name('site.contact');
    
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
