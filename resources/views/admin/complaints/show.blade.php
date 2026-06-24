@php use App\Models\Complaint; @endphp
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Complaint Details</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @include('partials.alerts')
        <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-2">
            <p><strong>Resident:</strong> {{ $complaint->resident->fullname }}</p>
            <p><strong>Type:</strong> {{ $complaint->complaint_type }}</p>
            <p><strong>Respondent:</strong> {{ $complaint->respondent_name }}</p>
            <p><strong>Status:</strong> {{ $complaint->status }}</p>
            <p><strong>Description:</strong> {{ $complaint->description }}</p>
            @if ($complaint->evidence_file)
                <p><strong>Evidence:</strong> <a href="{{ Storage::url($complaint->evidence_file) }}" target="_blank" class="text-blue-600">View file</a></p>
            @endif
        </div>
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="font-semibold mb-2">Update Status</h3>
            <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}" class="flex gap-2">
                @csrf @method('PATCH')
                <select name="status" class="rounded border-gray-300">
                    @foreach (Complaint::STATUSES as $status)
                        <option value="{{ $status }}" @selected($complaint->status === $status)>{{ $status }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-white">Update</button>
            </form>
        </div>
        @if ($complaint->hearing)
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Scheduled Hearing</h3>
                <p>{{ $complaint->hearing->hearing_date->format('M d, Y') }} at {{ $complaint->hearing->hearing_time }}</p>
                <p>Status: {{ $complaint->hearing->status }}</p>
            </div>
        @endif
    </div></div>
</x-app-layout>
