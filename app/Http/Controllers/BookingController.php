<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slots = Slot::all();

        foreach($slots as $slot)
        {
            if(Booking::where('slot_id', $slot->id)->exists())
            {
                if(Booking::where('slot_id', $slot->id)->orderBy('created_at', 'desc')->first()->created_at > Carbon::now())
                {
                    $slot->update(['is_engaged' => 0]);
                }
            }
        }

        return view('booking.create', compact('slots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Slot $slot)
    {
        Booking::create([
            'user_id' => auth()->id(),
            'slot_id' => $slot->id,
            'validity' => request('validity'),
        ]);

        Slot::where('id', $slot->id)->update(['is_engaged' => 1]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking, Slot $slot)
    {
        $booking = Slot::where('id', $slot->id)->first();

        if(!$booking->is_active)
        {
            return view('booking.show', compact('booking'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
