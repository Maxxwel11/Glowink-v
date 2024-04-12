<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminpageController extends Controller
{
    public function index()
    {
        return view('auth.adminpage');
    }
}
