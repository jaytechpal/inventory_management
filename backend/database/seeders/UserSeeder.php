<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $admin->roles()->attach(Role::where('slug', 'admin')->first());

        // Create manager user
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567891',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $manager->roles()->attach(Role::where('slug', 'manager')->first());

        // Create store keeper user
        $storeKeeper = User::create([
            'name' => 'Store Keeper User',
            'email' => 'storekeeper@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567892',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $storeKeeper->roles()->attach(Role::where('slug', 'store-keeper')->first());

        // Create sales staff user
        $salesStaff = User::create([
            'name' => 'Sales Staff User',
            'email' => 'sales@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567893',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $salesStaff->roles()->attach(Role::where('slug', 'sales-staff')->first());

        // Create accountant user
        $accountant = User::create([
            'name' => 'Accountant User',
            'email' => 'accountant@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567894',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $accountant->roles()->attach(Role::where('slug', 'accountant')->first());

        // Create read-only auditor user
        $auditor = User::create([
            'name' => 'Auditor User',
            'email' => 'auditor@inventory.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567895',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $auditor->roles()->attach(Role::where('slug', 'read-only-auditor')->first());
    }
}
