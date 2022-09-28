<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\ExtraPassenger;
use Response;
use Validator;
use Illuminate\Support\Facedes\input;
use App\http\Requests;
use View;

class ExtrasPassengersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extrapass = ExtraPassenger::all();

        return response()->json($extrapass);
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
    public function store(Request $request, $auction_id)
    {
        $auction = Auction::find($auction_id);
        $this->validate(
            $request,
            [
                'bid' => 'required',
                'bid' => 'required|integer|max:'.$auction->starting_bid
            ]
        );

        $extrapass = new ExtraPassenger();
        $extrapass->extra_id = $request->extra_id;
        $extrapass->quantity = $request->quantity;
        $extrapass->auction()->associate($auction);
        $extrapass->save();
        
        return back();
        
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
        // ExtraPassenger::findOrFail($id)->delete();

        // return back()->with('flash_message', 'Extra deleted!');

        $extrapass = ExtraPassenger::findOrFail($id);
        $extrapass->delete();

        return response()->json($extrapass);
    }
}
