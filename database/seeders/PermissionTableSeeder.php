<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'Default-role',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'role-updateuserrole',
           'role-romove-fromrole',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',


           'dashboard-list',
           'usermanagement-link',
           'staffmanagement-link',
           'basicsettingsmanagement-link',
           'apps-link',

          

        ];

        foreach ($permissions as $permission) {
            $str = $permission;
            $delimiter = '-';
            $words = explode($delimiter, $str);

            foreach ($words as $word) {
                if($word == "user")
                Permission::create(['name' => $permission,'title'=>"User Management"]);

                if($word == "role")
                Permission::create(['name' => $permission,'title'=>"Role Management"]);

                if($word == "permission")
                Permission::create(['name' => $permission,'title'=>"Permission Management"]);

                if($word == "dashboard")
                Permission::create(['name' => $permission,'title'=>"Dashboard Pages"]);

               
            }
            //  Permission::create(['name' => $permission]);
        }
    }
}
