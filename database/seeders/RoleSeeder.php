<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            "name" => "Super Admin",
            "display_name" => "Super Administraator",
            "guard_name" => "web",
        ]);
        Role::create(["name" => "Admin", "display_name" => "Administraator", "guard_name" => "web"]);
        Role::create(["name" => "Moderator", "display_name" => "Moderaator", "guard_name" => "web"]);
        Role::create(["name" => "Customer", "display_name" => "Klient", "guard_name" => "web"]);
    }
}
