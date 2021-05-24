<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Station;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $start_date=$this->faker->dateTimeThisYear($max='now',$timezone = 'Africa/Nairobi');
        $end_date=Carbon::parse($start_date)->addMonths(3)->format('Y-m-d');

        return [
            'employee_id'=>$this->faker->unique()->numberBetween(1,Employee::count()),
            'employee_type'=>'casual',
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'status'=>$this->faker->boolean,
            'station_id'=>Station::all()->random()->id,
            'unit_id'=>Unit::all()->random()->id,
            'salary'=>$this->faker->randomElement($array=array('25000','20000','13000')),
            'bank_id'=>Bank::all()->random()->id,
        ];

    }
}
