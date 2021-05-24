<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations=[
            ['id'=>1,'name'=>'Huduma Secretariat'],
            ['id'=>2,'name'=>'GPO'],
            ['id'=>3,'name'=>'City Square'],
            ['id'=>4,'name'=>'Kibra'],
            ['id'=>5,'name'=>'Thika'],
            ['id'=>6,'name'=>'Machakos'],
        ];

        foreach ($stations as $station){
            Station::updateOrCreate(['id'=>$station['id']],$station);

        }
    }
}
