<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // protected function authenticated(Request $request, $user)
    // {
    //     if (\Auth::user()->user_type == 1) {
    //         return redirect('/myauctions/privatetransfers/index');
    //     } else {
    //         return redirect('suppliers/index');
    //     }
    // }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('preventbackbutton')->except('logout');
        // $this->middleware('revalidate'); $this->middleware('auth'); 
    }

    // protected function redirectTo(){
    //     return url()->previous();
    // }
}
