<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Permission;
use Carbon\Carbon;
use App\Profile;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request, User $user)
    {
        $request->flash();
        $name = $request->input('name');
        $email = $request->input('email');
        $company_name = $request->input('company_name');
        $phone = $request->input('phone');
        $perPage = 15;

        if (!empty($name)) {
            $users = User::where('name', 'LIKE', "%$name%")->latest()->paginate($perPage);
        }elseif (!empty($email)) {
            $users = User::where('email', 'LIKE', "%$email%")->latest()->paginate($perPage);
        }elseif (!empty($company_name)) {
            $users = User::where('company_name', 'LIKE', "%$company_name%")->latest()->paginate($perPage);
        }elseif (!empty($phone)) {
            $users = User::where('phone', 'LIKE', "%$phone%")->latest()->paginate($perPage);
        }else {
            $users = User::latest()->paginate($perPage);
        }

        return view('manageusers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        return view('manageusers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users',
                'password' => 'required',
                // 'roles' => 'required'
            ]
        );

        $data = $request->except('password');

        // $user = User::create($data);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->lang = $request->lang;
        $user->company_name = $request->company_name;
        $user->user_type = $request->user_type;
        $user->password = bcrypt($request->password);
        $user->registration_date = \Carbon\Carbon::now();
        $user->next_payment = \Carbon\Carbon::now()->addMonths(1);
        $user->save();
        // foreach ($request->roles as $role) {
        //     $user->assignRole($role);
        // }

        $user->roles()->attach(2);

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);

        return redirect('manage/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('manageusers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit(Request $request, $id)
    {
        $request->flash();
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        $user = User::with('roles')->findOrFail($id);
        // $user_roles = [];
        // foreach ($user->roles as $role) {
        //     $user_roles[] = $role->name;
        // }

        return view('manageusers.edit', compact('user', 'roles', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->flash();
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users,email,' . $id,
                // 'roles' => 'required'
            ]
        );

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        // $user->roles()->detach();
        // foreach ($request->roles as $role) {
        //     $user->assignRole($role);
        // }

        return redirect('manage/users')->with('flash_message', 'User updated!');
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->password = Hash::make('123456');
        $user->save();

        return back()->with('flash_message', 'Password updated for: '.$user->name);
    }

    public function verificate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->email_verified_at = \Carbon\Carbon::now();
        $user->save();

        return back()->with('flash_message', $user->name . ' was verified correctly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->email_verified_at = \Carbon\Carbon::now();

        return redirect('manage/users')->with('flash_message', 'User Activated!');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->email_verified_at = '';
        $user->update();

        return redirect('manage/users')->with('flash_message', 'User Deactivated!');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('manage/users')->with('flash_message', 'User deleted!');
    }
}
