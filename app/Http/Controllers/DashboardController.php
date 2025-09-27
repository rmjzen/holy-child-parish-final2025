<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $isAdmin = Auth::user()->is_admin; // true/false
        return view('dashboard', compact('isAdmin'));
    }
}
