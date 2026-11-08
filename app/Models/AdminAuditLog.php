<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['actor_user_id', 'action', 'target_type', 'target_id', 'previous_value', 'new_value', 'ip_address', 'success'])]
class AdminAuditLog extends Model
{
    protected function casts(): array
    {
        return [
            'previous_value' => 'array',
            'new_value' => 'array',
            'success' => 'boolean',
        ];
    }

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }
}
