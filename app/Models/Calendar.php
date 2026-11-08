<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['owner_user_id', 'name', 'color', 'is_shared'])]
class Calendar extends Model
{
    protected $table = 'calendar_calendars';

    protected static function booted(): void
    {
        static::creating(function (Calendar $calendar) {
            $calendar->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'is_shared' => 'boolean',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(CalendarEvent::class, 'calendar_id');
    }
}
