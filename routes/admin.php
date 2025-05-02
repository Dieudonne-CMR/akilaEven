<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController2;
use App\Http\Controllers\EventHallController2;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;



/* Route::middleware('auth')->group(function () { */
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::controller(HotelController2::class)->group(function () {
        // Afficher la liste des hôtels
        Route::get("/hotels",'index')->name("hotels");
        // Afficher le formulaire de création d'hôtels
        Route::get('/hotels/create', 'create')->name('hotels.create');
        // Enregistrer un hôtel
        Route::post('/hotels/store', 'store')->name('hotels.store');
        // Afficher le formulaire de création d'hôtels
        Route::get('/hotels/{hotel}', 'show')->name('hotels.show');
        
    });
    
    
    Route::controller(BookingController::class)->group(function () {
        // Afficher la liste des réservations
        Route::get("/bookings", 'index')->name("bookings");
        // Afficher les détails d'une réservation
        Route::get("/bookings/{booking}",'show')->name("booking.show");
        
    });
    Route::controller(EventHallController2::class)->group(function () {
        // Afficher la liste des salles de fêtes
        Route::get("/eventHalls", 'index')->name("eventHalls");
        // Créer une salle de fête
        Route::get("/event-halls/create/{hotel}", 'create')->name("event-hall.create");
        // Enregistrer une salle de fête
        Route::post("/event-halls/create/{hotel}", 'store')->name("event-hall.store");
        // Voir les détails d'une salle de fête
        Route::get("/event-halls/{event-hall}",'show')->name("event-hall.show");
        
    });

    
    
/* });    

require __DIR__.'/auth.php';
 */