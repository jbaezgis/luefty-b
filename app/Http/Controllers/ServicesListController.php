<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\ServicePrice;
use App\Location;


class ServicesListController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => ['show']]);
    }

    public function index(Request $request)
    {
        $request->flash();
        $from = $request->input('from');
        $to = $request->input('to');

        if (!empty($from and $to)) {
            $services = Service::where('from', $from)->where('to', $to)->get();
        }elseif (!empty($from)){
            $services = Service::where('from', $from)->get();
        }elseif (!empty($to)){
            $services = Service::where('to', $to)->get();
        }else{
            $services = Service::whereNotNull('from')->whereNotNull('to')->get();
        }

        // $services = Service::get();
        return view('manage.transferslist.index', compact('services'));
    }

    public function show(Request $request, $from, $to)
    {
        $request->flash();
        $locationfrom = Location::where('slug', $from)->first();
        $locationto = Location::where('slug', $to)->first();
        $service = Service::where('from', $locationfrom->id)->where('to', $locationto->id)->first();

        // $services_options = ServicePrice::where('service_id', $service->id)->orderBy('oneway_price', 'ASC')->get();
        // $services_options = ServicePrice::where('service_id', $service->id)->whereHas('priceOption', function ($query) use($request) {
        //     $query->where('max_passengers', '>=', $request->passengers);
        // })->orderBy('oneway_price', 'ASC')->get();

        if ($request->passengers){
            $services_options = ServicePrice::where('service_id', $service->id)->whereHas('priceOption', function ($query) use($request) {
                $query->where('max_passengers', '>=', $request->passengers);
            })->orderBy('oneway_price', 'ASC')->get();
        }
        else{
            $services_options = ServicePrice::where('service_id', $service->id)->orderBy('oneway_price', 'ASC')->get();
        }


        return view('pages.service', compact('service', 'services_options', 'request'));
    }
}
