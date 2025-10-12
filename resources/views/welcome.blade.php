<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Holy Child Parish - Tabango Leyte</title>

    <link rel="icon" type="image/png" href="{{ asset('HCP.png') }}">

    <!-- Tailwind CSS (already included with Breeze/Jetstream or Laravel 11/12) -->
    @vite('resources/css/app.css')
</head>

<body class="antialiased">

    <!-- Background -->
    <div class="relative min-h-screen bg-cover bg-center"
        style="background-image: url('{{ asset('holychildparish.png') }}')">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Content -->
        <div class="relative flex items-center justify-center min-h-screen">
            <div class="text-center text-white px-6">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Holy Child Parish</h1>
                <h2 class="text-xl md:text-2xl font-medium mb-8">Tabango, Leyte</h2>

                <p class="max-w-2xl mx-auto mb-10 text-lg">
                    Welcome to our parish management system. Book services, manage schedules, and stay updated with
                    church activities.
                </p>

                <div class="flex justify-center gap-4">
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg text-lg font-semibold shadow-lg">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-lg text-lg font-semibold shadow-lg">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
