<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ResidentController extends Controller
{
    public function index(): View
    {
        $residents = Resident::with('user')->latest()->paginate(10);

        return view('admin.residents.index', compact('residents'));
    }

    public function create(): View
    {
        return view('admin.residents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fullname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'birthdate' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => User::ROLE_RESIDENT,
            ]);

            Resident::create([
                'user_id' => $user->id,
                'fullname' => $validated['fullname'],
                'address' => $validated['address'],
                'contact_number' => $validated['contact_number'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'birthdate' => $validated['birthdate'] ?? null,
            ]);
        });

        return redirect()->route('admin.residents.index')
            ->with('success', 'Resident created successfully.');
    }

    public function show(Resident $resident): View
    {
        $resident->load(['user', 'complaints']);

        return view('admin.residents.show', compact('resident'));
    }

    public function edit(Resident $resident): View
    {
        $resident->load('user');

        return view('admin.residents.edit', compact('resident'));
    }

    public function update(Request $request, Resident $resident): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($resident->user_id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'fullname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'birthdate' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($validated, $resident) {
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (! empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $resident->user->update($userData);

            $resident->update([
                'fullname' => $validated['fullname'],
                'address' => $validated['address'],
                'contact_number' => $validated['contact_number'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'birthdate' => $validated['birthdate'] ?? null,
            ]);
        });

        return redirect()->route('admin.residents.index')
            ->with('success', 'Resident updated successfully.');
    }

    public function destroy(Resident $resident): RedirectResponse
    {
        $resident->user?->delete();

        return redirect()->route('admin.residents.index')
            ->with('success', 'Resident deleted successfully.');
    }
}
