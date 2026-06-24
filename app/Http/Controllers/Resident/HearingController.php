<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Hearing;
use Illuminate\View\View;

class HearingController extends Controller
{
    public function index(): View
    {
        $resident = auth()->user()->resident;

        $hearings = $resident
            ? Hearing::with('complaint')
                ->whereHas('complaint', fn ($query) => $query->where('resident_id', $resident->id))
                ->orderBy('hearing_date')
                ->orderBy('hearing_time')
                ->paginate(10)
            : collect();

        return view('resident.hearings.index', compact('hearings', 'resident'));
    }
}
