<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bid;
use App\Auction;
use App\Tour;
use App\User;
use Auth;

class MyBidsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOld(Request $request, Bid $bids)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $status = $request->get('status');


        if (!empty($keyword)) {
            $bids = Bid::where('user_id', $user_id)->where('auction_id', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $bids = Bid::where('user_id', $user_id)->where('canceled', 0)->latest()->paginate($perPage);
        }

        // $bids = Bid::where('user_id', $user_id)->latest()->paginate($perPage);

        return view('mybids.index', compact('bids'));
    }

    public function index(Request $request, Bid $bids)
    {
        // $keyword = $request->get('search');
        // $perPage = 15;
        // $user_id = Auth::user()->id;

        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $status = $request->input('status');
        // $accepted = $request->input('accepted');

        if (!empty($from and $to)) {
            $auctions = Auction::where('from_city', $from)->where('to_city', $to)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_city', $from)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_city', $to)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->active()->latest()->get();

        }elseif (!empty($status)) {
            $auctions = Auction::where('status', $status)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->active()->latest()->get();

        // }elseif ($accepted == 1) {
        //     $auctions = Auction::whereHas('bids', function ($query) use($user) {
        //         $query->where('user_id', $user->id)->where('won', 0);
        //     })->private()->active()->latest()->get();

        }else {
            // $auctions = Auction::from()->private()->active()->latest()->get();
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->active()->latest()->get();
        }

        $bids = Bid::won()->where('user_id', $user_id)->where('canceled', 0)->latest()->paginate($perPage);
        $bids2 = Bid::where('user_id', $user_id)->get();

        return view('mybids.index', compact('auctions', 'bids', 'bids2', 'user'));
    }

    public function won(Request $request, Bid $bids)
    {
        // $keyword = $request->get('search');
        // $perPage = 15;
        // $user_id = Auth::user()->id;

        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $status = $request->input('status');
        // $accepted = $request->input('accepted');

        if (!empty($from and $to)) {
            $auctions = Auction::where('from_city', $from)->where('to_city', $to)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->private()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_city', $from)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->private()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_city', $to)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->private()->active()->latest()->get();

        }elseif (!empty($status)) {
            $auctions = Auction::where('status', $status)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->private()->active()->latest()->get();

        }else {
            // $auctions = Auction::from()->private()->active()->latest()->get();
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->private()->active()->latest()->get();
        }

        $bids = Bid::won()->where('user_id', $user_id)->where('canceled', 0)->latest()->paginate($perPage);
        $bids2 = Bid::where('user_id', $user_id)->get();

        return view('mybids.won', compact('auctions', 'bids', 'bids2', 'user'));
    }

    public function lost(Request $request, Bid $bids)
    {
        // $keyword = $request->get('search');
        // $perPage = 15;
        // $user_id = Auth::user()->id;

        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $status = $request->input('status');
        // $accepted = $request->input('accepted');

        if (!empty($from and $to)) {
            $auctions = Auction::where('from_city', $from)->where('to_city', $to)
            ->where('status', 'Closed')->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->private()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_city', $from)
            ->where('status', 'Closed')->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->private()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_city', $to)
            ->where('status', 'Closed')->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->private()->active()->latest()->get();

        }elseif (!empty($status)) {
            $auctions = Auction::where('status', $status)
            ->where('status', 'Closed')->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->private()->active()->latest()->get();

        // }elseif ($accepted == 1) {
        //     $auctions = Auction::whereHas('bids', function ($query) use($user) {
        //         $query->where('user_id', $user->id)->where('won', 0);
        //     })->private()->active()->latest()->get();

        }else {
            // $auctions = Auction::from()->private()->active()->latest()->get();
            $auctions = Auction::where('status', 'Closed')->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->private()->active()->latest()->get();
        }

        $bids = Bid::won()->where('user_id', $user_id)->where('canceled', 0)->latest()->paginate($perPage);
        $bids2 = Bid::where('user_id', $user_id)->get();

        return view('mybids.lost', compact('auctions', 'bids', 'bids2', 'user'));
    }

    // public function lost(Request $request, Bid $bids)
    // {
    //     $keyword = $request->get('search');
    //     $perPage = 15;
    //     $user_id = Auth::user()->id;

    //     $bids = Bid::lost()->where('user_id', $user_id)->where('canceled', 0)->latest()->paginate($perPage);

    //     return view('mybids.lost', compact('bids'));
    // }

    public function canceled(Request $request, Bid $bids)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;

        $bids = Bid::lost()->where('user_id', $user_id)->where('canceled', 1)->latest()->paginate($perPage);

        return view('mybids.canceled', compact('bids'));
    }

    public function showauction($auction_id)
    {
        $auction = Auction::findOrFail($auction_id);
        $auction_id = Auction::value('id');
        $bids = Bid::where('canceled', 0)->get();
        $bid_won = Bid::where('auction_id', $auction_id)->won()->count();

        // return view('auctions.show', [
        //     'auction' => $auction,
        //     'bid' => $auction->bids()->where('user_id', \Auth::id())->first()
        // ]);
        return view('mybids.showauction', compact('auction', 'bids', 'bid_won'));
    }

    public function changedauction($auction_id)
    {
        $auction = Auction::findOrFail($auction_id);
        $auction_id = Auction::value('id');
        $bids = Bid::sortable()->where('auction_id', $auction)->get();
        $bid_won = Bid::where('auction_id', $auction_id)->won()->count();

        // return view('auctions.show', [
        //     'auction' => $auction,
        //     'bid' => $auction->bids()->where('user_id', \Auth::id())->first()
        // ]);
        return view('mybids.changedauction', compact('auction', 'bids', 'bid_won'));
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
