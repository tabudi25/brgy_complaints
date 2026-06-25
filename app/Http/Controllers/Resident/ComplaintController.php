<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use App\Notifications\NewComplaintFiled;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    public function index(): View
    {
        $resident = auth()->user()->resident;

        $complaints = $resident
            ? $resident->complaints()->with('hearing')->latest()->paginate(10)
            : collect();

        return view('resident.complaints.index', compact('complaints', 'resident'));
    }

    public function create(): View
    {
        return view('resident.complaints.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $resident = auth()->user()->resident;

        if (! $resident) {
            return back()->with('error', 'Please complete your resident profile first.');
        }

        $validated = $request->validate([
            'complaint_type' => ['required', 'string', 'max:255'],
            'respondent_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'evidence_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ]);

        if ($request->hasFile('evidence_file')) {
            $validated['evidence_file'] = $request->file('evidence_file')->store('evidence', 'public');
        }

        $complaint = $resident->complaints()->create([
            ...$validated,
            'status' => Complaint::STATUS_PENDING,
        ]);

        $admins = User::where('role', User::ROLE_ADMIN)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewComplaintFiled($complaint));
        }

        return redirect()->route('resident.complaints.index')
            ->with('success', 'Complaint submitted successfully.');
    }

    public function show(Complaint $complaint): View
    {
        $this->authorizeComplaint($complaint);

        $complaint->load('hearing');

        return view('resident.complaints.show', compact('complaint'));
    }

    protected function authorizeComplaint(Complaint $complaint): void
    {
        if ($complaint->resident_id !== auth()->user()->resident?->id) {
            abort(403, 'Unauthorized access to this complaint.');
        }
    }
}
