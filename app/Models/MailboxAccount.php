<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[Fillable([
    'user_id', 'email', 'linux_username', 'type', 'status',
    'quota_mb', 'suspended_at', 'provisioned_at',
])]
class MailboxAccount extends Model
{
    use SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (MailboxAccount $mailbox) {
            $mailbox->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'suspended_at' => 'datetime',
            'provisioned_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(MailboxAlias::class);
    }

    public function quota(): HasOne
    {
        return $this->hasOne(MailboxQuota::class);
    }

    public function access(): HasMany
    {
        return $this->hasMany(MailboxAccess::class);
    }

    public function signatures(): HasMany
    {
        return $this->hasMany(MailboxSignature::class);
    }

    public function identities(): HasMany
    {
        return $this->hasMany(MailboxIdentity::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(EmailRule::class);
    }

    public function securitySettings(): HasOne
    {
        return $this->hasOne(EmailSecuritySetting::class);
    }

    public function quarantinedMessages(): HasMany
    {
        return $this->hasMany(EmailQuarantine::class);
    }

    public function isShared(): bool
    {
        return $this->type === 'shared';
    }
}
