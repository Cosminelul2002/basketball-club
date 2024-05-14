<?php

namespace Database\Seeders;

use App\Enums\Permission;
use Codestage\Authorization\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Role::query()->firstOrCreate([
            'key' => 'super_admin',
            'name' => 'Super Administrator'
        ]);

        $admin = Role::query()->firstOrCreate([
            'key' => 'admin',
            'name' => 'Administrator'
        ]);

        $user = Role::query()->firstOrCreate([
            'key' => 'user',
            'name' => 'Utilizator'
        ]);

        $user = Role::query()->firstOrCreate([
            'key' => 'parent',
            'name' => 'Părinte'
        ]);

        $player = Role::query()->firstOrCreate([
            'key' => 'player',
            'name' => 'Jucator'
        ]);

        foreach (Permission::cases() as $permission) {
            $admin->permissions()->firstOrCreate([
                'permission' => $permission
            ]);
        }
    }
}
