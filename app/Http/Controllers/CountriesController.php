<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CountriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('roles:admin');
    // }

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::where('active', 1)->orderBy('id', 'ASC')->paginate(15);

        return view('locations.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->flash();

        return view('locations.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country();

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            $country_image = $request->image->storeAs('images/countries/'.$country->id, $filename, 'public');
            $country->image = $filename;

            // $image__1200x800 = Image::make(public_path('storage/'.$country_image.'_1200x800'))->fit(1200, 800);
            // $image__1200x800->save();

            // $image__280x300 = Image::make(public_path('storage/'.$country_image.'_280x300'))->fit(280, 300);
            // $image__280x300->save();
        }

        $country->code = $request->code;
        $country->en_name = $request->en_name;
        $country->es_name = $request->en_name;
        $country->slug = Str::slug($request->en_name, '-');
        $country->description = $request->description;
        $country->active = 1;
        $country->save();

        return redirect('locations/countries/' . $country->id . '/edit')->with('flash_message', 'Country added!');
    }

    public function regions($id)
    {
        $country = Country::findOrFail($id);

        $regions = Region::where('country_id', $country->id)->paginate(15);

        return view('locations.regions.index', compact('country', 'regions'));
    }

    public function locations($id)
    {
        $region = Region::findOrFail($id);

        $locations = Location::where('region_id', $region->id)->where('active', 1)->orderBy('order', 'ASC')->paginate(15);

        return view('locations.locations.index', compact('region', 'locations'));
    }

    public function regionStore(Request $request)
    {
        // $request->flash();
        // $service = Service::find($service_id);
        // $last_location = Location::where('active', 1)->latest()->first();

        $region = new Region();
        $region->country_id = $request->country_id;
        $region->name = $request->name;
        // $region->active = 1;

        $region->save();

        return back();
    }

    public function locationStore(Request $request)
    {
        // $request->flash();
        // $service = Service::find($service_id);
        $last_location = Location::where('active', 1)->latest()->first();

        $location = new Location();
        $location->region_id = $request->region_id;
        $location->name = $request->name;
        $location->order = $request->order;
        $location->is_airport = $request->is_airport;
        $location->order = $last_location->order + 1;
        $location->active = 1;

        $location->save();

        return back();
    }

    public function regionDelete($id)
    {
        Region::destroy($id);

        return back()->with('flash_message', 'Region deleted!');
    }

    public function locationDelete($id)
    {
        Location::destroy($id);

        return back()->with('flash_message', 'Location deleted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);

        return view('locations.countries.show', compact('country'));
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

        $country = Country::findOrFail($id);

        return view('locations.countries.edit', compact('country'));
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
        $country = Country::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($country->image)
            {
                Storage::delete('/public/images/countries/'.$country->image);
            }

            $country_image = $request->image->storeAs('images/countries/'.$country->id, $filename, 'public');
            $country_image_thumb = $request->image->storeAs('images/countries/'.$country->id.'/thumb', $filename, 'public');
            $country->image = $filename;

            $image__1200x800 = Image::make(public_path('storage/'.$country_image))->fit(1200, 800);
            $image__1200x800->save();

            $image__280x300 = Image::make(public_path('storage/'.$country_image_thumb))->fit(280, 300);
            $image__280x300->save();
        }

        $country->code = $request->code;
        $country->en_name = $request->en_name;
        // $country->es_name = $request->en_name;
        $country->slug = Str::slug($request->en_name, '-');
        $country->description = $request->description;
        $country->save();

        return redirect('locations/countries')->with('flash_message', 'Country updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
