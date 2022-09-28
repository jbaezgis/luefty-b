<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attraction;
use Auth;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AttractionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => ['show', 'attraction']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->flash();
        $keyword = $request->get('search');
        $location = $request->input('location_id');
        $perPage = 15;

        if (!empty($keyword)) {
            $attractions = Attraction::where('title', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        }elseif (!empty($location)) {
            $attractions = Attraction::where('location_id', $location)->latest()->paginate($perPage);
        }else {
            $attractions = Attraction::latest()->paginate($perPage);
        }
        

        return view('manage.attractions.index', compact('attractions'));
    }

    public function attraction($slug)
    {
        $attraction = Attraction::where('slug', $slug)->first();

        $attractions = Attraction::where('location_id', $attraction->location_id)->take(10)->get();

        return view('pages.attraction', compact('attraction', 'attractions')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.attractions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attraction = new Attraction();

        if ($request->has('image'))
        {
            $filename = $request->image->getClientOriginalName();

            $attraction_image = $request->image->storeAs('images/attractions', $filename, 'public');
            $attraction_image_thumb = $request->image->storeAs('images/attractions/thumbs', $filename, 'public');
            $attraction->image = $filename;
            // dd($post_image);
            $image = Image::make(public_path('storage/'.$attraction_image))->fit(1200, 800);
            $image->save();

            $image_thumb = Image::make(public_path('storage/'.$attraction_image_thumb))->fit(1200, 800);
            $image_thumb->save();
        }

        $attraction->user_id = auth()->user()->id;
        $attraction->location_id = $request->location_id;
        $attraction->image_alt = $request->image_alt;
        $attraction->title = $request->title;
        $attraction->slug = $request->slug;
        // $attraction->slug = Str::slug($request->name, '-');
        $attraction->short_description = $request->short_description;
        $attraction->description = $request->description;
        $attraction->published = $request->published;

        $attraction->save();

        return redirect('administration/content/attractions/'.$attraction->id.'/edit')->with('flash_message', __('Attraction added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attraction = Attraction::findOrFail($id);

        return view('manage.attractions.show', compact('attraction')); 
    }

    // public function attraction($slug)
    // {
    //     $attraction = Attraction::where('slug', $slug)->first();

    //     return view('pages.attraction', compact('attraction')); 
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->flash();

        $attraction = Attraction::findOrFail($id);

        return view('manage.attractions.edit', compact('attraction')); 
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
        $attraction = Attraction::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($attraction->image)
            {
                Storage::delete('/public/images/attractions/' . $attraction->image);
            }
            $attraction_image = $request->image->storeAs('images/attractions', $filename, 'public');
            $attraction_image_thumb = $request->image->storeAs('images/attractions/thumbs', $filename, 'public');
            $attraction->image = $filename;

            $image = Image::make(public_path('storage/'.$attraction_image))->fit(1200, 800);
            $image->save();

            $image_thumb = Image::make(public_path('storage/'.$attraction_image_thumb))->fit(345, 450);
            $image_thumb->save();
        }

        $attraction->location_id = $request->location_id;
        $attraction->title = $request->title;
        // $attraction->slug = Str::slug($request->name, '-');
        $attraction->short_description = $request->short_description;
        $attraction->description = $request->description;
        $attraction->published = $request->published;

        $attraction->save();

        return redirect('administration/content/attractions/'.$attraction->id.'/edit')->with('flash_message', __('Attraction updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attraction::findOrFail($id)->delete();

        return back()->with('flash_message', 'Attraction deleted!');
    }
}
