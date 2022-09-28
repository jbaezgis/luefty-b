<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ManageLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->flash();
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $locations = Location::where('active', 1)->where('name', 'LIKE', "%$keyword%")->paginate(15);
        }else {
            $locations = Location::where('active', 1)->where('is_airport', 0)->paginate(15);
        }

        return view('manage.locations.index', compact('locations'));
    }

    public function location($slug)
    {
        $location = Location::where('slug', $slug)->first();

        return view('pages.location', compact('location')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mode = 'create';
        return view('manage.locations.create', compact('mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location();

        $location->name = $request->name;
        $location->slug = Str::slug($request->name, '-');
        $location->image_alt = $request->name;
        $location->country_id = $request->country_id;
        $location->region_id = $request->region_id;
        $location->is_airport = $request->is_airport;
        $location->active = $request->active;

        $location->save();

        return redirect('administration/content/locations/'.$location->id.'/edit')->with('flash_message', __('Location added'));
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

        return view('manage.locations.show', compact('location')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $mode = 'update';

        $request->flash();

        $location = Location::findOrFail($id);

        return view('manage.locations.edit', compact('location', 'mode')); 
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
            if ($location->img)
            {
                Storage::delete('/public/images/locations/' . $location->img);
            }
            $location_image = $request->image->storeAs('images/locations', $filename, 'public');
            $location->image = $filename;

            $image = Image::make(public_path('storage/'.$location_image))->fit(1200, 800);
            $image->save();

        }

        if ($location->slug == NULL)
        {
            $location->slug = Str::slug($location->name, '-').'-'.$location->id;
        }
        $location->image_alt = $location->name;
        if ($request->country_id)
        {
            $location->country_id = $request->country_id;
        }
        $location->region_id = $request->region_id;
        $location->is_airport = $request->is_airport;
        $location->active = $request->active;
        $location->short_description = $request->short_description;
        $location->description = $request->description;

        $location->save();

        return back()->with('flash_message', __('Location updated'));
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
