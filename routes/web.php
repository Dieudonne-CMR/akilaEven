<?php

use App\Http\Controllers\EventHallController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Route;


Route::get('/mailable', function () {

    $booking = App\Models\Bookings::find(1);
    return new App\Mail\EventHallBookingCreateEmailToAdmin($booking);

});

Route::post("/create-booking", [siteController::class, 'booking'])->name('booking.create');
Route::get("/event-hall-confirm-booking/{token}", [siteController::class, 'eventHallConfirmBooking'])->name('site.event-hall-confirm-booking')->middleware('signed');
Route::get("/rooms", [RoomController::class, 'index'])->name('site.bl-rooms.rooms');
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
    Route::controller(HotelController::class)->group(function () {
        Route::get('/hotels/create', 'create')->name('hotels.create');
        // enregistrer un hotel
        Route::post('/hotels/store', 'store')->name('hotels.store');
        // afficher la liste des hotels
        Route::get('/hotel/select','selectHotel')->name('select-hotel');
    });
    

    // Accès uniquement aux propriétaires du hotel
    Route::middleware(['check.hotel.owner'])->group(function(){
        //
        Route::get('/hotels-{hotel}-manage',[HotelController::class, 'manageHotel'])->name('hotels.manage');
        Route::get('/hotels-{hotel}-room-create',[RoomController::class, 'createRoom'])->name('rooms.create');
        Route::get('/hotels-{hotel}-event_halls-create',[EventHallController::class, 'createEventHall'])->name('event_halls.create');
        Route::post('/hotels-{hotel}-event_halls-create',[EventHallController::class, 'storeEventhall'])->name('event_halls.store');
        // Afficher les salles de fête pour un hôtel donné
        Route::get('/hotels-{hotel}-event-halls', [EventHallController::class, 'index']) ->name('event-halls.index');
        

    });
    route::middleware(['auth'])->group(function(){
        Route::get('/hotels-event-halls-{event_hall}',[EventHallController::class, 'show'])->name('event-halls.show');
        Route::get('/event-halls-{event_hall}-edit', [EventHallController::class, 'edit'])->name('event-halls.edit');
        Route::put('/event-halls-{event_hall}', [EventHallController::class, 'update'])->name('event-halls.update');
    });

});

// Routes du tableau de bord d'administration
Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

require __DIR__.'/auth.php';
