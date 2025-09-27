<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Notification') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                @forelse ($notifications as $notification)
                    <div class="p-4 mb-4 border rounded-lg shadow-sm flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-lg">
                                {{ $notification->data['title'] ?? 'Notification' }}
                            </h3>
                            <p class="text-gray-600">
                                {!! $notification->data['message'] ?? '' !!}
                            </p>
                        </div>

                        @if (is_null($notification->read_at))
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                <button class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                                    Mark as Read
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm">Read</span>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-600">No notifications available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
