<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Auction;
use App\Service;
use App\Region;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Auction $auctions)
    {
        // $user = User::findOrFail($id);
        $keyword = $request->get('search');
        $perPage = 12;

        // $roles = Role::withCount('users')->get();
        $bidders = User::withRole('bidder')->get();

        if (!empty($keyword)) {
            $auctions = Auction::open()->where('from', 'LIKE', "%$keyword%")->orWhere('to', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $auctions = Auction::from()->open()->active()->latest()->paginate($perPage);
        }

        $services = Service::get();
        $regions = Region::get();
        // $auctions = Auction::private()->sortable()->from()->open()->active()->latest()->paginate($perPage);

        return view('home', compact('auctions', 'bidders', 'services', 'regions'));
    }
}
