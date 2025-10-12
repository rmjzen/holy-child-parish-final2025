<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BaptismalCertificate;
use Illuminate\Support\Facades\Auth;

class BaptismalCertificateController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validate the request
        $validated = $request->validate([
            'child_name'   => 'required|string|max:255',
            'date'         => 'required|date',
            'birthdate'    => 'required|date',
            'father_name'  => 'required|string|max:255',
            'mother_name'  => 'required|string|max:255',
        ]);

        // ✅ Check login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to request a baptismal certificate.');
        }

        // ✅ Check for date conflicts with other services
        $requestedDate = \Carbon\Carbon::parse($validated['date'])->format('Y-m-d');

        $conflict =
            \App\Models\SacramentalService::whereDate('date', $requestedDate)->exists() ||
            \App\Models\MarriageCertificate::whereDate('date', $requestedDate)->exists() ||
            \App\Models\BaptismalCertificate::whereDate('date', $requestedDate)->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'That date is already booked. Please select another date.');
        }

        // ✅ Save the record and booking
        DB::transaction(function () use ($validated) {
            $validated['user_id'] = Auth::id();

            $baptismal = \App\Models\BaptismalCertificate::create($validated);

            \App\Models\Booking::create([
                'user_id'      => Auth::id(),
                'booking_type' => 'baptismal_certificate',
                'reference_id' => $baptismal->id,
                'status'       => 'Pending',
            ]);
        });

        return back()->with('success', 'Baptismal Certificate Request & Booking Created!');
    }
}
