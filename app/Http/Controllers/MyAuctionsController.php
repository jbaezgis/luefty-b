<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Auction;
use Auth;
use Mail;
use App\Bid;
use App\Http\Requests\CreateAuctionsRequest;
Use Alert;
use App\Extra;
use App\Category;
use DB;
use App\ExtraPassenger;
use App\ExtraProvider;
use App\Events\AuctionBidCancelled;
use App\Location;
use App\Place;
use App\Events\AuctionWon;
use App\Events\NewAuctionNotification;
use App\Events\AuctionBidAccepted;
use App\User;
use App\Notifications\BidAccepted;
use App\Mail\NewAuctionB2B;
use App\Mail\AuctionChangedNotification;

class MyAuctionsController extends Controller
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
    public function index(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');
        $perPage = 15;

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($service_number and $from and $to and $asc_desc)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
            ->orderBy('end_date', $asc_desc)->active()->sortable()->paginate($perPage);
        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->active()->sortable()->paginate($perPage);
        }elseif (!empty($from and $asc_desc)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)->orderBy('end_date', $asc_desc)
                ->active()->sortable()->paginate($perPage);
        }elseif (!empty($from)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)
                ->active()->sortable()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('user_id', $user_id)->where('to_city', $to)
                ->active()->sortable()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->active()->sortable()->paginate($perPage);

        }elseif (!empty($status)) {
            $auctions = Auction::where('user_id', $user_id)->where('status', $status)
                ->active()->sortable()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::where('user_id', $user_id)->orderBy('end_date', $asc_desc)
                ->active()->sortable()->paginate($perPage);

        }else {
            // $auctions = Auction::where('user_id', $user_id)->from()->private()->active()->latest()->paginate();
            $auctions = Auction::where('user_id', $user_id)->active()->sortable()->paginate();
        }

        $bids = Bid::where('canceled', 0)->orderBy('bid', 'ASC')->get();

        // Counts
        $auctions_all = Auction::where('user_id', $user_id)->private()->active()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
            $query->where('canceled', 0);
        })->where('user_id', $user_id)->private()->active()->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1)->where('canceled', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_inactive = Auction::where('user_id', $user_id)->private()->inactive()->count();


        return view('myauctions.privatetransfers.index',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'trashcount',
                'incomplete',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'auctions_inactive'
            ));
    }

    // Private transfers Status: No bid yet
    public function privatenobidyet(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');
        $perPage = 15;

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->private()->active()->latest()->paginate($perPage);
        }elseif (!empty($from)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('from_city', $from)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('to_city', $to)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($status)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('status', $status)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->orderBy('end_date', $asc_desc)
                ->private()->active()->paginate($perPage);

        }else {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
            })->where('user_id', $user_id)->private()->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->orderBy('bid', 'ASC')->get();

        // Counts
        $auctions_all = Auction::where('user_id', $user_id)->private()->active()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
            $query->where('canceled', 0);
        })->where('user_id', $user_id)->private()->active()->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_inactive = Auction::where('user_id', $user_id)->private()->inactive()->count();


        return view('myauctions.privatetransfers.nobidyet',
            compact('auctions',
            'bids',
            'privatecount',
            'sharingcount',
            'tourscount',
            'emptylegscount',
            // 'private',
            'trashcount',
            'incomplete',
            'auctions_all',
            'auctions_nobidyet',
            'auctions_openbid',
            'auctions_accepted',
            'auctions_inactive'
        ));
    }

    // Private transfers Status: Open bid
    public function privateopenbid(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');
        $perPage = 15;

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->private()->active()->latest()->paginate($perPage);
        }elseif (!empty($from)) {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('from_city', $from)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('to_city', $to)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($status)) {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('status', $status)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->orderBy('end_date', $asc_desc)
                ->private()->active()->latest()->paginate($perPage);

        }else {
            $auctions = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->private()->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->orderBy('bid', 'ASC')->get();

         // Counts
         $auctions_all = Auction::where('user_id', $user_id)->private()->active()->count();

         $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
             $query->where('canceled', 0);
         })->where('user_id', $user_id)->private()->active()->count();

         $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                 $query->where('canceled', 0)->where('won', 0);
             })->where('user_id', $user_id)->private()->active()->count();

         $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                 $query->where('won', 1);
             })->where('user_id', $user_id)->private()->active()->count();

        $auctions_inactive = Auction::where('user_id', $user_id)->private()->inactive()->count();

        return view('myauctions.privatetransfers.openbid',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                // 'private',
                'trashcount',
                'incomplete',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'auctions_inactive'
            ));
    }

    // Private transfers Status: Open bid
    public function privateaccepted(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');
        $perPage = 15;

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->private()->active()->latest()->paginate($perPage);
        }elseif (!empty($from)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('from_city', $from)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('to_city', $to)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($status)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('status', $status)
                ->private()->active()->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->orderBy('end_date', $asc_desc)
                ->private()->active()->latest()->paginate($perPage);

        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
            })->where('user_id', $user_id)->private()->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->orderBy('bid', 'ASC')->get();

         // Counts
         $auctions_all = Auction::where('user_id', $user_id)->private()->active()->count();

         $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
             $query->where('canceled', 0);
         })->where('user_id', $user_id)->private()->active()->count();

         $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                 $query->where('canceled', 0)->where('won', 0);
             })->where('user_id', $user_id)->private()->active()->count();

         $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                 $query->where('won', 1);
             })->where('user_id', $user_id)->private()->active()->count();

        $auctions_inactive = Auction::where('user_id', $user_id)->private()->inactive()->count();

        return view('myauctions.privatetransfers.accepted',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                // 'private',
                'trashcount',
                'incomplete',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'auctions_inactive'
            ));
    }

    public function archived(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');
        $perPage = 15;

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->private()->inactive()->latest()->paginate($perPage);
        }elseif (!empty($from)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)
                ->private()->inactive()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('user_id', $user_id)->where('to_city', $to)
                ->private()->inactive()->latest()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->private()->inactive()->latest()->paginate($perPage);

        }elseif (!empty($status)) {
            $auctions = Auction::where('user_id', $user_id)->where('status', $status)
                ->private()->inactive()->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::where('user_id', $user_id)->orderBy('end_date', $asc_desc)
                ->private()->inactive()->paginate($perPage);

        }else {

            $auctions = Auction::where('user_id', $user_id)->private()->inactive()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->orderBy('bid', 'ASC')->get();

        // Counts
        $auctions_all = Auction::where('user_id', $user_id)->private()->active()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
            $query->where('canceled', 0);
        })->where('user_id', $user_id)->private()->active()->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1)->where('canceled', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_inactive = Auction::where('user_id', $user_id)->private()->inactive()->count();

        return view('myauctions.privatetransfers.archived',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                // 'private',
                'trashcount',
                'incomplete',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'auctions_inactive'
            ));
    }

    public function sharing(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');


        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::where('user_id', $user_id)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->from()->sharing()->active()->latest()->get();

        }else {
            $auctions = Auction::from()->sharing()->where('user_id', $user_id)->active()->latest()->get();
        }

        $bids = Bid::where('canceled', 0)->get();

        // Counts
        $auctions_all = Auction::where('user_id', $user_id)->from()->sharing()->active()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
            $query->where('canceled', 0);
        })->where('user_id', $user_id)->from()->sharing()->active()->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->from()->sharing()->active()->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
            })->where('user_id', $user_id)->from()->sharing()->active()->count();


        return view('myauctions.sharedshuttles.index',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'private',
                'trashcount',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted'
                ));
    }

    // Private transfers Status: No bid yet
    public function sharingnobidyet(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('from_city', $from)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($service_number)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($status)) {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
                })->where('user_id', $user_id)->where('status', $status)
                ->from()->sharing()->active()->latest()->get();

        }else {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('canceled', 0);
            })->where('user_id', $user_id)->from()->sharing()->active()->latest()->get();
        }

        $bids = Bid::where('canceled', 0)->get();

        // Counts
        $auctions_all = Auction::where('user_id', $user_id)->from()->sharing()->active()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
            $query->where('canceled', 0);
        })->where('user_id', $user_id)->from()->sharing()->active()->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->from()->sharing()->active()->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
            })->where('user_id', $user_id)->from()->sharing()->active()->count();


        return view('myauctions.sharedshuttles.nobidyet',
            compact('auctions',
            'bids',
            'privatecount',
            'sharingcount',
            'tourscount',
            'emptylegscount',
            'private',
            'trashcount',
            'incomplete',
            'auctions_all',
            'auctions_nobidyet',
            'auctions_openbid',
            'auctions_accepted'
        ));
    }

    // Private transfers Status: Open bid
    public function sharingopenbid(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('from_city', $from)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($service_number)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($status)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
                })->where('user_id', $user_id)->where('status', $status)
                ->from()->sharing()->active()->latest()->get();

        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->from()->sharing()->active()->latest()->get();
        }

        $bids = Bid::where('canceled', 0)->get();

         // Counts
         $auctions_all = Auction::where('user_id', $user_id)->from()->sharing()->active()->count();

         $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
             $query->where('canceled', 0);
         })->where('user_id', $user_id)->from()->sharing()->active()->count();

         $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                 $query->where('canceled', 0)->where('won', 0);
             })->where('user_id', $user_id)->from()->sharing()->active()->count();

         $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                 $query->where('won', 1);
             })->where('user_id', $user_id)->from()->sharing()->active()->count();

        return view('myauctions.sharedshuttles.openbid',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'private',
                'trashcount',
                'incomplete',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted'
            ));
    }

    // Private transfers Status: Open bid
    public function sharingaccepted(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $incomplete = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->count();

        if (!empty($from and $to)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();
        }elseif (!empty($from)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('from_city', $from)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($to)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('to_city', $to)
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($service_number)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->from()->sharing()->active()->latest()->get();

        }elseif (!empty($status)) {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
                })->where('user_id', $user_id)->where('status', $status)
                ->from()->sharing()->active()->latest()->get();

        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1);
            })->where('user_id', $user_id)->from()->sharing()->active()->latest()->get();
        }

        $bids = Bid::where('canceled', 0)->get();

         // Counts
         $auctions_all = Auction::where('user_id', $user_id)->from()->sharing()->active()->count();

         $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
             $query->where('canceled', 0);
         })->where('user_id', $user_id)->from()->sharing()->active()->count();

         $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                 $query->where('canceled', 0)->where('won', 0);
             })->where('user_id', $user_id)->from()->sharing()->active()->count();

         $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                 $query->where('won', 1);
             })->where('user_id', $user_id)->from()->sharing()->active()->count();

        return view('myauctions.sharedshuttles.accepted',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'private',
                'trashcount',
                'incomplete',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted'
            ));
    }

    public function tours(Request $request, Auction $auctions)
    {

        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $status = $request->input('status');

        $from = $from;

        $privatecount = Auction::private()->active()->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $auctions = Auction::tours()->where('user_id', $user_id)->active()->get();

        $bids = Bid::get();


        return view('myauctions.tours',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'private',
                'trashcount'));
    }

    public function emptylegs(Request $request, Auction $auctions)
    {

        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $status = $request->input('status');

        $privatecount = Auction::private()->active()->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $auctions = Auction::emptyLegs()->where('user_id', $user_id)->active()->get();

        $bids = Bid::get();


        return view('myauctions.emptylegs',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'private',
                'trashcount'));
    }

    public function trash(Request $request, Auction $auctions)
    {

        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;
        $user = Auth::user()->id;
        $from = $request->input('from');
        $to = $request->input('to');
        $service_number = $request->input('service_number');
        $status = $request->input('status');
        $asc_desc = $request->input('asc_desc');

        $privatecount = Auction::private()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        // $auctions = Auction::where('deleted', 1)->where('user_id', $user_id)->get();
        if (!empty($from and $to)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)->where('to_city', $to)
                ->where('deleted', 1)->private()->paginate($perPage);
        }elseif (!empty($from)) {
            $auctions = Auction::where('user_id', $user_id)->where('from_city', $from)
                ->where('deleted', 1)->private()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('user_id', $user_id)->where('to_city', $to)
                ->where('deleted', 1)->private()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('user_id', $user_id)->where('service_number', 'LIKE', "%$service_number%")
                ->where('deleted', 1)->private()->paginate($perPage);

        }elseif (!empty($status)) {
            $auctions = Auction::where('user_id', $user_id)->where('status', $status)
                ->where('deleted', 1)->private()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::where('user_id', $user_id)->orderBy('end_date', $asc_desc)
                ->where('deleted', 1)->private()->paginate($perPage);

        }else {
            $auctions = Auction::where('user_id', $user_id)->where('deleted', 1)->private()->paginate($perPage);
        }

        $bids = Bid::get();

        // Counts
        $auctions_all = Auction::where('user_id', $user_id)->private()->active()->count();

        $auctions_nobidyet = Auction::whereDoesntHave('bids', function ($query) use($user) {
            $query->where('canceled', 0);
        })->where('user_id', $user_id)->private()->active()->count();

        $auctions_openbid = Auction::where('status', 'Open')->whereHas('bids', function ($query) use($user) {
                $query->where('canceled', 0)->where('won', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_accepted = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('won', 1)->where('canceled', 0);
            })->where('user_id', $user_id)->private()->active()->count();

        $auctions_inactive = Auction::where('user_id', $user_id)->private()->inactive()->count();


        return view('myauctions.trash',
                compact('auctions',
                'bids',
                'privatecount',
                'sharingcount',
                'tourscount',
                'emptylegscount',
                'private',
                'trashcount',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'auctions_inactive'
            ));
    }

    public function incomplete(Request $request, Auction $auctions)
    {
        $user_id = Auth::user()->id;

        $privatecount = Auction::private()->active()->where('user_id', $user_id)->count();
        $sharingcount = Auction::sharing()->active()->where('user_id', $user_id)->count();
        $tourscount = Auction::tours()->active()->where('user_id', $user_id)->count();
        $emptylegscount = Auction::emptyLegs()->active()->where('user_id', $user_id)->count();
        $trashcount = Auction::where('deleted', 1)->where('user_id', $user_id)->count();

        $auctions = Auction::where('from_location', null)->where('title', null)->where('user_id', $user_id)->where('deleted', 0)->get();

        return view('myauctions.incomplete',
            compact('auctions',
            'privatecount',
            'sharingcount',
            'tourscount',
            'emptylegscount',
            'private',
            'trashcount'));
    }

    public function closed(Request $request, Auction $auctions)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;

        if (!empty($keyword)) {
            $auctions = Auction::closed()->where('user_id', $user_id)->where('from', 'LIKE', "%$keyword%")->orWhere('to', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $auctions = Auction::closed()->where('user_id', $user_id)->latest()->paginate($perPage);
        }

        $bids = Bid::get();

        return view('myauctions.closed', compact('auctions', 'bids'));
    }

    public function open(Request $request, Auction $auctions)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $user_id = Auth::user()->id;

        if (!empty($keyword)) {
            $auctions = Auction::open()->where('user_id', $user_id)->where('from', 'LIKE', "%$keyword%")->orWhere('to', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $auctions = Auction::open()->where('user_id', $user_id)->latest()->paginate($perPage);
        }

        $bids = Bid::latest();

        return view('myauctions.open', compact('auctions', 'bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extras = Extra::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('myauctions.create', compact('extras', 'categories'));
    }

    public function createprivate(Request $request)
    {
        $auction = new Auction();
        $auction->category_id = 1;
        $auction->user_id = $request->user()->id;
        $auction->save();

        return redirect('myauctions/' . $auction->id . '/edit');
    }

    public function createsharing(Request $request)
    {
        $auction = new Auction();
        $auction->category_id = 2;
        $auction->user_id = $request->user()->id;
        $auction->save();

        return redirect('myauctions/' . $auction->id . '/edit');
    }

    public function createtour(Request $request)
    {
        $auction = new Auction();
        $auction->category_id = 3;
        $auction->user_id = $request->user()->id;
        $auction->save();

        return redirect('myauctions/' . $auction->id . '/edit');
    }

    public function createemptylegs(Request $request)
    {
        $auction = new Auction();
        $auction->category_id = 4;
        $auction->user_id = $request->user()->id;
        $auction->save();

        return redirect('myauctions/' . $auction->id . '/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_id' => 'required',
                // 'name' => 'required',
            ]
        );

        $auction = new Auction();
        $auction->category_id = $request->category_id;
        // $auction->date = $request->date;
        $auction->user_id = $request->user()->id;
        // $auction->time = date('H:m:d', strtotime($request->time));
        // $auction->from = $request->from;
        // $auction->to = $request->to;
        // $auction->starting_bid = $request->starting_bid;
        // $auction->passengers = $request->passengers;
        // $auction->min_seats = $request->min_seats;
        // $auction->child_seats = $request->child_seats;
        // $auction->description = $request->description;
        $auction->save();
        // $auction->category()->attach($request->extras);

        return redirect('myauctions/' . $auction->id . '/edit')
        ->with('info', trans('globals.auction_created') . ':' . ' ' . trans('globals.from')  .  ' ' . '<strong>' . $request->input('from') . '</strong>' . ' ' . trans('globals.to') .  ' ' . '<strong>' . $request->input('to') . '</strong>' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        $auction_id = Auction::value('id');
        $bids = Bid::where('canceled', 0)->orderBy('bid', 'asc')->get();
        $bids_canceled = Bid::where('canceled', 1)->get();
        $bid_won = Bid::where('auction_id', $id)->won()->count();
        $won_user = Bid::where('auction_id', $id)->won()->first();

        $bid_won_sum = Bid::where('auction_id', $id)->where('canceled', 0)->won()->sum('total');

        $extraspass = ExtraPassenger::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();
        $extraspro = ExtraProvider::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();

        return view('myauctions.show', compact('auction', 'bids', 'bid_won', 'extraspass', 'extraspro', 'bid_won_sum', 'bids_canceled', 'won_user'));
    }

    public function accepted($id)
    {
        $auction = Auction::findOrFail($id);

        $bid = Bid::where('won', 1)->where('auction_id', $id)->first();
        $bids = Bid::where('canceled', 0)->get();

        if ($bid->notified == 1)
        {

        } else {
            event(new AuctionWon($bid));
            $recipient = User::find($bid->user_id);
            $recipient->notify(new BidAccepted($bid));

            $bid->notified = 1;
            $bid->save();
        }

        return view('myauctions.accepted', compact('auction', 'bids', 'bid'));
    }

    public function destroybid(Request $request)
    {
        $bid = Bid::find($request->id)->delete();

        return back()->with('flash_message', 'Bid deleted!');

        // dd($post =Bid::find($request->id));
        // if ($post != null) {
        //     $post->delete();
        //     return back()->with('flash_message', 'Bid deleted!');
        // }

        // return back()->with('flash_message', 'No se pudo eliminar esta oferta!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $auction = Auction::findOrFail($id);
        $extras = Extra::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $from_city = $request->get('from_city');
        $to_city = $request->get('to_city');

        $extraspass = ExtraPassenger::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();
        $extraspro = ExtraProvider::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();

        return view('myauctions.edit', compact('auction', 'extras', 'categories', 'extraspass', 'extraspro', 'from_city', 'to_city'));
    }

    public function change(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);
        $auction_id = Auction::value('id');
        $bids = Bid::where('auction_id', $auction->id)->orderBy('bid', 'asc')->get();
        $bid_won = Bid::where('auction_id', $id)->won()->count();

        $bid_won_sum = Bid::where('auction_id', $id)->won()->sum('total');

        $extraspass = ExtraPassenger::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();
        $extraspro = ExtraProvider::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();

        return view('myauctions.change', compact('auction', 'bids', 'bid_won', 'extraspass', 'extraspro', 'bid_won_sum'));
    }

    public function changed(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);
        $auction->changed = 1;
        $auction->passengers = $auction->shared_seats;
        $auction->save();

        $bids = Bid::where('auction_id', $auction->id)->get();

        foreach ($bids as $bid) {

            Mail::to($bid->user->email)->send(new AuctionChangedNotification($auction));
        }

        // $delete_bids = $bids->delete();
        $delete_bids = Bid::where('auction_id', $auction->id)->delete();

        $bids_cancelled = Bid::where('auction_id', $auction->id)->where('canceled', 1)->get();

        // event(new AuctionBidCancelled($bids_cancelled));

        return redirect('myauctions/'. $auction->id. '/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function from_locations($id)
    {
        // $from_city = Input::get('from_city');
        $places = Place::where('location_id', $id)->get();

        return json_encode($places);

    }

    public function to_locations($id)
    {
        // $to_city = Input::get('to_city');
        $places = Place::where('location_id', $id)->get();

        return json_encode($places);

    }

    public function first_step(Request $request, $id)
    {
        $request->flash();
        $auction = Auction::findOrFail($id);

        return view('myauctions.first_step', compact('auction'));
    }

    public function first_step_update(Request $request, $id)
    {
        $request->flash();
        $auction = Auction::findOrFail($id);

        $auction->category_id = $request->category_id;
        $auction->save();

        return redirect('myauctions/' . $auction->id . '/edit');
    }

    public function update(Request $request, $id)
    {
        $request->flash();

        $from_city = $request->get('from_city');
        $to_city = $request->get('to_city');
        $auction = Auction::findOrFail($id);
        $locations = Location::all();

        $location = Location::where('id', $from_city)->first();


        if ($auction->changed === 1)
        {
            $this->validate(
                $request,
                [
                    // 'date' => 'required|after:yesterday',
                    // 'time' => 'required',
                    // 'from_location' => 'required_if:category_id,1',
                    // 'to_location' => 'required_if:category_id,1',
                    // 'starting_bid' => 'required',
                    // 'min_seats' => 'required',
                    'service_number' => 'required|unique:auctions,service_number,' . $auction->id,
                ]
            );
        }else
        {
            if ($auction->category->code == 'private')
            {
                $this->validate(
                    $request,
                    [
                        'date' => 'required|after:yesterday',
                        // 'time' => 'required',
                        // 'from_location' => 'required',
                        // 'to_location' => 'required',
                        // 'starting_bid' => 'required',
                        // 'min_seats' => 'required',
                        // 'service_number' => 'required|unique:auctions,service_number,' . $auction->id,
                        'service_number' => 'required',
                    ]
                );
            }

            if ($auction->category->code == 'shared')
            {
                $this->validate(
                    $request,
                    [
                        // 'date' => 'required|after:yesterday',
                        // 'time' => 'required',
                        // 'from_location' => 'required',
                        // 'to_location' => 'required',
                        // 'starting_bid' => 'required',
                        // 'min_seats' => 'required',
                        // 'service_number' => 'required|unique:auctions,service_number,' . $auction->id,
                        // 'service_number' => 'required',
                        // 'from_time' => 'date_format:H:i:s',
                        // 'to_time' => 'after:from_time',
                    ]
                );
            }
        }

        $auction->date = $request->date;
        if ($auction->category->code == 'contract')
        {
            $auction->start_date = $request->start_date;
            $auction->end_date = $request->end_date;
        }

        $auction->service_number = $request->service_number;
        $auction->time = date('H:i:s', strtotime($request->time));
        $auction->from_time = date('H:i:s', strtotime($request->from_time));
        $auction->to_time = date('H:i:s', strtotime($request->to_time));
        $auction->title = $request->title;
        $auction->pickup_from_location = $request->pickup_from_location;
        $auction->from_city = $request->from_city;
        $auction->from_location = $request->from_location;
        $auction->to_city = $request->to_city;
        $auction->to_location = $request->to_location;
        $auction->auction_id = 'PS'.$id.$request->service_number.$request->from_location.$request->to_location;
        $auction->starting_bid = $request->starting_bid;
        $auction->passengers = $request->passengers;
        if ($auction->category->code == 'shared')
        {
            $auction->shared_seats = $request->passengers;
        }
        $auction->min_seats = $request->min_seats;
        $auction->child_seats = $request->child_seats;
        $auction->baby_seats = $request->baby_seats;
        $auction->description = $request->description;

        if ($auction->category->code == 'private')
        {
            $auction->end_date = $request->date. ' ' .date('H:i:s', strtotime($request->time));
        }elseif ($auction->category_id === 2)
        {
            // $auction->start_date = $request->date. ' ' .date('H:i:s', strtotime($request->from_time));
            // $auction->end_date = $request->date. ' ' .date('H:i:s', strtotime($request->to_time));
        }

        // New fields
        // $auction->vehicle_size = $request->vehicle_size;
        $auction->more_information = $request->more_information;

        $auction->country_id = $location->country_id;
        $auction->region_id = $location->region_id;

        $auction->save();

        // event(new NewAuctionNotification($auction));
        
        // $users = User::where('region_id', $auction->region_id)->get();
        // foreach ($users as $user) {

        //     Mail::to($user->email)->send(new NewAuctionB2B($auction));
        // }

        return redirect('myauctions/privatetransfers/index')->with('updated', __('Update Confirmed'));
    }

    public function recover(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);

        $auction->deleted = 0;
        $auction->save();

        return back()
        ->with('recover', trans('globals.auction_recovered') . ':' . ' ' . trans('globals.from')  .  ' ' . '<strong>' . $auction->fromlocation->name . '</strong>' . ' ' . trans('globals.to') .  ' ' . '<strong>' . $auction->tolocation->name . '</strong>' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Auction::findOrFail($id)->delete();

        // return back()->with('se', 'Auction deleted!');

        $auction = Auction::findOrFail($id);

        $auction->deleted = 1;
        $auction->save();

        $bids = Bid::where('auction_id', $id)
            ->delete();


        // Alert::success('Success Title', 'Success Message');
        if ($auction->from_location or $auction->title)
        {
            return back()
            ->with('deleted', trans('globals.auction_deleted') . ':' . ' ' . trans('globals.from')  .  ' ' . '<strong>' . $auction->fromlocation->name . '</strong>' . ' ' . trans('globals.to') .  ' ' . '<strong>' . $auction->tolocation->name . '</strong>')
            ->with('auction_id', $auction->id);

        }else
        {
            if ($auction->category_id === 1)
            {
                return redirect('myauctions/privatetransfers/index');

            }elseif ($auction->category_id === 2)
            {
                return redirect('myauctions/sharedshuttles/index');

            }elseif ($auction->category_id === 3)
            {
                return redirect('myauctions/tours/index');

            }else
            {
                return redirect('myauctions/empty-legs/index');
            }
        }


    }

    public function destroy2($id)
    {
        // Auction::findOrFail($id)->delete();

        // return back()->with('se', 'Auction deleted!');

        $auction = Auction::findOrFail($id);

        $auction->deleted = 1;
        $auction->save();

        $bids = Bid::where('auction_id', $id)
            ->delete();

        return back();
        // if ($auction->from_location)
        // {
        //     if ($auction->category_id === 1)
        //     {
        //         return redirect('myauctions/privatetransfers/index')
        //         ->with('deleted', trans('globals.auction_deleted') . ':' . ' ' . trans('globals.from')  .  ' ' . '<strong>' . $auction->fromlocation->name . '</strong>' . ' ' . trans('globals.to') .  ' ' . '<strong>' . $auction->tolocation->name . '</strong>')
        //         ->with('auction_id', $auction->id);

        //     }elseif ($auction->category_id === 2)
        //     {
        //         return redirect('myauctions/sharedshuttles/index')
        //         ->with('deleted', trans('globals.auction_deleted') . ':' . ' ' . trans('globals.from')  .  ' ' . '<strong>' . $auction->fromlocation->name . '</strong>' . ' ' . trans('globals.to') .  ' ' . '<strong>' . $auction->tolocation->name . '</strong>')
        //         ->with('auction_id', $auction->id);

        //     }elseif ($auction->category_id === 3)
        //     {
        //         return redirect('myauctions/tours/index');

        //     }else
        //     {
        //         return redirect('myauctions/empty-legs/index');
        //     }
        // }else
        // {
        //     if ($auction->category_id === 1)
        //     {
        //         return redirect('myauctions/privatetransfers/index');

        //     }elseif ($auction->category_id === 2)
        //     {
        //         return redirect('myauctions/sharedshuttles/index');

        //     }
        // }

    }

    public function delete($id)
    {
        $auction = Auction::findOrFail($id)->delete();

        $bids = Bid::where('auction_id', $id)
            ->delete();

        // return redirect('myauctions');
        if ($auction->category->code == 'private')
        {
            return redirect('myauctions/privatetransfers/index');

        }elseif ($auction->category->code == 'shared')
        {
            return redirect('myauctions/sharedshuttles/index');

        }
    }
}
