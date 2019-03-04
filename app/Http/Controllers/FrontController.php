<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('front.index');
    }
    
    public function shirts()
    {
        return view('front.items.shirts');
    }

    public function shirt()
    {
        return view('front.items.shirt');
    }
}
