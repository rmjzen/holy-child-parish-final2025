<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\SacramentalService;
use Illuminate\Support\Facades\DB;
use App\Models\MarriageCertificate;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationTest;
use App\Notifications\DocumentRequestSubmitted;

class MarriageCertificateController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Check login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to request a marriage certificate.');
        }

        // ✅ Validate request
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email',
            'date'           => 'required|date',
            'marriage_date'  => 'required|date',
            'marriage_place' => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'spouse_name'    => 'required|string|max:255',
        ]);

        // ✅ Check for date conflicts
        $bookingDate = \Carbon\Carbon::parse($validated['date'])->format('Y-m-d');

        $conflict =
            \App\Models\SacramentalService::whereDate('date', $bookingDate)->exists() ||
            \App\Models\MarriageCertificate::whereDate('date', $bookingDate)->exists() ||
            \App\Models\BaptismalCertificate::whereDate('date', $bookingDate)->exists();

        if ($conflict) {
            return back()
                ->withInput()
                ->with('error', 'This date is already booked. Please select another date.');
        }

        // ✅ Create records
        DB::transaction(function () use ($validated) {
            $validated['user_id'] = Auth::id();

            $marriage = \App\Models\MarriageCertificate::create($validated);

            \App\Models\Booking::create([
                'user_id'      => Auth::id(),
                'booking_type' => 'marriage_certificate',
                'reference_id' => $marriage->id,
                'status'       => 'Pending',
            ]);
        });

        return back()->with('success', 'Marriage Certificate Request Submitted Successfully!');
    }
}
