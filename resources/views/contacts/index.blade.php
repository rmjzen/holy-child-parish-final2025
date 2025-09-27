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

                <!-- Visit Us on Facebook -->
                <div class="mb-8 text-center">
                    <a href="https://www.facebook.com/holychildparishofficial" target="_blank" class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 0H1.325C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.495v-9.294H9.691V11.07h3.129V8.414c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.636h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z"/>
                        </svg>
                        <span class="font-semibold">Visit us on Facebook</span>
                    </a>
                </div>

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
