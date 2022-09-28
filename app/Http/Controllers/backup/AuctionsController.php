<?php

namespace App\Http\Controllers;

use App\Auction;
use Auth;
use Mail;
use App\Bid;
use App\ExtraPassenger;
use App\ExtraProvider;
use App\Place;
use App\Location;

use App\Http\Requests\CreateAuctionsRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

class AuctionsController extends Controller
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
    public function from_locations($id)
    {
        // $from_city = Input::get('from_city');
        $places = Place::where('location_id', $id)->orderBy('name')->get();

        return json_encode($places);

    }

    public function f_locations()
    {
        $from_city = Input::get('from_city');
        $places = Place::where('location_id', $from_city)->orderBy('name')->get();

        return response()->json($places);

    }

    public function to_locations($id)
    {
        // $to_city = Input::get('to_city');
        $places = Place::where('location_id', $id)->orderBy('name')->get();

        return json_encode($places);

    }

    public function bestbid($id)
    {
        $bestbid = Bid::where('auction_id', $id)->min('bid');

        return json_encode($bestbid);

    }

    public function bidcount($id)
    {
        $bidcount = Bid::where('auction_id', $id)->count();

        return json_encode($bidcount);

    }

    public function index(Request $request, Auction $auctions)
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
                ->private()->latest()->paginate($perPage);

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('from_city', $from)->where('to_city', $to);
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('from_city', $from)->where('to_city', $to);
            })->where('won', 0)->sum('bid');

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_city', $from)
                ->private()->latest()->paginate($perPage);

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
                ->private()->latest()->paginate($perPage);

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($to) {
                $query->where('to_city', $to);
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($from, $to) {
                $query->where('to_city', $to);
            })->where('won', 0)->sum('bid');

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")
                ->private()->latest()->paginate($perPage);

            $accepted_bids_sum = Bid::whereHas('auction', function ($query) use($service_number) {
                $query->where('service_number', 'LIKE', "%$service_number%");
            })->where('won', 1)->sum('bid');

            $open_bids_sum = Bid::whereHas('auction', function ($query) use($service_number) {
                $query->where('service_number', 'LIKE', "%$service_number%");
            })->where('won', 0)->sum('bid');

        }elseif (!empty($status)) {
            $auctions = Auction::where('status', $status)
                ->private()->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)
                ->private()->paginate($perPage);

            $accepted_bids_sum = Bid::where('won', 1)->sum('bid');
            $open_bids_sum = Bid::where('won', 0)->sum('bid');

        }else {
            $auctions = Auction::private()->latest()->paginate($perPage);

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

        // $nobidyet_sum = Auction::where('status', 'Open')->doesntHave('bids')->sum('starting_bid');

        $allauctions_sum = $accepted_bids_sum + $open_bids_sum + $nobidyet_sum;

        return view('manage.auctions.index',
            compact(
                'auctions',
                'auctions_all',
                'auctions_nobidyet',
                'auctions_openbid',
                'auctions_accepted',
                'accepted_bids_sum',
                'open_bids_sum',
                'nobidyet_sum',
                'allauctions_sum',
                'testing_accepted_bid_sum',
                'nobidyet_count'
            ));
    }

    public function transfers(Request $request, Auction $auctions)
    {
        // $request->flash();
        // $keyword = $request->get('search');
        // // $date = $request->input('end_date');
        // $from_city = $request->get('from_city');
        // $from = $request->input('from_location');
        // $to_city = $request->get('to_city');
        // $to = $request->input('to_location');
        // $category = $request->input('category_id');
        // $date = $request->input('date');
        // $perPage = 15;

        // if (!empty($from_city and $to_city and $from and $to and $category and $date)) {
        //     $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
        //         ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
        //         ->private()->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from_city and $to_city and $category and $date)) {
        //     $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from and $to and $category and $date)) {
        //     $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from_city and $to_city and $category)) {
        //     $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from and $to and $category)) {
        //     $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from_city and $to_city)) {
        //     $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from and $to)) {
        //     $auctions = Auction::where('from_location', $from)->where('to_location', $to)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from_city and $category)) {
        //     $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from and $category)) {
        //     $auctions = Auction::where('from_location', $from)->where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from and $date)) {
        //     $auctions = Auction::where('from_location', $from)->where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from_city and $date)) {
        //     $auctions = Auction::where('from_city', $from_city)->where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($to and $category)) {
        //     $auctions = Auction::where('to_location', $to)->where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($to_city and $category)) {
        //     $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($to_city and $date)) {
        //     $auctions = Auction::where('to_city', $to_city)->where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($to and $date)) {
        //     $auctions = Auction::where('to_location', $to)->where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from)) {
        //     $auctions = Auction::where('from_location', $from)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($from_city)) {
        //     $auctions = Auction::where('from_city', $from_city)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($to_city)) {
        //     $auctions = Auction::where('to_city', $to_city)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // }elseif (!empty($to)) {
        //     $auctions = Auction::where('to_location', $to)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // } elseif (!empty($category)) {
        //     $auctions = Auction::where('category_id', $category)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        // } elseif (!empty($date)) {
        //     $auctions = Auction::where('date', $date)
        //         ->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        // }else {
        //     $auctions = Auction::private()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        // }


        // $bids = Bid::where('canceled', 0)->get();


        // return view('auctions.transfers', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));

        return redirect('/auctions/privatetransfers/index');
    }

    public function openauctions(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
            ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }


        $bids = Bid::where('canceled', 0)->get();


        // $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
        //     $query->where('user_id', $user->id);
        // })->sortable()->from()->open()->active()->latest()->get();

        return view('auctions.openauctions', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function winning(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->private()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }



        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.winning', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function winningtest(Request $request, Auction $auctions)
    {
        $user = Auth::user();

        $bids = Bid::where('user_id', $user->id)
            ->active()->get();

        // $bestbid = $bids->where('auction_id', $item->id)->min('bid');
        // $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid');



        $auctions = Auction::whereHas('bids', function ($query) use($user) {
            $query->where('user_id', $user->id);
        })->sortable()->from()->open()->active()->latest()->get();

        // $posts = App\Post::whereHas('comments', function ($query) {
        //     $query->where('content', 'like', 'foo%');
        // }, '>=', 10)->get();

        return view('auctions.winningtest', compact('auctions', 'bids'));
    }

    public function losing(Request $request, Auction $auctions)
    {
        $user = Auth::user();
        $request->flash();
        $keyword = $request->get('search');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }


        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.losing', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    // Idea to see the auctions with bids by me
    // public function auctionsbidbyme(Request $request, Auction $auctions)
    // {
    //     $perPage = 15;

    //     $auctions = Auction::sortable()->open()->active()->latest()->paginate($perPage);

    //     return view('auctions.byme');

    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auctions.create');
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


        return redirect()->route('auctions.index')->with('flash_message', 'Auction added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(auth()->user()->following->all());
        $auction = Auction::findOrFail($id);
        // $auction = Auction::where('auction_id','=', $auction_id)->firstOrFail();
        $auction_id = Auction::value('id');
        // $favorite_user = auth()->user()->following->contains($user->profile->id);
        $bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->orderBy('bid','asc')->get();
        // $favorite_bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->whereHas('bids', function ($query) {
        //     $query->where('user_id', auth()->user()->following->profile->user_id);
        // })->orderBy('created_at','DESC')->get();


        $bestbid = $bids->where('auction_id', $auction->id)->min('bid');
        $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid');
        $max = ($bestbid - 1);
        $min = ($bestbid * 50)/100;

        $extraspass = ExtraPassenger::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();
        $extraspro = ExtraProvider::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();

        // $bids = Bid::where('canceled', 0)->get();

        return view('auctions.show', compact('auction', 'bids', 'extraspro', 'extraspass', 'bids', 'max', 'min'));
    }

    public function auction_show($id)
    {
        // dd(auth()->user()->following->all());
        $auction = Auction::findOrFail($id);
        // $auction = Auction::where('auction_id','=', $auction_id)->firstOrFail();
        $auction_id = Auction::value('id');
        // $favorite_user = auth()->user()->following->contains($user->profile->id);
        $bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->orderBy('bid','asc')->get();
        // $favorite_bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->whereHas('bids', function ($query) {
        //     $query->where('user_id', auth()->user()->following->profile->user_id);
        // })->orderBy('created_at','DESC')->get();


        $bestbid = $bids->where('auction_id', $auction->id)->min('bid');
        $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid');
        $max = ($bestbid - 1);
        $min = ($bestbid * 50)/100;

        $extraspass = ExtraPassenger::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();
        $extraspro = ExtraProvider::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();

        // $bids = Bid::where('canceled', 0)->get();

        return view('auctions.auction_show', compact('auction', 'bids', 'extraspro', 'extraspass', 'bids', 'max', 'min'));
    }

    public function destroybid(Request $request)
    {
        // $bid = Bid::find($request->id)->delete();

        // return back()->with('flash_message', 'Bid deleted!');

        dd($post =Bid::find($request->id));

        if ($post != null) {
            $post->delete();
            return back()->with('flash_message', 'Bid deleted!');
        }

        return back()->with('flash_message', 'No se pudo eliminar esta oferta!');
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
        // Auction::findOrFail($id)->delete();
        $auction = Auction::findOrFail($id)->delete();

        $bids = Bid::where('auction_id', $id)
            ->delete();

        return back()->with('flash_message', 'Auctions deleted!');
    }
}
