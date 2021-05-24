<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Qualification;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'phonenumber'=> $this->faker->phoneNumber,
            //'username'=>$this->faker->userName,
            'gender'=>$this->faker->randomElement($array=array('Male','Female')),
            'idno'=>$this->faker->unique(true)->randomNumber(8),
            'email' => $this->faker->unique(true)->freeEmail,
            'qualification_id'=>Qualification::all()->random()->id
        ];
    }
}
