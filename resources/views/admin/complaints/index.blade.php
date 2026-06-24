<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Complaints</h2>
            <a href="{{ route('admin.complaints.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white">Add Complaint</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.alerts')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Type</th>
                            <th class="px-4 py-2 text-left">Resident</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($complaints as $complaint)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $complaint->complaint_type }}</td>
                                <td class="px-4 py-2">{{ $complaint->resident->fullname }}</td>
                                <td class="px-4 py-2">{{ $complaint->status }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.complaints.show', $complaint) }}" class="text-blue-600">View</a>
                                    <a href="{{ route('admin.complaints.edit', $complaint) }}" class="text-indigo-600">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No complaints found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $complaints->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
