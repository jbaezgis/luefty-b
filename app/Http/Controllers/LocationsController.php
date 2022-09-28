<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Location;
use Illuminate\Support\Str;

class LocationsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('roles:admin');
    // }

    public function __construct()
    {
        $this->middleware('admin',['except' => ['getlocations','getregions']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getlocations($id)
    {
        // $from_city = Input::get('from_city');
        $locations = Location::where('country_id', $id)->where('active', 1)->where('is_airport', 0)->orderBy('name')->get();

        return json_encode($locations);

    }

    public function getregions($id)
    {
        // $from_city = Input::get('from_city');
        $regions = Region::where('country_id', $id)->orderBy('name')->get();

        return json_encode($regions);

    }

    public function index($id)
    {
        $region = Region::findOrFail($id);

        $locations = Location::where('region_id', $region->id)->paginate(15);

        return view('locations.locations.index', compact('region', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $region = Region::findOrFail($id);

        return view('locations.locations.create', compact('region'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newLocation(Request $request)
    {
        $this->validate(
            $request,
            [
                // 'country' => 'required',
                'name' => 'required',
            ]
        );

        $region = Region::where('id', $request->region_id)->first();

        $location = new Location();

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            $location_image = $request->image->storeAs('images/locations/'.$location->id, $filename, 'public');
            $location->image = $filename;

            $image__1200x800 = Image::make(public_path('storage/'.$location_image.'_1200x800'))->fit(1200, 800);
            $image__1200x800->save();

            $image__280x300 = Image::make(public_path('storage/'.$location_image.'_280x300'))->fit(280, 300);
            $image__280x300->save();
        }

        $location->country_id = $region->country_id;
        $location->region_id = $request->region_id;
        $location->name = $request->name;
        if ($request->is_airport)
        {
            $location->is_airport = $request->is_airport;
        }else
        {
            $location->is_airport = 0;
        }
        $location->slug = Str::slug($request->name, '-');
        $location->description = $request->description;
        $location->active = 1;

        $location->save();

        // return redirect('locations')->with('flash_message', 'Location added!');
        // return redirect('locations/locations' . $location->id . '/edit')->with('flash_message', 'Location added!');
        return back()->with('flash_message', 'Location added!');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                // 'country' => 'required',
                'name' => 'required',
            ]
        );

        $location = new Location();

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images/locations', $filename, 'public');
            $location->image = $filename;
        }

        $location->country_id = 1;
        $location->region_id = $request->region_id;
        $location->name = $request->name;
        $location->slug = Str::slug($request->name, '-');
        $location->description = $request->description;

        $location->save();

        // return redirect('locations')->with('flash_message', 'Location added!');
        // return redirect('locations/locations' . $location->id . '/edit')->with('flash_message', 'Location added!');
        return back()->with('flash_message', 'Location added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);

        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);

        return view('locations.edit', compact('location'));
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

        $location = Location::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($region->image)
            {
                Storage::delete('/public/images/regions/' . $region->image);
            }
            $request->image->storeAs('images/regions', $filename, 'public');
            $region->image = $filename;
        }

        // $location->update($request->all());

        $region->save();

        return redirect('locations')->with('flash_message', 'Location updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::destroy($id);

        return back()->with('flash_message', 'Location deleted!');
    }
}
