<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Faq;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Faq $faqs)
    {
        // $user = User::findOrFail($id);
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $faqs = Faq::where('title', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $faqs = Faq::latest()->paginate($perPage);
        }


        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
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
			'en_title' => 'required',
        ]);
        
        $requestData = $request->all();
        
        Faq::create($requestData);

        return redirect('admin/faqs')->with('flash_message', 'FAQ added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.edit', compact('faq'));
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
        $this->validate($request, [
			'en_title' => 'required',
		]);
        $requestData = $request->all();
        
        $faq = Faq::findOrFail($id);
        $faq->update($requestData);

        return redirect('admin/faqs')->with('flash_message', 'FAQ updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
