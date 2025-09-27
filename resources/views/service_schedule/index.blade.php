<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Schedule') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-md shadow-xl rounded-lg p-6">
                <h1 class="text-2xl font-bold text-center mb-6">Parish Service Schedule</h1>

                <div id="ec-calendar" class="min-h-[600px]"></div>
            </div>
        </div>
    </div>

    <!-- EventCalendar CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@event-calendar/build@4.6.0/dist/event-calendar.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@event-calendar/build@4.6.0/dist/event-calendar.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ec = EventCalendar.create(document.getElementById('ec-calendar'), {
                view: 'dayGridMonth',
                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                editable: true, // 🔥 allows drag and drop + resize
                events: [
                    { id: 1, title: 'Baptism', start: '2025-10-02' },
                    { id: 2, title: 'Wedding', start: '2025-10-11' },
                    { id: 3, title: 'Funeral', start: '2025-10-20' },
                    { id: 4, title: 'Holy Mass', start: '2025-10-29' }
                ],

                // when a date is clicked
                dateClick: function (info) {
                    alert('Date clicked: ' + info.dateStr);
                },

                // when an event is dropped to another date
                eventDrop: function (info) {
                    alert('Event moved: ' + info.event.title + 
                          ' → new date: ' + info.event.startStr);
                },

                // when event is resized (if you want multi-day events)
                eventResize: function (info) {
                    alert('Event resized: ' + info.event.title + 
                          ' → end date: ' + info.event.endStr);
                }
            });
        });
    </script>
</x-app-layout>
