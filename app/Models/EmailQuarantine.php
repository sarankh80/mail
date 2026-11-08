<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable([
    'mailbox_account_id', 'sender', 'recipient', 'subject', 'received_at',
    'detection_reason', 'risk_score', 'storage_path', 'retention_until', 'status',
])]
class EmailQuarantine extends Model
{
    protected $table = 'email_quarantine';

    protected static function booted(): void
    {
        static::creating(function (EmailQuarantine $item) {
            $item->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'received_at' => 'datetime',
            'retention_until' => 'date',
            'risk_score' => 'decimal:2',
        ];
    }

    public function mailboxAccount(): BelongsTo
    {
        return $this->belongsTo(MailboxAccount::class);
    }

    public function isExpired(): bool
    {
        return $this->retention_until->isPast();
    }
}
