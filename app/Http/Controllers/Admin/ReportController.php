<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Hearing;
use App\Models\Resident;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_residents' => Resident::count(),
            'total_complaints' => Complaint::count(),
            'pending_complaints' => Complaint::where('status', Complaint::STATUS_PENDING)->count(),
            'under_review_complaints' => Complaint::where('status', Complaint::STATUS_UNDER_REVIEW)->count(),
            'scheduled_complaints' => Complaint::where('status', Complaint::STATUS_SCHEDULED)->count(),
            'resolved_complaints' => Complaint::where('status', Complaint::STATUS_RESOLVED)->count(),
            'dismissed_complaints' => Complaint::where('status', Complaint::STATUS_DISMISSED)->count(),
            'upcoming_hearings' => Hearing::where('status', Hearing::STATUS_SCHEDULED)
                ->where('hearing_date', '>=', now()->toDateString())
                ->count(),
        ];

        $complaintsByType = Complaint::query()
            ->selectRaw('complaint_type, count(*) as total')
            ->groupBy('complaint_type')
            ->orderByDesc('total')
            ->get();

        $recentComplaints = Complaint::with('resident.user')
            ->latest()
            ->limit(10)
            ->get();

        $upcomingHearings = Hearing::with(['complaint.resident'])
            ->where('status', Hearing::STATUS_SCHEDULED)
            ->where('hearing_date', '>=', now()->toDateString())
            ->orderBy('hearing_date')
            ->orderBy('hearing_time')
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact(
            'stats',
            'complaintsByType',
            'recentComplaints',
            'upcomingHearings'
        ));
    }
}
