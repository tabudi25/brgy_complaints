<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800">My Complaints</h2>
            <a href="{{ route('resident.complaints.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition-colors shadow-sm">Submit Complaint</a>
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @include('partials.alerts')
        <div class="bg-white shadow-md sm:rounded-lg p-6">
            <table class="min-w-full">
                <thead class="bg-gray-50"><tr><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Type</th><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Submitted</th><th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Actions</th></tr></thead>
                <tbody>
                    @forelse ($complaints as $complaint)
                        <tr class="border-t hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm">{{ $complaint->complaint_type }}</td>
                            <td class="px-4 py-3"><span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $complaint->status }}</span></td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $complaint->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3"><a href="{{ route('resident.complaints.show', $complaint) }}" class="text-blue-600 hover:text-blue-800 font-medium">View</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No complaints yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if (method_exists($complaints, 'links'))<div class="mt-4">{{ $complaints->links() }}</div>@endif
        </div>
    </div></div>
</x-app-layout>
