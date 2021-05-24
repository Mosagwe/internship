<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $departments=[
            ['id'=>1,'name'=>'ICT'],
            ['id'=>2,'name'=>'Marketing and Communication'],
            ['id'=>3,'name'=>'Program Management Division'],
            ['id'=>4,'name'=>'Operations'],
            ['id'=>5,'name'=>'Office of the Secretary'],
        ];

        foreach ($departments as $department){
            Department::updateOrCreate(['id'=>$department['id']],$department);
        }
    }
}
