<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Send Notification') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Send Notification</h2>

                <!-- Flash message -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="" method="POST" class="space-y-6">
                    @csrf

                    <!-- To -->
                    <div>
                        <label class="block font-semibold mb-2">To</label>
                        <input type="text" name="to" class="w-full border border-gray-300 rounded-md px-3 py-2"
                               placeholder="Enter recipient" required>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block font-semibold mb-2">Subject</label>
                        <input type="text" name="subject" class="w-full border border-gray-300 rounded-md px-3 py-2"
                               placeholder="Enter subject" required>
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block font-semibold mb-2">Message</label>
                        <textarea name="message" rows="6"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2"
                                  placeholder="Enter your message..." required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                            Send Notification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
