<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['mailbox_request_id', 'token_hash', 'verified_at', 'expires_at'])]
class MailboxRequestVerification extends Model
{
    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function mailboxRequest(): BelongsTo
    {
        return $this->belongsTo(MailboxRequest::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
