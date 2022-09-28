<?php

namespace App\Http\Controllers;

use App\Tour;
use App\Bid;
use Auth;
use Mail;
use App\Http\Requests\CreateToursRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// use Image;
use Intervention\Image\Facades\Image;
use App\Location;
use App\Attraction;
use App\TourImages;

class ToursController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth', ['except' => [ 'show', 'tours']]);
    // }

    public function __construct()
    {
        $this->middleware('admin',['except' => ['show', 'tour']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $location = $request->input('location');
        $perPage = 15;

        $tours = Tour::paginate($perPage);

        return view('manage.tours.index', compact('tours'));
    }

    public function tours(Request $request, Tour $tours)
    {
        $request->flash();
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $location = $request->input('location');
        // $to = $request->input('to');
        
        $perPage = 15;

        if (!empty($location)) {
            $tours = Tour::sortable()->where('location', 'LIKE', "%$location%")
                ->open()->latest()->paginate($perPage);
        }else {
            $tours = Tour::open()->sortable()->latest()->paginate($perPage);
        }
        
        return view('tours.tours', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.tours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attraction = Attraction::where('id', $request->attraction_id)->first();
        $location = Location::where('id', $attraction->location_id)->first();

        $tour = new Tour();

        // if ($request->has('image'))
        // {
        //     $filename = $request->image->getClientOriginalName();

        //     $tour_image = $request->image->storeAs('images/tours', $filename, 'public');
        //     $tour_image_thumb = $request->image->storeAs('images/tours/thumbs', $filename, 'public');
        //     $tour->image = $filename;
        //     $image = Image::make(public_path('storage/'.$tour_image))->fit(1200, 800);
        //     $image->save();

        //     $image_thumb = Image::make(public_path('storage/'.$tour_image_thumb))->fit(345, 450);
        //     $image_thumb->save();
        // }

        $tour->country_id = $location->country_id;
        $tour->location_id = $location->id;
        $tour->attraction_id = $request->attraction_id;
        // $tour->image_alt = $request->image_alt;
        // $tour->url = $request->url;
        $tour->title = $request->title;
        $tour->slug = Str::slug($request->title, '-');
        // $tour->slug = $request->slug;
        $tour->short_description = 'Edit this text';
        $tour->description = 'Edit this text';
        $tour->status = 'Published';

        $tour->save();

        return redirect('administration/content/tours/'.$tour->id.'/edit')->with('flash_message', __('Tour added'));
    }

    public function storeBid(Request $request, $tour_id)
    {
        // dd();

        $tour = Tour::find($tour_id);

        $bid = new Bid();
        $bid->bid = $request->bid;
        $bid->user_id = $request->user()->id;
        $bid->tour()->associate($tour);
        $bid->save();

        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        $tour_id = Tour::value('id');
        $bids = Bid::sortable()->where('tour_id', $tour)->get();

        return view('manage.tours.show', compact('tour', 'bids')); 
    }

    public function tour($slug)
    {
        $tour = Tour::where('slug', $slug)->first();

        return view('pages.tour', compact('tour')); 
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

        $tour = Tour::findOrFail($id);

        return view('manage.tours.edit', compact('tour')); 
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
        $tour = Tour::findOrFail($id);
        $attraction = Attraction::where('id', $request->attraction_id)->first();
        $location = Location::where('id', $attraction->location_id)->first();

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($tour->image)
            {
                Storage::delete('/public/images/tours/' . $tour->image);
            }
            $tour_image = $request->image->storeAs('images/tours', $filename, 'public');
            $tour_image_thumb = $request->image->storeAs('images/tours/thumbs', $filename, 'public');
            $tour->image = $filename;

            $image = Image::make(public_path('storage/'.$tour_image))->fit(1200, 800);
            $image->save();

            $image_thumb = Image::make(public_path('storage/'.$tour_image_thumb))->fit(345, 450);
            $image_thumb->save();
        }

        if ($request->has('tour_multiple_images'))
        {
            foreach ($request->file('tour_multiple_images') as $file) {
                $tourImage = new TourImages;
                $tourImage->tour_id = $tour->id;
    
                $name = $file->getClientOriginalName();
                $tour_tourImage = $file->storeAs('images/tours/'.$tour->id, $name, 'public');
                $tour_tourImage_thumb = $file->storeAs('images/tours/'.$tour->id.'/thumbs', $name, 'public');

                $t_image = Image::make(public_path('storage/'.$tour_tourImage))->fit(1200, 800);
                $t_image->save();

                $t_image_thumb = Image::make(public_path('storage/'.$tour_tourImage_thumb))->fit(345, 450);
                $t_image_thumb->save();
                
                $tourImage->file_name = $name;
                $tourImage->type = $file->extension();
                $tourImage->size = $file->getSize();
    
                $tourImage->save();
            }
        }

        $tour->country_id = $location->country_id;
        $tour->location_id = $location->id;
        $tour->attraction_id = $request->attraction_id;

        $tour->image_alt = $request->image_alt;
        $tour->url = $request->url;
        $tour->title = $request->title;
        $tour->slug = $request->slug;
        $tour->status = $request->status;

        $tour->duration = $request->duration;
        $tour->type = $request->type;
        $tour->departure_location = $request->departure_location;
        $tour->departure_time = $request->departure_time;
        $tour->adults_price = $request->adults_price;
        $tour->children_price = $request->children_price;
        $tour->latitude = $request->latitude;
        $tour->longitude = $request->longitude;

        $tour->description = $request->description;

        $tour->save();

        // return redirect('administration/content/tours')->with('flash_message', __('Tour updated'));
        return back()->with('flash_message', __('Tour updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tour::findOrFail($id)->delete();

        return back()->with('flash_message', 'Tour deleted!');
    }
}
