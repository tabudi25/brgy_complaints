<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Residents</h2>
            <a href="{{ route('admin.residents.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white">Add Resident</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.alerts')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Full Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Contact</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($residents as $resident)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $resident->fullname }}</td>
                                <td class="px-4 py-2">{{ $resident->user?->email }}</td>
                                <td class="px-4 py-2">{{ $resident->contact_number ?? '—' }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.residents.show', $resident) }}" class="text-blue-600">View</a>
                                    <a href="{{ route('admin.residents.edit', $resident) }}" class="text-indigo-600">Edit</a>
                                    <form action="{{ route('admin.residents.destroy', $resident) }}" method="POST" class="inline" onsubmit="return confirm('Delete this resident?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No residents found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $residents->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
