<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fa-solid fa-calendar-days text-indigo-600"></i>
            {{ __('Service Schedule') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl p-8 border border-indigo-100">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-indigo-700 mb-2">Parish Service Calendar</h1>
                    <p class="text-gray-500 text-sm">
                        View all upcoming baptisms, weddings, and church events. Only dates with events can be clicked.
                    </p>
                </div>

                <div id="calendar" class="min-h-[650px] rounded-xl border border-indigo-100 shadow-inner"></div>
            </div>
        </div>
    </div>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.css" rel="stylesheet" />

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>

    <!-- FontAwesome & SweetAlert2 -->
    <script src="https://kit.fontawesome.com/a2e0f1f6e6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #calendar {
            background: white;
            border-radius: 12px;
        }

        .fc-theme-standard .fc-toolbar .fc-button {
            background-color: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        .fc-theme-standard .fc-toolbar .fc-button:hover {
            background-color: #4f46e5;
        }

        .fc-theme-standard .fc-daygrid-day-number {
            color: #374151;
        }

        .special-event {
            font-weight: bold !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            border-radius: 4px !important;
        }

        .fc-daygrid-day:hover {
            background-color: #dbeafe !important;
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const events = @json($events);

            // Create a set of all event dates (YYYY-MM-DD) for quick lookup
            const eventDates = new Set(events.map(e => new Date(e.start).toISOString().split('T')[0]));

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '2025-10-11',
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                dayMaxEvents: true,
                eventBackgroundColor: '#6366f1',
                eventBorderColor: '#4f46e5',
                eventTextColor: '#ffffff',
                events: events,

                // Only allow clicking on dates that have events
                dateClick: function(info) {
                    const clickedDate = info.dateStr;

                    if (!eventDates.has(clickedDate)) {
                        // Do nothing for dates without events
                        return;
                    }

                    Swal.fire({
                        icon: 'info',
                        title: 'Date Has Event',
                        text: `The date ${new Date(clickedDate).toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        })} has a scheduled service. Please click the event for details.`,
                        confirmButtonColor: '#4f46e5',
                        confirmButtonText: 'OK'
                    });
                },

                // Show event details when clicking the event itself
                eventClick: function(info) {
                    const event = info.event;
                    const startDate = new Date(event.start).toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    const location = event.extendedProps?.location || 'N/A';
                    const fullName = event.extendedProps?.full_name || 'N/A';
                    const contact = event.extendedProps?.contact_number || 'N/A';
                    const email = event.extendedProps?.email || 'N/A';

                    Swal.fire({
                        icon: 'info',
                        title: 'Service Details',
                        html: `
                            <div style="text-align: left; font-size: 14px;">
                                <strong>Service Type:</strong> ${event.title}<br><br>
                                <strong>Date:</strong> ${startDate}<br><br>
                                <strong>Location:</strong> ${location}<br><br>
                                <strong>Full Name:</strong> ${fullName}<br><br>
                                <strong>Contact Number:</strong> ${contact}<br><br>
                                <strong>Email:</strong> ${email}<br><br>
                                <small>Event ID: ${event.id}</small>
                            </div>
                        `,
                        confirmButtonColor: '#4f46e5',
                        confirmButtonText: 'Close'
                    });
                },

                eventClassNames: function(arg) {
                    const startDate = new Date(arg.event.start);
                    if (startDate.getMonth() === 9 && (startDate.getDate() === 11 || startDate
                            .getDate() === 13)) {
                        return ['special-event'];
                    }
                    return [];
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
