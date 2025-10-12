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
            const eventDates = new Set(events.map(e => new Date(e.start).toISOString().split('T')[0]));

            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                events: events,

                dateClick: function(info) {
                    const clickedDate = info.dateStr;
                    if (eventDates.has(clickedDate)) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Unavailable',
                            text: 'This date already has an event scheduled.',
                            confirmButtonColor: '#4f46e5',
                            confirmButtonText: 'OK'
                        });
                    }
                },

                eventClick: function(info) {
                    const event = info.event;
                    const props = event.extendedProps;
                    const isOwner = props.is_owner;

                    const startDate = new Date(event.start).toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    // If the user is not the owner
                    if (!isOwner) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Unavailable',
                            html: `
                <div style="text-align:left; font-size:14px;">
                    <strong>Date:</strong> ${startDate}<br><br>
                    <strong>Category:</strong> ${props.category}<br><br>
                    <strong>Event Type:</strong> ${props.event_type}
                </div>
            `,
                            confirmButtonColor: '#4f46e5'
                        });
                        return;
                    }

                    // If the user is the owner, show all details
                    let detailsHtml = `
        <strong>Date:</strong> ${startDate}<br><br>
        <strong>Category:</strong> ${props.category}<br><br>
        <strong>Event Type:</strong> ${props.event_type}<br><br>
    `;

                    for (const key in props) {
                        if (key !== 'is_owner' && key !== 'category' && key !== 'event_type' && props[
                                key]) {
                            const label = key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                            detailsHtml += `<strong>${label}:</strong> ${props[key]}<br><br>`;
                        }
                    }

                    Swal.fire({
                        icon: 'info',
                        title: event.title,
                        html: `<div style="text-align:left; font-size:14px;">${detailsHtml}</div>`,
                        confirmButtonColor: '#4f46e5',
                        confirmButtonText: 'Close'
                    });
                }


            });

            calendar.render();
        });
    </script>

</x-app-layout>
