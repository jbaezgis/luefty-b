<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FallowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        // $user = User::findOrFail($id);
        // dd($user);
        return auth()->user()->following()->toggle($user->profile);
    }
}
