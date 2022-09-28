<?php

namespace App\Http\Controllers;

use App\Auction;
use Illuminate\Http\Request;
use App\Extra;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extras = Extra::paginate(15);

        return view('admin.extras.index', compact('extras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.extras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $auction = Auction::where('id', $request->auction_id)->first();

        // If auction is Open cannot make changes
        if ($auction->status == 'Open')
        {
            return redirect('booking/mybooking/'.$auction->auction_id)->with('cannot_edit', __('It is not possible to make changes to this auction!'));
        }else
        {
            if (Extra::where('auction_id', $auction->id)->where('name', $request->name)->count())
            {
                $extra_id = Extra::where('auction_id', $request->auction_id)->where('name', $request->name)->first();
                $extra = Extra::findOrFail($extra_id->id);
                $extra->quantity = $request->quantity;
                $extra->price = $request->price;
                $extra->total = $request->price * $request->quantity;
                $extra->save();

            }else
            {
                $extra = new Extra();
                $extra->auction_id = $request->auction_id;
                $extra->name = $request->name;
                $extra->quantity = $request->quantity;
                $extra->price = $request->price;
                $extra->total = $request->price * $request->quantity;
                $extra->save();
            }

            return back();
        }
    }

    public function addExtra(Request $request)
    {
        $request->flash();
        $auction = Auction::where('id', $request->auction_id)->first();

        if (Extra::where('auction_id', $auction->id))
        {
            $extra_id = Extra::where('auction_id', $auction->id)->first();
            $extra = Extra::findOrFail($extra_id->id);
            $extra->quantity = $request->quantity;
            $extra->price = $request->price;
            $extra->total = $request->price * $request->quantity;
            $extra->save();

        }else
        {
            $extra = new Extra();
            $extra->auction_id = $request->auction_id;
            $extra->name = $request->name;
            $extra->quantity = $request->quantity;
            $extra->price = $request->price;
            $extra->total = $request->price * $request->quantity;
            $extra->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $extra = Extra::findOrFail($id);

        return view('admin.extras.edit', compact('extra'));
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
                'name' => 'required',
            ]
        );

        $extra = Extra::findOrFail($id);
        $extra->update($request->all());

        return redirect('admin/extras')->with('flash_message', 'Extra updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Extra::destroy($id);

        return back();
    }
}
