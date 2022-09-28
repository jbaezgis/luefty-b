<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\FakeBid;

class FakeBidsController extends Controller
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
        $auction = Auction::where('id', $request->auction_id)->first();

        $fakebids = FakeBid::where('auction_id', $auction->id)->get();

        $bid = new FakeBid();
        $bid->auction_id = $auction->id;

        if($auction->type == 'roundtrip')
        {
            $total = $auction->order_total; //286

            if($fakebids->count() == 1) 
            {
                $bid_per = $total * 0.10; // 314.6
                $bid->bid = $total + $bid_per;

            }elseif($fakebids->count() == 2)
            {
                $bid_per = $total * 0.06; //303.16
                $bid->bid = $total + $bid_per;
            }elseif($fakebids->count() == 3)
            {
                $bid->bid = $total; //286
            }
        }else{
            if($fakebids->count() == 1) 
            {
                $bid_per = $auction->order_total * 0.10;
                $bid->bid = $auction->order_total + $bid_per;
    
            }elseif($fakebids->count() == 2)
            {
                $bid_per = $auction->order_total * 0.06;
                $bid->bid = $auction->order_total + $bid_per;
            }elseif($fakebids->count() == 3)
            {
                $bid->bid = $auction->order_total;
            }
        }


        $bid->save();

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
        $auction = Auction::where('id', $request->auction_id)->first();
        $bid = FakeBid::findOrFail($id);
        
        // Bid
        $bid->selected = 1;
        $bid->save();

        // Auction
        $auction->status = '';
        $auction->order_total = $bid->bid;
        $auction->save();

        // event(new BidAcceptedNotification($bid));

        // return redirect('booking/confirmation/'.$auction->key);
        return redirect('booking/complete_form/'.$auction->key.'/edit');
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
