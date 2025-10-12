<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fa-solid fa-calendar-check text-indigo-500"></i>
            {{ __('Bookings Management') }}
        </h2>
    </x-slot>

    {{-- ✅ SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="max-w-4xl mx-auto mt-6 px-6">
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm">
                <div class="flex items-center justify-between">
                    <span><strong>Success:</strong> {{ session('success') }}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                        ✕
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="py-10 space-y-12" x-data="{ showModal: false, selectedBooking: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">All Bookings</h2>
                    <span class="text-sm text-gray-500">Total: {{ $bookings->count() }}</span>
                </div>

                <!-- ✅ DataTable -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-600 datatable border rounded-lg">
                        <thead class="bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-700 uppercase text-xs font-semibold tracking-wider">
                            <tr>
                                <th class="px-6 py-3">User</th>
                                <th class="px-6 py-3">Booking Type</th>
                                <th class="px-6 py-3">Reference ID</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3 font-medium">{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-3 capitalize">{{ $booking->booking_type ?? 'N/A' }}</td>
                                    <td class="px-6 py-3 text-gray-500">#{{ $booking->reference_id }}</td>
                                    <td class="px-6 py-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($booking->status == 'Approved') bg-green-100 text-green-700
                                            @elseif ($booking->status == 'Rejected') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center flex-wrap gap-2">
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
                                                class="px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md transition">
                                                <i class="fa-solid fa-eye mr-1"></i> View
                                            </button>

                                            <!-- Edit -->
                                            <a href="{{ route('bookings.edit', $booking->id) }}" 
                                               class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                                               <i class="fa-solid fa-pen mr-1"></i> Edit
                                            </a>

                                            <!-- Approve -->
                                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST" 
                                                  onsubmit="return confirm('Approve this booking?');">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-md transition">
                                                    <i class="fa-solid fa-check mr-1"></i> Approve
                                                </button>
                                            </form>

                                            <!-- Reject -->
                                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST"
                                                  onsubmit="return confirm('Reject this booking?');">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Rejected">
                                                <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md transition">
                                                    <i class="fa-solid fa-xmark mr-1"></i> Reject
                                                </button>
                                            </form>

                                            <!-- Delete -->
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                  onsubmit="return confirm('Delete this booking?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition">
                                                    <i class="fa-solid fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-gray-400 italic">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ✅ Booking Details Modal -->
        <div 
            x-show="showModal"
            x-transition.opacity.duration.300ms
            class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50"
            style="display: none;"
        >
            <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md relative transform transition-all">
                <h2 class="text-xl font-bold mb-4 text-center text-indigo-600">Booking Details</h2>
                <div class="space-y-3 text-sm text-gray-700">
                    <p><strong>User:</strong> <span x-text="selectedBooking.user.name"></span></p>
                    <p><strong>Type:</strong> <span x-text="selectedBooking.booking_type"></span></p>
                    <p><strong>Reference ID:</strong> <span x-text="selectedBooking.reference_id"></span></p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 py-0.5 rounded text-xs font-semibold"
                              :class="{
                                  'bg-green-100 text-green-700': selectedBooking.status === 'Approved',
                                  'bg-red-100 text-red-700': selectedBooking.status === 'Rejected',
                                  'bg-yellow-100 text-yellow-700': selectedBooking.status === 'Pending'
                              }"
                              x-text="selectedBooking.status"></span>
                    </p>
                    <hr class="my-3 border-gray-200">
                    <p><strong>Created:</strong> <span x-text="selectedBooking.created_at"></span></p>
                    <p><strong>Updated:</strong> <span x-text="selectedBooking.updated_at"></span></p>
                </div>

                <div class="mt-6 flex justify-end">
                    <button @click="showModal = false" 
                            class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Include DataTables --}}
    @include('partials.datatable_includes')
</x-app-layout>
