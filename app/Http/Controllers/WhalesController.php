<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;
use App\Order;
use App\Whale;

class WhalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('whales.index');
    }

    public function optionOne()
    {
        $hotel=true;
        return view('whales.option_one',compact('hotel'));
    }

    public function optionTwo()
    {
        $hotel=true;
        return view('whales.option_two',compact('hotel'));
    }

    public function optionThree()
    {
        $hotel=true;
        return view('whales.option_three',compact('hotel'));
    }

    public function optionFour()
    {
        $location=true;
        return view('whales.option_four',compact('location'));
    }

    public function optionGroupOne()
    {
        $person=true;
        return view('whales.option_group_one',compact('person'));
    }

    public function optionGroupTwo()
    {
        $person=true;
        return view('whales.option_group_two',compact('person'));
    }

    public function thanks()
    {
        return view('whales.thanks');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function admin()
    {
        $whales = Whale::get();

        return view('manage.whales.index');
    }

    public function create()
    {
        //
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
            'name'=>'required',
            'email'=> 'required',
            'phone' => 'required',
            'persons' => 'required',
            'date' => 'required',
            'hotel'=> 'required',
            'room_hotel'=> 'required',
        ]);

        $order = Order::create($request->all());
        $order->tour_id = 1;
        $order->total = 0.00;
        $order->save();
          
        return view('whales.thanks');
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
        //
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
        //
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
