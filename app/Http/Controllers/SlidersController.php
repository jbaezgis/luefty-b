<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin',['except' => ['show']]);
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
        $perPage = 15;

        if (!empty($keyword)) {
            $sliders = Slider::where('title', 'LIKE', "%$keyword%")->latest()->paginate($perPage);

        }else {
            $sliders = Slider::latest()->paginate($perPage);
        }

        return view('manage.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();

        if ($request->has('image'))
        {
            $filename = $request->image->getClientOriginalName();

            $slider_image = $request->image->storeAs('images/sliders', $filename, 'public');
            $slider_image_mobile = $request->image->storeAs('images/sliders/mobile', $filename, 'public');
            $slider->image = $filename;
            // dd($slider_image);
            $image = Image::make(public_path('storage/'.$slider_image))->fit(1280, 500);
            $image->save();

            $image_mobile = Image::make(public_path('storage/'.$slider_image_mobile))->fit(480, 480);
            $image_mobile->save();
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->status = $request->status;
        $slider->order = $request->order;

        $slider->save();

        return redirect('administration/content/sliders/'.$slider->id.'/edit')->with('flash_message', __('Slider added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::findOrFail($id);

        return view('manage.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('manage.sliders.edit', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        if ($request->has('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($slider->image)
            {
                Storage::delete('/public/images/sliders/' . $slider->image);
            }

            $slider_image = $request->image->storeAs('images/sliders', $filename, 'public');
            $slider_image_mobile = $request->image->storeAs('images/sliders/mobile', $filename, 'public');
            $slider->image = $filename;
            // dd($slider_image);
            $image = Image::make(public_path('storage/'.$slider_image))->fit(1280, 500);
            $image->save();

            $image_mobile = Image::make(public_path('storage/'.$slider_image_mobile))->fit(480, 480);
            $image_mobile->save();
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->status = $request->status;
        $slider->order = $request->order;

        $slider->save();

        return back()->with('flash_message', __('Slider updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slider::findOrFail($id)->delete();

        return back()->with('flash_message', 'Slider deleted!');
    }
}
