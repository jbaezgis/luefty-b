<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Page;
use App\Location;

class PlacesContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $places = Page::where('title', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $places = Page::paginate($perPage);
        }

        return view('content.places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project();

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images/places', $filename, 'public');
            $project->image = $filename;
        }

        $project->title = $request->title;
        $project->company = $request->company;
        $project->date = $request->date;
        $project->location = $request->location;
        $project->content = $request->content;
        $project->save();

        return redirect('content/places')->with('flash_message', ' Agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('content.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
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
        $project = Project::findOrFail($id);

        if ($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
            if ($project->image)
            {
                Storage::delete('/public/images/projects/' . $project->image);
            }
            $request->image->storeAs('images/projects', $filename, 'public');
            $project->image = $filename;
        }

        $project->title = $request->title;
        $project->company = $request->company;
        $project->date = $request->date;
        $project->location = $request->location;
        $project->content = $request->content;

        $project->save();

        return redirect('admin/projects')->with('flash_message', 'Actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return redirect('admin/projects')->with('flash_message', 'Eliminado correctamente!');
    }
}
