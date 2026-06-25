<x-guest-layout>
    <div class="text-center">
        <div class="mb-4">
            <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">Email Verified!</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Your email has been successfully verified. You can now access the Barangay Complaints System.</p>

        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Continue to Dashboard
        </a>
    </div>
</x-guest-layout>
