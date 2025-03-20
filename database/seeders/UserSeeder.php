<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            ]
        );
        $admin->assignRole('admin');

        // Create a default Customer User
        $customer = User::firstOrCreate(
            ['email' => 'customer@example.com'], // Change email as needed
            [
                'name' => 'Customer User',
                'password' => Hash::make('password'), // Change password as needed
            ]
        );
        $customer->assignRole('customer');

        // Create multiple dummy customer accounts
        for ($i = 1; $i <= 5; $i++) {
            $dummyCustomer = User::create([
                'name' => 'Customer ' . $i,
                'email' => 'customer' . $i . '@example.com',
                'password' => Hash::make('password'), // Default password
            ]);
            $dummyCustomer->assignRole('customer');
        }

        echo "Admin and Customer users seeded successfully!\n";
    }
}
