<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">My Hearing Schedule</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('partials.alerts')
        <div class="bg-white shadow-md sm:rounded-lg p-6">
            <table class="min-w-full">
                <thead class="bg-gray-50"><tr><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Time</th><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Complaint</th><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th></tr></thead>
                <tbody>
                    @forelse ($hearings as $hearing)
                        <tr class="border-t hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm">{{ $hearing->hearing_date->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $hearing->hearing_time }}</td>
                            <td class="px-4 py-3 text-sm">{{ $hearing->complaint->complaint_type }}</td>
                            <td class="px-4 py-3"><span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $hearing->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No hearings scheduled.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if (method_exists($hearings, 'links'))<div class="mt-4">{{ $hearings->links() }}</div>@endif
        </div>
    </div></div>
</x-app-layout>
