<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Whale;

class AdminWhalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => ['show', 'whale']]);
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

        $whales = Whale::paginate($perPage);

        return view('manage.whales.index', compact('whales'));
    }

    public function whales(Request $request, Whale $whales)
    {
        $keyword = $request->get('search');
        // $date = $request->input('end_date');
        $location = $request->input('location');
        // $to = $request->input('to');
        
        $perPage = 15;

        if (!empty($location)) {
            $whales = Whale::sortable()->where('location', 'LIKE', "%$location%")
                ->open()->latest()->paginate($perPage);
        }else {
            $whales = Whale::open()->sortable()->latest()->paginate($perPage);
        }
        
        return view('whales.whales', compact('whales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.whales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // auth()->user()->whales()->create($request->all());

        $whale = new Whale();

        if ($request->has('image'))
        {
            $filename = $request->image->getClientOriginalName();

            $whale_image = $request->image->storeAs('images/whales', $filename, 'public');
            $whale->image = $filename;
            // dd($whale_image);
            $image = Image::make(public_path('storage/'.$whale_image))->fit(1200, 800);
            $image->save();
        }

        $whale->title = $request->title;
        $whale->name = $request->name;
        $whale->slug = $request->slug;
        $whale->description = $request->description;

        $whale->save();

        return redirect('administration/whales')->with('flash_message', __('Whale added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $whale = Whale::findOrFail($id);
        $whale_id = Whale::value('id');

        return view('manage.whales.show', compact('whale')); 
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

        $whale = Whale::findOrFail($id);

        return view('manage.whales.edit', compact('whale')); 
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
        $whale = Whale::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($whale->image)
            {
                Storage::delete('/public/images/whales/' . $whale->image);
            }
            $whale_image = $request->image->storeAs('images/whales', $filename, 'public');
            $whale->image = $filename;

            $image = Image::make(public_path('storage/'.$whale_image))->fit(1200, 800);
            $image->save();
        }

        $whale->title = $request->title;
        $whale->name = $request->name;
        $whale->slug = $request->slug;
        $whale->description = $request->description;

        $whale->save();

        return redirect('administration/whales')->with('flash_message', __('Whale updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Whale::findOrFail($id)->delete();

        return back()->with('flash_message', 'Whale deleted!');
    }
}
