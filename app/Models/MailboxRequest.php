<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'full_name', 'desired_email', 'personal_email', 'department',
    'reason', 'status', 'reviewed_by', 'rejection_reason', 'reviewed_at',
    'provisioned_mailbox_account_id',
])]
class MailboxRequest extends Model
{
    protected static function booted(): void
    {
        static::creating(function (MailboxRequest $request) {
            $request->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
        ];
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function provisionedMailboxAccount(): BelongsTo
    {
        return $this->belongsTo(MailboxAccount::class, 'provisioned_mailbox_account_id');
    }

    public function verifications(): HasMany
    {
        return $this->hasMany(MailboxRequestVerification::class);
    }
}
