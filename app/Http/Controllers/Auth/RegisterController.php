<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
// use Carbon\Carbon;
use \Illuminate\Http\Request;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Location;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'country_id' => 'required',
            'region_id' => 'required',
            'lang' => 'required',
            'contract' => 'required',
            'company_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // $location = Location::where('id', $data['location_id'])->first();
        // dd($location);
        // $roles = Role::pluck('name', 'id');

        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->country = $request->country;
        // $user->lang = $request->lang;
        // $user->company_name = $request->company_name;
        // $user->password = Hash::make($request->password);
        // $user->registration_date = Carbon\Carbon::now();
        // $user->next_payment = Carbon\Carbon::now()->addMonths(1);
        // $user->save();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country_id' => $data['country_id'],
            'region_id' => $data['region_id'],
            'lang' => $data['lang'],
            'company_name' => $data['company_name'],
            'user_type' => 1,
            'password' => Hash::make($data['password']),
            'registration_date' => \Carbon\Carbon::now(),
            'next_payment' => \Carbon\Carbon::now()->addMonths(1),
            'contract' => $data['contract'],
            // 'region_id' => $location->region_id,
        ]);

        // $role = new Role(['role' => 2]);
        // $user->roles()->save($role);
        $user->roles()->attach(2);

        $profile = Profile::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
