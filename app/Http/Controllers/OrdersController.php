<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use Mail;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'email'=> 'required|email',
            'phone' => 'required',
            // 'persons' => 'required',
            // 'kids' => 'required',
            'adult' => 'required',
            'date' => 'required',
            'hotel'=> 'required',
            'room_number'=> 'required',
        ]);

        $order = Order::create($request->all());
        $order->whale_id = $request->get('whale_id');
        $order->total = 0.00;
        $order->save();

        // Mail::to($order->email)
        // ->subject('Tour Ballenas')
        // ->view('whales.client_mail');

        Mail::send('whales.mail', ['msg' => $order], function($m) use ($order){
            $m->from('info@luefty.com', 'Luefty.com');
            $m->to($order->email, $order->name)->subject('Tour Whales of Samaná');
        });

        Mail::send('whales.admin_mail', ['msg' => $order], function($m) use ($order){
            $m->from('info@luefty.com', 'Luefty.com');
            $m->to('info@luefty.com', 'Luefty.com')->subject('New order for Tour Whales of Samaná');
        });
        
        return redirect('whales/thanks');
    }

    public function exclusiveoption(Request $request)
    {
        
        $this->validate($request, [
            'name'=>'required',
            'email'=> 'required|email',
            'phone' => 'required',
            'persons' => 'required',
            'date' => 'required',
            'hotel_location'=> 'required',
            'room_number'=> 'required',
        ]);

        $order = Order::create($request->all());
        $order->whale_id = $request->get('whale_id');
        $order->total = 0.00;
        $order->save();

        // Mail::to($order->email)
        // ->subject('Tour Ballenas')
        // ->view('whales.client_mail');

        Mail::send('whales.mail', ['msg' => $order], function($m) use ($order){
            $m->from('info@luefty.com', 'Luefty.com');
            $m->to($order->email, $order->name)->subject('Tour Whales of Samaná');
        });

        Mail::send('whales.admin_mail', ['msg' => $order], function($m) use ($order){
            $m->from('info@luefty.com', 'Luefty.com');
            $m->to('info@luefty.com', 'Luefty.com')->subject('New order for Tour Whales of Samaná');
        });
        
        return redirect('whales/thanks');
    }
    public function exclusive(Request $request)
    {
        
        $this->validate($request, [
            'name'=>'required',
            'email'=> 'required|email',
            'phone' => 'required',
            'persons' => 'required',
            'date' => 'required',
            'hotel'=> 'required',
            'location'=>'required',
            'room_number'=> 'required',
        ]);

        $order = Order::create($request->all());
        $order->whale_id = $request->get('whale_id');
        $order->total = 0.00;
        $order->save();

        // Mail::to($order->email)
        // ->subject('Tour Ballenas')
        // ->view('whales.client_mail');

        Mail::send('whales.mail', ['msg' => $order], function($m) use ($order){
            $m->from('info@luefty.com', 'Luefty.com');
            $m->to($order->email, $order->name)->subject('Tour Whales of Samaná');
        });

        Mail::send('whales.admin_mail', ['msg' => $order], function($m) use ($order){
            $m->from('info@luefty.com', 'Luefty.com');
            $m->to('info@luefty.com', 'Luefty.com')->subject('New order for Tour Whales of Samaná');
        });
        
        return redirect('whales/thanks');
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
        $order = Order::findOrFail($id);
        
        $order->paid = 1;
        $order->save();

        return back();
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
