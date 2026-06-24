<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Reports</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ([
                'Total Residents' => $stats['total_residents'],
                'Total Complaints' => $stats['total_complaints'],
                'Pending' => $stats['pending_complaints'],
                'Resolved' => $stats['resolved_complaints'],
            ] as $label => $value)
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <p class="text-sm text-gray-500">{{ $label }}</p>
                    <p class="text-2xl font-bold">{{ $value }}</p>
                </div>
            @endforeach
        </div>
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="font-semibold mb-4">Complaints by Type</h3>
            @forelse ($complaintsByType as $row)
                <p>{{ $row->complaint_type }}: {{ $row->total }}</p>
            @empty
                <p class="text-gray-500">No data yet.</p>
            @endforelse
        </div>
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="font-semibold mb-4">Upcoming Hearings</h3>
            @forelse ($upcomingHearings as $hearing)
                <p>{{ $hearing->hearing_date->format('M d, Y') }} — {{ $hearing->complaint->complaint_type }} ({{ $hearing->complaint->resident->fullname }})</p>
            @empty
                <p class="text-gray-500">No upcoming hearings.</p>
            @endforelse
        </div>
    </div></div>
</x-app-layout>
