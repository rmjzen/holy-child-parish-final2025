<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\SacramentalService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SacramentalServiceRequested;

class SacramentalServiceController extends Controller
{


    public function store(Request $request)
    {
        // ✅ Validate
        $validated = $request->validate([
            'service_type'       => 'required|string|max:255',
            'date'               => 'required|date',
            'time_from'          => 'required',
            'time_to'            => 'required',
            'location'           => 'nullable|string|max:255',
            'full_name'          => 'nullable|string|max:255',
            'contact_number'     => 'nullable|string|max:20',
            'payment_reference'  => 'nullable|string|max:255',
        ]);

        // ✅ Check login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to book a service.');
        }

        $requestedDate = \Carbon\Carbon::parse($validated['date'])->format('Y-m-d');
        $timeFrom = $validated['time_from'];
        $timeTo = $validated['time_to'];

        // ✅ Check time conflict on the same date
        $conflict = \App\Models\SacramentalService::whereDate('date', $requestedDate)
            ->where(function ($query) use ($timeFrom, $timeTo) {
                $query->where(function ($q) use ($timeFrom, $timeTo) {
                    $q->where('time_from', '<', $timeTo)
                        ->where('time_to', '>', $timeFrom);
                });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This time slot is already booked. Please choose a different time.');
        }

        // ✅ Create service and booking
        $validated['user_id'] = Auth::id();
        $service = \App\Models\SacramentalService::create($validated);

        \App\Models\Booking::create([
            'user_id'      => Auth::id(),
            'booking_type' => 'sacramental',
            'reference_id' => $service->id,
            'status'       => 'Pending',
        ]);

        Auth::user()->notify(new \App\Notifications\SacramentalServiceRequested($service));

        return back()->with('success', 'Sacramental service booked successfully!');
    }
}
