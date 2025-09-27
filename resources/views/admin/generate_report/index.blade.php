<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate Reports') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Generate Report</h2>

                <!-- Flash message -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="" method="POST" class="space-y-6">
                    @csrf

                    <!-- Report Type -->
                    <div>
                        <label class="block font-semibold mb-2">Select Report</label>
                        <select name="report_type" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                            <option value="">-- Select Report Type --</option>
                            <option value="bookings">Bookings Report</option>
                            <option value="payments">Payments Report</option>
                            <option value="services">Services Report</option>
                            <option value="notifications">Notifications Report</option>
                        </select>
                    </div>

                    <!-- Date Range -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold mb-2">From Date</label>
                            <input type="date" name="from_date" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>
                        <div>
                            <label class="block font-semibold mb-2">To Date</label>
                            <input type="date" name="to_date" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>
                    </div>

                    <!-- Assigned Priest -->
                    <div>
                        <label class="block font-semibold mb-2">Assigned Priest</label>
                        <select name="priest" class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="">-- Select Priest --</option>
                            <option value="Fr. Miguel Santos">Fr. Miguel Santos</option>
                            <option value="Fr. Jose Ramirez">Fr. Jose Ramirez</option>
                            <option value="Fr. Rafael Cruz">Fr. Rafael Cruz</option>
                            <option value="Fr. Antonio Lopez">Fr. Antonio Lopez</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
                            Generate Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
