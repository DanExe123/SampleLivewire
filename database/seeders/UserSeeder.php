<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'customer']);

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Change email as needed
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Change password as needed
                'role' => 'admin',
                
            ]
        );
        $admin->assignRole('admin');

        // Create Customer User
        $customer = User::firstOrCreate(
            ['email' => 'customer@example.com'], // Change email as needed
            [
                'name' => 'Customer User',
                'password' => Hash::make('password'), // Change password as needed
                'role' => 'customer',
             
            ]
        );
        $customer->assignRole('customer');

        echo " Admin and Customer users seeded successfully!\n";
    }
}
