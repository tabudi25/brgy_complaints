@php use App\Models\Hearing; @endphp
<div>
    <label class="block font-medium">Complaint</label>
    <select name="complaint_id" class="mt-1 w-full rounded border-gray-300" required>
        @foreach ($complaints as $complaint)
            <option value="{{ $complaint->id }}" @selected(old('complaint_id', $hearing->complaint_id ?? '') == $complaint->id)>
                #{{ $complaint->id }} — {{ $complaint->complaint_type }} ({{ $complaint->resident->fullname }})
            </option>
        @endforeach
    </select>
</div>
<div>
    <label class="block font-medium">Hearing Date</label>
    <input type="date" name="hearing_date" value="{{ old('hearing_date', isset($hearing) ? $hearing->hearing_date->format('Y-m-d') : '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Hearing Time</label>
    <input type="time" name="hearing_time" value="{{ old('hearing_time', $hearing->hearing_time ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Remarks</label>
    <textarea name="remarks" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('remarks', $hearing->remarks ?? '') }}</textarea>
</div>
<div>
    <label class="block font-medium">Status</label>
    <select name="status" class="mt-1 w-full rounded border-gray-300" required>
        @foreach (Hearing::STATUSES as $status)
            <option value="{{ $status }}" @selected(old('status', $hearing->status ?? Hearing::STATUS_SCHEDULED) === $status)>{{ $status }}</option>
        @endforeach
    </select>
</div>
