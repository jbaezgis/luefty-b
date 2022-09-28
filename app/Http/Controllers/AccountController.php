<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Auction;

use App\Tour;

use App\User;

use App\Bid;

use Auth;

use Mail;

use App\Http\Requests\CreateAuctionsRequest;

class AccountController extends Controller
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
    public function index(Request $request, Auction $auctions, Bid $bids)
    {
        $user_id = Auth::user()->id;
        $perPage = 10;

        $auctions = Auction::where('user_id', $user_id)->latest()->paginate($perPage);

        $bids = Bid::where('user_id', $user_id)->latest()->paginate($perPage);
        
        return view('account.index', compact('auctions', 'bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function auctions(Request $request, Auction $auctions) 
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        
        if (!empty($keyword)) {
            $auctions = Auction::where('user_id', $user_id)->where('from', 'LIKE', "%$keyword%")->orWhere('to', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $auctions = Auction::where('user_id', $user_id)->latest()->paginate($perPage);
        }

        $bids = Bid::get();

        return view('account.auctions', compact('auctions', 'bids'));
    }

    public function showauction($id)
    {
        $auction = Auction::findOrFail($id);
        $auction_id = Auction::value('id');
        $bids = Bid::sortable()->where('auction_id', $auction)->get();
        $bid_won = Bid::where('auction_id', $id)->won()->count();

        // return view('auctions.show', [
        //     'auction' => $auction,
        //     'bid' => $auction->bids()->where('user_id', \Auth::id())->first()
        // ]);    
        return view('account.showauction', compact('auction', 'bids', 'bid_won'));   

    }

    public function tours(Request $request, Tour $tours)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        
        if (!empty($keyword)) {
            $tours = Tour::where('user_id', $user_id)->where('location', 'LIKE', "%$keyword%")->open()->latest()->paginate($perPage);
        } else {
            $tours = Tour::latest()->paginate($perPage);
        }

        // $tours = Tour::get();

        $bids = Bid::get();

        return view('account.tours', compact('tours', 'bids'));
    }

    public function createTour()
    {
        return view('account.create_tour');
    }

    public function storeTour(CreateToursRequest $request)
    {
        auth()->user()->tours()->create($request->all());

        return redirect()->route('account.my-tours')->with('flash_message', 'Tour added!');
    }

    public function showTour($id)
    {
        $tour = Tour::findOrFail($id);
        $tour_id = Tour::value('id');
        $bids = Bid::sortable()->where('tour_id', $tour)->get();
        $bid_won = Bid::where('tour_id', $id)->won()->count();

        // return view('auctions.show', [
        //     'auction' => $auction,
        //     'bid' => $auction->bids()->where('user_id', \Auth::id())->first()
        // ]);    
        return view('account.showtour', compact('tour', 'bids', 'bid_won'));   

    }

    public function auctionsBids(Request $request, Bid $bids)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;

        $bids = Bid::where('user_id', $user_id)->latest()->paginate($perPage);

        return view('account.auctions_bids', compact('bids'));
        
    }

    public function toursBids(Request $request, Bid $bids)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;

        $bids = Bid::where('user_id', $user_id)->latest()->paginate($perPage);

        return view('account.auctions_bids', compact('bids'));
        
    }

    public function bids(Request $request, Bid $bids)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;

        // if (!empty($keyword)) {
        //     $bids = Bid::where('user_id', $user_id)->where('auction_id', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        // } else {
        //     $bids = Bid::where('user_id', $user_id)->latest()->paginate($perPage);
        // }

        $bids = Bid::where('user_id', $user_id)->latest()->paginate($perPage);

        return view('account.bids', compact('bids'));
        
    }

    public function create()
    {
        return view('account.auction_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAuctionsRequest $request)
    {
        // $auction = Auction::create($request->all());
        // $auction->save();
        // if (auth()->check())
        // {
        //     auth()->user()->auctions()->save($auction);
        // }

        auth()->user()->auctions()->create($request->all());

        return redirect()->route('account.my-auctions')->with('flash_message', 'Auction added!');
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
        $auction = Auction::findOrFail($id);

        return view('auctions.edit', compact('auction'));
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
        Auction::findOrFail($id)->delete();

        return back()->with('flash_message', 'Auctions deleted!');
    }
}
