<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'calendar_id', 'created_by', 'title', 'description', 'location',
    'starts_at', 'ends_at', 'all_day', 'timezone', 'rrule',
])]
class CalendarEvent extends Model
{
    protected static function booted(): void
    {
        static::creating(function (CalendarEvent $event) {
            $event->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'all_day' => 'boolean',
        ];
    }

    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(CalendarAttendee::class);
    }

    public function isRecurring(): bool
    {
        return ! is_null($this->rrule);
    }
}
