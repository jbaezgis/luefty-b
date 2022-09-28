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

class SharedShuttlesController extends Controller
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
        $perPage = 15;
        
        if (!empty($from_city and $to_city and $from and $to and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->sharing()->ortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->sharing()->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);   
        }


        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.sharedshuttles.index', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function nobidded(Request $request, Auction $auctions)
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
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->sharing()->ortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->sharing()->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereDoesntHave('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
             
        }

        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.sharedshuttles.nobidded', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function bidded(Request $request, Auction $auctions)
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
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->sharing()->ortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->sharing()->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id);
            })->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
             
        }

        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.sharedshuttles.bidded', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));
    }

    public function accepted(Request $request, Auction $auctions)
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
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category and $date)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $to and $category)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)->where('category_id', $category)
                ->sharing()->ortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $to_city)) {
            $auctions = Auction::where('from_city', $from_city)->where('to_city', $to_city)
                ->sharing()->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $to)) {
            $auctions = Auction::where('from_location', $from)->where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        }elseif (!empty($from_city and $category)) {
            $auctions = Auction::where('from_city', $from_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from and $category)) {
            $auctions = Auction::where('from_location', $from)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from and $date)) {
            $auctions = Auction::where('from_location', $from)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city and $date)) {
            $auctions = Auction::where('from_city', $from_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to and $category)) {
            $auctions = Auction::where('to_location', $to)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city and $category)) {
            $auctions = Auction::where('to_city', $to_city)->where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($to_city and $date)) {
            $auctions = Auction::where('to_city', $to_city)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to and $date)) {
            $auctions = Auction::where('to_location', $to)->where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        
        }elseif (!empty($from)) {
            $auctions = Auction::where('from_location', $from)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($from_city)) {
            $auctions = Auction::where('from_city', $from_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to_city)) {
            $auctions = Auction::where('to_city', $to_city)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        }elseif (!empty($to)) {
            $auctions = Auction::where('to_location', $to)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        } elseif (!empty($category)) {
            $auctions = Auction::where('category_id', $category)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
                
        } elseif (!empty($date)) {
            $auctions = Auction::where('date', $date)
                ->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
        }else {
            $auctions = Auction::whereHas('bids', function ($query) use($user) {
                $query->where('user_id', $user->id)->won()->active();
            })->sharing()->sortable()->from()->open()->active()->latest()->paginate($perPage);
             
        }

        $bids = Bid::where('canceled', 0)->get();


        return view('auctions.sharedshuttles.accepted', compact('auctions', 'from', 'bids', 'from_city', 'to_city'));

    }
}


