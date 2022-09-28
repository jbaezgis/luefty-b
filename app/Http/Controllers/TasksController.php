<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
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
    public function index()
    {
        $tasks = Task::latest()->paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'module' => 'required',
                'name' => 'required',
            ]
        );

        $task = new Task();
        $task->user_id = $request->user()->id;
        $task->module = $request->module;
        $task->name = $request->name;
        $task->description = $request->description;
        // $task->status = $request->status;
        $task->save();
        // $auction->extras()->attach($request->extras);

        // $task = Task::create($request->all());

        return redirect('tasks')->with('flash_message', 'Task added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
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
        $this->validate(
            $request,
            [
                'module' => 'required',
                'name' => 'required',
            ]
        );

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect('tasks')->with('flash_message', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);

        return redirect('tasks')->with('flash_message', 'Task deleted!');
    }
}
