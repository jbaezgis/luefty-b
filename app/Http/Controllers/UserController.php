<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Auction;
use App\Vehicle;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('auth.profile', array('user' => Auth::user()));
    }

    public function verified()
    {
        return view('auth.verified');
    }

    public function showChangePasswordForm(){
        return view('auth.password.changepassword');
    }

    public function edit(Request $request)
    {
        $request->flash();

        // $user = Auth::findOrFail($id);

        return view('auth.update');
    }

    public function update(Request $request)
    {
        // dd($request->public);
        $user = Auth::user();



        if ($user->email_verified_at)
        {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    // 'email' => 'required|email',
                    // 'email' => 'required|string|max:255|email|unique:users,email,' . $user->id,
                    // 'roles' => 'required'
                    ]
                );
        }else
        {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'email' => 'required|string|max:255|email|unique:users,email,' . $user->id,
                    // 'roles' => 'required'
                    ]
                );
        }


        $user->public = $request->public;
        $user->name = $request->name;
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        // $user->email = $request->email;
        $user->region_id = $request->region_id;
        $user->address = $request->address;
        $user->address_ispublic = $request->address_ispublic;
        $user->lang = $request->lang;
        $user->phone = $request->phone;
        $user->company_name = $request->company_name;
        $user->user_type = $request->user_type;
        // $user->cedula = $request->cedula;
        // $user->cedula_ispublic = $request->cedula_ispublic;
        // $user->rnc = $request->rnc;
        // $user->rnc_ispublic = $request->rnc_ispublic;
        $user->web_site = $request->web_site;
        $user->save();

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        // $user->roles()->detach();
        // foreach ($request->roles as $role) {
        //     $user->assignRole($role);
        // }


        // $user->update($request->all());
        // $this->authorize($user);

        return back()->with('info', __('User updated'));
    }

    public function editPassword(Request $request)
    {
        $request->flash();

        // $user = Auth::findOrFail($id);

        return view('auth.change_password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->validate(
            $request,
            [
                'password' => 'required',
                ]
            );

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('info', __('Password updated'));
    }

    public function favorites()
    {
        $user = auth()->user();

        $auctions = Auction::from()->open()->active()->get();

        $users = User::all();

        return view('auth.favorites', compact('user', 'users', 'auctions'));
    }

    public function vehicles()
    {
        $vehicles = Vehicle::where('user_id', auth()->user()->id)->get();

        return view('auth.vehicles.index', compact('vehicles'));
    }
}
