<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Resident;
use App\Notifications\ComplaintStatusChanged;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(): View
    {
        $complaints = Complaint::with(['resident.user', 'hearing'])
            ->latest()
            ->paginate(10);

        return view('admin.complaints.index', compact('complaints'));
    }

    public function create(): View
    {
        $residents = Resident::with('user')->orderBy('fullname')->get();

        return view('admin.complaints.create', compact('residents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'resident_id' => ['required', 'exists:residents,id'],
            'complaint_type' => ['required', 'string', 'max:255'],
            'respondent_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'evidence_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'status' => ['required', Rule::in(Complaint::STATUSES)],
        ]);

        if ($request->hasFile('evidence_file')) {
            $validated['evidence_file'] = $request->file('evidence_file')->store('evidence', 'public');
        }

        Complaint::create($validated);

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Complaint created successfully.');
    }

    public function show(Complaint $complaint): View
    {
        $complaint->load(['resident.user', 'hearing']);

        return view('admin.complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint): View
    {
        $complaint->load('resident');
        $residents = Resident::with('user')->orderBy('fullname')->get();

        return view('admin.complaints.edit', compact('complaint', 'residents'));
    }

    public function update(Request $request, Complaint $complaint): RedirectResponse
    {
        $validated = $request->validate([
            'resident_id' => ['required', 'exists:residents,id'],
            'complaint_type' => ['required', 'string', 'max:255'],
            'respondent_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'evidence_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'status' => ['required', Rule::in(Complaint::STATUSES)],
        ]);

        $oldStatus = $complaint->status;

        if ($request->hasFile('evidence_file')) {
            if ($complaint->evidence_file) {
                Storage::disk('public')->delete($complaint->evidence_file);
            }

            $validated['evidence_file'] = $request->file('evidence_file')->store('evidence', 'public');
        }

        $complaint->update($validated);

        if ($oldStatus !== $complaint->status) {
            $complaint->resident->user->notify(new ComplaintStatusChanged($complaint, $oldStatus));
        }

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Complaint updated successfully.');
    }

    public function destroy(Complaint $complaint): RedirectResponse
    {
        if ($complaint->evidence_file) {
            Storage::disk('public')->delete($complaint->evidence_file);
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Complaint deleted successfully.');
    }

    public function updateStatus(Request $request, Complaint $complaint): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(Complaint::STATUSES)],
        ]);

        $oldStatus = $complaint->status;
        $complaint->update(['status' => $validated['status']]);

        if ($oldStatus !== $complaint->status) {
            $complaint->resident->user->notify(new ComplaintStatusChanged($complaint, $oldStatus));
        }

        return back()->with('success', 'Complaint status updated successfully.');
    }
}
