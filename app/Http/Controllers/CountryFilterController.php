<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

use App\Auction;
use App\Tour;
use App\Faq;
use App\User;
use Auth;
use App\Instruction;
use App\Page;
use Config;
use App\Service;
use App\ServicePrice;
use App\Region;
use App\Http\Controllers\Controller;
use App\Whale;
use App\Location;
use App\Post;
use App\Attraction;
use Illuminate\Support\Facades\DB;

class CountryFilterController extends Controller
{
    public function servicesTo($id) {

        return json_encode(Service::where('from', $id)->join('locations', 'services.to', '=', 'locations.id')->distinct()->orderBy('locations.name', 'asc')->get());
    }
    
    public function index(Request $request, $country)
    {   
        $request->flash();
        $from = $request->from;
        $to = $request->to;
        $passengers = $request->passengers;

        $country = Country::where('slug', $country)->first();

        $auctions = Auction::from()->open()->active()->get();
        $countries = Country::get();
        $regions = Region::get();
        $whales = Whale::get();
        $tours = Tour::take(6)->get();

        // $tours_punta_cana = Tour::whereHas('locationid', function($q){
        //     $q->where('name', 'Punta Cana')->where('active', 1);
        // })->take(6)->get();

        // $tours_santo_domingo = Tour::whereHas('locationid', function($q){
        //     $q->where('name', 'Santo Domingo')->where('active', 1);
        // })->take(6)->get();

        $posts = Post::where('published', 1)->take(8)->get();

        $services_from_airports = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.country_id', $country->id)->where('locations.is_airport', 1)->orderBy('locations.name')->distinct()->get()->unique('from');
        $services_from = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.country_id', $country->id)->where('locations.is_airport', 0)->orderBy('locations.name')->distinct()->get()->unique('from');
        
        $services_to = Service::join('locations', 'services.to', '=', 'locations.id')->distinct()->get();
        
        $locations = Location::where('active', 1)->where('is_airport', NULL)->whereHas('attractions')->take(8)->get();
        
        $services_filter_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.country_id', $country->id)->distinct()->get();
        
        $services = Service::take(8)->get();

        $services_prices = ServicePrice::get();

        $services_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.country_id', $country->id)->select('*','services.id as s_id')->where('featured', 1)->orderBy('from', 'asc')->take(9)->get();

        $last_attraction = Attraction::latest()->first();
        
        $attractions = Attraction::latest()->skip(1)->take(6)->get();

        // Services resutls
        $service = Service::where('from', $from)->where('to', $to)->first();

        if ($request->has('from')){
            $services_options = ServicePrice::where('service_id', $service->id)->whereHas('priceOption', function ($query) use($passengers){
                $query->where('max_passengers', '>=', $passengers);
            })->orderBy('oneway_price', 'ASC')->get(); 
        }
        else{
            $services_options = '';
        }

        return view('country', 
            compact('country',
                    'auctions', 
                    'tours', 
                    'services',
                    'countries',
                    'regions', 
                    'whales', 
                    'services_from', 
                    'services_to', 
                    'posts', 
                    'locations',
                    'attractions',
                    'last_attraction',
                    'services_prices',
                    'services_by_country',
                    'request',
                    'services_from_airports',
                    'service',
                    'services_options'
            ));
    }

    public function region(Request $request, $country, $region)
    {
        $request->flash();
        $from = $request->from;
        $to = $request->to;
        $passengers = $request->passengers;

        // $country = Country::where('slug', $country)->first();
        $region = Region::where('slug', $region)->first();

        $auctions = Auction::from()->open()->active()->get();
        $countries = Country::get();
        $regions = Region::get();
        $whales = Whale::get();
        $tours = Tour::take(6)->get();

        // $tours_punta_cana = Tour::whereHas('locationid', function($q){
        //     $q->where('name', 'Punta Cana')->where('active', 1);
        // })->take(6)->get();

        // $tours_santo_domingo = Tour::whereHas('locationid', function($q){
        //     $q->where('name', 'Santo Domingo')->where('active', 1);
        // })->take(6)->get();

        $posts = Post::where('published', 1)->take(8)->get();

        $services_from_airports = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.region_id', $region->id)->where('locations.is_airport', 1)->orderBy('locations.name')->distinct()->get()->unique('from');
        $services_from = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.region_id', $region->id)->where('locations.is_airport', 0)->orderBy('locations.name')->distinct()->get()->unique('from');
        
        $services_to = Service::join('locations', 'services.to', '=', 'locations.id')->distinct()->get();
        
        $locations = Location::where('active', 1)->where('is_airport', NULL)->whereHas('attractions')->take(8)->get();
        
        $services_filter_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.region_id', $region->id)->distinct()->get();
        
        $services = Service::take(8)->get();

        $services_prices = ServicePrice::get();

        $services_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.region_id', $region->id)->select('*','services.id as s_id')->where('featured', 1)->orderBy('from', 'asc')->take(9)->get();

        $last_attraction = Attraction::latest()->first();
        
        $attractions = Attraction::latest()->skip(1)->take(6)->get();

        // Services resutls
        $service = Service::where('from', $from)->where('to', $to)->first();

        if ($request->has('from')){
            $services_options = ServicePrice::where('service_id', $service->id)->whereHas('priceOption', function ($query) use($passengers){
                $query->where('max_passengers', '>=', $passengers);
            })->orderBy('oneway_price', 'ASC')->get(); 
        }
        else{
            $services_options = '';
        }

        return view('country-region', 
            compact('region',
                    'auctions', 
                    'tours', 
                    'services',
                    'countries',
                    'regions', 
                    'whales', 
                    'services_from', 
                    'services_to', 
                    'posts', 
                    'locations',
                    'attractions',
                    'last_attraction',
                    'services_prices',
                    'services_by_country',
                    'request',
                    'services_from_airports',
                    'service',
                    'services_options'
            ));
    }

    public function location(Request $request, $country, $location_id)
    {
        $request->flash();
        $from = $request->from;
        $to = $request->to;
        $passengers = $request->passengers;

        // $country = Country::where('slug', $country)->first();
        // $region = Region::where('slug', $region)->first();
        $location = Location::where('slug', $location_id)->first();

        $auctions = Auction::from()->open()->active()->get();
        $countries = Country::get();
        $regions = Region::get();
        $whales = Whale::get();
        $tours = Tour::take(6)->get();


        $services_from_airports = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.id', $location->id)->where('locations.is_airport', 1)->orderBy('locations.name')->distinct()->get()->unique('from');
        $services_from = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.id', $location->id)->where('locations.is_airport', 0)->orderBy('locations.name')->distinct()->get()->unique('from');
        
        // $services_to_airports = Service::join('locations', 'services.to', '=', 'locations.id')->where('locations.id', $location->id)->where('locations.is_airport', 1)->orderBy('locations.name')->distinct()->get()->unique('from');
        $services_to_airports = Service::where('from', $location->id)->where('is_airport', 1)->join('locations', 'services.to', '=', 'locations.id')->distinct()->orderBy('locations.name', 'asc')->get();
        // $services_to = Service::join('locations', 'services.to', '=', 'locations.id')->where('locations.id', $location->id)->distinct()->get();
        $services_to = Service::where('from', $location->id)->where('is_airport', 0)->join('locations', 'services.to', '=', 'locations.id')->distinct()->orderBy('locations.name', 'asc')->get();
        
        $locations = Location::where('active', 1)->where('is_airport', NULL)->whereHas('attractions')->take(8)->get();
        
        $services_filter_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.id', $location->id)->distinct()->get();
        
        $services = Service::take(8)->get();

        $services_prices = ServicePrice::get();

        $services_by_country = Service::join('locations', 'services.from', '=', 'locations.id')->where('locations.id', $location->id)->select('*','services.id as s_id')->where('featured', 1)->orderBy('from', 'asc')->take(9)->get();

        $last_attraction = Attraction::latest()->first();
        
        $attractions = Attraction::latest()->skip(1)->take(6)->get();

        // Services resutls
        $service = Service::where('from', $from)->where('to', $to)->first();

        if ($request->has('from')){
            $services_options = ServicePrice::where('service_id', $service->id)->whereHas('priceOption', function ($query) use($passengers){
                $query->where('max_passengers', '>=', $passengers);
            })->orderBy('oneway_price', 'ASC')->get(); 
        }
        else{
            $services_options = '';
        }

        return view('country-region-location', 
            compact('location',
                    'auctions', 
                    'tours', 
                    'services',
                    'countries',
                    'regions', 
                    'whales', 
                    'services_from', 
                    'services_to', 
                    'locations',
                    'attractions',
                    'last_attraction',
                    'services_prices',
                    'services_by_country',
                    'request',
                    'services_from_airports',
                    'service',
                    'services_options',
                    'services_to_airports'
            ));
    }

    public function tours(Request $request, $country)
    {
        $request->flash();
        $location = $request->input('location');

        $country = Country::where('slug', $country)->first();
        $last_attraction = Attraction::where('country_id', $country->id)->latest()->first();
        
        if (!empty($location)) {
            $attractions = Attraction::where('location_id', $location)->latest()->get();
        }else {
            $attractions = Attraction::where('country_id', $country->id)->latest()->skip(1)->take(6)->get();
        }

        if (!empty($location)) {
            $tours = Tour::where('location_id', $location)->get();
        }else {
            $tours = Tour::where('country_id', $country->id)->take(12)->get();
        }

        // $attractions = Attraction::where('country_id', $country->id)->latest()->skip(1)->take(6)->get();

        $tours_locations = Tour::join('locations', 'tours.location_id', '=', 'locations.id')->where('locations.country_id', $country->id)->distinct()->get()->unique('location_id');

        return view('tours', compact('country', 'last_attraction', 'attractions','tours', 'tours_locations'));
    }

    public function attraction(Request $request, $country, $attraction)
    {
        $country = Country::where('slug', $country)->first();
        $attraction = Attraction::where('slug', $attraction)->first();
        $attractions = Attraction::where('country_id', $country->id)->where('location_id', $attraction->location_id)->take(10)->get();
        $tours = Tour::where('attraction_id', $attraction->id)->get();


        return view('attraction', compact('country', 'attraction', 'attractions', 'tours'));
    }

    public function tour(Request $request, $country, $tour)
    {
        $country = Country::where('slug', $country)->first();
        $tour = Tour::where('slug', $tour)->first();
        $attraction = Attraction::where('id', $tour->attraction_id)->first();
        $related_tours = Tour::where('type', $tour->type)->take(9)->get();

        return view('tour', compact('country', 'tour', 'attraction', 'related_tours'));
    }
}
