<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fa-solid fa-gauge text-indigo-500"></i>
            {{ Auth::user()->is_admin ? 'Admin Dashboard' : 'Parish Dashboard' }}
        </h2>
    </x-slot>

    {{-- ✅ ADMIN DASHBOARD --}}
    @if (Auth::user()->is_admin)
        <div class="py-10 bg-gradient-to-br from-indigo-50 via-white to-blue-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome, Admin!</h1>
                    <p class="text-gray-500 text-sm">Here’s an overview of the parish activities and statistics.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @php
                        $cards = [
                            [
                                'title' => 'Upcoming Services',
                                'value' => 12,
                                'icon' => 'fa-calendar-check',
                                'color' => 'from-green-400 to-emerald-600',
                            ],
                            [
                                'title' => 'Total Bookings',
                                'value' => 45,
                                'icon' => 'fa-book-open',
                                'color' => 'from-blue-400 to-indigo-600',
                            ],
                            [
                                'title' => 'Total Payments',
                                'value' => '₱125,000',
                                'icon' => 'fa-peso-sign',
                                'color' => 'from-yellow-400 to-amber-600',
                            ],
                            [
                                'title' => 'Unread Notifications',
                                'value' => 7,
                                'icon' => 'fa-bell',
                                'color' => 'from-pink-400 to-rose-600',
                            ],
                            [
                                'title' => 'Reports Generated',
                                'value' => 5,
                                'icon' => 'fa-file-lines',
                                'color' => 'from-purple-400 to-indigo-600',
                            ],
                            [
                                'title' => 'Assigned Priest',
                                'value' => 'Fr. John Doe',
                                'icon' => 'fa-user-tie',
                                'color' => 'from-cyan-400 to-sky-600',
                            ],
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        <div
                            class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 p-6 border border-gray-100 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r {{ $card['color'] }}"></div>
                            <div class="flex flex-col items-center">
                                <div
                                    class="p-4 rounded-full bg-gradient-to-br {{ $card['color'] }} text-white shadow-md mb-4">
                                    <i class="fa-solid {{ $card['icon'] }} text-2xl"></i>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-700">{{ $card['title'] }}</h2>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $card['value'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ✅ USER DASHBOARD --}}
    @else
        <div class="py-10 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl p-8 border border-gray-100">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-indigo-700 mb-2">Parish Schedule</h1>
                        <p class="text-gray-500 text-sm">View all regular parish activities and schedules below.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
                        @php
                            $schedules = [
                                [
                                    'title' => 'Office Hours',
                                    'desc' => 'Mon - Sat',
                                    'time' => '8:00 AM - 12:00 NN / 2:00 PM - 5:00 PM',
                                    'icon' => 'fa-clock',
                                ],
                                [
                                    'title' => 'Pre Jordan Seminar',
                                    'desc' => '2nd & 4th Saturday',
                                    'time' => '8:00 AM - 12:00 NN',
                                    'icon' => 'fa-people-group',
                                ],
                                [
                                    'title' => 'Pre Cana Seminar',
                                    'desc' => '1st & 3rd Saturday',
                                    'time' => '8:00 AM - 12:00 NN',
                                    'icon' => 'fa-heart',
                                ],
                                [
                                    'title' => 'Baptism',
                                    'desc' => 'Saturday / 6:00 AM',
                                    'time' => 'By Appointment',
                                    'icon' => 'fa-baby',
                                ],
                                [
                                    'title' => 'Marriage',
                                    'desc' => 'Saturday / 6:00 AM',
                                    'time' => 'By Appointment',
                                    'icon' => 'fa-ring',
                                ],
                                [
                                    'title' => 'Holy Mass',
                                    'desc' => 'Mon-Sat: 6:00 AM',
                                    'time' => 'Sun: 5:00 AM, 7:00 AM, 5:00 PM',
                                    'icon' => 'fa-church',
                                ],
                            ];
                        @endphp

                        @foreach ($schedules as $schedule)
                            <div
                                class="bg-gradient-to-br from-indigo-50 to-white shadow-lg hover:shadow-xl transition rounded-xl p-6 border border-indigo-100 text-center transform hover:-translate-y-1">
                                <div
                                    class="mx-auto mb-4 p-2 bg-indigo-100 rounded-full w-14 h-14 flex items-center justify-center">
                                    <img src="{{ asset('HCP.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                                </div>

                                <h2 class="text-lg font-semibold text-gray-800">{{ $schedule['title'] }}</h2>
                                <p class="text-sm text-gray-500">{{ $schedule['desc'] }}</p>
                                <p class="mt-2 font-medium text-indigo-600">{{ $schedule['time'] }}</p>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    @endif
</x-app-layout>
