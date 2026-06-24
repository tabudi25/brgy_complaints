@php use App\Models\Complaint; @endphp
<div>
    <label class="block font-medium">Resident</label>
    <select name="resident_id" class="mt-1 w-full rounded border-gray-300" required>
        @foreach ($residents as $resident)
            <option value="{{ $resident->id }}" @selected(old('resident_id', $complaint->resident_id ?? '') == $resident->id)>
                {{ $resident->fullname }} ({{ $resident->user?->email }})
            </option>
        @endforeach
    </select>
</div>
<div>
    <label class="block font-medium">Complaint Type</label>
    <input type="text" name="complaint_type" value="{{ old('complaint_type', $complaint->complaint_type ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Respondent Name</label>
    <input type="text" name="respondent_name" value="{{ old('respondent_name', $complaint->respondent_name ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Description</label>
    <textarea name="description" rows="4" class="mt-1 w-full rounded border-gray-300" required>{{ old('description', $complaint->description ?? '') }}</textarea>
</div>
<div>
    <label class="block font-medium">Evidence File</label>
    <input type="file" name="evidence_file" class="mt-1 w-full">
    @if (!empty($complaint?->evidence_file))
        <p class="mt-1 text-sm text-gray-600">Current: <a href="{{ Storage::url($complaint->evidence_file) }}" target="_blank" class="text-blue-600">View file</a></p>
    @endif
</div>
<div>
    <label class="block font-medium">Status</label>
    <select name="status" class="mt-1 w-full rounded border-gray-300" required>
        @foreach (Complaint::STATUSES as $status)
            <option value="{{ $status }}" @selected(old('status', $complaint->status ?? Complaint::STATUS_PENDING) === $status)>{{ $status }}</option>
        @endforeach
    </select>
</div>
