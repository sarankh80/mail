<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Permission slug => human-readable name.
     */
    private const PERMISSIONS = [
        'manage_users' => 'Manage users',
        'manage_roles' => 'Manage roles',
        'manage_mailboxes' => 'Manage mailboxes',
        'manage_shared_mailboxes' => 'Manage shared mailboxes',
        'manage_security_settings' => 'Manage security settings',
        'manage_quarantine' => 'Manage quarantine',
        'manage_allow_block_lists' => 'Manage allow/block lists',
        'approve_mailbox_requests' => 'Approve or reject address requests',
        'reset_user_passwords' => 'Reset forgotten passwords via secure links',
        'view_audit_logs' => 'View admin audit logs',
        'manage_server_settings' => 'Manage server and infrastructure settings',
        'manage_own_settings' => 'Manage personal mailbox settings',
    ];

    /**
     * Role slug => [name, description, permission slugs].
     */
    private const ROLES = [
        'owner' => [
            'name' => 'Owner',
            'description' => 'Permanent highest privilege. Cannot be removed, demoted, or suspended.',
            'permissions' => [
                'manage_users', 'manage_roles', 'manage_mailboxes', 'manage_shared_mailboxes',
                'manage_security_settings', 'manage_quarantine', 'manage_allow_block_lists',
                'approve_mailbox_requests', 'reset_user_passwords', 'view_audit_logs',
                'manage_server_settings', 'manage_own_settings',
            ],
        ],
        'administrator' => [
            'name' => 'Administrator',
            'description' => 'Full administration of mailboxes, users, and security.',
            'permissions' => [
                'manage_users', 'manage_roles', 'manage_mailboxes', 'manage_shared_mailboxes',
                'manage_security_settings', 'manage_quarantine', 'manage_allow_block_lists',
                'approve_mailbox_requests', 'reset_user_passwords', 'view_audit_logs',
                'manage_server_settings', 'manage_own_settings',
            ],
        ],
        'moderator' => [
            'name' => 'Moderator',
            'description' => 'Approves address requests and resets passwords via secure reset links. Cannot modify roles or server configuration.',
            'permissions' => [
                'approve_mailbox_requests', 'reset_user_passwords', 'manage_own_settings',
            ],
        ],
        'staff' => [
            'name' => 'Staff',
            'description' => 'Accesses authorized mailboxes and manages personal settings.',
            'permissions' => [
                'manage_own_settings',
            ],
        ],
    ];

    public function run(): void
    {
        $permissions = collect(self::PERMISSIONS)->map(
            fn (string $name, string $slug) => Permission::query()->updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            )
        );

        foreach (self::ROLES as $slug => $definition) {
            $role = Role::query()->updateOrCreate(
                ['slug' => $slug],
                ['name' => $definition['name'], 'description' => $definition['description'], 'is_system' => true]
            );

            $permissionIds = $permissions->only($definition['permissions'])->pluck('id');
            $role->permissions()->sync($permissionIds);
        }
    }
}
