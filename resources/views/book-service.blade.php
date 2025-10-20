<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Services') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Fallback Error Div (Optional: Shows if no SweetAlert) --}}
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-12" x-data="{ selectedService: '' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 text-center">Select a Service</h1>

                <!-- Service Dropdown -->
                <div class="flex justify-center">
                    <div class="w-full max-w-md">
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-2">
                            Choose a service
                        </label>
                        <select x-model="selectedService" id="service" name="service"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="" disabled selected>-- Select a Service --</option>
                            <option value="sacramental">Sacramental Service</option>
                            <option value="document">Document Request</option>
                        </select>
                    </div>
                </div>

                <!-- Sacramental Service Form -->
                <div class="mt-8" x-show="selectedService === 'sacramental'" x-cloak>
                    <h2 class="text-xl font-semibold mb-4">Sacramental Service Form</h2>
                    <form action="{{ route('sacramental-service.store') }}" method="POST" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Service Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Select a Service</label>
                            <select name="service_type" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('service_type') border-red-500 @enderror">
                                <option value="" disabled {{ old('service_type') ? '' : 'selected' }}>-- Choose
                                    Service --</option>
                                <option value="Wedding" {{ old('service_type') == 'Wedding' ? 'selected' : '' }}>Wedding
                                </option>
                                <option value="Baptism" {{ old('service_type') == 'Baptism' ? 'selected' : '' }}>Baptism
                                </option>
                                <option value="Funeral" {{ old('service_type') == 'Funeral' ? 'selected' : '' }}>Funeral
                                </option>
                                <option value="Mass" {{ old('service_type') == 'Mass' ? 'selected' : '' }}>Mass
                                </option>
                            </select>
                            @error('service_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Select Date</label>
                            <input type="date" name="date" value="{{ old('date') }}" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('date') border-red-500 @enderror">
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Time From</label>
                            <input type="time" name="time_from" value="{{ old('time_from') }}" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('time_from') border-red-500 @enderror">
                            @error('time_from')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Time To</label>
                            <input type="time" name="time_to" value="{{ old('time_to') }}" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('time_to') border-red-500 @enderror">
                            @error('time_to')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Location -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('full_name') border-red-500 @enderror">
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('contact_number') border-red-500 @enderror">
                            @error('contact_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="mt-6">
                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md">
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Document Request Section (Unchanged) --}}
                <div class="mt-8" x-show="selectedService === 'document'" x-cloak>
                    <h2 class="text-xl font-semibold mb-4">Document Request Form</h2>

                    <div x-data="{ docType: '' }">
                        <!-- Document Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Select Document Type</label>
                            <select x-model="docType" required
                                class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="" disabled selected>-- Choose Document --</option>
                                <option value="Marriage Certificate">Marriage Certificate</option>
                                <option value="Baptismal Certificate">Baptismal Certificate</option>
                            </select>
                        </div>

                        <!-- Marriage Certificate Form -->
                        <form x-show="docType === 'Marriage Certificate'" x-cloak
                            action="{{ route('marriage-request.store') }}" method="POST" class="space-y-4 mt-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Book Date</label>
                                <input type="date" name="date" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date of Marriage</label>
                                <input type="date" name="marriage_date" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Place of Marriage</label>
                                <input type="text" name="marriage_place" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name of Spouse</label>
                                <input type="text" name="spouse_name" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md">
                                    Book Now
                                </button>
                            </div>
                        </form>

                        <!-- Baptismal Certificate Form -->
                        <form x-show="docType === 'Baptismal Certificate'" x-cloak
                            action="{{ route('baptismal-request.store') }}" method="POST" class="space-y-4 mt-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name of the Child</label>
                                <input type="text" name="child_name" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                                <input type="date" name="birthdate" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Book Date</label>
                                <input type="date" name="date" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Father’s Name</label>
                                <input type="text" name="father_name" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Mother’s Name</label>
                                <input type="text" name="mother_name" required
                                    class="block w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md">
                                    Book Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    {{-- ✅ Script for Error Popup (Date Conflict) --}}
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Booking Unavailable',
                    text: '{{ session('error') }}', // e.g., "That date is not available. Please check the schedule page."
                    confirmButtonColor: '#ef4444', // Red theme
                    confirmButtonText: 'OK',
                    allowOutsideClick: true, // Close on outside click
                    timer: 5000 // Auto-close after 5 seconds (optional)
                });
            });
        </script>
    @endif
</x-app-layout>
