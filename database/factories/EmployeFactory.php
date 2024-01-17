<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    
    public function definition(): array
    {
        return [
        'registerNum'=>$this->faker->randomDigit() ,
        'fullname'=>$this->faker->name() ,
        'depart'=>$this->faker->word() ,
        'date_embauche'=> $this->faker->date() ,
        'phone'=>$this->faker->numberBetween() ,
        'adr'=>$this->faker->address() ,
        'city'=>$this->faker->city() ,
        ];
    }
}
