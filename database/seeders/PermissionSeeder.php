<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[
            \Spatie\Permission\PermissionRegistrar::class
        ]->forgetCachedPermissions();

        $models = [
            "category",
            "cinema",
            "cinema_room",
            "movie",
            "movie_session",
            "payment_history",
            "ticket",
            "user",
        ];

        // Default CRUD permissions
        foreach ($models as $model) {
            Permission::firstOrCreate(["name" => "create " . $model, "guard_name" => "web"]);
            Permission::firstOrCreate(["name" => "read " . $model, "guard_name" => "web"]);
            Permission::firstOrCreate(["name" => "update " . $model, "guard_name" => "web"]);
            Permission::firstOrCreate(["name" => "delete " . $model, "guard_name" => "web"]);
        }

        // Customer specific permissions
        Permission::firstOrCreate(["name" => "read own tickets", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "print own tickets", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "access customer panel", "guard_name" => "web"]);

        // Back office access permission
        Permission::firstOrCreate(["name" => "access admin panel", "guard_name" => "web"]);

        // Management permissions for sidebar links
        Permission::firstOrCreate(["name" => "manage_users", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "manage_movies", "guard_name" => "web"]);
        Permission::firstOrCreate(["name" => "manage_tickets", "guard_name" => "web"]);
        // Note: manage_categories, manage_cinemas etc. could also be added if needed for other sections

        $superAdminRole = Role::findByName("Super Admin", "web");
        // Super Admin gets all permissions by default due to the line below,
        // but explicitly assigning management perms is fine if Permission::all() changes.
        $superAdminRole->givePermissionTo(Permission::all()); // This already covers it.

        $adminRole = Role::findByName("Admin", "web");
        $adminRole->givePermissionTo([
            "create category",
            "read category",
            "update category",
            "delete category",
            "create cinema",
            "read cinema",
            "update cinema",
            "delete cinema",
            "create cinema_room",
            "read cinema_room",
            "update cinema_room",
            "delete cinema_room",
            "create movie",
            "read movie",
            "update movie",
            "delete movie",
            "create movie_session",
            "read movie_session",
            "update movie_session",
            "delete movie_session",
            "create payment_history",
            "read payment_history",
            "update payment_history",
            "delete payment_history",
            "create ticket",
            "read ticket",
            "update ticket",
            "delete ticket",
            "access admin panel", // Admins should access admin panel
            // Assign new management permissions to Admin
            "manage_users",
            "manage_movies",
            "manage_tickets"
        ]);

        $moderatorRole = Role::findByName("Moderator", "web");
        $moderatorRole->givePermissionTo([
            "read movie",
            "read movie_session",
            "read ticket",
            "access admin panel", // Moderators should access admin panel
            // Moderators might only manage movies or specific things, adjust as needed
            // For now, let's say they can see the movie management link
            "manage_movies",
            // "read user" // Example if they need to see users but not manage them
        ]);

        // Super Admin already has all permissions via givePermissionTo(Permission::all())
        // If that line is removed or changed, ensure Super Admin gets these:
        // $superAdminRole->givePermissionTo(["manage_users", "manage_movies", "manage_tickets"]);


        $customerRole = Role::findByName("Customer", "web");
        $customerRole->givePermissionTo([
            "read own tickets",
            "print own tickets",
            "access customer panel"
        ]);

        // Assign roles to existing or new users
        // Super Admin User
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin User',
                'password' => bcrypt('password123'),
            ]
        );
        $superAdminUser->assignRole($superAdminRole);

        // Admin User
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password123'),
            ]
        );
        $adminUser->assignRole($adminRole);


        // Moderator User (formerly worker)
        $moderatorUser = User::firstOrCreate(
            ['email' => 'moderator@example.com'], // Changed from worker@example.com for clarity
            [
                'name' => 'Moderator User',
                'password' => bcrypt('password123'),
            ]
        );
        $moderatorUser->assignRole($moderatorRole);

        // Example Customer User
        $customerUser = User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer User',
                'password' => bcrypt('password123'),
            ]
        );
        $customerUser->assignRole($customerRole);
    }
}
