<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class laundryFactory extends Factory
{
    protected $model = Customers::class;


    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(15),
            'phone' => $this->faker->sentence(10),
        ];
    }
}



