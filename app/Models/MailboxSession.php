<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'mailbox_device_id', 'session_id', 'ip_address', 'login_at', 'last_activity_at', 'revoked_at'])]
class MailboxSession extends Model
{
    protected function casts(): array
    {
        return [
            'login_at' => 'datetime',
            'last_activity_at' => 'datetime',
            'revoked_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(MailboxDevice::class, 'mailbox_device_id');
    }

    public function isActive(): bool
    {
        return is_null($this->revoked_at);
    }
}
