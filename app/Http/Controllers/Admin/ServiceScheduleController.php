<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SacramentalService;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    public function index(){
        $sacramentalServices = SacramentalService::all();
        return view('admin.service_schedule.index', compact('sacramentalServices'));
    }
}
