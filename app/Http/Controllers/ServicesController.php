<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceOption;
use App\Service;
use App\ServicePrice;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function from($id)
    {
        // $from_city = Input::get('from_city');
        $services = Service::get();

        return json_encode($services);

    }

    public function to($id)
    {
        // $from_city = Input::get('from_city');
        $services = Service::where('from', $id)->get();

        return json_encode($services);

    }

    public function index(Request $request)
    {
        $request->flash();
        $from = $request->input('from');
        $to = $request->input('to');

        if (!empty($from and $to)) {
            $services = Service::where('from', $from)->where('to', $to)->latest()->paginate(15);
        }elseif (!empty($from)){
            $services = Service::where('from', $from)->latest()->paginate(15);
        }elseif (!empty($to)){
            $services = Service::where('to', $to)->latest()->paginate(15);
        }else{
            $services = Service::latest()->paginate(15);
        }

        // if (!empty($from)){
        //     $duplicates = Service::select('from', 'to')
        //     ->where('from', $from)
        //     ->groupBy('from', 'to')
        //     ->havingRaw('COUNT(*) > 1')
        //     ->get();
        // }else{
        //     $duplicates = '';
        // }
        $duplicates = Service::select('from', 'to')
        // ->where('from', $from)
        ->groupBy('from', 'to')
        ->havingRaw('COUNT(*) > 1')
        ->get();

        return view('services.index', compact('services', 'duplicates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();

        $service = new Service();

        $service->from = $request->from;
        $service->to = $request->to;
        $service->driving_time = $request->driving_time;
        $service->featured = $request->featured;

        $service->save();

        return redirect('/services/'.$service->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('services.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->flash();

        $service = Service::findOrFail($id);

        $services_price = ServicePrice::where('service_id', $service->id)->get();

        return view('services.edit', compact('service', 'services_price'));
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
        $service = Service::findOrFail($id);

        $service->from = $request->from;
        $service->to = $request->to;
        $service->driving_time = $request->driving_time;
        $service->featured = $request->featured;

        $service->save();

        return back();
    }

    public function servicePrice(Request $request)
    {
        $request->flash();
        $this->validate(
            $request,
            [
                'vehicle_type' => 'required',
                'price_option_id' => 'required',
                'oneway_price' => 'required',
            ]
        );
        // $service = Service::find($service_id);

        $service_price = new ServicePrice();
        $service_price->service_id = $request->service_id;
        $service_price->vehicle_type = $request->vehicle_type;
        $service_price->price_option_id = $request->price_option_id;
        $service_price->oneway_price = $request->oneway_price;
        // $service_price->starting_bid = $request->starting_bid;

        $service_price->save();

        return back();
    }

    public function destroyServicePrice($id)
    {
        ServicePrice::destroy($id);

        return back()->with('destroy_service_price', 'Service Price deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);

        ServicePrice::where('service_id', $id)->delete();

        return back()->with('destroy_service', 'Service deleted!');
    }
}
