<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Successful') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>

                <h1 class="mt-4 text-2xl font-bold text-gray-800">Thank you!</h1>
                <p class="mt-2 text-gray-600">Your payment has been processed successfully.</p>

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                        Go Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
