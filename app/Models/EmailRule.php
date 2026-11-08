<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'mailbox_account_id', 'name', 'conditions', 'actions', 'priority',
    'enabled', 'is_vacation_responder', 'vacation_subject', 'vacation_body',
    'vacation_start_date', 'vacation_end_date',
])]
class EmailRule extends Model
{
    protected function casts(): array
    {
        return [
            'conditions' => 'array',
            'actions' => 'array',
            'enabled' => 'boolean',
            'is_vacation_responder' => 'boolean',
            'vacation_start_date' => 'date',
            'vacation_end_date' => 'date',
        ];
    }

    public function mailboxAccount(): BelongsTo
    {
        return $this->belongsTo(MailboxAccount::class);
    }

    public function isVacationActive(): bool
    {
        if (! $this->is_vacation_responder || ! $this->enabled) {
            return false;
        }

        $today = now()->toDateString();

        return (! $this->vacation_start_date || $this->vacation_start_date->toDateString() <= $today)
            && (! $this->vacation_end_date || $this->vacation_end_date->toDateString() >= $today);
    }
}
