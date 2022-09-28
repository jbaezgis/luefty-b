<?php

namespace App\Http\Controllers;

use App\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        // $this->middleware('roles:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Instruction $instructions)
    {
        // $user = User::findOrFail($id);
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $instructions = Instruction::where('title_en', 'LIKE', "%$keyword%")->orWhere('title_es', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $instructions = Instruction::latest()->paginate($perPage);
        }


        return view('admin.instructions.index', compact('instructions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'title_en' => 'required',
        ]);
        
        $requestData = $request->all();
        
        Instruction::create($requestData);

        return redirect('administration/instructions')->with('flash_message', 'Instruction added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function show(Instruction $instruction)
    {
        $instruction = Instruction::findOrFail($id);

        return view('admin.instructions.show', compact('instruction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function edit(Instruction $instruction)
    {
        $Instruction = Instruction::findOrFail($id);

        return view('admin.instructions.edit', compact('Instruction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instruction $instruction)
    {
        $this->validate($request, [
			'title_en' => 'required',
		]);
        $requestData = $request->all();
        
        $instruction = Instruction::findOrFail($id);
        $instruction->update($requestData);

        return redirect('administration/instructions')->with('flash_message', 'Instruction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruction $instruction)
    {
        Instruction::destroy($id);

        return redirect('admin/instructions')->with('flash_message', 'Instruction deleted!');
    }
}
