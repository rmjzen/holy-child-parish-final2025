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
        $userId = auth()->id();

        // 1️⃣ Sacramental Services
        $services = \App\Models\SacramentalService::all();
        foreach ($services as $service) {
            $isOwner = ($service->user_id == $userId);
            $start = \Carbon\Carbon::parse($service->date)->format('Y-m-d');
            $category = 'Sacramental Request';

            $events->push([
                'id' => 's-' . $service->id,
                'title' =>  $category . ': ' . ($isOwner ? $service->service_type : 'Unavailable'),
                'start' => $start,
                'allDay' => true,
                'backgroundColor' => $isOwner ? '#6366f1' : '#ef4444',
                'borderColor' => $isOwner ? '#4f46e5' : '#b91c1c',
                'extendedProps' => [
                    'category' =>  $category,
                    'event_type' => $service->service_type,  // Wedding, Baptism, Funeral, Mass
                    'location' => $service->location,
                    'full_name' => $service->full_name,
                    'contact_number' => $service->contact_number,
                    'time' => $service->time,
                    'email' => $service->email,
                    'is_owner' => $isOwner,
                ]
            ]);
        }

        // 2️⃣ Marriage Certificates (Document Request)
        $marriages = \App\Models\MarriageCertificate::all();
        foreach ($marriages as $marriage) {
            $isOwner = ($marriage->user_id == $userId);
            $start = \Carbon\Carbon::parse($marriage->date)->format('Y-m-d');
            $category = 'Document Request';

            $events->push([
                'id' => 'm-' . $marriage->id,
                'title' => $isOwner ? $category . ': ' . $marriage->full_name : 'Unavailable',
                'start' => $start,
                'allDay' => true,
                'backgroundColor' => $isOwner ? '#f59e0b' : '#ef4444',
                'borderColor' => $isOwner ? '#b45309' : '#b91c1c',
                'extendedProps' => [
                    'category' => 'Document Request',
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

        // 3️⃣ Baptismal Certificates (Document Request)
        $baptismals = \App\Models\BaptismalCertificate::all();
        foreach ($baptismals as $baptism) {
            $isOwner = ($baptism->user_id == $userId);
            $start = \Carbon\Carbon::parse($baptism->date)->format('Y-m-d');
            $category = 'Document Request';
            $events->push([
                'id' => 'b-' . $baptism->id,
                'title' => $isOwner ? $category . ': ' . $baptism->child_name : 'Unavailable',
                'start' => $start,
                'allDay' => true,
                'backgroundColor' => $isOwner ? '#10b981' : '#ef4444',
                'borderColor' => $isOwner ? '#047857' : '#b91c1c',
                'extendedProps' => [
                    'category' => 'Document Request',
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
