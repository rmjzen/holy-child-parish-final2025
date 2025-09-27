<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Bookings') }}
        </h2>
    </x-slot>

    <div class="py-8 space-y-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-x-auto sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Baptismal Bookings</h2>

                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ([
                            ['Juan dela Cruz', '2025-10-01', '08:00 AM', 'Holy Child Parish', 'Confirmed'],
                            ['Maria Santos', '2025-10-02', '10:00 AM', 'Holy Child Parish', 'Pending'],
                        ] as $booking)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            @foreach ($booking as $data)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white shadow overflow-x-auto sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Sacramental Bookings</h2>

                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ([
                            ['Jose Ramirez', '2025-10-03', 'Funeral', 'Holy Child Parish', 'Confirmed'],
                            ['Liza Cruz', '2025-10-04', 'Mass', 'Holy Child Parish', 'Pending'],
                        ] as $booking)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            @foreach ($booking as $data)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white shadow overflow-x-auto sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Marriage Bookings</h2>

                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Couple Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ([
                            ['Pedro & Ana', '2025-10-05', '09:00 AM', 'St. Mary’s Chapel', 'Confirmed'],
                            ['Mark & Lisa', '2025-10-06', '10:00 AM', 'St. Mary’s Chapel', 'Pending'],
                        ] as $booking)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            @foreach ($booking as $data)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
