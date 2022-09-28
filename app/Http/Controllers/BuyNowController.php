<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyNowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookings(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $from_city = $request->get('from_city');

        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');
        $perPage = 15;

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->count();
        $tourscount = Auction::tours()->active()->count();
        $emptylegscount = Auction::emptyLegs()->active()->count();
        $trashcount = Auction::where('deleted', 1)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::where('from_city', $from)->where('to_city', $to)
                ->latest()->paginate($perPage);

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('from_city', $from)->where('to_city', $to);
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('from_city', $from)->where('to_city', $to);
            })->where('won', 0)->sum('bid');

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_city', $from)
                ->latest()->paginate($perPage);

            $nobidyet_count = Auction::where('from_city', $from)->where('status', 'Open')->whereDoesntHave('bids')->count();
            $nobidyet_sum = Auction::where('from_city', $from)->where('status', 'Open')->doesntHave('bids')->sum('starting_bid');

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($from) {
                $query->where('from_city', $from)->where('status', 'Closed');
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('from_city', $from)->where('status', 'Open');
            })->where('won', 0)->sum('bid');

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_city', $to)
                ->latest()->paginate($perPage);

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($to) {
                $query->where('to_city', $to);
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('to_city', $to);
            })->where('won', 0)->sum('bid');

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")
                ->latest()->paginate($perPage);

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($service_number) {
                $query->where('service_number', 'LIKE', "%$service_number%");
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($service_number) {
                $query->where('service_number', 'LIKE', "%$service_number%");
            })->where('won', 0)->sum('bid');

        }elseif (!empty($status)) {
            $auctions = Auction::where('status', $status)
                ->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)
                ->paginate($perPage);

            $accepted_bids_sum = Bid::where('won', 1)->sum('bid');
            $open_bids_sum = Bid::where('won', 0)->sum('bid');

        }else {
            $auctions = Auction::where('status', 'Open')->orWhere('status', 'Closed')->where('category_id', '!=', 7)->latest()->paginate($perPage);

            $nobidyet_count = Auction::whereDoesntHave('bids')->count();
            $nobidyet_sum = Auction::where('status', 'Open')->doesntHave('bids')->sum('starting_bid');

            $accepted_bids_sum = Bid::where('won', 1)->sum('bid');
            $open_bids_sum = Bid::where('won', 0)->sum('bid');
        }

        $bids = Bid::where('canceled', 0)->orderBy('bid', 'ASC')->get();

        // Counts
        $auctions_all = Auction::private()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids')->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1)->where('canceled', 0);
            })->count();

        // Bids sum

        $nobidyet_sum = Auction::where('status', 'Open')->doesntHave('bids')->sum('starting_bid');

        $allauctions_sum = $accepted_bids_sum + $open_bids_sum + $nobidyet_sum;

        return view('manage.auctions.bookings',
            compact(
                'auctions',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'accepted_bids_sum',
                'open_bids_sum',
                'nobidyet_sum',
                'allauctions_sum'
                // 'testing_accepted_bid_sum'
                // 'nobidyet_count'
            ));
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
        //
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
