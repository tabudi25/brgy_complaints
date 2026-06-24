<div>
    <label class="block font-medium">Account Name</label>
    <input type="text" name="name" value="{{ old('name', $resident->user->name ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Email</label>
    <input type="email" name="email" value="{{ old('email', $resident->user->email ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Password {{ isset($resident) ? '(leave blank to keep)' : '' }}</label>
    <input type="password" name="password" class="mt-1 w-full rounded border-gray-300" {{ isset($resident) ? '' : 'required' }}>
    <input type="password" name="password_confirmation" class="mt-2 w-full rounded border-gray-300" placeholder="Confirm password">
</div>
<div>
    <label class="block font-medium">Full Name</label>
    <input type="text" name="fullname" value="{{ old('fullname', $resident->fullname ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Address</label>
    <input type="text" name="address" value="{{ old('address', $resident->address ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
</div>
<div>
    <label class="block font-medium">Contact Number</label>
    <input type="text" name="contact_number" value="{{ old('contact_number', $resident->contact_number ?? '') }}" class="mt-1 w-full rounded border-gray-300">
</div>
<div>
    <label class="block font-medium">Gender</label>
    <select name="gender" class="mt-1 w-full rounded border-gray-300">
        <option value="">—</option>
        @foreach (['male', 'female', 'other'] as $gender)
            <option value="{{ $gender }}" @selected(old('gender', $resident->gender ?? '') === $gender)>{{ ucfirst($gender) }}</option>
        @endforeach
    </select>
</div>
<div>
    <label class="block font-medium">Birthdate</label>
    <input type="date" name="birthdate" value="{{ old('birthdate', isset($resident) && $resident->birthdate ? $resident->birthdate->format('Y-m-d') : '') }}" class="mt-1 w-full rounded border-gray-300">
</div>
