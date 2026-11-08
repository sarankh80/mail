<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['mailbox_account_id', 'alias_email'])]
class MailboxAlias extends Model
{
    public function mailboxAccount(): BelongsTo
    {
        return $this->belongsTo(MailboxAccount::class);
    }
}
