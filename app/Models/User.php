<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Passkeys\Contracts\PasskeyUser;
use Laravel\Passkeys\PasskeyAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'])]
class User extends Authenticatable implements MustVerifyEmail, PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            $user->uuid ??= (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'suspended_at' => 'datetime',
            'password' => 'hashed',
            'is_owner' => 'boolean',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function role(): HasOne
    {
        return $this->hasOne(RoleUser::class)->with('role');
    }

    public function mailboxAccounts(): HasMany
    {
        return $this->hasMany(MailboxAccount::class);
    }

    public function mailboxAccess(): HasMany
    {
        return $this->hasMany(MailboxAccess::class);
    }

    public function devices(): HasMany
    {
        return $this->hasMany(MailboxDevice::class);
    }

    public function mailboxSessions(): HasMany
    {
        return $this->hasMany(MailboxSession::class);
    }

    public function signatures(): HasMany
    {
        return $this->hasMany(MailboxSignature::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'owner_user_id');
    }

    public function contactGroups(): HasMany
    {
        return $this->hasMany(ContactGroup::class, 'owner_user_id');
    }

    public function calendars(): HasMany
    {
        return $this->hasMany(Calendar::class, 'owner_user_id');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AdminAuditLog::class, 'actor_user_id');
    }

    public function currentRole(): ?Role
    {
        return $this->role?->role;
    }

    public function hasRole(string $slug): bool
    {
        return $this->currentRole()?->slug === $slug;
    }

    public function hasPermission(string $slug): bool
    {
        if ($this->is_owner) {
            return true;
        }

        return $this->currentRole()?->permissions->contains('slug', $slug) ?? false;
    }

    public function isOwner(): bool
    {
        return (bool) $this->is_owner;
    }
}
