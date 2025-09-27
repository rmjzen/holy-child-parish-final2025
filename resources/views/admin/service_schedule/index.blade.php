<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Schedule') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-x-auto sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Upcoming Services</h2>

                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Priest</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ([
                            ['2025-10-01', '08:00 AM', 'Baptism', 'Holy Child Parish', 'Fr. Miguel Santos'],
                            ['2025-10-02', '10:00 AM', 'Wedding', 'St. Mary’s Chapel', 'Fr. Jose Ramirez'],
                            ['2025-10-03', '06:00 AM', 'Mass', 'Holy Child Parish', 'Fr. Rafael Cruz'],
                            ['2025-10-04', '02:00 PM', 'Funeral', 'Holy Child Parish', 'Fr. Antonio Lopez'],
                            ['2025-10-05', '09:00 AM', 'Pre-Cana Seminar', 'St. Mary’s Chapel', 'Fr. Miguel Santos'],
                        ] as $service)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            @foreach ($service as $data)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data }}</td>
                            @endforeach
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
