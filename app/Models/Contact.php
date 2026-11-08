<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

#[Fillable([
    'owner_user_id', 'full_name', 'email', 'phone', 'company',
    'job_title', 'department', 'notes', 'photo_path',
])]
class Contact extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Contact $contact) {
            $contact->uuid ??= (string) Str::uuid();
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(ContactGroup::class, 'contact_group_members');
    }

    public function isCompanyDirectoryEntry(): bool
    {
        return is_null($this->owner_user_id);
    }
}
