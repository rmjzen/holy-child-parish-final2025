<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagePaymentController extends Controller
{
    public function index(){
        return view('admin.payment.index');
    }
}
