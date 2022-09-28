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

class PrivateTransfersController extends Controller
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
        $places = Place::where('location_id', $id)->get();

        return json_encode($places);

    }

    public function f_locations()
    {
        $from_city = Input::get('from_city');
        $places = Place::where('location_id', $from_city)->get();

        return response()->json($places);

    }

    public function to_locations($id)
    {
        // $to_city = Input::get('to_city');
        $places = Place::where('location_id', $id)->get();

        return json_encode($places);

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
                ->orderBy('end_date', $asc_desc)->open()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->orderBy('end_date', $asc_desc)->open()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->open()->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('end_date', $asc_desc)
            ->open()->active()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->open()->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('end_date', $asc_desc)
            ->open()->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)->open()->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->open()->active()->paginate($perPage);

        }else{
            $auctions = Auction::open()->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('auctions.privatetransfers.index', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function bidbyme(Request $request, Auction $auctions)
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
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->orderBy('end_date', $asc_desc)->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->orderBy('end_date', $asc_desc)->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->paginate($perPage);

        }else{
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('auctions.privatetransfers.bidbyme', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function won(Request $request, Auction $auctions)
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
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->orderBy('end_date', $asc_desc)->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->orderBy('end_date', $asc_desc)->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }else{
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1);
            })->where('status', 'Closed')->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('auctions.privatetransfers.won', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function lost(Request $request, Auction $auctions)
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
        $order_by = $request->input('order_by');
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->orderBy('end_date', $asc_desc)->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->orderBy('end_date', $asc_desc)->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $asc_desc)) {
            $auctions = Auction::where('to_city', $to_city)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 0);
                })->where('status', 'Closed')->active()->latest()->paginate($perPage);

        }elseif (!empty($date and $asc_desc)) {
            $auctions = Auction::where('date', $date)->orderBy('end_date', $asc_desc)
            ->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->paginate($perPage);

        }else{
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 0);
            })->where('status', 'Closed')->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        return view('auctions.privatetransfers.lost', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function open(Request $request, Auction $auctions)
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
        $asc_desc = $request->input('asc_desc');
        $service_number = $request->input('service_number');
        $perPage = 15;

        if (!empty($from_city and $to_city and $from and $to and $category and $date and $asc_desc)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
            ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
            ->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($asc_desc)) {
            $auctions = Auction::orderBy('end_date', $asc_desc)->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($service_number)) {
            $auctions = Auction::where('service_number', 'LIKE', "%$service_number%")->whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->open()->active()->latest()->paginate($perPage);
        }

        $bids = Bid::where('canceled', 0)->get();

        // $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
        //     $query->where('user_id', $user->id);
        // })->sortable()->from()->open()->active()->latest()->get();

        return view('auctions.privatetransfers.open', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
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
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->private()->sortable()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->private()->sortable()->open()->active()->latest()->paginate($perPage);
        }



        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.privatetransfers.winning', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
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
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('canceled', 0);
                })->sortable()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('canceled', 0);
            })->sortable()->open()->active()->latest()->paginate($perPage);
        }


        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.privatetransfers.losing', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function accepted(Request $request, Auction $auctions)
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
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);

        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->whereHas('bids', function ($query) use($user) {
                    $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
                })->sortable()->closed()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->where('won', 1)->where('canceled', 0);
            })->sortable()->closed()->latest()->paginate($perPage);
        }


        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.privatetransfers.accepted', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }
}
