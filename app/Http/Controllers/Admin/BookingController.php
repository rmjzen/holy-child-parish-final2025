<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\SacramentalService;
use App\Models\MarriageCertificate;
use App\Http\Controllers\Controller;
use App\Models\BaptismalCertificate;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user')->latest()->get();

        foreach ($bookings as $booking) {
            switch ($booking->booking_type) {
                case 'sacramental':
                    $booking->service = SacramentalService::find($booking->reference_id);
                    break;

                case 'marriage_certificate':
                    $booking->service = MarriageCertificate::find($booking->reference_id);
                    break;

                case 'baptismal_certificate':
                    $booking->service = BaptismalCertificate::find($booking->reference_id);
                    break;
            }
        }

        return view('admin.booking.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => $request->input('status', $booking->status),
            'booking_type' => $request->input('booking_type', $booking->booking_type),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking status updated successfully.');
    }


    public function edit(Booking $booking)
    {
        return view('admin.booking.edit', compact('booking'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
