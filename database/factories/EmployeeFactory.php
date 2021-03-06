<?php

namespace Database\Factories;

use App\Models\Category;
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
            'employee_type_id'=>1,
            'gender'=>$this->faker->randomElement($array=array('Male','Female')),
            'idno'=>$this->faker->unique(true)->randomNumber(8),
            'email' => $this->faker->unique(true)->freeEmail,
            'qualification_id'=>Qualification::all()->random()->id,
            'category_id'=>$this->faker->randomElement($array=array(2,3,5,6,7,8,9)),
        ];
    }
}
