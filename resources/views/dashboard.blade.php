<x-app-layout>
      <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->is_admin ? 'Admin Dashboard' : 'Dashboard' }}
        </h2>
    </x-slot>

  

    @if(Auth::user()->is_admin)
     <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Admin Dashboard</h1>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Upcoming Services -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="font-bold text-lg">Upcoming Services</h2>
                    <p class="text-3xl font-semibold mt-2">12</p>
                </div>

                <!-- Total Bookings -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="font-bold text-lg">Total Bookings</h2>
                    <p class="text-3xl font-semibold mt-2">45</p>
                </div>

                <!-- Total Payments -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="font-bold text-lg">Total Payments</h2>
                    <p class="text-3xl font-semibold mt-2">₱125,000</p>
                </div>

                <!-- Unread Notification -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="font-bold text-lg">Unread Notifications</h2>
                    <p class="text-3xl font-semibold mt-2">7</p>
                </div>

                <!-- Reports Generated -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="font-bold text-lg">Reports Generated</h2>
                    <p class="text-3xl font-semibold mt-2">5</p>
                </div>

                <!-- Assigned Priest -->
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <h2 class="font-bold text-lg">Assigned Priest</h2>
                    <p class="text-3xl font-semibold mt-2">Fr. John Doe</p>
                </div>
            </div>
        </div>
    </div>  
    @else
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
    @endif
</x-app-layout>
