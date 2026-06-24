<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">My Hearing Schedule</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('partials.alerts')
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full">
                <thead><tr><th class="px-4 py-2 text-left">Date</th><th class="px-4 py-2 text-left">Time</th><th class="px-4 py-2 text-left">Complaint</th><th class="px-4 py-2 text-left">Status</th></tr></thead>
                <tbody>
                    @forelse ($hearings as $hearing)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $hearing->hearing_date->format('M d, Y') }}</td>
                            <td class="px-4 py-2">{{ $hearing->hearing_time }}</td>
                            <td class="px-4 py-2">{{ $hearing->complaint->complaint_type }}</td>
                            <td class="px-4 py-2">{{ $hearing->status }}</td>
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
