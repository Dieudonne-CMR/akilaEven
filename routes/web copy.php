<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
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
    //  creer un hotel
    Route::get('/hotels/create',[HotelController::class, 'create'])->name('hotels.create');
    // enregistrer un hotel
    Route::post('/hotels/store',[HotelController::class, 'store'])->name('hotels.store');
    // liste des hotels
    // Route::get('/hotels/liste_hotels',[HotelController::class, 'liste_hotels'])->name('hotels.liste_hotels');
    // Route::get('/hotels/{{hotel}}/manage',[HotelController::class, 'manageHotel'])->name('hotels.manage');
    
    // Route::get('/switch-hotel', [HotelController::class, 'showSwitchForm'])->name('hotels.switch');
    // Route::post('/switch-hotel', [HotelController::class, 'switchHotel'])->name('hotels.switch');
    Route::get('/hotels/switch-hotel', [HotelController::class, 'showSwitchForm'])->name('hotels.switch');
    Route::post('/hotels/switch-hotel', [HotelController::class, 'switchHotel']);
    Route::get('/hotels/manager',[HotelController::class, 'manageHotel'])->name('hotels.manage');

    Route::get('/hotels/rooms/create',[RoomController::class, 'createRoom'])->name('rooms.create');
    Route::post('/hotels/rooms/store',[RoomController::class, 'storeRoom'])->name('rooms.store');
    

});

require __DIR__.'/auth.php';
