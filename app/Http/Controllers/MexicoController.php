<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Country;

class MexicoController extends Controller
{
    public function index()
    {
        $services = Service::get();

        $countries = Country::get();

        return view('mexico.puertovallarta.index', compact('services', 'countries'));
    }
}
