<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() 
    {
        return view('auth.profile');
    }

    public function update() 
    {
        return view('auth.update');
    }
}
