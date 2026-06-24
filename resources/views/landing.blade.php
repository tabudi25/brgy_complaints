<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barangay Complaints Management System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <x-application-logo class="h-10 w-auto fill-current text-blue-700" />
                <div>
                    <p class="font-bold text-lg leading-tight">Barangay Complaints</p>
                    <p class="text-sm text-gray-500">Management System</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-700">
                        Log in
                    </a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Register as Resident
                    </a>
                @endif
            </div>
        </div>
    </header>

    <main>
        <section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">File and Track Barangay Complaints Online</h1>
                <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-8">
                    A simple system for residents to submit complaints, upload evidence, and monitor hearing schedules — managed by barangay officials.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-blue-800 font-semibold rounded-md hover:bg-blue-50">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="px-6 py-3 border border-white/40 font-semibold rounded-md hover:bg-white/10">
                        Sign In
                    </a>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-2xl font-bold text-center mb-10">How It Works</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="text-blue-600 font-bold text-xl mb-2">1. Register</div>
                    <p class="text-gray-600">Residents create an account with their profile information to access the system.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="text-blue-600 font-bold text-xl mb-2">2. Submit Complaint</div>
                    <p class="text-gray-600">File a complaint with details and optional evidence such as photos or documents.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="text-blue-600 font-bold text-xl mb-2">3. Track Progress</div>
                    <p class="text-gray-600">Monitor complaint status and view scheduled hearings until resolution.</p>
                </div>
            </div>
        </section>

        <section class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <h2 class="text-2xl font-bold text-center mb-10">For Barangay Officials</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                    <div class="p-4">
                        <p class="font-semibold mb-1">Manage Residents</p>
                        <p class="text-sm text-gray-500">Create and update resident records</p>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold mb-1">Handle Complaints</p>
                        <p class="text-sm text-gray-500">Review and update complaint status</p>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold mb-1">Schedule Hearings</p>
                        <p class="text-sm text-gray-500">Set hearing dates and remarks</p>
                    </div>
                    <div class="p-4">
                        <p class="font-semibold mb-1">View Reports</p>
                        <p class="text-sm text-gray-500">Summary of complaints and hearings</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-gray-300 text-center py-6 text-sm">
        &copy; {{ date('Y') }} Barangay Complaints Management System
    </footer>
</body>
</html>
