<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fa-solid fa-calendar-check text-indigo-500"></i>
            {{ __('Bookings Management') }}
        </h2>
    </x-slot>

    {{-- ✅ SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="max-w-6xl mx-auto mt-6 px-6">
            <div
                class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm flex justify-between items-center">
                <span><strong>Success:</strong> {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()"
                    class="text-green-600 hover:text-green-800 font-bold">✕</button>
            </div>
        </div>
    @endif

    <div class="py-10 space-y-8" x-data="{ showModal: false, selectedBooking: {} }">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">Bookings</h2>
                        <p class="text-sm text-gray-500">Manage and approve incoming service bookings</p>
                    </div>
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-sm rounded-full font-medium">
                        Total: {{ $bookings->count() }}
                    </span>
                </div>

                <!-- ✅ DataTable -->
                <div class="overflow-hidden border border-gray-200 rounded-xl">
                    <table class="min-w-full text-sm text-gray-700 datatable">
                        <thead class="bg-indigo-50 text-indigo-700 uppercase text-xs font-semibold tracking-wider">
                            <tr>
                                <th class="px-6 py-3 text-left">User</th>
                                <th class="px-6 py-3 text-left">Type</th>
                                <th class="px-6 py-3 text-left">Reference ID</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($bookings as $booking)
                                <tr class="hover:bg-indigo-50 transition">
                                    <td class="px-6 py-3 font-medium">{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-3 capitalize">{{ $booking->booking_type ?? 'N/A' }}</td>
                                    <td class="px-6 py-3 text-gray-500">#{{ $booking->reference_id }}</td>
                                    <td class="px-6 py-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($booking->status == 'Approved') bg-green-100 text-green-700
                                            @elseif ($booking->status == 'Rejected') bg-red-100 text-red-700
                                            @elseif ($booking->status == 'Completed') bg-blue-100 text-blue-700
                                            @elseif ($booking->status == 'Cancelled') bg-gray-100 text-gray-600
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center gap-2 flex-wrap">
                                            <!-- View -->
                                            <button
                                                @click="
                                                    showModal = true;
                                                    selectedBooking = {
                                                        id: {{ $booking->id }},
                                                        user: { name: '{{ $booking->user->name ?? 'N/A' }}' },
                                                        booking_type: '{{ $booking->booking_type ?? 'N/A' }}',
                                                        reference_id: '{{ $booking->reference_id ?? 'N/A' }}',
                                                        status: '{{ $booking->status }}',
                                                        created_at: '{{ $booking->created_at->format('Y-m-d H:i') }}',
                                                        updated_at: '{{ $booking->updated_at->format('Y-m-d H:i') }}'
                                                    }
                                                "
                                                class="inline-flex items-center px-3 py-1.5 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md text-xs font-medium transition">
                                                <i class="fa-solid fa-eye mr-1"></i> View
                                            </button>

                                            <!-- Edit -->
                                            <a href="{{ route('bookings.edit', $booking->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-xs font-medium transition">
                                                <i class="fa-solid fa-pen mr-1"></i> Edit
                                            </a>

                                            <!-- Approve -->
                                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST"
                                                onsubmit="return confirm('Approve this booking?');">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white rounded-md text-xs font-medium transition">
                                                    <i class="fa-solid fa-check mr-1"></i> Approve
                                                </button>
                                            </form>

                                            <!-- Reject -->
                                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST"
                                                onsubmit="return confirm('Reject this booking?');">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Rejected">
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs font-medium transition">
                                                    <i class="fa-solid fa-xmark mr-1"></i> Reject
                                                </button>
                                            </form>

                                            <!-- Delete -->
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this booking?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-gray-500 hover:bg-gray-600 text-white rounded-md text-xs font-medium transition">
                                                    <i class="fa-solid fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-400 italic">
                                        No bookings found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ✅ Booking Details Modal -->
        <div x-show="showModal" x-transition.opacity.duration.300ms
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50"
            style="display: none;">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-lg relative transform transition-all">
                <h2 class="text-xl font-bold mb-4 text-center text-indigo-600 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-info"></i> Booking Details
                </h2>
                <div class="space-y-3 text-sm text-gray-700">
                    <div class="grid grid-cols-2 gap-y-2">
                        <p><strong>User:</strong></p>
                        <p x-text="selectedBooking.user.name"></p>

                        <p><strong>Type:</strong></p>
                        <p x-text="selectedBooking.booking_type"></p>

                        <p><strong>Reference ID:</strong></p>
                        <p x-text="selectedBooking.reference_id"></p>

                        <p><strong>Status:</strong></p>
                        <p>
                            <span class="px-2 py-0.5 rounded text-xs font-semibold"
                                :class="{
                                    'bg-green-100 text-green-700': selectedBooking.status === 'Approved',
                                    'bg-red-100 text-red-700': selectedBooking.status === 'Rejected',
                                    'bg-yellow-100 text-yellow-700': selectedBooking.status === 'Pending',
                                    'bg-blue-100 text-blue-700': selectedBooking.status === 'Completed'
                                }"
                                x-text="selectedBooking.status"></span>
                        </p>

                        <p><strong>Created:</strong></p>
                        <p x-text="selectedBooking.created_at"></p>

                        <p><strong>Updated:</strong></p>
                        <p x-text="selectedBooking.updated_at"></p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button @click="showModal = false"
                        class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md text-sm font-medium transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Include DataTables --}}
    @include('partials.datatable_includes')
</x-app-layout>
