<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">

                <h2 class="text-2xl font-bold mb-6 text-center">We’d Love to Hear From You</h2>

                <!-- Contact Information -->
                <div class="mb-8 text-center">
                    <p><strong>Address:</strong> Holy Child Parish, Tabango, Leyte, Philippines</p>
                    <p><strong>Email:</strong> info@holychildparish-tabango.org</p>
                    <p><strong>Phone:</strong> +63 123 456 789</p>
                    <p><strong>Office Hours:</strong> Monday to Friday, 8:00 AM - 5:00 PM</p>
                </div>

                <!-- Flash message -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Contact Form -->
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-semibold">Your Name</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-md" placeholder="Enter your Full Name" required>
                    </div>

                    <div>
                        <label class="block font-semibold">Your Email</label>
                        <input type="email" name="email" class="w-full border-gray-300 rounded-md" placeholder="Enter your Email Address" required>
                    </div>

                    <div>
                        <label class="block font-semibold">Your Message</label>
                        <textarea name="message" rows="4" class="w-full border-gray-300 rounded-md" placeholder="Enter your Message here..." required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded shadow">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
