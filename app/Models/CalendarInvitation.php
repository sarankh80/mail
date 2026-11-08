<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable(['calendar_event_id', 'calendar_attendee_id', 'ics_uid', 'sent_at', 'responded_at'])]
class CalendarInvitation extends Model
{
    protected static function booted(): void
    {
        static::creating(function (CalendarInvitation $invitation) {
            $invitation->ics_uid ??= (string) Str::uuid().'@'.config('company.domain');
        });
    }

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'responded_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(CalendarEvent::class, 'calendar_event_id');
    }

    public function attendee(): BelongsTo
    {
        return $this->belongsTo(CalendarAttendee::class, 'calendar_attendee_id');
    }
}
