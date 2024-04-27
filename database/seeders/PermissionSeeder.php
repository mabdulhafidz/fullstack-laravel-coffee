<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        // Permission::create(['name' => 'list categories']);
        // Permission::create(['name' => 'view categories']);
        // Permission::create(['name' => 'create categories']);
        // Permission::create(['name' => 'update categories']);
        // Permission::create(['name' => 'delete categories']);

        // Permission::create(['name' => 'list customers']);
        // Permission::create(['name' => 'view customers']);
        // Permission::create(['name' => 'create customers']);
        // Permission::create(['name' => 'update customers']);
        // Permission::create(['name' => 'delete customers']);

        // Permission::create(['name' => 'list resersvation']);
        // Permission::create(['name' => 'view resersvation']);
        // Permission::create(['name' => 'create resersvation']);
        // Permission::create(['name' => 'update resersvation']);
        // Permission::create(['name' => 'delete resersvation']);

        // Permission::create(['name' => 'list employees']);
        // Permission::create(['name' => 'view employees']);
        // Permission::create(['name' => 'create employees']);
        // Permission::create(['name' => 'update employees']);
        // Permission::create(['name' => 'delete employees']);

        // Permission::create(['name' => 'list menus']);
        // Permission::create(['name' => 'view menus']);
        // Permission::create(['name' => 'create menus']);
        // Permission::create(['name' => 'update menus']);
        // Permission::create(['name' => 'delete menus']);

        // Permission::create(['name' => 'list orders']);
        // Permission::create(['name' => 'view orders']);
        // Permission::create(['name' => 'create orders']);
        // Permission::create(['name' => 'update orders']);
        // Permission::create(['name' => 'delete orders']);

        // Permission::create(['name' => 'list stocks']);
        // Permission::create(['name' => 'view stocks']);
        // Permission::create(['name' => 'create stocks']);
        // Permission::create(['name' => 'update stocks']);
        // Permission::create(['name' => 'delete stocks']);

        // Permission::create(['name' => 'list tables']);
        // Permission::create(['name' => 'view tables']);
        // Permission::create(['name' => 'create tables']);
        // Permission::create(['name' => 'update tables']);
        // Permission::create(['name' => 'delete tables']);

        // Permission::create(['name' => 'list produktitipans']);
        // Permission::create(['name' => 'view produktitipans']);
        // Permission::create(['name' => 'create produktitipans']);
        // Permission::create(['name' => 'update produktitipans']);
        // Permission::create(['name' => 'delete produktitipans']);

        // Permission::create(['name' => 'list transactions']);
        // Permission::create(['name' => 'view transactions']);
        // Permission::create(['name' => 'create transactions']);
        // Permission::create(['name' => 'update transactions']);
        // Permission::create(['name' => 'delete transactions']);

        // Permission::create(['name' => 'list transactiondetails']);
        // Permission::create(['name' => 'view transactiondetails']);
        // Permission::create(['name' => 'create transactiondetails']);
        // Permission::create(['name' => 'update transactiondetails']);
        // Permission::create(['name' => 'delete transactiondetails']);

        // Permission::create(['name' => 'list types']);
        // Permission::create(['name' => 'view types']);
        // Permission::create(['name' => 'create types']);
        // Permission::create(['name' => 'update types']);
        // Permission::create(['name' => 'delete types']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('superadmin@gmail.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}