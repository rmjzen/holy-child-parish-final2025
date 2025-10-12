<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Service Schedule
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <form action="{{ route('service_schedule.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block font-medium">Service Type</label>
                            <select name="service_type" class="w-full border-gray-300 rounded-md">
                                @foreach(['Wedding', 'Baptism', 'Funeral', 'Mass'] as $type)
                                    <option value="{{ $type }}" {{ $service->service_type == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium">Date</label>
                            <input type="date" name="date" value="{{ $service->date }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-medium">Time</label>
                            <input type="time" name="time" value="{{ $service->time }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-medium">Location</label>
                            <input type="text" name="location" value="{{ $service->location }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-medium">Full Name</label>
                            <input type="text" name="full_name" value="{{ $service->full_name }}" class="w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block font-medium">Contact Number</label>
                            <input type="text" name="contact_number" value="{{ $service->contact_number }}" class="w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-2">
                        <a href="{{ route('service_schedule.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
