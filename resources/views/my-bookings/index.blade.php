<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('My Bookings') }}
            </h2>
        </div>
    </x-slot>

    <div class="container mx-auto px-6 py-8">
        {{-- ✅ Success Message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- ======================== SACRAMENTAL SERVICES ======================== --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Sacramental Services</h3>
            </div>

            <div class="p-6 overflow-x-auto">
                <table id="sacramentalTable" class="min-w-full border border-gray-200 rounded-lg display">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700 text-sm uppercase tracking-wide">
                            <th class="py-3 px-4 text-left border">ID</th>
                            <th class="py-3 px-4 text-left border">Name</th>
                            <th class="py-3 px-4 text-left border">Service Type</th>
                            <th class="py-3 px-4 text-left border">Reference No.</th>
                            <th class="py-3 px-4 text-left border">Date</th>
                            <th class="py-3 px-4 text-left border">Time From</th>
                            <th class="py-3 px-4 text-left border">Time To</th>
                            <th class="py-3 px-4 text-left border">Location</th>
                            <th class="py-3 px-4 text-left border">Contact</th>
                            <th class="py-3 px-4 text-center border">Status</th>
                            <th class="py-3 px-4 text-center border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sacramentalServices as $item)
                            <tr class="hover:bg-gray-50 text-gray-700">
                                <td class="py-3 px-4 border">{{ $item->id ?? '—' }}</td>
                                <td class="py-3 px-4 border">{{ $item->user?->name ?? '—' }}</td>
                                <td class="py-3 px-4 border">{{ $item->service_type ?? '—' }}</td>
                                <td class="py-3 px-4 border font-mono text-sm text-gray-600">
                                    {{ $item->payment_reference ?? '—' }}
                                </td>
                                <td class="py-3 px-4 border">
                                    {{ $item->date ? \Carbon\Carbon::parse($item->date)->format('M j, Y') : '—' }}
                                </td>
                                <td class="py-3 px-4 border">
                                    {{ $item->time_from ? \Carbon\Carbon::parse($item->time_from)->format('h:i A') : '—' }}
                                </td>
                                <td class="py-3 px-4 border">
                                    {{ $item->time_to ? \Carbon\Carbon::parse($item->time_to)->format('h:i A') : '—' }}
                                </td>
                                <td class="py-3 px-4 border">{{ $item->location ?? '—' }}</td>
                                <td class="py-3 px-4 border">{{ $item->contact_number ?? '—' }}</td>

                                {{-- ✅ Status Badge --}}
                                <td class="py-3 px-4 border text-center">
                                    @php
                                        $statusColors = [
                                            'Pending' => 'bg-yellow-100 text-yellow-800',
                                            'Paid' => 'bg-blue-100 text-blue-800',
                                            'Approved' => 'bg-green-100 text-green-800',
                                            'Rejected' => 'bg-red-100 text-red-800',
                                            'Cancelled' => 'bg-gray-200 text-gray-700',
                                            'Completed' => 'bg-emerald-100 text-emerald-800',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                {{-- ✅ Action Buttons --}}
                                <td class="py-3 px-4 border text-center space-x-2">
                                    <a href="{{ route('sacramental.my_bookings.edit', $item->id) }}"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm transition">
                                        Edit
                                    </a>
                                    <a href="#"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-sm transition"
                                        onclick="showPaymentImage('{{ asset('gcash.jpg') }}')">
                                        Pay
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="py-6 px-4 text-center text-gray-500">
                                    No sacramental services found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ DataTables CSS/JS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    {{-- ✅ SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ✅ DataTables Initialization --}}
    <script>
        $(document).ready(function() {
            $('#sacramentalTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                language: {
                    search: "Search Booking:",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching bookings found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });
        });

        function showPaymentImage(imageUrl) {
            Swal.fire({
                title: 'Scan to Pay',
                html: `
                <p style="
                    margin-top: 15px;
                    font-size: 15px;
                    font-weight: bold;
                    background-color: #fff3cd;
                    color: #856404;
                    padding: 12px;
                    border-radius: 6px;
                    border: 1px solid #ffeeba;
                    text-align: left;
                ">
                    ⚠️ <strong>Reminder:</strong> If you’ve already paid, please enter your 
                    <strong>reference number</strong> in your booking record.<br><br>
                    📝 Once submitted, the <strong>admin will verify your payment</strong> and update the status of your booking.
                </p>
            `,
                imageUrl: imageUrl,
                imageAlt: 'Payment QR Code',
                imageWidth: 300,
                imageHeight: 300,
                confirmButtonText: 'Close',
                confirmButtonColor: '#3085d6',
                showCloseButton: true
            });
        }
    </script>

    {{-- ✅ Tailwind-friendly DataTable Styling --}}
    <style>
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            margin: 0 0.5rem;
        }
    </style>
</x-app-layout>
