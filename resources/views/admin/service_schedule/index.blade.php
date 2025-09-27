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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($sacramentalServices as $service)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->time }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->service_type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->full_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $service->contact_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach

                        @if($sacramentalServices->isEmpty())
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No services found.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
