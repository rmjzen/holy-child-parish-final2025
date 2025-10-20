<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Sacramental Service') }}
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

        {{-- ✅ Edit Form --}}
        <div class="bg-white shadow-md rounded-xl p-6 max-w-2xl mx-auto">
            <form action="{{ route('sacramental.my_bookings.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Date --}}
                <div class="mb-4">
                    <label for="date" class="block font-semibold mb-1 text-gray-700">Date</label>
                    <input type="date" name="date" id="date"
                        value="{{ old('date', \Carbon\Carbon::parse($service->date)->format('Y-m-d')) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                {{-- reference number --}}
                <div class="mb-4">
                    <label for="payment_reference" class="block font-semibold mb-1 text-gray-700">Payment Reference
                        Number</label>
                    <input type="text" name="payment_reference" id="payment_reference"
                        value="{{ old('payment_reference', $service->payment_reference) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Time From --}}
                <div class="mb-4">
                    <label for="time_from" class="block font-semibold mb-1 text-gray-700">Time From</label>
                    <input type="time" name="time_from" id="time_from"
                        value="{{ old('time_from', $service->time_from) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Time To --}}
                <div class="mb-4">
                    <label for="time_to" class="block font-semibold mb-1 text-gray-700">Time To</label>
                    <input type="time" name="time_to" id="time_to" value="{{ old('time_to', $service->time_to) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Location --}}
                <div class="mb-4">
                    <label for="location" class="block font-semibold mb-1 text-gray-700">Location</label>
                    <input type="text" name="location" id="location"
                        value="{{ old('location', $service->location) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Contact Number --}}
                <div class="mb-4">
                    <label for="contact_number" class="block font-semibold mb-1 text-gray-700">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number"
                        value="{{ old('contact_number', $service->contact_number) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>



                {{-- Buttons --}}
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('my_bookings') }}"
                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
