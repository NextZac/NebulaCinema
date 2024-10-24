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

        foreach ($models as $model) {
            Permission::create(["name" => "create " . $model]);
            Permission::create(["name" => "read " . $model]);
            Permission::create(["name" => "update " . $model]);
            Permission::create(["name" => "delete " . $model]);
        }

        $superAdminRole = Role::findByName("Super Admin");
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::findByName("Admin");
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
        ]);

        $workerRole = Role::findByName("Moderator");
        $workerRole->givePermissionTo([
            "read movie",
            "read movie_session",
            "read ticket",
        ]);

        $superAdmin = User::create([
            "name" => "Super Admin User",
            "email" => "superadmin@example.com",
            "password" => bcrypt("password123"),
        ]);
        $superAdmin->assignRole("Super Admin");

        $worker = User::create([
            "name" => "Worker User",
            "email" => "worker@example.com",
            "password" => bcrypt("password123"),
        ]);
        $worker->assignRole("Moderator");
    }
}
