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
            ['name'=>'create employee' ],
            ['name'=>'import employees' ],
            ['name'=>'edit employee' ],
            ['name'=>'activate-deactivate employee' ],
            ['name'=>'delete employee' ],
            ['name'=>'view employee' ],

            ['name'=>'create contract' ],
            ['name'=>'edit contract' ],
            ['name'=>'activate-deactivate contract' ],
            ['name'=>'view contract' ],
            ['name'=>'view expired contracts' ],
            ['name'=>'renew contract' ],

            ['name'=>'manage category' ],
            ['name'=>'manage users' ],
            ['name'=>'manage roles' ],

            ['name'=>'manage departments' ],
            ['name'=>'manage stations' ],
            ['name'=>'manage units' ],
            ['name'=>'manage banks' ],

            ['name'=>'run payroll' ],
            ['name'=>'approve payroll' ],
            ['name'=>'view approved' ],
            ['name'=>'approve payable employees' ],

            ['name'=>'view reports' ],



        ];

        foreach ($permissions as $permission)
        {
            Permission::create($permission);
        }

       $role = Role::create(['id'=>1,'name' => 'super-admin']);
       $role->givePermissionTo(Permission::all());
    }
}
