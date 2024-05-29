<?php

namespace Database\Seeders;

use App\Enums\Staff_Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_names = Staff_Roles::values();

        foreach ($role_names as $role_name) {
            \App\Models\StaffRole::query()->firstOrCreate([
                'name' => $role_name,
                'description' => 'Staff role: ' . $role_name,
            ]);
        }
    }
}
