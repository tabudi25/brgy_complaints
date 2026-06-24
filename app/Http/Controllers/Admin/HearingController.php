<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Hearing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HearingController extends Controller
{
    public function index(): View
    {
        $hearings = Hearing::with(['complaint.resident.user'])
            ->latest()
            ->paginate(10);

        return view('admin.hearings.index', compact('hearings'));
    }

    public function create(): View
    {
        $complaints = Complaint::with('resident')
            ->whereDoesntHave('hearing')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.hearings.create', compact('complaints'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'complaint_id' => ['required', 'exists:complaints,id', 'unique:hearings,complaint_id'],
            'hearing_date' => ['required', 'date', 'after_or_equal:today'],
            'hearing_time' => ['required', 'date_format:H:i'],
            'remarks' => ['nullable', 'string'],
            'status' => ['required', Rule::in(Hearing::STATUSES)],
        ]);

        $hearing = Hearing::create($validated);

        $hearing->complaint->update(['status' => Complaint::STATUS_SCHEDULED]);

        return redirect()->route('admin.hearings.index')
            ->with('success', 'Hearing scheduled successfully.');
    }

    public function show(Hearing $hearing): View
    {
        $hearing->load(['complaint.resident.user']);

        return view('admin.hearings.show', compact('hearing'));
    }

    public function edit(Hearing $hearing): View
    {
        $hearing->load('complaint.resident');
        $complaints = Complaint::with('resident')->orderByDesc('created_at')->get();

        return view('admin.hearings.edit', compact('hearing', 'complaints'));
    }

    public function update(Request $request, Hearing $hearing): RedirectResponse
    {
        $validated = $request->validate([
            'complaint_id' => ['required', 'exists:complaints,id', Rule::unique('hearings', 'complaint_id')->ignore($hearing->id)],
            'hearing_date' => ['required', 'date'],
            'hearing_time' => ['required', 'date_format:H:i'],
            'remarks' => ['nullable', 'string'],
            'status' => ['required', Rule::in(Hearing::STATUSES)],
        ]);

        $hearing->update($validated);

        return redirect()->route('admin.hearings.index')
            ->with('success', 'Hearing updated successfully.');
    }

    public function destroy(Hearing $hearing): RedirectResponse
    {
        $hearing->delete();

        return redirect()->route('admin.hearings.index')
            ->with('success', 'Hearing deleted successfully.');
    }
}
