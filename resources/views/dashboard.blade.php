<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-md shadow-xl rounded-lg p-6">
                <h1 class="text-2xl font-bold text-center mb-8">Parish Schedule</h1>

                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Office Hours -->
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h2 class="font-bold text-lg">Office Hours</h2>
                        <p class="text-sm text-gray-600">Mon - Sat</p>
                        <p class="mt-2">8:00 AM - 12:00 NN</p>
                        <p>2:00 PM - 5:00 PM</p>
                    </div>

                    <!-- Pre Jordan Seminar -->
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h2 class="font-bold text-lg">Pre Jordan Seminar</h2>
                        <p class="text-sm text-gray-600">2nd &amp; 4th Sat</p>
                        <p class="mt-2">8:00 AM - 12:00 NN</p>
                    </div>

                    <!-- Pre Cana Seminar -->
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h2 class="font-bold text-lg">Pre Cana Seminar</h2>
                        <p class="text-sm text-gray-600">1st &amp; 3rd Sat</p>
                        <p class="mt-2">8:00 AM - 12:00 NN</p>
                    </div>

                    <!-- Baptism -->
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h2 class="font-bold text-lg">Baptism</h2>
                        <p class="text-sm text-gray-600">Sat / 6:00 AM</p>
                        <p class="mt-2">By Appointment</p>
                    </div>

                    <!-- Marriage -->
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h2 class="font-bold text-lg">Marriage</h2>
                        <p class="text-sm text-gray-600">Sat / 6:00 AM</p>
                        <p class="mt-2">By Appointment</p>
                    </div>

                    <!-- Holy Mass -->
                    <div class="bg-white shadow rounded-lg p-4 text-center">
                        <h2 class="font-bold text-lg">Holy Mass</h2>
                        <p class="text-sm text-gray-600">Mon - Sat: 6:00 AM</p>
                        <p class="mt-2">Sun: 5:00 AM, 7:00 AM, 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
