<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use App\Booking;
use Illuminate\Http\Request;
use App\Auction;
use App\Bid;
use App\Service;
use App\ServicePrice;
use App\Events\AuctionNotification;
use App\Extra;
use App\Events\NewBidNotification;
use App\User;
use App\Mail\NewAuctionB2C;
use App\Mail\NewBidB2B;
use App\Mail\NewBidB2C;
use App\Mail\NewBidToAuctioneer;
use Mail;
use App\VehicleType;
use App\Location;
use App\FakeBid;
use App\Coupon;
use Twilio\Rest\Client;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function to_airport($id)
    {
        // $from_city = Input::get('from_city');
        $places = Location::where('is_airport', 1)->where('active', 1)->orderBy('order')->get();

        return json_encode($places);

    }

    public function index(Request $request)
    {
        $request->flash();
        $from = $request->input('from');
        $to = $request->input('to');

        return view('bookings.index');
    }

    public function touristBookings(Request $request)
    {
        $request->flash();
        $paginate = 15;

        $auctions = Auction::booking()->open()->latest()->paginate($paginate);

        return view('bookings.tourist_bookings', compact('auctions'));
    }

    public function touristAuctions(Request $request)
    {
        $request->flash();
        $paginate = 15;

        $bids = Bid::where('canceled', 0)->get();

        $auctions = Auction::auction()->open()->latest()->paginate($paginate);

        return view('bookings.tourist_auctions', compact('auctions', 'bids'));
    }

    public function bookingSearch(Request $request)
    {
        $request->flash();
        // $auction_id = $request->input('auction_id');
        $email = $request->input('email');

        $auctions = Auction::where('email', $email)->where('payment_status', NULL)->latest()->get();

        return view('bookings.booking_search', compact('auctions','request'));
    }

    public function myBooking(Request $request, $auction_id)
    {
        $request->flash();
        $user = Auth::user();
        
        $auction = Auction::where('auction_id', $auction_id)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }
        // $auction_id = $request->input('auction_id');
        // $email = $request->input('email');

        // if ($request){
        //     $auction = Auction::where('auction_id', $auction_id)->where('email', $email)->first();
        // }else {
        //     $auction = '';
        // }

        $service = Service::where('id', $auction->service_id)->first();
        
        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        $bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->orderBy('bid', 'ASC')->get();

        $service_price = ServicePrice::where('service_id', $service->id)->first();


        return view('bookings.my_booking', compact('auction', 'request', 'extras', 'bids', 'service_price'));
    }

    public function fakebids(Request $request, $key)
    {
        $request->flash();
        $user = Auth::user();
        
        $auction = Auction::where('key', $key)->first();

        // if ($auction->payment_status == 'Paid')
        // {
        //     return redirect('booking/closed/'.$auction->key);
        // }

        $service = Service::where('id', $auction->service_id)->first();
        
        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        $bids = Bid::where('auction_id', $auction->id)->where('canceled', 0)->orderBy('bid', 'ASC')->get();
        $fakebids = FakeBid::where('auction_id', $auction->id)->orderBy('bid', 'DESC')->get();
        $fakebid = FakeBid::where('auction_id', $auction->id)->latest()->first();

        $service_price = ServicePrice::where('service_id', $service->id)->first();


        return view('bookings.fakebids', compact('auction', 'request', 'extras', 'bids', 'service_price', 'fakebids', 'fakebid'));
    }

    // public function myBooking(Request $request)
    // {
    //     $request->flash();
    //     $auction_id = $request->input('auction_id');
    //     $email = $request->input('email');

    //     $auction = Auction::where('auction_id', $auction_id)->where('email', $email)->first();

    //     return view('bookings.my_booking', compact('auction'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = Location::where('id', $request->from)->first();

        $auction = new Auction();

        $auction->country_id = $location->country_id;
        $auction->region_id = $location->region_id;
        $auction->from_city = $request->from;
        $auction->to_city = $request->to;
        if ($request->return_date)
        {
            $auction->date = $request->date;
            $auction->return_date = $request->return_date;
            $auction->type = 'roundtrip';
            
        }else {
            $auction->date = $request->date;
            $auction->type = 'oneway';
        }
        
        $auction->passengers = $request->passengers;
        $auction->status = '';
        
        $service = Service::where('id', $request->service_id)->first();
        $service_price = ServicePrice::findOrFail($request->service_price_id);
        $percentaje = $service_price->oneway_price * 0.1;
        $total = $service_price->oneway_price + $percentaje;

        $auction->category_id = 8;
        $auction->service_id = $service->id;
        $auction->vehicle_type = $request->vehicleid;
        $auction->service_price_id = $service_price->id;

        
        if ($auction->type == 'roundtrip')
        {
            $starting_bid = $service_price->oneway_price * 2;
            $buy_now = $total * 2;
            $buy_now_per = $buy_now * 0.1;
            $auction->starting_bid = $starting_bid;
            $auction->order_total = $buy_now;
        }else{
            $starting_bid = $service_price->oneway_price;
            $buy_now = $total;
            $buy_now_per = $buy_now * 0.1;
            $auction->starting_bid = $starting_bid ;
            $auction->order_total = $buy_now;
        }

        $auction->save();

        // Key
        $hashstring = 'secret-@#-'.$auction->id;
        // $booking->key = Hash::make($hashstring);
        $auction->key = str_replace('/', '', Hash::make($hashstring));

        // Code
        $auction->auction_id = 'I' . $auction->id . 'F' . $request->from . 'T' . $request->to . 'D' . \Carbon\Carbon::now()->format('ym');
        $auction->save();

        // Fake bid
        $fakebid = new FakeBid();
        $fakebid->auction_id = $auction->id;
        $fakebid_percentaje = $auction->order_total * 0.15;
        $fakebid_total = $auction->order_total + $fakebid_percentaje; 
        if ($auction->type == 'roundtrip')
        {
            $fakebid->bid = $fakebid_total;
        }else{
            $fakebid->bid = $fakebid_total;
        }
        $fakebid->save();

        // return redirect('select_vehicle/'.$auction->key.'/edit');
        // return redirect('booking/bids/'.$auction->key);
        return redirect('booking/complete_form/'.$auction->key.'/edit');
    }

    // Change to one-way
    public function oneway($id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->status == 'Open')
        {
            return redirect('booking/mybooking/'.$auction->auction_id)->with('cannot_edit', __('It is not possible to make changes to this auction!'));
        }else
        {
            $auction->type = 'oneway';
            $auction->save();

            return back();
        }
    }

    // Change to round-trip
    public function roundtrip($id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->status == 'Open')
        {
            return redirect('booking/mybooking/'.$auction->auction_id)->with('cannot_edit', __('It is not possible to make changes to this auction!'));
        }else
        {
            $auction->type = 'roundtrip';
            $auction->save();

            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        // $booking = Booking::findOrFail($id);
        $auction = Auction::where('key', $key)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        return view('bookings.second_step', compact('auction', 'extras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $key)
    {
        $request->flash();

        $auction = Auction::where('key', $key)->first();

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $service = Service::where('from', $auction->from_city)->where('to', $auction->to_city)->first();

        if ($service){
            $services_prices = ServicePrice::where('service_id', $service->id)->whereHas('priceOption', function ($query) use($auction) {
                $query->where('max_passengers', '>=', $auction->passengers);
            })->orderBy('oneway_price', 'ASC')->get(); 
            // $services_prices = ServicePrice::where('service_id', $service->id)->orderBy('oneway_price', 'ASC')->get(); 
        }
        else{
            $services_prices = '';
        }

        // return view('bookings.first_step', compact('auction', 'services_prices', 'service'));
        return view('bookings.1_select_vehicle', compact('auction', 'services_prices', 'service', 'extras'));
    }

    public function stepTwo(Request $request, $key)
    {
        $request->flash();

        $auction = Auction::where('key', $key)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $service = Service::where('from', $auction->from_city)->where('to', $auction->to_city)->first();

        $services_prices = ServicePrice::where('service_id', $service->id)->get();

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        $extras_total = Extra::where('auction_id', $auction->id)->sum('total');

        $total = $auction->order_total + $extras_total;

        $extra_wheelchair = Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->first();
        $extra_5min = Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->first();
        $extra_child_seat = Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->first();
        $extra_booster_seat = Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->first();

        return view('bookings.step_two', 
            compact('auction', 
            'services_prices', 
            'service', 
            'extras', 
            'total',
            'extra_wheelchair',
            'extra_5min',
            'extra_child_seat',
            'extra_booster_seat'
            ));
    }

    public function completeForm(Request $request, $key)
    {
        $request->flash();

        $auction = Auction::where('key', $key)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $service = Service::where('from', $auction->from_city)->where('to', $auction->to_city)->first();

        $services_prices = ServicePrice::where('service_id', $service->id)->get();

        $service_price = ServicePrice::where('service_id', $service->id)->first();

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();


        $extra_wheelchair = Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->first();
        $extra_5min = Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->first();
        $extra_child_seat = Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->first();
        $extra_booster_seat = Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->first();

        $extras_total = Extra::where('auction_id', $auction->id)->sum('total');

        $total = $auction->order_total + $extras_total;

        return view('bookings.2_complete_form', 
            compact('auction', 
            'services_prices', 
            'service', 
            'extras', 
            'total', 
            'service_price',
            'extra_wheelchair',
            'extra_5min',
            'extra_child_seat',
            'extra_booster_seat'
            ));
    }

    public function extras(Request $request, $key)
    {
        $request->flash();

        $auction = Auction::where('key', $key)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $service = Service::where('from', $auction->from_city)->where('to', $auction->to_city)->first();

        $services_prices = ServicePrice::where('service_id', $service->id)->get();
        
        $service_price = ServicePrice::where('service_id', $service->id)->first();

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        $extras_total = Extra::where('auction_id', $auction->id)->sum('total');

        $total = $auction->order_total + $extras_total;

        return view('bookings.3_extras', compact('auction', 'services_prices', 'service', 'extras', 'total', 'service_price'));
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
        $request->flash();
        $auction = Auction::findOrFail($id);
        $service = Service::where('id', $auction->service_id)->first();

        // if ($auction->status == 'Open')
        // {
        //     return redirect('booking/mybooking/'.$auction->auction_id)->with('cannot_edit', __('It is not possible to make changes to this auction!'));
        // }else
        // {

        // }
        // $auction->baby_seats = $request->baby_seats;
        // $auction->child_seats = $request->child_seats;
        
        $auction->full_name = $request->full_name;
        $auction->email = $request->email;
        $auction->phone = $request->country_code . ' ' .$request->phone;
        $auction->adults = $request->adults;
        $auction->infants = $request->infants;
        $auction->babies = $request->babies;
        if ($auction->date == NULL)
        { 
            $auction->date = $request->date;
        }
        // $auction->date = $request->date;
        $auction->arrival_time = date('H:i:s', strtotime($request->arrival_time));
        $auction->pickup_time = date('H:i:s', strtotime($request->pickup_time));
        $auction->arrival_airline = $request->arrival_airline;
        $auction->flight_number = $request->flight_number;
        // $auction->passengers = $request->adults + $request->infants + $request->babies;
        // $auction->service_price_id = $request->service_price_id;
        $auction->more_information = $request->more_information;
        $auction->more_information_2 = $request->more_information_2;
        // $auction->ip = Request::ip();
        $auction->status = '';

        if ($auction->type == 'roundtrip')
        {
            if ($auction->return_date == NULL)
            {
                $auction->return_date = $request->return_date;
            }
            $auction->return_airline = $request->return_airline;
            $auction->return_flight_number = $request->return_flight_number;
            $auction->return_time = date('H:i:s', strtotime($request->return_time));
            $auction->return_more_information = $request->return_more_information;
            $auction->return_more_information_2 = $request->return_more_information_2;
            
        }
        
        // Pickup time
        if ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == NULL)
        {
            if ($request->pickup_time2){
                $auction->pickup_time =date('H:i:s', strtotime($request->pickup_time2));
            }else{
                $auction->want_to_arrive = $request->want_to_arrive;
                $driving_time = $service->driving_time;
                $pickup_time_1 = date('H:i',strtotime("-$driving_time minutes",strtotime($request->return_time)));
                $pickup_time_2 = date('H:i',strtotime("-$request->want_to_arrive minutes",strtotime($pickup_time_1)));
                $auction->pickup_time = date('H:i',strtotime("-15 minutes",strtotime($pickup_time_2)));
            }
            
        }
        
        if ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == 1)
        {
            if ($request->pickup_time2){
                $auction->pickup_time =date('H:i:s', strtotime($request->pickup_time2));
            }else{
                $auction->want_to_arrive = $request->want_to_arrive;
                $driving_time = $service->driving_time;
                $pickup_time_1 = date('H:i',strtotime("-$driving_time minutes",strtotime($request->arrival_time)));
                $pickup_time_2 = date('H:i',strtotime("-$request->want_to_arrive minutes",strtotime($pickup_time_1)));
                $auction->pickup_time = date('H:i',strtotime("-15 minutes",strtotime($pickup_time_2)));
            }
            
        }

        // if ($auction->fromcity->is_airport == 1 && $auction->type == 'roundtrip')
        // {
        //     if ($request->pickup_time2){
        //         $auction->pickup_time =date('H:i:s', strtotime($request->pickup_time2));
        //     }else{
        //         $auction->want_to_arrive = $request->want_to_arrive;
        //         $driving_time = $service->driving_time;
        //         $pickup_time_1 = date('H:i',strtotime("-$driving_time minutes",strtotime($request->arrival_time)));
        //         $pickup_time_2 = date('H:i',strtotime("-$request->want_to_arrive minutes",strtotime($pickup_time_1)));
        //         $auction->pickup_time = date('H:i',strtotime("-15 minutes",strtotime($pickup_time_2)));
        //     }
            
        // }

        $auction->save();

        // Extras

        // Extras
        if ($request->wheelchair)
        {
            if (Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->count())
            {
                $extra_id = Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->first();
                $extra = Extra::findOrFail($extra_id->id);
                $extra->quantity = $request->wheelchair;
                $extra->price = 7;
                $extra->total = 7 * $request->wheelchair;
                $extra->save();

            }else
            {
                $extra = new Extra();
                $extra->auction_id = $auction->id;
                $extra->name = 'Wheelchair';
                $extra->quantity = $request->wheelchair;
                $extra->price = 7;
                $extra->total = 7 * $request->wheelchair;
                $extra->save();
            }
        }

        if ($request->min_extra)
        {
            if (Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->count())
            {
                $extra_id = Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->first();
                $extra = Extra::findOrFail($extra_id->id);
                $extra->quantity = $request->min_extra;
                $extra->price = 15;
                $extra->total = 15 * $request->min_extra;
                $extra->save();

            }else
            {
                $extra = new Extra();
                $extra->auction_id = $auction->id;
                $extra->name = '5 min extra';
                $extra->quantity = $request->min_extra;
                $extra->price = 15;
                $extra->total = 15 * $request->min_extra;
                $extra->save();
            }
        }

        if ($request->child_seat)
        {
            if (Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->count())
            {
                $extra_id = Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->first();
                $extra = Extra::findOrFail($extra_id->id);
                $extra->quantity = $request->child_seat;
                $extra->price = 10;
                $extra->total = 10 * $request->child_seat;
                $extra->save();

            }else
            {
                $extra = new Extra();
                $extra->auction_id = $auction->id;
                $extra->name = 'Child seat';
                $extra->quantity = $request->child_seat;
                $extra->price = 10;
                $extra->total = 10 * $request->child_seat;
                $extra->save();
            }
        }

        if ($request->booster_seat)
        {
            if (Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->count())
            {
                $extra_id = Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->first();
                $extra = Extra::findOrFail($extra_id->id);
                $extra->quantity = $request->booster_seat;
                $extra->price = 10;
                $extra->total = 10 * $request->booster_seat;
                $extra->save();

            }else
            {
                $extra = new Extra();
                $extra->auction_id = $auction->id;
                $extra->name = 'Booster seat';
                $extra->quantity = $request->booster_seat;
                $extra->price = 10;
                $extra->total = 10 * $request->booster_seat;
                $extra->save();
            }
        }

        if ($auction->vehicleType->max_passengers < $auction->passengers)
        {
            return back()->with('passengers_error', __('Passengers error'));
        }else
        {
            // Notification for tourist
            event(new AuctionNotification($auction));

            // Notificaction for users in auction's region
            // $users = User::where('region_id', $auction->region_id)->get();
            // foreach ($users as $user) {
            //     Mail::to($user->email)->send(new NewAuctionB2C($auction));
            // }
            // return redirect('booking/extras/'.$auction->key)->with('auction_created', __('Auction has been created'));
            // return redirect('booking/mybooking/'.$auction->auction_id);
            return redirect('booking/confirmation/'. $auction->key);
            
        }
            
        
    }

    public function bookingSave(Request $request, $id)
    {
        $request->flash();
        $auction = Auction::findOrFail($id);
        $service = Service::where('id', $auction->service_id)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }elseif ($auction->status == 'Open')
        {
            return redirect('booking/mybooking/'.$auction->auction_id)->with('cannot_edit', __('It is not possible to make changes to this auction!'));
        }else
        {
            $auction->baby_seats = $request->baby_seats;
            $auction->child_seats = $request->child_seats;

            $auction->full_name = $request->full_name;
            $auction->email = $request->email;
            $auction->phone = $request->country_code . ' ' .$request->phone;
            $auction->language = $request->language;
            // $auction->date = $request->date;
            $auction->arrival_time = date('H:i:s', strtotime($request->arrival_time));
            $auction->pickup_time = date('H:i:s', strtotime($request->pickup_time));
            $auction->arrival_airline = $request->arrival_airline;
            $auction->flight_number = $request->flight_number;

            $auction->adults = $request->adults;
            $auction->infants = $request->infants;
            $auction->babies = $request->babies;
            // $auction->passengers = $request->adults + $request->infants + $request->babies;
            // $auction->service_price_id = $request->service_price_id;
            $auction->more_information = $request->more_information;
            $auction->more_information_2 = $request->more_information_2;
            $auction->starting_bid = $auction->order_total;
            // $auction->ip = Request::ip();
            // $auction->type = 'booking';
            if ($auction->type == 'roundtrip')
            {
                // $auction->return_date = $request->return_date;
                $auction->return_airline = $request->return_airline;
                $auction->return_flight_number = $request->return_flight_number;
                $auction->return_time = date('H:i:s', strtotime($request->return_time));
                $auction->return_more_information = $request->return_more_information;
                $auction->return_more_information_2 = $request->return_more_information_2;

            }
            
            // Pickup time
            if ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == NULL)
            {
                $auction->want_to_arrive = $request->want_to_arrive;
                $driving_time = $service->driving_time;
                $pickup_time_1 = date('H:i',strtotime("-$driving_time minutes",strtotime($request->return_time)));
                $pickup_time_2 = date('H:i',strtotime("-$request->want_to_arrive minutes",strtotime($pickup_time_1)));
                $auction->pickup_time = date('H:i',strtotime("-15 minutes",strtotime($pickup_time_2)));
                
            }
            
            if ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == 1)
            {
                
                $auction->want_to_arrive = $request->want_to_arrive;
                $driving_time = $service->driving_time;
                $pickup_time_1 = date('H:i',strtotime("-$driving_time minutes",strtotime($request->arrival_time)));
                $pickup_time_2 = date('H:i',strtotime("-$request->want_to_arrive minutes",strtotime($pickup_time_1)));
                $auction->pickup_time = date('H:i',strtotime("-15 minutes",strtotime($pickup_time_2)));
                
            }
            

            $auction->save();

            // Extras
            if ($request->wheelchair)
            {
                if (Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->count())
                {
                    $extra_id = Extra::where('auction_id', $auction->id)->where('name', 'Wheelchair')->first();
                    $extra = Extra::findOrFail($extra_id->id);
                    $extra->quantity = $request->wheelchair;
                    $extra->price = 7;
                    $extra->total = 7 * $request->wheelchair;
                    $extra->save();

                }else
                {
                    $extra = new Extra();
                    $extra->auction_id = $auction->id;
                    $extra->name = 'Wheelchair';
                    $extra->quantity = $request->wheelchair;
                    $extra->price = 7;
                    $extra->total = 7 * $request->wheelchair;
                    $extra->save();
                }
            }

            if ($request->min_extra)
            {
                if (Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->count())
                {
                    $extra_id = Extra::where('auction_id', $auction->id)->where('name', '5 min extra')->first();
                    $extra = Extra::findOrFail($extra_id->id);
                    $extra->quantity = $request->min_extra;
                    $extra->price = 15;
                    $extra->total = 15 * $request->min_extra;
                    $extra->save();

                }else
                {
                    $extra = new Extra();
                    $extra->auction_id = $auction->id;
                    $extra->name = '5 min extra';
                    $extra->quantity = $request->min_extra;
                    $extra->price = 15;
                    $extra->total = 15 * $request->min_extra;
                    $extra->save();
                }
            }

            if ($request->child_seat)
            {
                if (Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->count())
                {
                    $extra_id = Extra::where('auction_id', $auction->id)->where('name', 'Child seat')->first();
                    $extra = Extra::findOrFail($extra_id->id);
                    $extra->quantity = $request->child_seat;
                    $extra->price = 10;
                    $extra->total = 10 * $request->child_seat;
                    $extra->save();

                }else
                {
                    $extra = new Extra();
                    $extra->auction_id = $auction->id;
                    $extra->name = 'Child seat';
                    $extra->quantity = $request->child_seat;
                    $extra->price = 10;
                    $extra->total = 10 * $request->child_seat;
                    $extra->save();
                }
            }

            if ($request->booster_seat)
            {
                if (Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->count())
                {
                    $extra_id = Extra::where('auction_id', $auction->id)->where('name', 'Booster seat')->first();
                    $extra = Extra::findOrFail($extra_id->id);
                    $extra->quantity = $request->booster_seat;
                    $extra->price = 10;
                    $extra->total = 10 * $request->booster_seat;
                    $extra->save();

                }else
                {
                    $extra = new Extra();
                    $extra->auction_id = $auction->id;
                    $extra->name = 'Booster seat';
                    $extra->quantity = $request->booster_seat;
                    $extra->price = 10;
                    $extra->total = 10 * $request->booster_seat;
                    $extra->save();
                }
            }

            if ($auction->servicePrice->vehicle->max_passengers < $auction->passengers)
            {
                return back()->with('passengers_error', __('Passengers error'));
            }else
            {
                // return redirect('booking/extras/'.$auction->key)->with('booking_created', __('Booking created'));
                return redirect('booking/confirmation/'. $auction->key);
            }

            // $auction->save();

        }
    }

    public function auctionShow($key)
    {
        // $booking = Booking::findOrFail($id);
        $auction = Auction::where('key', $key)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        return view('bookings.auction_show', compact('auction','extras'));
    }

    public function assignStatus($id)
    {
        $auction = Auction::findOrFail($id);

        $auction->status = '';
        $auction->save();

        // event(new AuctionNotification($auction));

        $users = User::get();

        // foreach ($users as $user) {
        //     Mail::to($user->email)->send(new NewAuctionB2C($auction));
        // }

        return redirect('booking/mybooking/'.$auction->auction_id);
    }

    public function applyCoupon(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);
        // $auction = Coupon::findOrFail($request->coupon_id);
        $coupon = Coupon::where('code', $request->coupon)->first();

        if ($coupon->status == 'Used')
        {
            return back()->with('coupon_error', __('This coupon has already been used'));
        }else {

            $auction->coupon_id = $coupon->id;
            $auction->discount = $coupon->discount;
            $auction->save();
    
            $coupon->status = 'Used';
            $coupon->save();
    
            return back()->with('coupon_success', __('Your discount was applied'));
        }
    }

    public function confirmation($key)
    {
        // $booking = Booking::findOrFail($id);
        $auction = Auction::where('key', $key)->first();

        if ($auction->payment_status == 'Paid')
        {
            return redirect('booking/closed/'.$auction->key);
        }

        $extras = Extra::where('auction_id', $auction->id)->orderBy('id', 'ASC')->get();

        $extras_total = Extra::where('auction_id', $auction->id)->sum('total');

        $percentage = $auction->servicePrice->starting_bid * 0.10;

        $total_booking = $auction->servicePrice->oneway_price + $extras_total;

        $total_auction = $auction->servicePrice->starting_bid + $percentage + $extras_total;

        $coupon = Coupon::where('id', $auction->coupon_id)->first();

        // $bid = Bid::where('auction_id', $auction->id)->where('won', 1)->first();
        // $bid_percentage = $bid->bid * 0.10;
        // $bid_total = $bid->bid + $bid_percentage;

        // if (Bid::where('auction_id', $auction->id)->where('won', 1)->count())
        // {
        //     $auction->order_total = $bid_total;
        // }else {
        //     if ($auction->category_id == 7){
        //         $auction->order_total = $total_booking;
        //     }else{
        //         $auction->order_total = $total_auction;
        //     }
        // }

        // $auction->save();

        return view('bookings.confirmation', compact('auction', 'extras', 'coupon'));
    }

    public function serviceId(Request $request, $id)
    {

        $auction = Auction::findOrFail($id);

        $auction->service_id = $request->service_price_id;

        $auction->save();

        return redirect('first_step/'.$auction->key.'/edit')->with('service_price', __('Your selected a Price'));
    }

    public function fromto(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);

        $auction->from_city = $request->from_city;
        $auction->to_city = $request->to_city;

        $auction->save();

        return redirect('first_step/'.$auction->key.'/edit')->with('location_updated', __('Locations changed'));
    }

    public function assignPrice(Request $request, $id)
    {
        $service_price = ServicePrice::findOrFail($id);
        $auction = Auction::findOrFail($request->auction_id);

        $percentaje = $service_price->oneway_price * 0.1;
        $order_total = $service_price->oneway_price + $percentaje;

        $auction->category_id = 7;
        $auction->service_id = $service_price->service_id;
        $auction->service_price_id = $service_price->id;
        $auction->vehicle_type = $request->vehicleid;
        if ($auction->type == 'roundtrip')
        {
            $auction->starting_bid = $order_total * 2;
            $auction->order_total = $order_total * 2;
        }else{
            $auction->starting_bid = $order_total;
            $auction->order_total = $order_total;
        }

        $auction->save();

        return redirect('step_two/'.$auction->key.'/edit');
    }

    // Auction proccess
    public function assignService(Request $request, $id)
    {
        $auction = Auction::findOrFail($request->id);
        $service = Service::where('from', $auction->from_city)->where('to', $auction->to_city)->first();
        $service_price = ServicePrice::findOrFail($request->service_price_id);
        $percentaje = $service_price->oneway_price * 0.1;
        $total = $service_price->oneway_price + $percentaje;

        if ($auction->status == 'Open')
        {
            return redirect('booking/mybooking/'.$auction->auction_id)->with('cannot_edit', __('It is not possible to make changes to this auction!'));
        }else
        {
            $auction->category_id = 8;
            $auction->service_id = $service->id;
            $auction->vehicle_type = $request->vehicleid;
            $auction->service_price_id = $service_price->id;
            
            if ($auction->type == 'roundtrip')
            {
                $auction->starting_bid = $service_price->oneway_price * 2;
                $auction->order_total = $service_price->oneway_price * 2;
            }else{
                $auction->starting_bid = $service_price->oneway_price;
                $auction->order_total = $service_price->oneway_price;
            }
    
            $auction->save();
    
            return redirect('booking/complete_form/'.$auction->key.'/edit');
        }
    }

    public function acceptStartingBid(Request $request, $id)
    {
        $request->flash();
        $auction = Auction::findOrFail($id);

        $percentage = $auction->starting_bid * 0.10;

        $auction->order_total = $auction->starting_bid + $percentage;
        // $auction->type = 'booking';
        $auction->status = 'Closed';

        $auction->save();

        return redirect('booking/confirmation/'.$auction->key)->with('booking_created', __('Booking created'));
    }

    public function bookingbid(Request $request)
    {
        $user = Auth::user();
        $auction_id = $request->auction_id;
        $auction = Auction::find($auction_id);
        $users = User::where('id', '!=', $user->id)->where('region_id', $auction->region_id)->get();
        
        $bids = Bid::where('canceled', 0);

        // $bids = Bid::where('auction_id', $auction)->where('canceled', 0);
        if ($auction->status == 'Closed')
        {
            return redirect('suppliers/auction/'.$auction->id);
        }else
        {
            if (Bid::where('auction_id', $auction->id)->where('canceled', 0)->where('user_id', $user->id)->count() > 0)
            {
                $findmybid = $bids->where('auction_id', $auction_id)->where('user_id', auth()->user()->id)->first();
    
                $bid = Bid::find($findmybid->id);
    
                $bid->bid = $request->bid;
    
                $bid->save();
    
                $previousUrl = app('url')->previous();

                $bidders = User::where('id', '!=', $user->id)->where('region_id', $auction->region_id)
                ->whereHas('bids', function ($query) use($auction) {
                    $query->where('auction_id', $auction->id);
                })->get();
    
                if ($auction->category_id == 7 or $auction->category_id == 8)
                {
                    // event(new NewBidNotification($bid));
                    
                    // if ($auction->bids->count() <= 1)
                    // {
                    //     foreach ($users as $item) {
                            
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2C($bid));
                    //     }
                    // }else {
                    //     foreach ($bidders as $item) {
        
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2C($bid));
                    //     }
                    // }

                }elseif ($auction->category_id == 1)
                {
                    // Mail::to($bid->auction->user->email)->send(new NewBidToAuctioneer($bid));
                    // Mail::to($bid->auction->user->email)->locale($bid->auction->user->lang)->send(new NewBidToAuctioneer($bid));
    
                    // if ($auction->bids->count() <= 1)
                    // {
                    //     foreach ($users as $item) {
                            
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2C($bid));
                    //     }
                    // }else {
                    //     foreach ($bidders as $item) {
        
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2C($bid));
                    //     }
                    // }
                }
    
                return redirect($previousUrl.'#auction'.$auction->id);
                // return redirect('suppliers/auction/'.$auction->id);
    
            }else
            {
    
                $bid = new Bid();
                $bid->user_id = $request->user()->id;
                $bid->auction_id = $request->auction_id;
                $bid->bid = $request->bid;
    
                $bid->save();

                $bidders = User::where('id', '!=', $user->id)->where('region_id', $auction->region_id)
                ->whereHas('bids', function ($query) use($auction) {
                    $query->where('auction_id', $auction->id);
                })->get();
    
                $previousUrl = app('url')->previous();
    
                if ($auction->category_id == 7 or $auction->category_id == 8)
                {
                    event(new NewBidNotification($bid));
    
                    // if ($auction->bids->count() <= 1)
                    // {
                    //     foreach ($users as $item) {
                            
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2C($bid));
                    //     }
                    // }else {
                    //     foreach ($bidders as $item) {
        
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2C($bid));
                    //     }
                    // }
    
                }elseif ($auction->category_id == 1)
                {
                    // Mail::to($bid->auction->user->email)->send(new NewBidToAuctioneer($bid));
                    // Mail::to($bid->auction->user->email)->locale($bid->auction->user->lang)->send(new NewBidToAuctioneer($bid));
    
                    // if ($auction->bids->count() <= 1)
                    // {
                    //     foreach ($users as $item) {
                            
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2B($bid));
                    //     }
                    // }else {
                    //     foreach ($bidders as $item) {
        
                    //         Mail::to($item->email)->locale($item->lang)->send(new NewBidB2B($bid));
                    //     }
                    // }
                }
    
                return redirect($previousUrl.'#auction'.$auction->id);
                // return redirect('suppliers/auction/'.$auction->id);
    
            }
        }//if auction closed

    }

    public function acceptCurrentBid(Request $request, $id)
    {
        $request->flash();
        $service_price = ServicePrice::findOrFail($id);
        $auction = Auction::findOrFail($request->auction_id);

        $auction->service_id = $service_price->service_id;
        $auction->service_price_id = $service_price->id;
        if ($auction->type == 'roundtrip')
        {
            $auction->order_total = $service_price->oneway_price * 2;
        }else{
            $auction->order_total = $service_price->oneway_price;
        }

        $auction->save();

        return redirect('booking/confirmation/'.$auction->key);

    }

    public function acceptBid(Request $request, $id)
    {

        $auction_id = $request->auction_id;

        $auction = Auction::findOrFail($auction_id);
        $bid = Bid::findOrFail($id);

        $bid_percentage = $bid->bid * 0.1;
        $bid_total = $bid->bid + $bid_percentage;

        // Auction
        $auction->status = 'Closed';
        $auction->bid_amount = $bid_total;
        $auction->save();

        // Bid
        $bid->won = 1;
        $bid->save();

        // WhatsApp notification
        
        $from = $auction->fromcity->name;
        $to = $auction->tocity->name;
        $bidder = $bid->user->name;
        $bid_amount = $auction->country->currency_symbol. number_format($bid->bid, 2, '.', ',');
        
        // $sid = env("TWILIO_AUTH_SID");
        // $token = env("TWILIO_AUTH_TOKEN");
        // $twilio = new Client($sid, $token);
        // $message = $twilio->messages
        //     ->create("whatsapp:18493412723", // to
        //             [   
        //                 "from" => "whatsapp:+14155238886",
        //                 "body" => "https://luefty.com \n \nCongratulations! *$bidder* you won this Auction: \n \n*$from* to *$to* \n \nYour bid: *$bid_amount*",
        //             ]
        //     );

        // dd($message->sid);

        // event(new BidAcceptedNotification($bid));

        // return redirect('booking/confirmation/'.$auction->key);
        return back();

    }

    public function auctionClosed($key)
    {
        $auction = Auction::where('key', $key)->first();
        return view('bookings.closed', compact('auction'));
    }

    public function cancel($id)
    {
        $auction = Auction::findOrFail($id);

        $delete_bids = Bid::where('auction_id', $auction->id)->delete();

        $extras = Extra::where('auction_id', $auction->id)->delete();

        $auction->delete();

        return redirect('/');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function transfer1(Request $request)
    {
        $location = Location::where('id', $request->from)->first();

        $auction = new Auction();
        
        $auction->country_id = $location->country_id;
        $auction->region_id = $location->region_id;
        $auction->service_id = $request->service_id;
        $auction->from_city = $request->from;
        $auction->to_city = $request->to;
        $auction->type = $request->type;
        $auction->passengers = $request->passengers;

        $auction->status = '';
        
        // aqui
        $service_price = ServicePrice::findOrFail($request->service_price_id);
        $percentaje = $service_price->oneway_price * 0.1;
        $total = $service_price->oneway_price + $percentaje;

        $auction->category_id = 8;
        $auction->service_id = $service->id;
        $auction->vehicle_type = $request->vehicleid;
        $auction->service_price_id = $service_price->id;
        
        if ($auction->type == 'roundtrip')
        {
            $auction->starting_bid = $service_price->oneway_price * 2;
            $auction->order_total = $service_price->oneway_price * 2;
        }else{
            $auction->starting_bid = $service_price->oneway_price;
            $auction->order_total = $service_price->oneway_price;
        }

        $auction->save();

        // Key
        $hashstring = 'secret-@#-'.$auction->id;
        // $booking->key = Hash::make($hashstring);
        $auction->key = str_replace('/', '', Hash::make($hashstring));

        // Code
        $auction->auction_id = 'I' . $auction->id . 'F' . $request->from . 'T' . $request->to . 'D' . \Carbon\Carbon::now()->format('ym');
        $auction->save();

        // Fake bid
        $fakebid = new FakeBid();
        $fakebid->auction_id = $auction->id;
        $fakebid_percentaje = $total * 0.15;
        $fakebid_total = $total + $fakebid_percentaje; 
        if ($auction->type == 'roundtrip')
        {
            $fakebid->bid = $fakebid_total * 2;
        }else{
            $fakebid->bid = $fakebid_total;
        }
        $fakebid->save();

        // return redirect('select_vehicle/'.$auction->key.'/edit');
        return redirect('booking/bids/'.$auction->key);
    }

    public function transfer(Request $request)
    {
        $location = Location::where('id', $request->from)->first();

        $auction = new Auction();

        $auction->category_id = 8;
        $auction->country_id = $location->country_id;
        $auction->region_id = $location->region_id;
        $auction->service_id = $request->service_id;
        $auction->from_city = $request->from;
        $auction->to_city = $request->to;
        $auction->type = $request->type;
        $auction->passengers = $request->passengers;

        $auction->status = '';

        $auction->save();

        // Key
        $hashstring = 'secret-@#-'.$auction->id;
        $auction->key = str_replace('/', '', Hash::make($hashstring));

        // Code
        $auction->auction_id = 'I' . $auction->id . 'F' . $request->from . 'T' . $request->to . 'D' . \Carbon\Carbon::now()->format('ym');
        $auction->save();

        return redirect('select_vehicle/'.$auction->key.'/edit');

        
    }

    

    public function destroy($id)
    {
        //
    }
}
