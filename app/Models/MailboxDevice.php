<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'user_id', 'device_name', 'browser', 'platform', 'user_agent_hash',
    'is_trusted', 'first_seen_at', 'last_seen_at',
])]
class MailboxDevice extends Model
{
    protected static function booted(): void
    {
        static::creating(function (MailboxDevice $device) {
            $device->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'is_trusted' => 'boolean',
            'first_seen_at' => 'datetime',
            'last_seen_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(MailboxSession::class);
    }
}
