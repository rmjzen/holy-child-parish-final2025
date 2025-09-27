<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SacramentalService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SacramentalServiceRequested;

class SacramentalServiceController extends Controller
{
   public function store(Request $request)  
    {
        $validated = $request->validate([
            'service_type' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'string|max:255',
            'full_name' => 'string|max:255',
            'contact_number' => 'string|max:20',
        ]);

        $service = SacramentalService::create($validated);

        // notify the user who created
        Auth::user()->notify(new SacramentalServiceRequested($service));


        return redirect()->route('book-service')
            ->with('success', 'Sacramental Service booked successfully!');
    }
}
