{{-- resources/views/payment/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-medium text-gray-900 mb-4">Service Fee</h3>
                <p class="text-sm text-gray-600 mb-6">
                    Complete Your Payment Now
                </p>

                {{-- Stripe Checkout Form --}}
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                        Amount Due: ₱ 100.00 - Pay Now
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
