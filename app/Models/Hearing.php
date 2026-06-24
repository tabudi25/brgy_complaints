<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hearing extends Model
{
    public const STATUS_SCHEDULED = 'Scheduled';

    public const STATUS_COMPLETED = 'Completed';

    public const STATUS_CANCELLED = 'Cancelled';

    public const STATUS_POSTPONED = 'Postponed';

    public const STATUSES = [
        self::STATUS_SCHEDULED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
        self::STATUS_POSTPONED,
    ];

    protected $fillable = [
        'complaint_id',
        'hearing_date',
        'hearing_time',
        'remarks',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'hearing_date' => 'date',
        ];
    }

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }
}
