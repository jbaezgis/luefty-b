<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\User;

class AdminController extends Controller
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
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }
}
