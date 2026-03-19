<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // just renders the dashboard view, nothing fancy
    public function index()
    {
        return view('dashboard');
    }
}
