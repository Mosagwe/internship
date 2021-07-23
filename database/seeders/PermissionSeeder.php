<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            ['name'=>'create role' ],
            ['name'=>'create permission' ],
            ['name'=>'create user' ],
            ['name'=>'run payroll' ],
            ['name'=>'approve payroll' ],
            ['name'=>'view approved' ]
        ];

        foreach ($permissions as $permission)
        {
            Permission::create($permission);
        }

       $role = Role::create(['id'=>1,'name' => 'super-admin']);
       $role->givePermissionTo(Permission::all());
    }
}
