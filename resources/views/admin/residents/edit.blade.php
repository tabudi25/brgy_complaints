<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Resident</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @include('partials.alerts')
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.residents.update', $resident) }}" class="space-y-4">
                    @csrf @method('PUT')
                    @include('admin.residents._form', ['resident' => $resident])
                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
