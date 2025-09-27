<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MarriageCertificate;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationTest;
use App\Notifications\DocumentRequestSubmitted;

class MarriageCertificateController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email',
            'marriage_date'  => 'required|date',
            'marriage_place' => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'spouse_name'    => 'required|string|max:255',
        ]);

        MarriageCertificate::create($validated);

    

        return back()->with('success', 'Marriage Certificate Request Submitted!');
    }
}
