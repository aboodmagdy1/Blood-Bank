<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'active-user', 'display_name' => "تفعيل المستخدمين"]);
        Permission::create(['name' => 'deactive-user', 'display_name' => "احباط المستخدمين"]);
    }
}
