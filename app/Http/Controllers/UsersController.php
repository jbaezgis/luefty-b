<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auction;
use App\Bid;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // $user = User::findOrFail($id);
        $keyword = $request->get('search');
        $perPage = 15;
        
        $auctions = Auction::from()->open()->active()->get(); 

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")->orWhere('company_name', 'LIKE', "%$keyword%")
                ->where('public', 1)->latest()->paginate($perPage);
        } else {
            $users = User::where('public', 1)->latest()->paginate($perPage);
        }

        return view('users.index', compact('users', 'auctions'));
    }

    public function show(User $user)
    {
        // $user = User::findOrFail($id);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;
        $buttontext = auth()->user()->following->contains($user->profile->id) ? __('Remove from my favotives') : 'Add to my favorites';
        $buttonclass = auth()->user()->following->contains($user->profile->id) ? 'btn-danger' : 'btn-primary';
        // dd($follows);
        
        // $auctions = Auction::all();
        $auctions = Auction::where('user_id', $user->id)->from()->open()->active()->get();   
        $bids = Bid::where('canceled', 0)->get();

        return view('users.show', compact('user', 'auctions','bids', 'follows', 'buttontext', 'buttonclass'));
    }

    public function store(User $user)
    {
        // return $user->name; 
        auth()->user()->following()->toggle($user->profile);

        return back();
    }
}
