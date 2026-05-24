<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Full system access and administration privileges',
                'is_active' => true,
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Management level access with oversight capabilities',
                'is_active' => true,
            ],
            [
                'name' => 'Store Keeper',
                'slug' => 'store-keeper',
                'description' => 'Manages inventory and warehouse operations',
                'is_active' => true,
            ],
            [
                'name' => 'Sales Staff',
                'slug' => 'sales-staff',
                'description' => 'Handles sales transactions and customer interactions',
                'is_active' => true,
            ],
            [
                'name' => 'Accountant',
                'slug' => 'accountant',
                'description' => 'Manages financial records and transactions',
                'is_active' => true,
            ],
            [
                'name' => 'Read-only Auditor',
                'slug' => 'read-only-auditor',
                'description' => 'View-only access for auditing purposes',
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
