<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\SacramentalService;
use App\Models\MarriageCertificate;
use App\Http\Controllers\Controller;
use App\Models\BaptismalCertificate;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Get all services
        $sacramentalServices = \App\Models\SacramentalService::all();

        // ✅ Check and update status if payment_reference is not null
        foreach ($sacramentalServices as $service) {
            if (!empty($service->payment_reference) && $service->status === 'Pending') {
                $service->status = 'Payment Verification';
                $service->save();
            } elseif (empty($service->payment_reference) && $service->status === 'Payment Verification') {
                $service->status = 'Pending';
                $service->save();
            }
        }

        $marriageCertificates = \App\Models\MarriageCertificate::all();
        $baptismalCertificates = \App\Models\BaptismalCertificate::all();

        return view('my-bookings.index', compact('sacramentalServices', 'marriageCertificates', 'baptismalCertificates'));
    }


    public function edit($id)
    {
        $service = \App\Models\SacramentalService::findOrFail($id);
        return view('my-bookings.edit', compact('service'));
    }


    public function update(Request $request, $id)
    {
        $service = SacramentalService::findOrFail($id);

        if ($service->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'time_from' => 'nullable',
            'time_to' => 'nullable',
            'payment_reference' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);



        $service->update($validated);

        return redirect()->route('my_bookings')->with('success', 'Booking updated successfully.');
    }
}
