<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Auth;
use Illuminate\Support\Str;
use App\Auction;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();

        return view('manage.coupons.index', compact('coupons'));
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
        $user = Auth::user();

        $coupon = new Coupon();
        // $discount = $total * 0.05;
        // $coupon->auction_id = $request->auction_id;
        $coupon->code = Str::random(3) . \Carbon\Carbon::now()->format('y') . $request->auction_id . Str::random(2) . \Carbon\Carbon::now()->format('m');
        // $coupon->code = 'B' . $auction->id . 'D' . \Carbon\Carbon::now()->format('ym');;
        $coupon->discount = $request->discount;
        $coupon->expiration_date = \Carbon\Carbon::now()->addYears(1);
        $coupon->status = 'Active';
        $coupon->user_id = $user->id;
        $coupon->save();

        return back()->with('coupon_success', __('Discount created correctly!'));
    }

    public function coupon(Request $request, $id)
    {
        $user = Auth::user();
        
        $coupon = new Coupon();
        $coupon->auction_id = $id;
        $coupon->code = Str::random(2) . $request->auction_id . Str::random(2) . \Carbon\Carbon::now()->format('ym');
        // $coupon->code = 'B' . $auction->id . 'D' . \Carbon\Carbon::now()->format('ym');;
        $coupon->discount = $request->discount;
        $coupon->expiration_date = \Carbon\Carbon::now()->addYears(1);
        $coupon->status = 'Used';
        $coupon->user_id = $user->id;
        $coupon->save();

        $auction = Auction::findOrFail($id);
        $auction->coupon_id = $coupon->id;
        $auction->discount = $request->discount;
        $auction->save();

        return back()->with('coupon_success', __('discount applied correctly!'));
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
        Coupon::findOrFail($id)->delete();

        return back()->with('flash_message', 'Coupon deleted!');
    }
}
