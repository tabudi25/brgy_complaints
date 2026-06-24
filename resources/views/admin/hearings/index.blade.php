<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Hearings</h2>
            <a href="{{ route('admin.hearings.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white">Schedule Hearing</a>
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('partials.alerts')
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full">
                <thead><tr><th class="px-4 py-2 text-left">Date</th><th class="px-4 py-2 text-left">Complaint</th><th class="px-4 py-2 text-left">Resident</th><th class="px-4 py-2 text-left">Status</th><th class="px-4 py-2 text-left">Actions</th></tr></thead>
                <tbody>
                    @forelse ($hearings as $hearing)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $hearing->hearing_date->format('M d, Y') }} {{ $hearing->hearing_time }}</td>
                            <td class="px-4 py-2">{{ $hearing->complaint->complaint_type }}</td>
                            <td class="px-4 py-2">{{ $hearing->complaint->resident->fullname }}</td>
                            <td class="px-4 py-2">{{ $hearing->status }}</td>
                            <td class="px-4 py-2"><a href="{{ route('admin.hearings.edit', $hearing) }}" class="text-indigo-600">Edit</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-4 text-center text-gray-500">No hearings scheduled.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $hearings->links() }}</div>
        </div>
    </div></div>
</x-app-layout>
