<?php

use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\HearingController as AdminHearingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResidentController as AdminResidentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resident\ComplaintController as ResidentComplaintController;
use App\Http\Controllers\Resident\HearingController as ResidentHearingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.reports.index');
    }

    return redirect()->route('resident.complaints.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('residents', AdminResidentController::class);
    Route::resource('complaints', AdminComplaintController::class);
    Route::patch('complaints/{complaint}/status', [AdminComplaintController::class, 'updateStatus'])
        ->name('complaints.status');
    Route::resource('hearings', AdminHearingController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::middleware(['auth', 'verified', 'resident'])->prefix('resident')->name('resident.')->group(function () {
    Route::resource('complaints', ResidentComplaintController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('hearings', [ResidentHearingController::class, 'index'])->name('hearings.index');
});

require __DIR__.'/auth.php';
