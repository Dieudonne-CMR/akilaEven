<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController2;
use App\Http\Controllers\EventHallController2;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
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
        // Afficher les détails d'un hôtel
        Route::get('/hotels/{hotel}', 'show')->name('hotels.show');
        // Supprimer un hôtel
        Route::delete('/hotels/delete/{hotel}', 'destroy')->name('hotels.destroy');
        // Supprimer plusieurs hôtels
        Route::delete('/hotels', 'bulkDestroy')->name('hotels.bulk-delete');
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

    Route::controller(RoomController::class)->group(function () {
        // Créer une chambre d'hôtel
        Route::get("/rooms/create/{hotel}", 'create')->name("rooms.create");
        // Enregistrer une chambre d'hôtel
        Route::post("/rooms/create/{hotel}", 'store')->name("rooms.store");
    });
    
    
/* });    

require __DIR__.'/auth.php';
 */