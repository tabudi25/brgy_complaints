<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Submit Complaint</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @include('partials.alerts')
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('resident.complaints.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div><label class="block font-medium">Complaint Type</label><input type="text" name="complaint_type" value="{{ old('complaint_type') }}" class="mt-1 w-full rounded border-gray-300" required></div>
                <div><label class="block font-medium">Respondent Name</label><input type="text" name="respondent_name" value="{{ old('respondent_name') }}" class="mt-1 w-full rounded border-gray-300" required></div>
                <div><label class="block font-medium">Description</label><textarea name="description" rows="4" class="mt-1 w-full rounded border-gray-300" required>{{ old('description') }}</textarea></div>
                <div><label class="block font-medium">Evidence (jpg, png, pdf — max 5MB)</label><input type="file" name="evidence_file" class="mt-1 w-full"></div>
                <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">Submit</button>
            </form>
        </div>
    </div></div>
</x-app-layout>
