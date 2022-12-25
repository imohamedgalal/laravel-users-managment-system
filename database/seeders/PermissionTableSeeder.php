<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'nothing',
            'show_users',
            'create_users',
            'active_disable_users',
            'edit_users',
            'delete_users',
            'show_admins',
            'create_admins',
            'edit_admins',
            'delete_admins',
            'show_logs',
            'edit_logs',
            'delete_logs',
            'show_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'show_product',
            'create_product',
            'edit_product',
            'delete_product',
            'show_agent',
            'create_agent',
            'edit_agent',
            'delete_agent',
            'show_reseller',
            'create_reseller',
            'edit_reseller',
            'delete_reseller',
            'show_payment',
            'create_payment',
            'edit_payment',
            'delete_payment',
            'show_settings',
            'edit_settings',
            'show_webapp_coins_info'
            ];
            foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            }
    }
}
