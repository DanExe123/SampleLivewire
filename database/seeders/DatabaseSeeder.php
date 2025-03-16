<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Ensure roles exist with the guard_name "web"
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        // Create or update the admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin123@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        // Assign Spatie Role if not already assigned
        if (!$admin->hasRole('admin')) {
            $admin->syncRoles([$adminRole]); // Removes previous roles & assigns "admin"
        }

        // 🔹 Update the role column in users table manually
        $admin->update(['role' => 'admin']); 




        // Create or update the customer user
        $customer = User::updateOrCreate(
            ['email' => 'customer1233@example.com'],
            [
                'name' => 'Customer User',
                'password' => Hash::make('password'),
            ]
        );

         // Assign Spatie Role if not already assigned
         if (!$customer->hasRole('customer')) {
            $customer->syncRoles([$customerRole]); // Removes previous roles & assigns "customer"
        }

        // 🔹 Update the role column in users table manually
        $customer->update(['role' => 'customer']);

        //  Add "Add to Cart" permission
        $addToCartPermission = Permission::firstOrCreate(['name' => 'add to cart', 'guard_name' => 'web']);

        //  Assign "Add to Cart" permission to the customer role
        if (!$customerRole->hasPermissionTo('add to cart')) {
            $customerRole->givePermissionTo($addToCartPermission);
        }
        echo "Admin and Customer users seeded successfully!\n";
    }
}
