<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'mailbox_account_id', 'name', 'body_html', 'body_text', 'is_default'])]
class MailboxSignature extends Model
{
    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mailboxAccount(): BelongsTo
    {
        return $this->belongsTo(MailboxAccount::class);
    }
}
