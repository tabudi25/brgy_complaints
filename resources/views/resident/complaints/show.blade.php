<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Complaint Details</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @include('partials.alerts')
        <div class="bg-white shadow-md sm:rounded-lg p-6 space-y-4">
            <div class="grid grid-cols-1 gap-4">
                <div><span class="text-sm font-medium text-gray-500">Type:</span> <span class="text-gray-900">{{ $complaint->complaint_type }}</span></div>
                <div><span class="text-sm font-medium text-gray-500">Respondent:</span> <span class="text-gray-900">{{ $complaint->respondent_name }}</span></div>
                <div><span class="text-sm font-medium text-gray-500">Status:</span> <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $complaint->status }}</span></div>
                <div><span class="text-sm font-medium text-gray-500">Description:</span> <p class="mt-1 text-gray-900">{{ $complaint->description }}</p></div>
                @if ($complaint->evidence_file)
                    <div><span class="text-sm font-medium text-gray-500">Evidence:</span> <a href="{{ Storage::url($complaint->evidence_file) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">View file</a></div>
                @endif
            </div>
        </div>
        @if ($complaint->hearing)
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-4 text-gray-800">Hearing Schedule</h3>
                <div class="space-y-3">
                    <p class="text-gray-900"><span class="text-sm font-medium text-gray-500">Date & Time:</span> {{ $complaint->hearing->hearing_date->format('M d, Y') }} at {{ $complaint->hearing->hearing_time }}</p>
                    <p><span class="text-sm font-medium text-gray-500">Status:</span> <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $complaint->hearing->status }}</span></p>
                    @if ($complaint->hearing->remarks)<p class="text-gray-900"><span class="text-sm font-medium text-gray-500">Remarks:</span> {{ $complaint->hearing->remarks }}</p>@endif
                </div>
            </div>
        @endif
    </div></div>
</x-app-layout>
