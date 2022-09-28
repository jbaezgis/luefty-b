<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;
use App\Auction;
use App\Tour;
use App\User;
use Auth;
use Mail;
use App\Events\AuctionWon;
use App\Events\AuctionBidAccepted;
use App\Events\BidAcceptedNotification;
use App\Events\NewBidNotification;
use App\Http\Requests\CreateBidsRequest;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Notifications\BidAccepted;
use App\Mail\AcceptedBidNotification;

class BidsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpdates()
    {
        $updates = Telegram::getUpdates();
        dd($updates);
    }

    public function index(Request $request, Bid $bids)
    {
        $bids = Bid::all();

        return view('bids.index', compact('bids'));
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

        $bids = Bid::where('canceled', 0);

        $bestbid = $bids->where('auction_id', $auction->id)->min('bid');
        $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid');
        $max = ($bestbid * 97)/100;
        $min = ($bestbid * 30)/100;
        // $findmybid = $bids->where('auction_id', $auction_id)->where('user_id', auth()->user()->id)->first();
        // dd($mybidid = $findmybid->id);

        if ($auction->category->code == 'private')
        {
            if ($auction->bids->count() > 0)
            {
                $this->validate(
                    $request,
                    [
                        'bid' => 'required|integer|min:'.$min.'|max:'.$max,
                    ]
                );
            }else
            {
                $this->validate(
                    $request,
                    [
                        'bid' => 'required|integer|min:1',
                    ]
                );

            }
        }elseif ($auction->category->code == 'shared')
        {
            $this->validate(
                $request,
                [
                    'seats' => 'required|integer|max:'.$auction->passengers,
                ]
            );
        }

        if (Bid::where('auction_id', $auction_id)->where('canceled', 0)->where('user_id', auth()->user()->id)->count() > 0)
        {
            $findmybid = $bids->where('auction_id', $auction_id)->where('user_id', auth()->user()->id)->first();

            $mybid = Bid::find($findmybid->id);

            if ($auction->category->code == 'private')
            {
                $mybid->bid = $request->bid;
            }

            if ($auction->category->code == 'shared')
            {
                $mybid->bid = $request->bid;
                $mybid->seats = $request->seats;
                $mybid->total = $request->seats * $request->bid;
            }

            $mybid->save();
        }else
        {
            $bid = new Bid();
            $bid->user_id = $request->user()->id;
            $bid->auction()->associate($auction);
            $bid->bid = $request->bid;

            if ($auction->category->code == 'shared')
            {
                $bid->seats = $request->seats;
                $bid->total = $request->seats * $request->bid;
            }

            $bid->save();
        }



        return back();

    }

    public function agencyBidStore(Request $request)
    {

        $bid = new Bid();
        $bid->user_id = $request->user_id;
        $bid->auction_id = $request->auction_id;
        $bid->bid = $request->bid;
        $bid->save();

        return back();

    }

    public function storefromtransfers(Request $request, $auction_id)
    {
        $auction = Auction::find($auction_id);

        if ($auction->category->code == 'private')
        {
            $this->validate(
                $request,
                [
                    // 'bid' => 'required|integer|max:'.$auction->starting_bid,
                ]
            );
        }elseif ($auction->category->code == 'shared')
        {
            $this->validate(
                $request,
                [
                    'seats' => 'required|integer|max:'.$auction->passengers,
                ]
            );
        }


        $bid = new Bid();
        $bid->user_id = $request->user()->id;
        $bid->auction()->associate($auction);
        $bid->bid = $request->bid;

        if ($auction->category_id === 2)
        {
            $bid->seats = $request->seats;
            $bid->total = $request->seats * $request->bid;
        }

        $bid->save();

        $previousUrl = app('url')->previous();

        return redirect($previousUrl.'#auction'.$auction->id);

        // return redirect('auctions/'.$auction->id);

    }

    public function storefromtransfers2(Request $request, $auction_id)
    {
        $auction = Auction::find($auction_id);
        $bids = Bid::where('auction_id', $auction_id)->where('canceled', 0);
        // $bestbid = Bid::where('auction_id', $auction_id)->where('canceled', 0)->min('bid');

        if ($bids->count() > 0)
        {
            $bestbid = $bids->where('auction_id', $auction->id)->min('bid');
            $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid');
            $max = ($bestbid - 1);
            $min = ($bestbid * 80)/100;
        }else
        {
            $starting_bid = $auction->starting_bid;
            $max = ($starting_bid - 1);
            $min = ($starting_bid * 80)/100;
        }

        // $bestbidfloat = (float)$bestbid;
        // dd($bestbid);

        if ($auction->category->code == 'private')
        {
            if ($auction->bids->count() > 0)
            {
                $this->validate(
                    $request,
                    [
                        // 'bid' => 'required|integer|min:'.$min.'|max:'.$max,
                    ]
                );
            }else
            {
                $this->validate(
                    $request,
                    [
                        // 'bid' => 'required|integer|min:'.$min.'|max:'.$max,
                    ]
                );

            }
        }elseif ($auction->category->code == 'shared')
        {
            $this->validate(
                $request,
                [
                    // 'seats' => 'required|integer|max:'.$auction->passengers,
                ]
            );
        }
        if (Bid::where('auction_id', $auction_id)->where('canceled', 0)->where('user_id', auth()->user()->id)->count() > 0)
        {
            $findmybid = $bids->where('auction_id', $auction_id)->where('user_id', auth()->user()->id)->first();

            $mybid = Bid::find($findmybid->id);

            if ($auction->category->code === 'private' or $auction->category->code === 'contract')
            {
                // $mybid->bid = $mybid->bid - $request->options;
                // $mybid->bid = $bestbid - $request->options;
                $mybid->bid = $request->bid;
            }

            if ($auction->category->code === 'shared')
            {
                $mybid->bid = $request->options;
                $mybid->seats = $request->seats;
                $mybid->total = $request->seats * $request->options;
            }
            $mybid->save();

            $previousUrl = app('url')->previous();

            if ($auction->category->code == 'private')
            {
                return redirect($previousUrl)
                ->with('winning', '<h4 class="alert-heading">' . __('Congratulations!') . '</h4>' . ' ' .
                __('You are winning this Auction:') . '<br/>' .
                __('From') . ' ' . '<strong>' . $auction->fromcity->name . '</strong>' . ' ' .
                __('To') .  ' ' . '<strong>' . $auction->tocity->name . '</strong>' . '<br/>' .
                '<p>' . '<strong>' . __('Category:') . '</strong>' . ' ' . $auction->category->name . ' ' .
                '|' . ' ' . '<strong>' . __('Your bid:') . '</strong>' . ' ' . '$' . number_format($mybid->bid, 2, '.', ',') . '</p>' .
                '<hr>' . '<a class="btn btn-success" href="' . url('auctions/' . $auction->id) . '">' . __('Bid history') . '</a>');

            }

            if ($auction->category->code == 'shared')
            {
                return redirect($previousUrl.'#auction'.$auction->id)
                // return redirect($previousUrl)
                ->with('winning', '<h4 class="alert-heading">' . __('Success') . '</h4>' . ' ' .
                __('Your bid details!:') . '<br/>' .
                __('From') . ' ' . '<strong>' . $auction->fromcity->name . '</strong>' . ' ' .
                __('To') .  ' ' . '<strong>' . $auction->tocity->name . '</strong>' . '<br/>' .
                '<p>' . '<strong>' . __('Category:') . '</strong>' . ' ' . $auction->category->name . ' ' . '|' . ' ' . '<strong>' . __('Starting bid:') . '</strong>' . ' ' . '$' . number_format($auction->starting_bid, 2, '.', ',') . ' ' .
                '|' . ' ' . '<strong>' . __('Bid per seat:') . '</strong>' . ' ' . '$' . number_format($mybid->bid, 2, '.', ',') . '</p>' .
                '|' . '<strong>' . __('Seats:') . '</strong>' . ' ' . $mybid->seats . ' ' . '|' . ' ' .
                '|' . '<strong>' . __('Total:') . '</strong>' . ' ' . number_format($mybid->total, 2, '.', ',') . ' ' . '|' .
                '<hr>' . '<a class="btn btn-success" href="' . url('auctions/' . $auction->id) . '">' . __('Bid history') . '</a>');

            }

        }else
        {

            $bid = new Bid();
            $bid->user_id = $request->user()->id;
            $bid->auction()->associate($auction);
            if ($auction->category->code == 'private' or $auction->category->code == 'contract' )
            {
                // if ($bids->count())
                if ($request->bid)
                {
                    $bid->bid = $request->bid;
                }else
                {
                    // $bid->bid = $auction->starting_bid - $request->options;
                    $bid->bid = $bestbid - $request->options;
                }


            }

            if ($auction->category->code == 'shared' )
            {
                $bid->bid = $request->bid;
                $bid->seats = $request->seats;
                $bid->total = $request->seats * $request->bid;
            }
            $bid->save();

            $previousUrl = app('url')->previous();

            if ($auction->category->code == 'private' or $auction->category->code == 'contract' )
            {
                // return redirect($previousUrl)
                return redirect($previousUrl.'#auction'.$auction->id)
                ->with('winning', '<h4 class="alert-heading">' . __('Congratulations!') . '</h4>' . ' ' .
                __('You are winning this Auction:') . '<br/>' .
                __('From') . ' ' . '<strong>' . $auction->fromcity->name . '</strong>' . ' ' .
                __('To') .  ' ' . '<strong>' . $auction->tocity->name . '</strong>' . '<br/>' .
                '<p>' . '<strong>' . __('Category:') . '</strong>' . ' ' . $auction->category->name . ' ' .
                '|' . ' ' . '<strong>' . __('Your bid:') . '</strong>' . ' ' . '$' . number_format($bid->bid, 2, '.', ',') . '</p>' .
                '<hr>' . '<a class="btn btn-success" href="' . url('auctions/' . $auction->id) . '">' . __('Bid history') . '</a>');

            }

            if ($auction->category->code == 'shared' )
            {
                return redirect($previousUrl.'#auction'.$auction->id)
                // return redirect($previousUrl)
                ->with('winning', '<h4 class="alert-heading">' . __('Success') . '</h4>' . ' ' .
                __('Your bid details!:') . '<br/>' .
                __('From') . ' ' . '<strong>' . $auction->fromcity->name . '</strong>' . ' ' .
                __('To') .  ' ' . '<strong>' . $auction->tocity->name . '</strong>' . '<br/>' .
                '<p>' . '<strong>' . __('Category:') . '</strong>' . ' ' . $auction->category->name . ' ' . '|' . ' ' . '<strong>' . __('Starting bid:') . '</strong>' . ' ' . '$' . number_format($auction->starting_bid, 2, '.', ',') . ' ' .
                '|' . ' ' . '<strong>' . __('Bid per seat:') . '</strong>' . ' ' . '$' . number_format($bid->bid, 2, '.', ',') . '</p>' .
                '|' . '<strong>' . __('Seats:') . '</strong>' . ' ' . $bid->seats . ' ' . '|' . ' ' .
                '|' . '<strong>' . __('Total:') . '</strong>' . ' ' . number_format($bid->total, 2, '.', ',') . ' ' . '|' .
                '<hr>' . '<a class="btn btn-success" href="' . url('auctions/' . $auction->id) . '">' . __('Bid history') . '</a>');

            }
        }

    }

    public function bookingbid(Request $request)
    {
        $auction_id = $request->auction_id;
        $auction = Auction::find($auction_id);

        $bids = Bid::where('canceled', 0);

        // $bids = Bid::where('auction_id', $auction)->where('canceled', 0);


        if (Bid::where('auction_id', $auction->id)->where('canceled', 0)->where('user_id', auth()->user()->id)->count() > 0)
        {
            $findmybid = $bids->where('auction_id', $auction_id)->where('user_id', auth()->user()->id)->first();

            $bid = Bid::find($findmybid->id);

            $bid->bid = $request->bid;

            $bid->save();

            $previousUrl = app('url')->previous();

            // event(new NewBidNotification($bid));

            return redirect($previousUrl.'#auction'.$auction->id);

        }else
        {

            $bid = new Bid();
            $bid->user_id = $request->user()->id;
            $bid->auction_id = $request->auction_id;
            $bid->bid = $request->bid;

            $bid->save();

            $previousUrl = app('url')->previous();

            // event(new NewBidNotification($bid));

            return redirect($previousUrl.'#auction'.$auction->id);

        }

    }

    public function acceptBid(Request $request, $id)
    {

        $auctionid = $request->auctionid;

        $auction = Auction::findOrFail($auctionid);
        $bid = Bid::findOrFail($id);

        $bid_percentage = $bid->bid * 0.10;
        $bid_total = $bid->bid + $bid_percentage;

        // Auction
        $auction->status = 'Closed';
        $auction->order_total = $bid_total;
        $auction->save();

        // Bid
        $bid->won = 1;
        $bid->save();

        // event(new BidAcceptedNotification($bid));

        return redirect('booking/confirmation/'.$auction->key);

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
        $bid = Bid::findOrFail($id);
        $auction = Auction::findOrFail($bid->auction_id);

        $bid->won = 1;
        $bid->save();


        if ($auction->category->code == 'private')
        {
            $auction->status = 'Closed';
            $auction->save();
            // event(new AuctionWon($bid));
            // // Send notificacion
            // $recipient = User::find($bid->user_id);
            // Mail::to($recipient)->send(new AcceptedBidNotification($bid));
        }elseif ($auction->category->code == 'shared')
        {
            if ($auction->passengers < $bid->seats)
            {
                $bid->won = 0;
                $bid->save();

                return back()->with('error', __('You must accept an offer that does not exceed the amount of available seats'));
            }else
            {
                $auction->passengers = $auction->passengers - $bid->seats;
                $auction->save();
                // event(new AuctionBidAccepted($bid));
            }

            if ($auction->passengers === 0)
            {
                $auction->status = 'Closed';
                $auction->save();
            }
        }elseif ($auction->category->code == 'contract')
        {
            $auction->status = 'Closed';
            $auction->save();
            // event(new AuctionWon($bid));
        }

        // Send notification
        $recipient = User::find($bid->user_id);
        // $recipient->notify(new BidAccepted($bid));

        return back();
    }

    public function updateTour(Request $request, $id)
    {
        $bid = Bid::findOrFail($id);

        $bid->won = 1;
        $bid->save();

        $tour = Tour::findOrFail($bid->tour_id);
        $tour->status = 'Closed';
        $tour->save();

        // event(new TourWon($bid));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bid::findOrFail($id)->delete();

        return back()->with('flash_message', 'Bid deleted!');
    }
}
