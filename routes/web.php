<?php

use App\Http\Controllers\EventHallController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Route;



Route::get('', [siteController::class, 'index'])->name('home');
route::get('/site-sallesfetes', [siteController::class, 'salleFete'])->name('site.sallesfetes');
route::get('/site-detail-sallesfetes-{eventHall}', [siteController::class, 'detailFallesFetes'])->name('site.detailSallesfetes');
    
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
    
    Route::get('/hotels/create',[HotelController::class, 'create'])->name('hotels.create');
    // enregistrer un hotel
    Route::post('/hotels/store',[HotelController::class, 'store'])->name('hotels.store');
    // afficher la liste des hotels
    Route::get('/hotel/select',[HotelController::class, 'selectHotel'])->name('select-hotel');
    //
    Route::middleware(['check.hotel.owner'])->group(function(){
        //
        Route::get('/hotels-{hotel}-manage',[HotelController::class, 'manageHotel'])->name('hotels.manage');
        Route::get('/hotels-{hotel}-room-create',[RoomController::class, 'createRoom'])->name('rooms.create');
        Route::get('/hotels-{hotel}-event_halls-create',[EventHallController::class, 'createEventHall'])->name('event_halls.create');
        Route::post('/hotels-{hotel}-event_halls-create',[EventHallController::class, 'storeEventhall'])->name('event_halls.store');
        Route::get('/hotels-{hotel}-event-halls', [EventHallController::class, 'index']) ->name('event-halls.index');

    });
    route::middleware(['aliasMiddleware'])->group(function(){
        Route::get('/hotels-event-halls-{event_hall}',[EventHallController::class, 'show'])->name('event-halls.show');
        Route::get('/event-halls-{event_hall}-edit', [EventHallController::class, 'edit'])->name('event-halls.edit');
        Route::put('/event-halls-{event_hall}', [EventHallController::class, 'update'])->name('event-halls.update');
    });

});



    

require __DIR__.'/auth.php';
