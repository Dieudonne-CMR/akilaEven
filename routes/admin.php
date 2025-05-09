<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgenceController2;
use App\Http\Controllers\EventHallController2;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;



/* Route::middleware('auth')->group(function () { */
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'verified']);
    Route::controller(AgenceController2::class)->group(function () {
        // Afficher la liste des agences
        Route::get("/agences",'index')->name("agences");
        // Afficher le formulaire de création d'agences
        Route::get('/agences/create', 'create')->name('agences.create');
        // Enregistrer une agence
        Route::post('/agences/store', 'store')->name('agences.store');
        // Afficher les détails d'une agence
        Route::get('/agences/{agence}', 'show')->name('agences.show');
        // Mettre à jour les médias d'une agence (logo et bannières)
        Route::post('/agences/{agence}/media', 'updateMedia')->name('agences.update-media');
        // Supprimer une agence
        Route::delete('/agences/{agence}', 'destroy')->name('agences.destroy');
        // Supprimer plusieurs agences
        Route::delete('/agences', 'bulkDestroy')->name('agences.bulk-delete');
    });
    
    
    Route::controller(BookingController::class)->group(function () {
        // Afficher la liste des réservations
        Route::get("/bookings", 'index')->name("bookings");
        // Afficher les détails d'une réservation
        Route::get("/bookings/{booking}",'show')->name("booking.show");
        // Supprimer une réservation
        Route::delete("/bookings/{id}", 'destroy')->name("booking.destroy");
        // Suppression groupée de réservations
        Route::delete("/bookings/bulk-delete", 'bulkDestroy')->name("booking.bulk-destroy");
        // Mettre à jour le statut d'une réservation
        Route::patch("/bookings/{booking}/status", 'updateStatus')->name("booking.update-status");
    });
    Route::controller(EventHallController2::class)->group(function () {
        // Afficher la liste des salles de fêtes
        Route::get("/eventHalls", 'index')->name("eventHalls");
        // Afficher le formulaire de création d'une salle de fête
        Route::get("/event-halls/create/{agence}", 'create')->name("event-hall.create");
        // Enregistrer une salle de fête
        Route::post("/event-halls/create/{agence}", 'store')->name("event-hall.store");
        // Voir les détails d'une salle de fête
        Route::get("/event-halls/{event-hall}",'show')->name("event-hall.show");
        // Supprimer une salle de fête
        Route::delete("/event-halls/{event-hall}", 'destroy')->name("event-hall.destroy");
        // Suppression groupée des salles de fête
        Route::delete("/event-halls/bulk-delete", 'bulkDestroy')->name("event-halls.bulk-delete");
        
    });

    Route::controller(LocationController::class)->group(function () {
        // Créer une location d'agence
        Route::get("/locations/create/{agence}", 'create')->name("location.create");
        // Enregistrer une location d'agence
        Route::post("/locations/create/{agence}", 'store')->name("location.store");
        // Afficher la liste des locations
        Route::get("/locations", 'index')->name("locations.index");
        // Afficher les détails d'une location
        Route::get("/locations/{location}", 'show')->name("location.show");
        // Mettre à jour une location
        Route::put("/locations/{location}", 'update')->name("location.update");
        // Supprimer une location   
        Route::delete("/locations/{location}", 'destroy')->name("location.destroy");
        // Suppression groupée des locations
        Route::delete("/locations/bulk-delete", 'bulkDestroy')->name("locations.bulk-delete");
    });
    
    
/* });    

require __DIR__.'/auth.php';
 */