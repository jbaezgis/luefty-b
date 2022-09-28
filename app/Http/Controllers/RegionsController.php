<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Region;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class RegionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('roles:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $country = Country::findOrFail($id);

        $regions = Region::where('country_id', $country->id)->where('active', 1)->paginate(15);

        return view('locations.regions.index', compact('country', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $country = Country::findOrFail($id);

        return view('locations.regions.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $region = new Region();

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images/regions', $filename, 'public');
            $region->image = $filename;
        }

        $region->country_id = $request->country_id;
        $region->name = $request->name;
        $region->slug = Str::slug($request->name, '-');
        $region->description = $request->description;
        $region->active = 1;

        $region->save();

        // return back();
        return redirect('locations/regions/' . $region->id . '/edit')->with('flash_message', 'Region added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::findOrFail($id);

        return view('locations.regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::findOrFail($id);

        return view('locations.regions.edit', compact('region'));
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
        $region = Region::findOrFail($id);

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

        // $region->country_id = $request->country_id;
        $region->name = $request->name;
        $region->slug = Str::slug($request->name, '-');
        $region->description = $request->description;

        $region->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Region::destroy($id);

        return back()->with('flash_message', 'Region deleted!');
    }
}
