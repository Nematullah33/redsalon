<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'mobile'=>$this->faker->randomNumber(),
            'country_id'=>$this->faker->randomNumber(),
            'city_id'=>$this->faker->randomNumber(),
            'area_id'=>$this->faker->randomNumber(),
            'photo'=>$this->faker->image('public/img/customer',640,480, null, false),
            'email' =>$this->faker->unique()->safeEmail,
            'company'=>$this->faker->text(10)

        ];
    }
}
