<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Payments') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-x-auto sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Payments</h2>

                <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parishioner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ([
                            ['Juan dela Cruz', '2500', 'Baptism', 'Cash', 'Paid', '2025-10-01'],
                            ['Maria Santos', '5000', 'Wedding', 'GCash', 'Pending', '2025-10-02'],
                            ['Jose Ramirez', '1500', 'Funeral', 'Cash', 'Paid', '2025-10-03'],
                            ['Liza Cruz', '2000', 'Mass', 'GCash', 'Pending', '2025-10-04'],
                        ] as $payment)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            @foreach ($payment as $index => $data)
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data }}</td>
                            @endforeach
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-2">
                                    <a href="#"
                                       class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                                    <a href="#"
                                       class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
