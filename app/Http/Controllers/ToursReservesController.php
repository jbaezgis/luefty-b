<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourReserve;
use App\Tour;

class ToursReservesController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tour = Tour::where('id', $request->tour_id)->first();

        $booking = new TourReserve();
        $booking->tour_id = $request->tour_id;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->date = $request->date;
        $booking->more_info = $request->more_info;

        $booking->adults = $request->adults;
        $booking->children = $request->children;

        $adults_total = $request->adults * $tour->adults_price;
        $childen_total = $request->childen * $tour->childen_price;

        $booking->order_total = $adults_total + $childen_total;

        $booking->save();

        Mail::to($booking->email)->send(new TourClientNotification($booking));
        Mail::to('info@luefty.com')->send(new TourLueftyNotification($booking));

        return back()->with('flash_message', __('Thank you!'));
        // return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
