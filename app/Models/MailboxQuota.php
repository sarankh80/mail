<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'mailbox_account_id', 'quota_mb', 'used_mb', 'inbox_mb',
    'sent_mb', 'trash_mb', 'attachments_mb', 'synced_at',
])]
class MailboxQuota extends Model
{
    protected function casts(): array
    {
        return [
            'synced_at' => 'datetime',
        ];
    }

    public function mailboxAccount(): BelongsTo
    {
        return $this->belongsTo(MailboxAccount::class);
    }

    public function remainingMb(): int
    {
        return max(0, $this->quota_mb - $this->used_mb);
    }
}
