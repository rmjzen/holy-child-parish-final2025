<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    public function index(){
        return view('admin.service_schedule.index');
    }
}
