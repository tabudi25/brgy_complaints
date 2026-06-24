<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Complaint Status</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @include('partials.alerts')
        <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-2">
            <p><strong>Type:</strong> {{ $complaint->complaint_type }}</p>
            <p><strong>Respondent:</strong> {{ $complaint->respondent_name }}</p>
            <p><strong>Status:</strong> {{ $complaint->status }}</p>
            <p><strong>Description:</strong> {{ $complaint->description }}</p>
            @if ($complaint->evidence_file)
                <p><strong>Evidence:</strong> <a href="{{ Storage::url($complaint->evidence_file) }}" target="_blank" class="text-blue-600">View file</a></p>
            @endif
        </div>
        @if ($complaint->hearing)
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Hearing Schedule</h3>
                <p>{{ $complaint->hearing->hearing_date->format('M d, Y') }} at {{ $complaint->hearing->hearing_time }}</p>
                <p>Status: {{ $complaint->hearing->status }}</p>
                @if ($complaint->hearing->remarks)<p>Remarks: {{ $complaint->hearing->remarks }}</p>@endif
            </div>
        @endif
    </div></div>
</x-app-layout>
