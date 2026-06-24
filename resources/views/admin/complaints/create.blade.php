<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Add Complaint</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @include('partials.alerts')
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('admin.complaints.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf @include('admin.complaints._form', ['residents' => $residents])
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Save</button>
            </form>
        </div>
    </div></div>
</x-app-layout>
