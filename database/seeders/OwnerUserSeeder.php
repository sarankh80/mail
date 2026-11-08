<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OwnerUserSeeder extends Seeder
{
    /**
     * Creates the single permanent owner account from env config.
     * Generates a random password and prints it once if OWNER_PASSWORD is not set.
     */
    public function run(): void
    {
        $email = env('OWNER_EMAIL');
        $name = env('OWNER_NAME', 'Owner');

        if (! $email) {
            $this->command?->warn('OWNER_EMAIL not set in .env — skipping owner account creation.');

            return;
        }

        if (User::query()->where('is_owner', true)->exists()) {
            $this->command?->info('Owner account already exists — skipping.');

            return;
        }

        $password = env('OWNER_PASSWORD');
        $generated = false;

        if (! $password) {
            $password = Str::password(20);
            $generated = true;
        }

        $owner = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_owner' => true,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $ownerRole = Role::query()->where('slug', 'owner')->firstOrFail();

        RoleUser::query()->updateOrCreate(
            ['user_id' => $owner->id],
            ['role_id' => $ownerRole->id]
        );

        if ($generated) {
            $this->command?->warn("Owner account created: {$email} / {$password} — store this password securely, it will not be shown again.");
        } else {
            $this->command?->info("Owner account created: {$email}");
        }
    }
}
