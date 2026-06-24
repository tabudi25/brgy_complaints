<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $resident->fullname }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('partials.alerts')
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-2">
                <p><strong>Email:</strong> {{ $resident->user?->email }}</p>
                <p><strong>Address:</strong> {{ $resident->address }}</p>
                <p><strong>Contact:</strong> {{ $resident->contact_number ?? '—' }}</p>
                <p><strong>Gender:</strong> {{ $resident->gender ? ucfirst($resident->gender) : '—' }}</p>
                <p><strong>Birthdate:</strong> {{ $resident->birthdate?->format('M d, Y') ?? '—' }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-4">Complaints ({{ $resident->complaints->count() }})</h3>
                @forelse ($resident->complaints as $complaint)
                    <div class="border-b py-2">
                        <a href="{{ route('admin.complaints.show', $complaint) }}" class="text-blue-600">{{ $complaint->complaint_type }}</a>
                        — {{ $complaint->status }}
                    </div>
                @empty
                    <p class="text-gray-500">No complaints.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
