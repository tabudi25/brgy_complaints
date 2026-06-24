<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Complaint extends Model
{
    public const STATUS_PENDING = 'Pending';

    public const STATUS_UNDER_REVIEW = 'Under Review';

    public const STATUS_SCHEDULED = 'Scheduled';

    public const STATUS_RESOLVED = 'Resolved';

    public const STATUS_DISMISSED = 'Dismissed';

    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_UNDER_REVIEW,
        self::STATUS_SCHEDULED,
        self::STATUS_RESOLVED,
        self::STATUS_DISMISSED,
    ];

    protected $fillable = [
        'resident_id',
        'complaint_type',
        'respondent_name',
        'description',
        'evidence_file',
        'status',
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    public function hearing(): HasOne
    {
        return $this->hasOne(Hearing::class);
    }
}
