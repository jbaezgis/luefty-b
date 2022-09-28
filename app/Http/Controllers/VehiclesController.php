<?php

namespace App\Http\Controllers;

use App\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::where('user_id', auth()->user()->id)->get();

        return view('auth.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->user_id = auth()->user()->id;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->type = $request->type;
        $vehicle->year = $request->year;
        $vehicle->seats = $request->seats;
        $vehicle->condition = $request->condition;
        $vehicle->gps_installed = $request->gps_installed;

        $vehicle->save();

        return redirect('/user/vehicles')->with('success', __('Vehicle added'));
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
        $vehicle = Vehicle::findOrFail($id);

        return view('auth.vehicles.edit', compact('vehicle'));
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
        $request->flash();
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->user_id = auth()->user()->id;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->type = $request->type;
        $vehicle->year = $request->year;
        $vehicle->seats = $request->seats;
        $vehicle->condition = $request->condition;
        $vehicle->gps_installed = $request->gps_installed;

        $vehicle->save();

        return redirect('/user/vehicles')->with('success', __('Vehicle updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id)->delete();

        return redirect('/user/vehicles')->with('deleted', __('Vehicle deleted'));
    }
}
