<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('sign-in');
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/salles', [HomeController::class, 'salles'])->name('salles');
    Route::get('/add-salle', [HomeController::class, 'addsalle'])->name('add-salle');
    //  creer un agence
    Route::get('/agences/create',[AgenceController::class, 'create'])->name('agences.create');
    // enregistrer un agence
    Route::post('/agences/store',[AgenceController::class, 'store'])->name('agences.store');
    // liste des agences
    // Route::get('/agences/liste_agences',[AgenceController::class, 'liste_agences'])->name('agences.liste_agences');
    // Route::get('/agences/{{agence}}/manage',[AgenceController::class, 'manageAgence'])->name('agences.manage');
    
    // Route::get('/switch-agence', [AgenceController::class, 'showSwitchForm'])->name('agences.switch');
    // Route::post('/switch-agence', [AgenceController::class, 'switchAgence'])->name('agences.switch');
    Route::get('/agences/switch-agence', [AgenceController::class, 'showSwitchForm'])->name('agences.switch');
    Route::post('/agences/switch-agence', [AgenceController::class, 'switchAgence']);
    Route::get('/agences/manager',[AgenceController::class, 'manageAgence'])->name('agences.manage');

    Route::get('/agences/locations/create',[LocationController::class, 'createLocation'])->name('locations.create');
    Route::post('/agences/locations/store',[LocationController::class, 'storeLocation'])->name('locations.store');
    

});

require __DIR__.'/auth.php';
