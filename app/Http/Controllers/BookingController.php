<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorebookingsRequest;
use App\Http\Requests\UpdatebookingsRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Bookings::all();
        return view('admin.booking.bookings');
    }


    /**
     * Afficher les détails d'une réservation
     * @param  Bookings  $bookings
     * @return View
     */
    public function show(Bookings $booking)
    {
        //
        return view("admin.booking.show-booking");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookings $bookings)
    {
        //
    }
}
