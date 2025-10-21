<?php

namespace App\Http\Controllers;

use App\Models\SacramentalService;
use App\Models\MarriageCertificate;
use App\Models\BaptismalCertificate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display bookings in the calendar.
     */
    public function index(Request $request)
    {
        $events = collect();
        $userId = auth()->id();

    
        /**
         * 🕊️ SACRAMENTAL SERVICE EVENTS
         */
        $services = SacramentalService::all();
        foreach ($services as $service) {
            $isOwner = ($service->user_id == $userId);
            $serviceDate = Carbon::parse($service->date)->format('Y-m-d');

            $start = Carbon::parse($serviceDate . ' ' . $service->time_from)->toIso8601String();
            $end = $service->time_to
                ? Carbon::parse($serviceDate . ' ' . $service->time_to)->toIso8601String()
                : Carbon::parse($serviceDate . ' ' . $service->time_from)->addHour()->toIso8601String();

            $category = 'Sacramental Request';

            $events->push([
                'id' => 's-' . $service->id,
                'title' => $category . ': ' . ($isOwner ? $service->service_type : 'Time Slot Unavailable'),
                'start' => $start,
                'end' => $end,
                'allDay' => false,
                'backgroundColor' => $isOwner ? '#6366f1' : '#ef4444',
                'borderColor' => $isOwner ? '#4f46e5' : '#b91c1c',
                'extendedProps' => [
                    'category' => $category,
                    'event_type' => $service->service_type,
                    'location' => $service->location,
                    'full_name' => $service->full_name,
                    'contact_number' => $service->contact_number,
                    'time_from' => $service->time_from,
                    'time_to' => $service->time_to,
                    'email' => $service->email ?? null,
                    'is_owner' => $isOwner,
                ]
            ]);
        }

        /**
         * 💍 MARRIAGE CERTIFICATE EVENTS
         */
        $marriages = MarriageCertificate::all();
        foreach ($marriages as $marriage) {
            $isOwner = ($marriage->user_id == $userId);
            $start = Carbon::parse($marriage->date)->format('Y-m-d');
            $category = 'Document Request';

            $events->push([
                'id' => 'm-' . $marriage->id,
                'title' => $isOwner ? $category . ': ' . $marriage->full_name : 'Slot Not Available',
                'start' => $start,
                'allDay' => true,
                'backgroundColor' => $isOwner ? '#f59e0b' : '#ef4444',
                'borderColor' => $isOwner ? '#b45309' : '#b91c1c',
                'extendedProps' => [
                    'category' => $category,
                    'event_type' => 'Marriage Certificate',
                    'location' => $marriage->location,
                    'full_name' => $marriage->full_name,
                    'spouse_name' => $marriage->spouse_name,
                    'contact_number' => $marriage->contact_number,
                    'email' => $marriage->email,
                    'is_owner' => $isOwner,
                ]
            ]);
        }

        /**
         * 👶 BAPTISMAL CERTIFICATE EVENTS
         * (Multiple bookings allowed)
         */
        $baptismals = BaptismalCertificate::all();
        foreach ($baptismals as $baptism) {
            $isOwner = ($baptism->user_id == $userId);
            $start = Carbon::parse($baptism->date)->format('Y-m-d');
            $category = 'Document Request';

            $events->push([
                'id' => 'b-' . $baptism->id,
                'title' => $isOwner ? $category . ': ' . $baptism->child_name : 'Slot Not Available',
                'start' => $start,
                'allDay' => true,
                'backgroundColor' => $isOwner ? '#10b981' : '#ef4444',
                'borderColor' => $isOwner ? '#047857' : '#b91c1c',
                'extendedProps' => [
                    'category' => $category,
                    'event_type' => 'Baptismal Certificate',
                    'child_name' => $baptism->child_name,
                    'father_name' => $baptism->father_name,
                    'mother_name' => $baptism->mother_name,
                    'is_owner' => $isOwner,
                ]
            ]);
        }

        return view('schedule.index', compact('events'));
    }
}
