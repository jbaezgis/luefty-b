<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Auction;
use Auth;
use Mail;
use App\Bid;
use App\ExtraPassenger;
use App\ExtraProvider;
use App\Place;
use App\Location;
use App\Http\Requests\CreateAuctionsRequest;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class AllAuctionsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['getActivate', 'anotherMethod']]);
        $this->middleware('auth');
    }



    public function index(Request $request, Auction $auctions)
    {
        $request->flash();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->orderBy('date', $asc_desc)->auction()->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->orderBy('date', $asc_desc)->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('date', $asc_desc)
            ->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('date', $asc_desc)
            ->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('date', $asc_desc)->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->open()->userLocation()->active()->paginate($perPage);

        }else{
            $auctions = Auction::open()->userLocation()->active()->allAuctions()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('allauctions.index', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function open(Request $request, Auction $auctions)
    {
        $request->flash();
        $user = Auth::user();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->orderBy('date', $asc_desc)->auction()->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->orderBy('date', $asc_desc)->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('date', $asc_desc)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereDoesntHave('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('date', $asc_desc)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('date', $asc_desc)->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->paginate($perPage);

        }else{
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->userLocation()->active()->allAuctions()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('allauctions.open', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function mybids(Request $request, Auction $auctions)
    {
        $request->flash();
        $user = Auth::user();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->orderBy('date', $asc_desc)->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->open()->userLocation()->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->paginate($perPage);

        }else{
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->open()->userLocation()->active()->allAuctions()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('allauctions.mybids', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function won(Request $request, Auction $auctions)
    {
        $request->flash();
        $user = Auth::user();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->latest()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->latest()->paginate($perPage);

        }else{
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('allauctions.won', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function lost(Request $request, Auction $auctions)
    {
        $request->flash();
        $user = Auth::user();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $from_city = $request->get('from_city');
        $from = $request->input('from_location');
        $to_city = $request->get('to_city');
        $to = $request->input('to_location');
        $category = $request->input('category_id');
        $date = $request->input('date');
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->paginate($perPage);

        }else{
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('allauctions.lost', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        $auction_id = Auction::value('id');
        $bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->orderBy('bid','asc')->get();

        $bestbid = $bids->where('auction_id', $auction->id)->min('bid');
        $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid');
        $won = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->first();
        $max = ($bestbid - 1);
        $min = ($bestbid * 50)/100;

        $extraspass = ExtraPassenger::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();
        $extraspro = ExtraProvider::where('auction_id', $auction->id)->orderBy('created_at','DESC')->get();

        // $bids = Bid::where('canceled', 0)->get();

        return view('allauctions.show', compact('auction', 'bids', 'extraspro', 'extraspass', 'bids', 'max', 'min', 'won'));
    }

}
