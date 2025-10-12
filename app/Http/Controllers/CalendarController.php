<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\SacramentalService;
use App\Models\MarriageCertificate;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display bookings in the calendar.
     */
    public function index(Request $request)
    {
        $events = collect();

        // 1️⃣ Sacramental Services
        $services = \App\Models\SacramentalService::where('user_id', auth()->id())->get();
        foreach ($services as $service) {
            $start = $service->date->format('Y-m-d');
            $isSpecialDate = ($service->date->month == 10 && in_array($service->date->day, [11, 13]));
            $color = $isSpecialDate ? '#ef4444' : '#6366f1';

            $events->push([
                'id' => 's-' . $service->id,
                'title' => $service->service_type,
                'start' => $start,
                'allDay' => true,
                'extendedProps' => [
                    'location' => $service->location,
                    'full_name' => $service->full_name,
                    'contact_number' => $service->contact_number,
                ],
                'backgroundColor' => $color,
                'borderColor' => $isSpecialDate ? '#dc2626' : '#4f46e5',
            ]);
        }

        // 2️⃣ Marriage Certificates
        $marriages = \App\Models\MarriageCertificate::all();
        foreach ($marriages as $marriage) {
            $start = \Carbon\Carbon::parse($marriage->date)->format('Y-m-d');
            $color = '#f59e0b'; // yellow for marriage certificates

            $events->push([
                'id' => 'm-' . $marriage->id,
                'title' => 'Marriage: ' . $marriage->full_name,
                'start' => $start,
                'allDay' => true,
                'extendedProps' => [
                    'location' => $marriage->location,
                    'full_name' => $marriage->full_name,
                    'spouse_name' => $marriage->spouse_name,
                    'contact_number' => $marriage->contact_number ?? '',
                    'email' => $marriage->email,
                ],
                'backgroundColor' => $color,
                'borderColor' => '#b45309',
            ]);
        }

        // 3️⃣ Baptismal Certificates ✅ NEW
        $baptismals = \App\Models\BaptismalCertificate::all();
        foreach ($baptismals as $baptism) {
            // Use birthdate or booking_date (if you have one)
            $start = \Carbon\Carbon::parse($baptism->date)->format('Y-m-d');
            $color = '#10b981'; // green for baptismal certificates

            $events->push([
                'id' => 'b-' . $baptism->id,
                'title' => 'Baptismal: ' . $baptism->child_name,
                'start' => $start,
                'allDay' => true,
                'extendedProps' => [
                    'father_name' => $baptism->father_name,
                    'mother_name' => $baptism->mother_name,
                ],
                'backgroundColor' => $color,
                'borderColor' => '#047857',
            ]);
        }

        return view('schedule.index', compact('events'));
    }
}
