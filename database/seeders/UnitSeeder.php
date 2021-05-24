<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units=[
            ['id'=>1,'department_id'=>1,'name'=>'Infrastructure & Support'],
            ['id'=>2,'department_id'=>1,'name'=>'Information Systems'],
            ['id'=>3,'department_id'=>2,'name'=>'Marketing'],
            ['id'=>4,'department_id'=>2,'name'=>'Branding'],
            ['id'=>5,'department_id'=>3,'name'=>'Procurement'],
            ['id'=>6,'department_id'=>3,'name'=>'Human Resource'],
            ['id'=>7,'department_id'=>3,'name'=>'Administration'],
            ['id'=>7,'department_id'=>4,'name'=>'Logistics'],
            ['id'=>8,'department_id'=>5,'name'=>'Quality'],
            ['id'=>9,'department_id'=>5,'name'=>'Legal Services'],
        ];

        foreach ($units as $unit){
            Unit::updateOrCreate(['id'=>$unit['id']],$unit);
        }
    }
}
